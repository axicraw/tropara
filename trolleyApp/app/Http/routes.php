<?php
	use App\Image;
	use App\Product;
	use App\Http\Requests;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/mainten', ['middleware'=>'mainten',function(){

// }]);

/**
 * Auth
 */
Route::post('authenticate',['as'=>'authenticate', 'uses'=>'AuthController@authenticate']);
Route::get('/login',['as'=>'login', 'uses'=>'AuthController@login']);
Route::get('/logout',['as'=>'logout', 'uses'=>'AuthController@logout']);
Route::post('register',['as'=>'register', 'uses'=>'AuthController@register']);
Route::get('/registration/success',['as'=>'register', 'uses'=>'PagesController@registersuccess']);
Route::get('/getpin', ['as'=>'getpin', 'uses'=>'AuthController@getpin']);
Route::get('/sendpinagain', ['as'=>'resendpin', 'uses'=>'AuthController@resendpin']);
//Route::post('/resendpinAfterMobile', ['as'=>'resendpinAfterMobile', 'uses'=>'AuthController@resendpinAfterMobile']);
Route::get('/changemobile', 'AuthController@changemobile');
Route::get('/savemobile', ['as'=>'getsavemobile', 'uses'=>'AuthController@savemobile']);
Route::post('/savemobile', ['as'=>'savemobile', 'uses'=>'AuthController@savemobile']);
Route::post('/activateuser', ['as'=>'activateuser','uses'=>'AuthController@doactivation']);
Route::group(['prefix' => 'admin'], function () {
	Route::post('authenticate',['as'=>'admin_authenticate', 'uses'=>'AuthController@admin_authenticate']);
	Route::get('/logout',['as'=>'admin_logout', 'uses'=>'AuthController@admin_logout']);
});
Route::group(['prefix'=>'authsocial'], function(){
	Route::get('/login/{type}',['as'=>'social.login', 'uses'=>'AuthController@redirectToProvider']);
	Route::get('/{type}/callback',['as'=>'social.callback', 'uses'=>'AuthController@handleProviderCallback']);
});

/***
** site pages
**/

Route::get('/', ['as'=>'home', 'uses'=>'PagesController@index']);
Route::get('/category/{cate_name}', ['as'=>'category', 'uses'=>'PagesController@category']);
Route::get('/product/{id}', ['as'=>'product', 'uses'=>'PagesController@product']);
Route::post('/changeArea', ['as'=>'change.area', 'uses'=>'CartController@changeArea']);
Route::get('/mainsearch', ['as'=>'mainsearch', 'uses'=>'PagesController@mainsearch']);
Route::get('/forgotpassword', ['as'=>'forgotpassword', 'uses'=>'PagesController@forgotpassword']);
Route::post('/forgotpassword', ['as'=>'forgotconfirm', 'uses'=>'PagesController@forgotconfirm']);
Route::get('/resetpassword', ['as'=>'receivereset', 'uses'=>'PagesController@receivereset']);
Route::post('/resetpassword', ['as'=>'resetpassword', 'uses'=>'PagesController@newpassword']);
Route::get('/productreturn/{id}', ['as'=>'returnform', 'uses'=>'PagesController@returnform']);
Route::post('/processreturn', ['as'=>'processreturn', 'uses'=>'PagesController@processreturn']);
Route::get('/myorder/{id}', ['as'=>'orderdetail', 'uses'=>'PagesController@orderdetail']);
Route::get('/contact', ['as'=>'contactus', 'uses'=>'PagesController@contactus']);
Route::get('/justvisit', ['as'=>'contactus', 'uses'=>'PagesController@justvisit']);
Route::get('/searchproducts', ['as'=>'searchproducts', 'uses'=>'PagesController@searchproducts']);
Route::post('/newfeedback', ['as'=>'newfeedback','middleware' => 'customer', 'uses'=>'ActionController@newfeedback']);

