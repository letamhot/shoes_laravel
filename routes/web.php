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
//layouts
Route::get('/', 'ShoesController@home')->name('shoesHome');
Route::get('/shoesHome', 'ShoesController@home')->name('shoesHome');
Route::get('/cart', 'ShoesController@cart')->name('cart');
Route::get('/blog-single', 'ShoesController@blogsingle')->name('blog-single');
Route::get('/shop', 'ShoesController@shop')->name('shop');
// Route::get('/loginshoes', 'ShoesController@login')->name('loginshoes');
Route::get('/blog', 'ShoesController@blog')->name('blog');
Route::get('/checkout', 'ShoesController@checkout')->name('checkout');
Route::get('/productdetail', 'ShoesController@productdetail')->name('productdetail');
Route::get('/contact', 'ShoesController@contact')->name('contact');
Route::get('/error', 'ShoesController@error')->name('error');

//login-shoes
Route::get('/loginshoes',  'Auth\LoginController@showLogin');

Route::post('signin', 'Auth\LoginController@doLogin');
Route::get('logoutshoes', 'Auth\LoginController@logoutshoes');


//home-admin
Route::get('/home', 'HomeController@index')->name('home');
//product
Route::resource('/product', 'ProductController');
Auth::routes();


//producer
Route::resource('/producer', 'ProducerController');
Auth::routes();

//user
Route::resource('/users', 'UsersController');


//type
Route::resource('/type', 'TypeController');
Auth::routes();

//post
Route::resource('/posts', 'PostsControllers');
Route::get('/search', 'PostsControllers@search')->name('posts.search');

//slide-image
Route::resource('/slide', 'SlideController');
Auth::routes();

// route to show the logout form
Route::get('/logout', 'LoginController@logout')->name('logout');

//dashboard-admin
Route::get('/dashboard', 'dashboardController@dashboard')->name('dashboard');
Route::get('/errors', 'dashboardController@error404')->name('error404');
Route::get('/button', 'dashboardController@button')->name('button');
Route::get('/card', 'dashboardController@card')->name('card');
Route::get('/chart', 'dashboardController@chart')->name('chart');
Route::get('/table', 'dashboardController@table')->name('table');
Route::get('/animation', 'dashboardController@animation')->name('animation');
Route::get('/border', 'dashboardController@border')->name('border');
Route::get('/color', 'dashboardController@color')->name('color');
Route::get('/orther', 'dashboardController@orther')->name('orther');