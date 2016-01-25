<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
use Event;
use Hash;
use DB;
use Carbon\Carbon;
use App\Flashtext;
use App\Area;
use App\User;
use App\Banner;
use App\Category;
use App\Product;
use App\Offer;
use App\Resettoken;
use App\Salesstats;
use App\Viewstats;
use App\Events\VoidSearch;
use App\Events\ForgotPassword;
use App\Events\ProductViewed;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->session()->all());
        $categories = Category::with('children')->where('parent_id', '=', 0)->get();
        $new_products = Product::with('images', 'prices', 'prices.unit')->has('images')->orderBy('created_at', 'desc')->take(8)->get();
        $banners = Banner::all();

      
        return view('site/home', compact('new_products', 'categories', 'banners', 'offers', 'hotpros', 'viewpros'));

    }

    public function category($catename){
        $categories = Category::all();
        $main_category = Category::with('parent', 'children', 'children.products')->where('category_name', $catename)->firstOrFail();
        $cate_products = Product::where('category_id', $main_category->id)
                        ->with('images', 'prices', 'prices.unit')->has('images')
                        ->orderBy('updated_at', 'desc')->get();
        $sub_categories = Category::with('children')->where('parent_id', $main_category->id)->lists('id');
        //dd($sub_categories);
        $sub_products = Product::whereIn('category_id',$sub_categories)
                        ->with('images', 'prices', 'prices.unit')->has('images')
                        ->orderBy('updated_at', 'desc')->get();
        return view('site/category', compact('categories', 'main_category','cate_products', 'sub_products'));
    }
    public function product($id){
        $product = Product::with('images', 'brand', 'prices', 'prices.unit', 'offers', 'category')->find($id);
        $main_category = Category::with('offers', 'children', 'products')->find($product->category_id);
        $categories = Category::all();
        if($user = Sentinel::check())
        {
            $user_id = $user->id;
        }
        else
        {
            $user_id = 0;
        }
        Event::fire(new ProductViewed($user_id, $product->id));
        return view('site/product', compact('product', 'categories', 'main_category'));
    }

    public function myaccount(Request $request){
        $user = Sentinel::check();
        $user = User::findorfail($user->id);

        //check for redirects and store
        if($redirect = $request->get('redirect'))
        {
            $request->session()->put('redirect', $redirect);
        }

        return view('site.account', compact('user'));
    }

    public function saveaccount(Request $request)
    {
        $user = Sentinel::check();
        $user = User::findorfail($user->id);
        $user->fill($request->all());
        $user->save();

        //redirecting
        if($request->session()->has('redirect'))
        {
            $redirect = $request->session()->pull('redirect');
            return redirect($redirect);
        }
        $toast = [
                    'type' => 'success',
                    'text' => 'Sucessfully saved profile changes.'
                ];
        return redirect()->route('home');
    }

    public function changepassword(Request $request)
    {

        $this->validate($request, [
            'password'=>'required',
            'capssword'=>'same.password'
        ]);
        $user = Sentinel::check();
        $data = ['password'=>$request->password]; 
        $user = Sentinel::update($user, $data);
        return redirect()->route('myaccount');
    }

    public function myorders()
    {
        $user = Sentinel::check();
        $user = User::with('checkouts', 'checkouts.orders', 'checkouts.orders.product')->findorfail($user->id);
        
        return view('site.myorders', compact('user'));
    }

    public function mainsearch(Request $request)
    {
        $key = $request->get('search');
        $products = Product::with('category', 'brand', 'prices', 'prices.unit', 'images')
                            ->where('product_name', 'LIKE','%'.$key.'%')
                            ->orWhere('local_name', 'LIKE','%'.$key.'%')
                            ->orWhereHas('category', function ($q) use ($key) {
                                $q->where('category_name', 'LIKE', '%'.$key.'%');
                            })
                            ->orWhereHas('brand', function ($q) use ($key) {
                                $q->where('brand_name', 'LIKE', '%'.$key.'%');
                            })
                            ->get();
        //dd(count($products));
        $count = count($products);
        if($count < 1)
        {
            if($user = Sentinel::check())
            {
                $user = User::findorfail($user->id);
            }
            else
            {   
                $user = User::findorfail(1);
            }
            //dd($user);
            Event::fire(new VoidSearch($user, $key));
            //fire command to store this keyword
        }
        return response()->json(['products'=>$products, 'count'=>$count]);
    }

    public function registersuccess(){
        $notification = 'Welcome to Trolleyin. You have been sucessfully registered. Login from <a href="/login">here</a>';
        //dd($notification);
        return view('site.notification', compact('notification'));
    }


    public function forgotpassword()
    {

        return view('site.forgotpassword');
    }

    public function forgotconfirm(Request $request)
    {
        $this->validate($request,['email'=>'required']);
        $user = User::where('email', $request->email)->first();

        if($user)
        {

            Event::fire(new ForgotPassword($user));
            $notification = "An email has been sent to your email account. Click the reset link inside it to reset your password.";
            return view('site.notification', compact('notification'));
        }
        $errors = new MessageBag(['password'=>'This email id is not registered with Trolleyin.com.']);
        return redirect()->back()->withInput()->withErrors($errors)->withInput();

    }

    public function receivereset(Request $request)
    {
        $token = $request->get('token');
        $reset = Resettoken::where('token', '=', $token)->firstorfail();

        $user  = User::findorfail($reset->user_id);
        if($reset)
        {
            return view('site.newpassword', compact('user', 'token'));
        }
        abort(404);
    }
    public function newpassword(Request $request)
    {
        $this->validate($request, [
            'password'=>'required|min:6|max:32|confirmed',
            'password_confirmation'=>'required',
        ]);
        $user_id = $request->user_id;
        $token  = $request->token;

        //dd($request->all());

        $gettoken = Resettoken::where('token', $token)
                                ->where('user_id', $user_id)->first();
        //dd($gettoken);
        if($gettoken)
        {
            $user = User::findorfail($user_id);
            $user->password = Hash::make($request->password);
            $user->save();
            //Resettoken::destroy($gettoken->id);
            return redirect()->route('login')->with(['toasttext'=>'Successfully changed password', 'toasttype'=>'success']);
        }

        $errors = new MessageBag(['password'=>'something went wrong']);
        return redirect()->back()->withInput()->withErrors($errors)->withInput();

    }

}
