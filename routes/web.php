<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('change-lang/{lang}', 'ChangeLangController@index')->name('chang.lang');

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login','AuthenticatedSessionController@store');
Route::get('/logout','AuthenticatedSessionController@destroy')->name('logout');;

Route::get('/app', function () {
    $role = Auth::user()->role;
        session()->put('role',strtolower($role));
        if($role->id = 3){
            return redirect()->back()->with(['errors_' => [__('msg.access_deny')]]);  
        }else{
            Route::get('/app/dashboard', 'admin\DashboardController@index')->name('dashboard');
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

    #Common
    Route::get('ajaxSelectCityGetCity','admin\common\AjaxSearchController@ajaxSelectCountryGetCity')->name('ajaxSelectCountryGetCity');
    Route::get('/ajax-get-events-and-users', 'admin\common\AjaxSearchController@ajaxGetEventsAndUsers')->name('ajaxGetEventsAndUsers');

    #Events
    Route::get('events', 'admin\event\EventController@index')->name('event.index');
    Route::get('event-datatable', 'admin\event\EventController@datatable')->name('event.datatable');
    Route::post('saving-event/{id?}', 'admin\event\EventController@save')->name('event.save');
    Route::get('event-edit/{id}', 'admin\event\EventController@edit')->name('event.edit');
    Route::get('block-event/{id}', 'admin\event\EventController@block')->name('event.block');
    Route::get('unblock-event/{id}', 'admin\event\EventController@unblock')->name('event.unblock');
    Route::get('event/remove-media/{id}', 'admin\event\EventController@removeMedia')->name('delete.event.media');
    Route::post('events/import', 'admin\event\EventController@import')->name('events.import');

    #Event Assign
    Route::get('event-assign', 'admin\event\AssignEventController@index')->name('event.assign');
    Route::get('event-assign-datatable', 'admin\event\AssignEventController@datatable')->name('event-assign.datatable');
    Route::post('saving-event-assign/{id?}', 'admin\event\AssignEventController@save')->name('event-assign.save');
    Route::get('event-assign-edit/{id}', 'admin\event\AssignEventController@edit')->name('event-assign.edit');
    Route::get('block-event-assign/{id}', 'admin\event\AssignEventController@block')->name('event-assign.block');
    Route::get('notify-event-reminder/{id}', 'admin\event\AssignEventController@notfyRemider')->name('notify.event.reminder');

    #event request from users
    Route::get('event-request', 'admin\event\EventRequestController@index')->name('event.request');
    Route::get('event-request-datatable', 'admin\event\EventRequestController@datatable')->name('event-request.datatable');
    Route::get('block-event-request/{id}', 'admin\event\EventRequestController@block')->name('event-request.block');
    Route::get('unblock-event-request/{id}', 'admin\event\EventRequestController@unblock')->name('event-request.unblock');

    
    #user panel event
    Route::get('event-assign-request/{id}', 'user\event\MyEventController@eventAssignRequest')->name('event.assign.request');
    
    
    Route::get('my-events', 'user\event\MyEventController@myEvent')->name('my.events');
    Route::get('user-event-datatable','user\event\MyEventController@userEventdatatable')->name('user.event.datatable');
    
    
    Route::get('upcoming-events', 'user\event\MyEventController@upcomingEvent')->name('upcoming.events');
    Route::get('upcoming-event-datatable','user\event\MyEventController@upcomingEventdatatable')->name('upcoming.event.datatable');

    Route::get('event-reminder', 'admin\event\EventReminderController@index')->name('event.reminder');
    Route::post('event-reminder-csv-save', 'admin\event\EventReminderController@import')->name('reminder-csv.save');
    Route::post('event.reminder.save', 'admin\event\EventReminderController@save')->name('event.reminder.save');
    Route::get('reminder-datatable','admin\event\EventReminderController@datatable')->name('event.reminder.datatable');

});