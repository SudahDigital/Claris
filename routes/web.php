<?php

use Illuminate\Support\Facades\Route;

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


// welcome

//*** CUSTOMER ***//

Route::get('/', ['as'=>'category','uses'=>'WelcomeController@index']);

Auth::routes();

Route::get('/login', 'LoginController@index')->name('cust_login');
Route::post('/beranda', 'LoginController@login')->name('cust_cek_login');
Route::get('/logout', 'LoginController@logout')->name('cust_logout');

// Route::middleware('auth.admin')->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/category', ['as'=>'category','uses'=>'WelcomeController@category']);
	// product
	Route::get('/product/category/', 'ProductController@category')->name('product_category');
	Route::get('/product/search/', 'ProductController@search')->name('product_search');
	Route::get('/product/detail/', 'ProductController@detail')->name('product_detail');

	// cart
	Route::post('/cart/add/', 'CartController@add')->name('add_cart');
	Route::get('/cart/', 'CartController@index')->name('cart');
	Route::get('/cart/delete/{id}', 'CartController@delete')->name('cart_delete');
	Route::get('/cart/update_mount/', 'CartController@update_mount')->name('update_mount');
	Route::post('/cart/pay', 'CartController@pay')->name('cart_pay');

	// order
	Route::post('/cart/order/', 'CartController@order')->name('order');

	// cara belanja
	Route::get('/cara-belanja', 'CaraBelanjaController@index')->name('cara_belanja');

	// contact us
	Route::get('/contact', 'ContactController@index')->name('contact');

// });

//*** ADMIN ***//

/*Route::get('/admin', 'DashboardController@index')->name('admin');
Route::post('/admin/home', 'DashboardController@checklogin')->name('checklogin');
Route::get('/admin', 'DashboardController@logout')->name('logout');

// admin dahboard
Route::get('/admin/dashboard', 'DashboardController@view')->name('dashboard');

// admin carabelanja
Route::get('/admin/dash-carabelanja', 'DashCaraBelanjaController@index')->name('dash_carabelanja');
Route::get('/admin/form-carabelanja', 'DashCaraBelanjaController@tambah')->name('form_carabelanja');

// admin product
Route::get('/admin/dash-produk', 'DashProductController@index')->name('dash_produk');
Route::get('/admin/form-produk', 'DashProductController@add')->name('form_produk');
Route::post('/admin/input-produk', 'DashProductController@create')->name('input_produk');

Route::get('/admin/form-edit-produk', 'DashProductController@edit')->name('form_edit_produk');
Route::post('/admin/edit-produk', 'DashProductController@update')->name('edit_produk');

Route::get('/admin/hapus-produk/{id}', 'DashProductController@delete')->name('hapus_produk');

// admin kategori
Route::get('/admin/dash-kategori', 'DashCategoryController@index')->name('dash_kategori');
Route::get('/admin/form-kategori', 'DashCategoryController@add')->name('form_kategori');
Route::post('/admin/input-kategori', 'DashCategoryController@create')->name('input_kategori');

Route::get('/admin/form-edit-kategori', 'DashCategoryController@edit')->name('form_edit_kategori');
Route::post('/admin/edit-kategori', 'DashCategoryController@update')->name('edit_kategori');

Route::get('/admin/hapus-kategori/{id}', 'DashCategoryController@delete')->name('hapus_kategori');

// admin kontak
Route::get('/admin/dash-kontak', 'DashContactController@index')->name('dash_kontak');
Route::get('/admin/form-edit-kontak', 'DashContactController@edit')->name('form_edit_kontak');
Route::post('/admin/edit-kontak', 'DashContactController@update')->name('edit_kontak');*/

Route::middleware('guest')->group(function () {
	Route::get('/admin', 'DashboardController@index')->name('login');
	Route::post('/admin/home', 'DashboardController@checklogin')->name('checklogin');
});

