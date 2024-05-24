<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
// admin@demo.com
// Dtnthievbn2021

Auth::routes([
    'register' => false,
    'reset'    =>  false,
]);

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
Route::post('/register', function (Request $request) {
    return app()->make(\App\Http\Controllers\Auth\RegisterController::class)->registerUser($request);
})->name('registerUser');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/admin/save', [App\Http\Controllers\HomeController::class, 'save'])->name('save')->middleware('auth');
Route::prefix('admin')->middleware('auth')->group(function(): void{
    Route::resource('partner', 'App\Http\Controllers\Backend\PartnerController');
    Route::resource('logo', 'App\Http\Controllers\Backend\LogoController');
    Route::resource('navbar', 'App\Http\Controllers\Backend\NavBarController');
    Route::resource('footer-contact', 'App\Http\Controllers\Backend\FooterContactController');
    Route::prefix('form')->group(function(): void{
        Route::prefix('content')->group(function(): void{
            Route::resource('application', 'App\Http\Controllers\Backend\FormsContent\ApplicationFormContentController');
            Route::resource('subscription', 'App\Http\Controllers\Backend\FormsContent\SubscriptionFormContentController');
        });
        Route::prefix('data')->group(function(): void{
            Route::get('application', 'App\Http\Controllers\Backend\FormsData\ApplicationController@index');
            Route::get('application/{id}', 'App\Http\Controllers\Backend\FormsData\ApplicationController@show');
            Route::delete('application/{id}', 'App\Http\Controllers\Backend\FormsData\ApplicationController@destroy');

            Route::get('subscription', 'App\Http\Controllers\Backend\FormsData\SubscriptionController@index');
            Route::get('subscription/{id}', 'App\Http\Controllers\Backend\FormsData\SubscriptionController@show');
            Route::delete('subscription/{id}', 'App\Http\Controllers\Backend\FormsData\SubscriptionController@destroy');
        });
    });
    Route::prefix('page')->group(function(): void{
        Route::resource('main', 'App\Http\Controllers\Backend\Pages\MainPageController');
        Route::resource('aboutUs', 'App\Http\Controllers\Backend\Pages\AboutUsPageController');
        Route::resource('grainExports', 'App\Http\Controllers\Backend\Pages\GrainExportsPageController');
        Route::resource('grainPurchase', 'App\Http\Controllers\Backend\Pages\GrainPurchasePageController');
        Route::resource('elevatorServices', 'App\Http\Controllers\Backend\Pages\ElevatorServicesPageController');
        Route::resource('contacts', 'App\Http\Controllers\Backend\Pages\ContactsPageController');
    });
});