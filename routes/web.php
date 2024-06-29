<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginWithGoogleController;


// demo purpose admin panel . This  will change one after one
Route::get('/demo-1','website\WebsiteController@demo')->name('home');
Route::get('/demo-2','website\WebsiteController@demo2')->name('send-email-or-sms');
Route::get('/demo-3','website\WebsiteController@demo3')->name('event');
Route::get('/demo-4','website\WebsiteController@demo4')->name('calendar');
Route::get('/demo-5','website\WebsiteController@demo5')->name('email-template');
Route::get('/demo-6','website\WebsiteController@demo6')->name('sms-template');
Route::get('/demo-7','website\WebsiteController@demo7')->name('profit-and-loss');
Route::get('/demo-8','website\WebsiteController@demo8')->name('bank-accounts');
Route::get('/demo-9','website\WebsiteController@demo9')->name('incomes');
Route::get('/demo-10','website\WebsiteController@demo10')->name('expenses');
Route::get('/demo-11','website\WebsiteController@demo11')->name('chart-of-accounts');
Route::get('/demo-12','website\WebsiteController@demo11')->name('item-category');
Route::get('/demo-13','website\WebsiteController@demo11')->name('item-list');
Route::get('/demo-14','website\WebsiteController@demo11')->name('item-store');
Route::get('/demo-15','website\WebsiteController@demo11')->name('suppliers');
Route::get('/demo-16','website\WebsiteController@demo11')->name('item-receive');
Route::get('/demo-17','website\WebsiteController@demo11')->name('item-sell');
Route::get('/demo-18','website\WebsiteController@demo11')->name('item-issue');
Route::get('/demo-19','website\WebsiteController@demo11')->name('countries');
Route::get('/demo-20','website\WebsiteController@demo11')->name('cities');
Route::get('/demo-21','website\WebsiteController@demo11')->name('districts');
Route::get('/demo-22','website\WebsiteController@demo11')->name('holidays');
Route::get('/demo-23','website\WebsiteController@demo11')->name('notification-settings');
Route::get('/demo-24','website\WebsiteController@demo11')->name('email-settings');
Route::get('/demo-25','website\WebsiteController@demo11')->name('sms-settings');
Route::get('/demo-26','website\WebsiteController@demo11')->name('tawk-to');
Route::get('/demo-27','website\WebsiteController@demo11')->name('messenger-chat');
Route::get('/demo-28','website\WebsiteController@demo11')->name('manage-currency');
Route::get('/demo-29','website\WebsiteController@demo11')->name('backup');
Route::get('/demo-30','website\WebsiteController@demo11')->name('language-setup');
Route::get('/demo-31','website\WebsiteController@demo11')->name('language');
Route::get('/demo-32','website\WebsiteController@demo11')->name('preloader-settings');
Route::get('/demo-33','website\WebsiteController@demo11')->name('configuration');
Route::get('/demo-34','website\WebsiteController@demo11')->name('weekend.index');
Route::get('/demo-35','website\WebsiteController@demo11')->name('admmin-section');
Route::get('/demo-35','website\WebsiteController@demo11')->name('admin-section');
Route::get('/demo-351','website\WebsiteController@demo11')->name('admission-query.index');
Route::get('/demo-3513','website\WebsiteController@demo11')->name('complaint.index');
Route::get('/demo-35231','website\WebsiteController@demo11')->name('phone-call-log.index');
Route::get('/demo-35232','website\WebsiteController@demo11')->name('academic-section');
Route::get('/demo-35234','website\WebsiteController@demo11')->name('academic-section.index');
Route::get('/demo-352342','website\WebsiteController@demo11')->name('academic-assign-subject.index');


Route::get('authorized/google','LoginWithGoogleController@redirectToGoogle');
Route::get('authorized/google/callback','LoginWithGoogleController@handleGoogleCallback');

