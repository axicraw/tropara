<?php

namespace App\Http\Controllers;

use Log;
use Sentinel;
use Activation;
use Socialite;
use Event;
use Session;
use Cart;
use DB;
use Illuminate\Support\MessageBag;
use App\Flashtext;
use App\Area;
use App\Events\LoggedIn;
use App\Events\SocialLogin;
use App\Events\NewRegistration;
use App\Events\ResendPin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function authenticate(Request $request){
        
        $this->validate($request, [
            'email'=> 'required|email', 'password'=>'required',
        ]);
        $user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $logged = Sentinel::authenticate($user);

        $user = Sentinel::getUser();
        $customer = Sentinel::findRoleBySlug('customer');
        //checks if user

        if($logged) //create temp cart
        {
          //check if user is activated
          $activation = Activation::exists($user);
          if(!$activation)
          {

            if(Sentinel::inRole($customer)) ///check if is customer
            {
               $user = Sentinel::check();
               $user = User::findorfail($user->id);
               $request->session()->put('deli_area', $user->area_id);
               $temporders = $user->tempcart()->get();
               Event::fire(new LoggedIn($user));
               if($request->ajax())
               {
                  return response()->json($logged);
               }
               //dd($request->session());
               return redirect()->intended();
            }
            else  //if not a customer
            {
              Sentinel::logout();
              if($request->ajax()){
                  return response()->json(['error'=>'you are not a customer'], 422);
              }
              return back()->withErrors();            
            }
          }
          else //if not activated
          {
            return redirect()->route('getpin', ['id'=>$user->id]);
            //$notification = "";
            //return view('notification', compact('notification'));
          }
        }
        else  //if not loggedin
        {
          if($request->ajax())
          {
            return response()->json(['serror'=>'Invalid Email and Password Combination!'], 422);
          }
          $errors = new MessageBag(['password'=>'Invalid Email and Password Combination!']);
          return redirect()->back()->withInput()->withErrors($errors);   
        }
    }

    public function adminlogin()
    {
      return view('site/adminlogin');
    }
   
    public function adminauth(Request $request){
      $this->validate($request, [
        'email'=>'email|required',
        'password'=>'required'
      ]);
      $user = [
          'email' => $request->input('email'),
          'password' => $request->input('password')
      ];
      $logged = Sentinel::authenticate($user);

      $user = Sentinel::getUser();
      //checks if user

      if($logged) //create temp cart
      {
        if(Sentinel::inRole('admin')) ///check if is customer
        {
          return redirect()->route('dashboard');
        }
        else
        {
          Sentinel::logout();
        }
      }
      //dd('not logged in');
      $errors = new MessageBag(['password'=>'Invalid Login Credentials']);
      return redirect()->back()->withInput()->withErrors($errors);
    }  

    public function stafflogin()
    {
      return view('site/stafflogin');
    }
      
    public function staffauth(Request $request){
      $this->validate($request, [
        'email'=>'email|required',
        'password'=>'required'
      ]);
      $user = [
          'email' => $request->input('email'),
          'password' => $request->input('password')
      ];
      $logged = Sentinel::authenticate($user);

      $user = Sentinel::getUser();
      //checks if user

      if($logged) //create temp cart
      {
        if(Sentinel::inRole('staff')) ///check if is customer
        {
          //return ('you are staff');
          return redirect()->route('orders');
        }
        else
        {
          Sentinel::logout();
        }
      }
      //dd('not logged in');
      $errors = new MessageBag(['password'=>'Invalid Login Credentials']);
      return redirect()->back()->withInput()->withErrors($errors)->withInput();
    }

    public function logout(){
        if(Sentinel::inRole('staff')) ///check if is customer
        {
          $redirect = 'stafflogin';
          Sentinel::logout();
          return redirect()->route($redirect);
        }
        elseif(Sentinel::inRole('admin')) ///check if is customer
        {
          $redirect = 'adminlogin';
          Sentinel::logout();
          return redirect()->route($redirect);
        }
        Sentinel::logout();
        Cart::destroy();
        return redirect()->back();
    }

    //ajaxx post for user registration
    public function register(Request $request){

        $this->validate($request, [
            'email'=> 'required|email|unique:users,email|max:255', 
            'password'=>'required|min:6|max:32|confirmed',
            'password_confirmation'=>'same:password',
            'mobile'=>'required|digits:10',
            'terms'=>'required'
        ]);

        //dd($request);
        $new_user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $registered = Sentinel::register($new_user);
        if($registered){
          $user = User::find($registered->id);
          $user->mobile = $request->mobile;
          $user->area_id = $request->area_id;
          $user->type = 'native';
          $user->active = 0;
          $user->cod = 1;
          $user->save();
          $role = Sentinel::findRoleBySlug('customer');
          $role->users()->attach($user);
          Event::fire(new NewRegistration($user));
          //return $registered;
        }
        if($request->ajax())
        {
          return response()->json($registered);
        }
        return back();
    }

    public function login(Request $request){

        if(!Sentinel::check())
        {
          $flashes = Flashtext::where('active', '1')->get();
          $areas = Area::where('deliverable', '1')->get();
          
          if($redirect = $request->get('redirect'))
          {
              $request->session()->put('redirect', $redirect);
          }
          //dd($request->session()->get('redirect'));
          return view('site/login', compact('flashtext', 'areas'));
        }
        return back();
    }

    /************* Social logins ********************/


    /**
        * Redirect the user to the GitHub authentication page.
        *
        * @return Response
        */
       public function redirectToProvider($type)
       {
           return Socialite::driver($type)->redirect();
       }

       /**
        * Obtain the user information from GitHub.
        *
        * @return Response
        */
   public function handleProviderCallback($type)
   {
     
       $user = Socialite::driver($type)->user();

       //dd($user->getID());
       $user_cred = [
           'social_id' => $user->getID(),
           'name' => $user->getName(),
           'email' => $user->getEmail(),
        ];
       switch($type){
            case 'facebook':
                $user_cred['type'] = 'facebook';
            break;
            case 'twitter':
                $user_cred['type'] = 'twitter';
            break;
            case 'google':
                 $user_cred['type'] = 'google';
            break;
            default:
                $user_cred['type'] = 'unkown';
            break;
       }
      $response = Event::fire(new SocialLogin($user_cred));
      $user = $response[0];

      $user = Sentinel::findById($user->id);
      //if()
      Sentinel::login($user);
      return redirect()->route('home');
  }

  public function getpin(Request $request)
  {

    $user_id = $request->get('id');
    $user = Sentinel::findById($user_id);
    return view('site.useractivate', compact('user'));
  }
  public function resendpin(Request $request)
  {

    $user_id = $request->get('id');
    $user = Sentinel::findById($user_id);

    $threshold = DB::table('activations')->where('user_id', $user_id)->get();
    if(count($threshold) > 3){
      $errors = new MessageBag(['pin'=>'Sorry no more sms can be sent to this customer.']);
      return redirect()->route('getpin', ['id'=>$user_id])->withErrors($errors);
    }
    else
    {
      Event::fire(new ResendPin($user));
    }
    $success = 'Sms has been sent again';
    return view('site.useractivate', compact('user', 'success'));
  }
 
  public function changemobile(Request $request)
  {

    $user_id = $request->get('id');
    $user = Sentinel::findById($user_id);
    return view('site.changemobile', compact('user'));
  }   
  public function savemobile(Request $request)
  {
    $this->validate($request, [
        'mobile' => 'required | digits:10'
      ]);
    $user = User::findorfail($request->id);
    $user->mobile = $request->mobile;
    $user->save();

    return redirect()->route('resendpin', ['id'=> $user->id]);
  }   
  public function doactivation(Request $request)
  {
    $this->validate($request, [
        'pin'=>'required | digits:6'
      ]);
    $user = Sentinel::findById($request->get('id'));
    $pin = $request->get('pin');
    $activate = Activation::complete($user, $pin);
    if($activate)
    {
        $notification = 'Your account has been successfully activated. Login from <a href="/login"><i clas="fa fa-sign-in"></i> here.</a>';
        return view('site.notification', compact('notification'));
    }
    else
    {
        $errors = new MessageBag(['pin'=>'Invalid PIN. Try Again.']);
        return redirect()->back()->withInput()->withErrors($errors);
    }
  }      
}
