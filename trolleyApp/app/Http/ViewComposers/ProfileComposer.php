<?php

namespace App\Http\ViewComposers;

use Sentinel;
use Carbon\Carbon;
use DB;
use App\Feedback;
use App\User;
use App\Area;
use App\Offer;
use App\Product;
use App\Salesstats;
use App\Viewstats;
use App\Flashtext;
use App\Category;
use Illuminate\Contracts\View\View;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        //$this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Category::with('children', 'products')->where('parent_id', '=', 0)->orderBy('did')->get();
        $hotpros_id = Salesstats::groupBy('product_id')->take(16)->get();
        $hotpros_id = $hotpros_id->lists('product_id');
        $hotpros = Product::with('images')->has('images')->has('prices')->wherein('id', $hotpros_id)->take(16)->get();

        $globals = DB::table('globalsettings')->get();
        $dts = DB::table('deliverytimes')->where('active', true)->get();
        foreach($dts as $dt)
        {
            $dt->start =Carbon::parse($dt->start)->format('h:ia');
            $dt->stop = Carbon::parse($dt->stop)->format('h:ia');
        }
        $settings = [];
        foreach ($globals as $global) {
            $name = $global->name;
            $value = $global->value;
            $settings[$name] = $value;
        }

        $offers = Offer::with(['categories', 
                    'categories.products'=>function($q){$q->has('images');}, 
                    'brands', 'brands.products'=>function($q){$q->has('images');},
                    'products'=>function($q){$q->has('images');}, 
                    'products.images', 'products.prices'])
                    ->where('active', true)
                    ->where('start', '<=', Carbon::today()->toDateString())
                    ->where('end', '>=', Carbon::today()->toDateString())
                    ->take(16)->get();
        //dd($offers);
        $feedbacks = Feedback::with('user')->take(8)->get();

        if($user = Sentinel::check())
        {
            $user = User::findorfail($user->id);
            $flashes = Flashtext::where('active', '1')->get();
            $areas = Area::where('deliverable', '1')->get();
            $viewpros_id = Viewstats::where('user_id', $user->id)->take(16)->get();
            //dd($viewpros_id);
            $viewpros_id = $viewpros_id->lists('product_id');
            $viewpros = Product::with('images')->has('images')->has('prices')->wherein('id', $viewpros_id)->take(16)->get();
            $view->with([
                'user' => $user,
                'flashes'=> $flashes,
                'areas'=> $areas,
                'hotpros'=>$hotpros,
                'viewpros'=>$viewpros,
                'offers'=>$offers,
                'settings'=>$settings,
                'dts'=>$dts,
                'feedbacks'=>$feedbacks,
                'categories'=>$categories
                ]);
        }
        else
        {
            $flashes = Flashtext::where('active', '1')->get();
            $areas = Area::where('deliverable', '1')->get();
            $viewpros_id = Viewstats::where('user_id', 0)->take(16)->get();
            $viewpros_id = $viewpros_id->lists('product_id');
            $viewpros = Product::with('images')->has('images')->has('prices')->wherein('id', $viewpros_id)->take(16)->get();
            $view->with([
                'flashes'=> $flashes,
                'areas'=> $areas,
                'hotpros'=>$hotpros,
                'viewpros'=>$viewpros,
                'offers'=>$offers,
                'settings'=>$settings,
                'dts'=>$dts,
                'feedbacks'=>$feedbacks,
                'categories'=>$categories
                ]);
        }
    }
}