/***
** plain pages
**/

Route::get('/termsandconditions', 'PlainController@terms');
Route::get('/privacy', 'PlainController@privacy');
Route::get('/shipping', 'PlainController@shipping');


/***
*CART
*/
Route::group(['prefix' => 'cart'], function(){
	Route::get('/add/{prodID}/{priceID}', 'CartController@addP2C');
	Route::post('/updateNos', 'CartController@updateNos');
	Route::get('/remove/{id}', 'CartController@remove');
	Route::get('/view', ['as'=>'cart.view','uses'=>'CartController@view']);
	Route::get('/checkout', ['as'=>'cart.checkout','middleware' => 'customer', 'uses'=>'CartController@checkout']);
	Route::get('/paymentmode', ['as'=>'cart.paymentmode','middleware' => 'customer', 'uses'=>'CartController@paymentmode']);
	Route::get('/get', 'CartController@get');
	Route::post('/changeaddress',['as'=>'cart.changeaddress','middleware' => 'customer', 'uses'=>'CartController@changeaddress']);
	Route::get('/myaddress',['middleware' => 'customer', 'uses'=>'CartController@myaddress']);
	Route::get('/confirmorder/{id}',['as'=>'cart.confirmorder','middleware' => 'customer', 'uses'=>'CartController@confirmOrder']);
	Route::get('/orderplaced',['as'=>'cart.orderplaced','middleware' => 'customer', 'uses'=>'CartController@orderplaced']);

});
/***
*User Account
*/
Route::group(['prefix' => 'account', 'middleware'=>'customer'], function(){
	Route::get('/',['as'=>'myaccount', 'uses'=>'PagesController@myaccount']);
	Route::get('/myreturns', 'PagesController@myreturns');
	Route::post('/saveaccount',['as'=>'account.save', 'uses'=>'PagesController@saveaccount']);
	Route::get('/myorders', ['as'=>'myorders', 'uses'=>'PagesController@myorders']);
	Route::post('/changepassword', ['as'=>'account.changepassword', 'uses'=>'PagesController@changepassword']);
	Route::get('/tempcart', 'CartController@tempcart');

});
/***
*AdminPanel
*/
Route::get('/trolleyinoverseer', ['as'=>'adminlogin', 'uses'=>'AuthController@adminlogin']);
Route::post('/trolleyinoverseer', ['as'=>'adminauth', 'uses'=>'AuthController@adminauth']);
Route::get('/staff', ['as'=>'stafflogin', 'uses'=>'AuthController@stafflogin']);
// Route::get('/staff/logout', ['as'=>'stafflogout', 'uses'=>'AuthController@stafflogout']);
// Route::post('/staff', ['as'=>'staffauth', 'uses'=>'AuthController@staffauth']);

