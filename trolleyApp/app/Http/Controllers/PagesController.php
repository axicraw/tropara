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
use App\Checkout;
use App\Offer;
use App\Order;
use App\Resettoken;
use App\Salesstats;
use App\Viewstats;
use App\Orderreturn;
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
        $categories = Category::with('children', 'products')->where('parent_id', '=', 0)->orderBy('category_name')->get();
        $new_products = Product::with('images', 'prices', 'prices.unit')->has('images')->has('prices')->orderBy('created_at', 'desc')->take(12)->get();
        $banners = Banner::all();
      
        return view('site/home', compact('new_products', 'categories', 'banners', 'offers', 'hotpros', 'viewpros'));

    }
    public function category($catename){
        $categories = Category::with('children')->where('parent_id', '=', 0)->orderBy('category_name')->get();
        $main_category = Category::with('parent', 'children', 'children.products')->where('category_name', $catename)->firstOrFail();
        if(count($main_category->parent) > 0){
            $parent_category = Category::with('children')->findOrFail($main_category->parent->id);
        }else{
            $parent_category = null;
        }
        //dd($parent_category);
        $cate_products = Product::where('category_id', $main_category->id)
                        ->with(['images', 'prices', 'prices.unit', 'mrps'])->has('images')->has('prices')
                        ->orderBy('updated_at', 'desc')->get();
        $sub_categories = Category::with('children')->where('parent_id', $main_category->id)->lists('id');

        $sub_products = Product::whereIn('category_id',$sub_categories)
                        ->with('images', 'prices', 'prices.unit', 'mrps', 'mrps.unit')->has('images')->has('prices')
                        ->orderBy('updated_at', 'desc')->get();
        //dd($cate_products);
        return view('site/category', compact('categories', 'main_category','cate_products', 'parent_category', 'sub_products'));
    }
    public function product($id){
        $product = Product::with(['images', 'brand', 'brand.offers','prices', 'prices.unit', 'offers', 'category', 'description', 'mrps', 'mrps.unit'])->find($id);
        $main_category = Category::with(['offers', 'children', 'products'=>function($q){$q->has('images');}])->find($product->category_id);
        if(count($main_category->parent) > 0){
            $parent_category = Category::with('children')->findOrFail($main_category->parent->id);
        }else{
            $parent_category = null;
        }
        $categories = Category::with('children')->where('parent_id', '=', 0)->orderBy('category_name')->get();
        if($user = Sentinel::check())
        {
            $user_id = $user->id;
        }
        else
        {
            $user_id = 0;
        }
        //dd($main_category);
        Event::fire(new ProductViewed($user_id, $product->id));
        return view('site/product', compact('product', 'categories', 'main_category', 'parent_category'));
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
        $this->validate($request, [
            'name'=>'required',
            'address' => 'required|min:10',
            'area_id' => 'required'
        ]);
        if($user->type == 'native')
        {
            $this->validate($request, [
                'email'=> 'required|email|unique:users,email,'.$user->id, 
            ]);
        }
        else
        {
            $this->validate($request, [
                'email'=> 'required|email', 
            ]);
        }
        

        if($request->has('mobile'))
        {
            $this->validate($request, [
                'mobile' => 'required|digits:10',
            ]);
        }

        $user->fill($request->all());
        $user->save();

        if($request->has('mobile'))
        {
            return redirect()->route('getsavemobile', [
                    'mobile' => $request->mobile,
                    'id' => $user->id,
                ]);
        }

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
                            ->has('images')
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
    public function searchproducts(Request $request)
    {
        $key = $request->get('key');
        $key = urldecode($key);
        $search_products = Product::with(['category', 'images', 'brand', 'prices', 'prices.unit', 'mrps', 'mrps.unit'])
                            ->has('images')
                            ->where('product_name', 'LIKE','%'.$key.'%')
                            ->orWhere('local_name', 'LIKE','%'.$key.'%')
                            ->orWhereHas('category', function ($q) use ($key) {
                                $q->where('category_name', 'LIKE', '%'.$key.'%');
                            })
                            ->orWhereHas('brand', function ($q) use ($key) {
                                $q->where('brand_name', 'LIKE', '%'.$key.'%');
                            })
                            ->get();
        $categories = Category::with('children', 'products')->where('parent_id', '=', 0)->get();
        //dd(count($products));
        $count = count($search_products);
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
        return view('site.searchresults', compact('search_products', 'key', 'categories'));
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

    public function returnform($id)
    {
        $user = Sentinel::check();
        $user  = User::findorfail($user->id);
        $checkout = Checkout::with('orders')->where('id', $id)->first();
        $returns = Orderreturn::with('order_return', 'order_return.orders')->where('user_id', $user->id)->get();
        //dd($returns);
        return view('site.returnproduct', compact('checkout', 'returns'));
    }
    public function myreturns()
    {
        $user = Sentinel::check();
        $user  = User::findorfail($user->id);
        $returns = Orderreturn::with('order_return', 'order_return.orders', 'order_return.orders.product')->where('user_id', $user->id)->get();

        ///dd($returns);
        return view('site.myreturns', compact('returns'));
    }
    public function processreturn(Request $request)
    {
        $this->validate($request, [
            'products' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address' => 'required',
            'reason' => 'required'
        ]);
        $order_ids = $request->get('products');
        $orders = Order::whereIn('id', $order_ids)->get();
        $user = Sentinel::check();
        $user = User::findorfail($user->id);

        $return_inputs = [
            'user_id' => $user->id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'address' => $request->get('address'),
            'area_id' => $user->area_id,
            'reason' => $request->get('reason'),
            'status' => 'Booked'
        ];

        //dd($return_inputs);
        $return  = Orderreturn::Create($return_inputs);

        if($return)
        {
            $returns = [];
            foreach($orders as $order)
            {
                array_push($returns, [
                    'order_id' => $order->id,
                    'return_id' => $return->id,
                ]);
            }
            DB::table('order_return')->insert($returns);
        }

        $notification = "Sorry! We regret you did not like these products.These products you have selected has been registered for return. Our staff will reach to you and receive those products. Kindly dont not consume the product and make it ready for pickup. Thank you.";
        return view('site.notification', compact('notification'));
    }
    
    public function orderdetail($id)
    {
        $checkout = Checkout::with('orders', 'orders.product')->findorfail($id);
        return view('site.myorderdetail', compact('checkout'));
    }

    public function contactus(){
        return view('site.contact');
    }

    public function justvisit(Request $request){
        $set = $request->session()->put('vistor', 'true');
        //dd($set);
        return back();
    }
}
