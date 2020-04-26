<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Auth::routes();
Auth::routes(['verify' => true]);
Route::resource('/comment', 'CommentController');
// Route::get('/comment/show/{id}', 'CommentController@show')->name('comment.show');


Route::resource('/details', 'ChangePasswordController');
Route::post('/user/changaddress', 'ChangePasswordController@postChangeAddress')->name('change_address');
Route::get('/user/account/profile', 'ChangePasswordController@edit')->name('details.profile');
Route::get('/password', 'ChangePasswordController@index')->name('password');

//Change email
Route::get('/user/account/email/', 'ChangePasswordController@getEmailVerify')->name('email');
Route::post('/user/account/email/', 'ChangePasswordController@postEmailVerify')->name('verifyemail')->middleware('verified');

//Change phone
Route::get('/user/account/phone/', 'ChangePasswordController@getUpdatePhone')->name('phoneNumber');
Route::post('/user/account/phone/', 'ChangePasswordController@postUpdatePhone')->name('verifyPhone');

//layouts
Route::get('/', 'ShoesController@home')->name('shoesHome');
Route::get('/shoesHome', 'ShoesController@home')->name('shoesHome');
Route::get('/cart', 'ShoesController@cart')->name('cart');
Route::get('/blog/{id}', 'ShoesController@blogsingle')->name('blog-single');
Route::get('/shop', 'ShoesController@shop')->name('shop');
Route::get('/getDetailProduct', 'ShoesController@getDetailProduct')->name('getDetailProduct');
//Find bill in page your order
Route::get('/bills/search/{id}', 'ShoesController@findbill')->name('find.bills');

// Route::get('/loginshoes', 'ShoesController@login')->name('loginshoes');
Route::get('/blog', 'ShoesController@blog')->name('blog');
// Route::get('/checkout', 'ShoesController@checkout')->name('checkoutGet');

Route::get('/product/detail/{id}', 'ShoesController@productdetail')->name('productdetail');

Route::get('/contact', 'ShoesController@contact')->name('contact');
Route::get('/error', 'ShoesController@error')->name('error');
//Add cart
Route::resource('/cartt', 'CartController');
Route::post('/cartt', 'CartController@store')->name('cartt.store')->middleware('verified');
Route::get('/remove/cart/{id}', 'CartController@deleteCart')->name('deleteCart');
Route::post('/checkout1', 'CartController@checkout')->name('checkoutPost');
Route::get('/addCartPost/{id}/{qty}/{check}/{size}', 'CartController@addCartPost')->name('addCartPost');
Route::get('/saveCart/{id}/{quantity}', 'CartController@saveListItemCart')->name('saveListItemCart');
Route::get('/deleteListCart/{id}', 'CartController@deleteListCart')->name('deleteListCart');
Route::get('/updateDeleteListCart', 'CartController@updateDeleteListCart')->name('updateDeleteListCart');

//login-shoes
Route::get('/loginshoes', 'Auth\LoginController@showLogin')->name('loginshoes');

Route::post('signin', 'Auth\LoginController@doLogin');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

//home-admin
Route::get('/home', 'HomeController@index')->name('home');
//product
Route::resource('/product', 'ProductController');
Route::get('/trash-product', 'ProductController@trashed')->name('product.trash');
Route::get('/product/{id}/restore', 'ProductController@restore')->name('product.restore');
Route::get('/product-restore-all', 'ProductController@restoreAll')->name('product.restore-all');
Route::get('/product/{id}/delete', 'ProductController@delete')->name('product.delete');
Route::get('/product-delete-all', 'ProductController@deleteAll')->name('product.delete-all');
Route::get('/new/{id}', 'ProductController@news')->name('product.new');
Route::get('/new/trash/{id}', 'ProductsController@newsTrash')->name('product.newTrash');

Route::get('qty/{id}', 'ProductController@qtyGet')->name('qtyGet');
Route::post('qty/{id}', 'ProductController@qtyPost')->name('qtyPost');

