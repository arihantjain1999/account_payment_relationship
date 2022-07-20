<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;
use App\Mail\newUserMail;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Mail;

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

Route::get('/florala', function () {
    return view('account.florala');
});
Route::get('/campaign', function () {
    return view('account.florala');
});



Route::get('login/{provider}', 'SocialController@redirect');
Route::get('login/{provider}/callback','SocialController@Callback');


Auth::routes();
Route::get('/email', function(){
    $event = 'udpmanage';
    Mail::to('udpmanage@gmail.com')->send(new newUserMail($event));
    return new newUserMail($event);
} );
Route::get('/' , 'AccountController@index')->middleware('auth');
Route::post('mail' , 'AccountController@mail');
Route::post('/restore-all', 'PaymentController@restoreAll')->name('payments.restore-all');
Route::get('/restore/{id}', 'PaymentController@restore')->name('payments.restore');
// Route::get('/payments/show/{id}', 'PaymentController@show')->name('payments.show');
Route::get('/chart', 'PaymentController@chart')->name('payments.chart');


Route::get('/payments/deletedpayments', 'PaymentController@deletedpayments')->name('payments.deletedpayments');

Route::get('/payments/reletedpayments/{id}' , 'PaymentController@reletedpayments' )->name('PaymentController.reletedpayments');
Route::get('/payments/create/{id}' , 'PaymentController@create' )->name('PaymentController.create');
Route::resource('/accounts' , 'AccountController')->middleware('auth');
Route::resource('/payments' , 'PaymentController')->middleware('auth');


Route::get('/home', 'HomeController@index')->name('home');