Route::middleware('auth')->group(function () {
	// Route::get('/admin', 'DashboardController@index')->name('dashboard');
	// Route::get('/admin', 'DashboardController@index')->name('admin');
	// Route::post('/admin/home', 'DashboardController@checklogin')->name('checklogin');
	Route::get('/admin/logout', 'DashboardController@logout')->name('logout');

	// admin dahboard
	// Route::get('/admin/dashboard', 'DashboardController@view')->name('dashboard')->middleware('auth.admin');
	Route::get('/admin/dashboard', 'DashHomeController@index')->name('dashboard');

	// admin carabelanja
	Route::get('/admin/dash-carabelanja', 'DashCaraBelanjaController@index')->name('dash_carabelanja');
	Route::get('/admin/form-carabelanja', 'DashCaraBelanjaController@tambah')->name('form_carabelanja');

	// admin product
	Route::get('/admin/dash-produk', 'DashProductController@index')->name('dash_produk');
	Route::get('/admin/form-produk', 'DashProductController@add')->name('form_produk');
	Route::post('/admin/input-produk', 'DashProductController@create')->name('input_produk');
	Route::get('/admin/form-edit-produk', 'DashProductController@edit')->name('form_edit_produk');
	Route::post('/admin/edit-produk', 'DashProductController@update')->name('edit_produk');
	Route::get('/admin/hapus-produk/{id}', 'DashProductController@delete')->name('hapus_produk');
	Route::get('/admin/view-produk', 'DashProductController@view')->name('view_produk');
	Route::get('/admin/exec-produk/{id}', 'DashProductController@execute')->name('exec_produk');

	// admin kategori
	Route::get('/admin/dash-kategori', 'DashCategoryController@index')->name('dash_kategori');
	Route::get('/admin/form-kategori', 'DashCategoryController@add')->name('form_kategori');
	Route::post('/admin/input-kategori', 'DashCategoryController@create')->name('input_kategori');
	Route::get('/admin/form-edit-kategori', 'DashCategoryController@edit')->name('form_edit_kategori');
	Route::post('/admin/edit-kategori', 'DashCategoryController@update')->name('edit_kategori');
	Route::get('/admin/hapus-kategori/{id}', 'DashCategoryController@delete')->name('hapus_kategori');

	// admin kontak
	Route::get('/admin/dash-kontak', 'DashContactController@index')->name('dash_kontak');
	Route::get('/admin/form-edit-kontak', 'DashContactController@edit')->name('form_edit_kontak');
	Route::post('/admin/edit-kontak', 'DashContactController@update')->name('edit_kontak');

	//admin user
	Route::get('/admin/dash-user', 'DashUserController@index')->name('dash_user');
	Route::get('/admin/form-user', 'DashUserController@add')->name('form_user');
	Route::post('/admin/input-user', 'DashUserController@create')->name('input_user');
	Route::get('/admin/form-edit-user', 'DashUserController@edit')->name('form_edit_user');
	Route::post('/admin/edit-user', 'DashUserController@update')->name('edit_user');
	Route::get('/admin/hapus-user/{id}', 'DashUserController@delete')->name('hapus_user');

	//admin manage order
	Route::get('/admin/list-order', 'DashOrderController@list_order')->name('list_order');
	Route::get('/admin/detail-order', 'DashOrderController@detail')->name('detail_order');
	Route::post('/admin/update-order', 'DashOrderController@update_order')->name('update_order');
	Route::get('/admin/form-edit-order', 'DashOrderController@edit')->name('form_edit_order');
	Route::post('/admin/edit-order', 'DashOrderController@edit_order')->name('edit_order');

	//admin manage banner
  	Route::get('/admin/dash-banner', 'DashBannerController@index')->name('dash_banner');
  	Route::get('/admin/form-banner', 'DashBannerController@add')->name('form_banner');
  	Route::post('/admin/input-banner', 'DashBannerController@create')->name('input_banner');
  	Route::get('/admin/form-edit-banner', 'DashBannerController@edit')->name('form_edit_banner');
  	Route::get('/admin/hapus-banner/{id}', 'DashBannerController@delete')->name('hapus_banner');

  	//admin change password
  	Route::get('/admin/view-pass', 'ChangePasswordController@index')->name('view_pass');
  	Route::get('/admin/update-pass', 'ChangePasswordController@update')->name('update_pass');

  	//admin manage voucher
  	Route::get('/admin/dash-voucher', 'DashVoucherController@index')->name('dash_voucher');
  	Route::get('/admin/form-voucher', 'DashVoucherController@add')->name('form_voucher');
  	Route::post('/admin/input-voucher', 'DashVoucherController@create')->name('input_voucher');
  	Route::get('/admin/form-edit-voucher', 'DashVoucherController@edit')->name('form_edit_voucher');
  	Route::post('/admin/edit-voucher', 'DashVoucherController@update')->name('edit_voucher');
	Route::get('/admin/hapus-voucher/{id}', 'DashVoucherController@delete')->name('hapus_voucher');
});