//producer
Route::resource('/producer', 'ProducerController');
Route::get('/trash-producer', 'ProducerController@trashed')->name('producer.trash');
Route::get('/producer/{id}/restore', 'ProducerController@restore')->name('producer.restore');
Route::get('/producer-restore-all', 'ProducerController@restoreAll')->name('producer.restore-all');
Route::get('/producer/{id}/delete', 'ProducerController@delete')->name('producer.delete');
Route::get('/producer-delete-all', 'ProducerController@deleteAll')->name('producer.delete-all');
Auth::routes();

//user
Route::resource('/users', 'UsersController');


//type
Route::resource('/type', 'TypeController');
Route::get('/trash-type', 'TypeController@trashed')->name('type.trash');
Route::get('/type/{id}/restore', 'TypeController@restore')->name('type.restore');
Route::get('/type-restore-all', 'TypeController@restoreAll')->name('type.restore-all');
Route::get('/type/{id}/delete', 'TypeController@delete')->name('type.delete');
Route::get('/type-delete-all', 'TypeController@deleteAll')->name('type.delete-all');

//Customer
Route::resource('/customer', 'CustomerController');
Route::get('/trash-customer', 'CustomerController@trashed')->name('customer.trash');
Route::get('/customer/{id}/restore', 'CustomerController@restore')->name('customer.restore');
Route::get('/customer-restore-all', 'CustomerController@restoreAll')->name('customer.restore-all');
Route::get('/customer/{id}/delete', 'CustomerController@delete')->name('customer.delete');
Route::get('/customer-delete-all', 'CustomerController@deleteAll')->name('customer.delete-all');
Route::get('/active-customer/{id}', 'CustomerController@active')->name('customer.active');

//Bills
Route::resource('/bills', 'BillsController');
Route::get('/trash-bills', 'BillsController@trashed')->name('bills.trash');
Route::get('/bills/{id}/restore', 'BillsController@restore')->name('bills.restore');
Route::get('/bills-restore-all', 'BillsController@restoreAll')->name('bills.restore-all');
Route::get('/bills/{id}/delete', 'BillsController@delete')->name('bills.delete');
Route::get('/bills-delete-all', 'BillsController@deleteAll')->name('bills.delete-all');
Route::get('/bills/paymoney/{id}', 'BillsController@pay_money')->name('bills.pay_money');
Route::get('/bills/status/{id}', 'BillsController@status')->name('bills.status');
Route::get('/bills/detail/status/{id}', 'BillsController@statusDetailBills')->name('bills.statusDetailBills');
Route::get('/bills/detail/{id}', 'BillsController@detailBills')->name('bills.details');

//Bill detail
Route::resource('/billDetail', 'BillDetailController');
Route::get('/trash/billDetail/{id}', 'BillDetailController@trashed')->name('billDetail.trash');
Route::get('/billDetail/restore/{id}', 'BillDetailController@restore')->name('billDetail.restore');
Route::get('/billDetail-restore-all', 'BillDetailController@restoreAll')->name('billDetail.restore-all');
Route::get('/billDetail/delete/{id}', 'BillDetailController@delete')->name('billDetail.delete');
Route::get('/billDetail-delete-all', 'BillDetailController@deleteAll')->name('billDetail.delete-all');

//post
Route::resource('/posts', 'PostsControllers');
Route::get('/search', 'PostsControllers@search')->name('posts.search');

//slide-image
Route::resource('/slide', 'SlideController');

// route to show the logout form
// Route::get('/logout', 'LoginController@logout')->name('logout');

//dashboard-admin
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/errors', 'DashboardController@error404')->name('error404');
Route::get('/button', 'DashboardController@button')->name('button');
Route::get('/card', 'DashboardController@card')->name('card');
Route::get('/chart', 'DashboardController@chart')->name('chart');
Route::get('/table', 'DashboardController@table')->name('table');
Route::get('/animation', 'DashboardController@animation')->name('animation');
Route::get('/border', 'DashboardController@border')->name('border');
Route::get('/color', 'DashboardController@color')->name('color');
Route::get('/orther', 'DashboardController@orther')->name('orther');

//login google
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