Route::get('change-lang/{lang}', 'ChangeLangController@index')->name('chang.lang');
Route::post('/register','user\register\RegisterController@store');
Route::post('/login','AuthenticatedSessionController@store');
Route::get('/logout','AuthenticatedSessionController@destroy')->name('logout');;
Route::get('/email/verify/{hash}','VerifyEmailController@__invoke');
Route::get('verify-user/{code}/{client_id?}', 'VerifyEmailController@activateUser')->name('activate.user');


Route::get('/my-profile','website\MyAccountController@index')->name('my.profile');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/dashboard','user\UserDashboardController@index')->name('user.dashboard');
    Route::get('/create-attendance','user\UserDashboardController@createAttendance')->name('create.attendance');

});
Route::get('/app', function () {
    $role = Auth::user()->role;
        session()->put('role',strtolower($role));
        if($role->id = 3){
            return redirect()->back()->with(['errors_' => [__('msg.access_deny')]]);  
        }else{
            return redirect(route('dashboard'));
        }
});


#Admin Panel
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','Blade'])->group(function () {

    #Groups
    Route::get('groups', 'user\GroupController@index')->name('groups');
    Route::get('groups-datatable', 'user\GroupController@datatable')->name('group.datatable');
    Route::post('save-group/{id?}', 'user\GroupController@save')->name('group.save');
    Route::get('group-edit/{id}', 'user\GroupController@edit')->name('group.edit');
    Route::get('block-group/{id}', 'user\GroupController@block')->name('group.block');
    Route::get('unblock-group/{id}', 'user\GroupController@unblock')->name('group.unblock');
    
    #Users
    Route::get('users', 'user\UserController@index')->name('users');
    Route::get('users-datatable', 'user\UserController@datatable')->name('user.datatable');
    Route::post('save-user/{id?}', 'user\UserController@save')->name('user.save');
    Route::get('user-edit/{id}', 'user\UserController@edit')->name('user.edit');
    Route::get('block-user/{id}', 'user\UserController@block')->name('user.block');
    Route::get('unblock-user/{id}', 'user\UserController@unblock')->name('user.unblock');
    


    #Countries
    Route::get('country', 'admin\generalSettings\CountryController@index')->name('country.index');
    Route::get('country-datatable', 'admin\generalSettings\CountryController@datatable')->name('country.datatable');

    #Cities
    Route::get('city', 'admin\generalSettings\CityController@index')->name('city.index');
    Route::get('city-datatable', 'admin\generalSettings\CityController@datatable')->name('city.datatable');
    Route::post('saving-city/{id?}', 'admin\generalSettings\CityController@save')->name('city.save');
    Route::get('city-edit/{id}', 'admin\generalSettings\CityController@edit')->name('city.edit');
    Route::get('block-city/{id}', 'admin\generalSettings\CityController@block')->name('city.block');
    Route::get('unblock-city/{id}', 'admin\generalSettings\CityController@unblock')->name('city.unblock');

    #common
    Route::get('ajaxSelectCityGetCity','admin\common\AjaxSearchController@ajaxSelectCountryGetCity')->name('ajaxSelectCountryGetCity');

    #events
    Route::get('events', 'admin\event\EventController@index')->name('event.index');
    Route::get('event-datatable', 'admin\event\EventController@datatable')->name('event.datatable');
    Route::post('saving-event/{id?}', 'admin\event\EventController@save')->name('event.save');
    Route::get('event-edit/{id}', 'admin\event\EventController@edit')->name('event.edit');
    Route::get('block-event/{id}', 'admin\event\EventController@block')->name('event.block');
    Route::get('unblock-event/{id}', 'admin\event\EventController@unblock')->name('event.unblock');
    Route::get('event/remove-media/{id}', 'admin\event\EventController@removeMedia')->name('delete.event.media');



    Route::get('event-request', 'admin\generalSettings\CityController@index')->name('event.request');
    Route::get('event-assign', 'admin\generalSettings\CityController@index')->name('event.assign');

});