Route::group(['prefix' => 'admin/order', 'middleware' => ['admin', 'staff']], function(){
	//order
	Route::get('/returns',['as'=>'admin.returns', 'uses'=>'OrderController@returns']);
	Route::get('/returns/status/{id}/{status}', 'OrderController@returnsstatus');
	Route::get('/', ['as'=>'orders', 'uses'=>'OrderController@index']);
	Route::get('/{id}', 'OrderController@listItems');
	Route::get('/changestatus/{id}/{status}', 'OrderController@changeStatus');
	Route::get('/print/{id}', 'OrderController@printItems');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

	//dashboard
	// Route::get('/admin/logout', ['as'=>'adminlogout', 'uses'=>'AuthController@adminlogout']);
	Route::get('/dashboard', ['as'=>'dashboard', 'middleware'=>'admin', 'uses'=>'ApanelController@index']);
	Route::get('/voidsearch', 'SettingsController@voidsearch');

	Route::get('/globalsettings', ['as'=>'admin.settings', 'uses'=>'SettingsController@globalsettings']);
	Route::post('/storesettings', ['as'=>'admin.settings.store', 'uses'=>'SettingsController@storesettings']);

	//users
	Route::get('/user', ['as'=>'admin.user', 'uses'=>'UserController@index']);
	Route::get('/user/staff/add', ['as'=>'admin.addstaff', 'uses'=>'UserController@addStaff']);
	Route::post('/user/staff/add', ['as'=>'admin.storestaff', 'uses'=>'UserController@storeStaff']);
	Route::get('/user/staff/{id}', ['as'=>'admin.addstaff', 'uses'=>'UserController@showStaff']);
	Route::put('/user/staff/{id}', ['as'=>'admin.updatestaff', 'uses'=>'UserController@updateStaff']);
	Route::get('/user/admin/add', ['as'=>'admin.addadmin', 'uses'=>'UserController@addAdmin']);
	Route::post('/user/admin/add', ['as'=>'admin.storeadmin', 'uses'=>'UserController@storeAdmin']);
	Route::get('/user/suspend/{id}', 'UserController@suspend');
	Route::get('/user/activate/{id}', 'UserController@activate');
	Route::get('/user/allowcod/{id}', 'UserController@allowcod');
	Route::get('/user/blockcod/{id}', 'UserController@blockcod');
	//Route::post('/user/delete/{id}', ['as'=>'admin.user.destroy', 'uses'=>'UserController@index']);

	//categories
	Route::resource('/category', 'CategoriesController');
	Route::post('/category/add', 'CategoriesController@add');


	//offers
	Route::resource('/offer', 'OfferController', ['only' => ['destroy']]);
	Route::get('/offer/create', 'OfferController@create');
	Route::get('/offer', ['as'=>'admin.offers', 'uses'=>'OfferController@index']);
	Route::get('/offer/{id}',['as'=>'admin.offer.show', 'uses'=>'OfferController@show']);
	Route::put('/offer/update/{id}',['as'=>'admin.offer.update', 'uses'=>'OfferController@update']);
	Route::post('/offer/store/{id}',['as'=>'admin.offer.store', 'uses'=>'OfferController@store']);

	Route::get('/offer/data/sync', 'OfferController@ajax_search');

	//brands
	Route::resource('/brand', 'BrandController');
	Route::post('/brand/add', 'BrandController@add');

	//banners
	Route::resource('/banner', 'BannersController');
	//flashtext
	Route::resource('/flashtext', 'FlashtextController');
	//areas
	Route::resource('/area', 'AreaController');
	//delivery
	Route::resource('/delivery', 'DeliveryController');

	//products
	Route::resource('/product', 'ProductController');
	Route::get('/product/search/{key}/', 'ProductController@search');
	Route::get('/product/delete/{id}/', 'ProductController@destroy');
	Route::put('/product/updatePrice/{id}', 'ProductController@updatePrice');
	Route::put('/product/updateMrp/{id}', 'ProductController@updateMrp');
	Route::post('/product/createPrice', 'ProductController@createPrice');
	Route::post('/product/createMrp', 'ProductController@createMrp');
	Route::delete('/product/deletePrice/{id}', 'ProductController@deletePrice');
	Route::delete('/product/deleteMrp/{id}', 'ProductController@deleteMrp');
	Route::get('/product/{id}/prices', 'ProductController@getprices');
	Route::get('/product/{id}/mrp', 'ProductController@getmrp');
	Route::delete('/product/deleteImage/{prod_id}/{image_id}', 'ProductController@deleteImage');
	Route::post('/product/updateImage', 'ProductController@updateImage');
	Route::get('/product/pagin/{id}/', 'ProductController@pagin');
	Route::get('/product/pagin/{id}/{direction}/', 'ProductController@pagindirection');

	//general
//	Route::get('initRoles', 'GeneralController@initRoles');
//	Route::get('initAdmin', 'GeneralController@initAdmin');

    
});

Route::get('initApp', 'GeneralController@initApp');


