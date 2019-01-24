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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//return view('blog/home');
//});

use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Posts routes
Route::get('/', 'PostController@publicHomePage')->name('getPublic');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts', 'PostController');
Route::resource('users', 'UserController');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::post('store', 'PostController@store')->name('posts.store');
Route::post('hidePost', 'PostController@hidePost')->name('posts.hidePost');

//Categories routes
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

//Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);

// Search users in admin routes amd logic
Route::get ( '/admin', function () {
    return view ( '/admin' );
} );
Route::any ( '/admin', function () {
    $q = Input::get ( 'q' );
    $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $user ) > 0)
        return view ( '/admin' )->withDetails ( $user )->withQuery ( $q );
    else
        return view ( '/admin' )->withMessage ( 'No Details found. Try to search again !' );
} );

Route::prefix('admin')->group(function() {
    // Admin Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.update');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});












