<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginWithGoogleController;

#articles
Route::get('/','frontend\country\poland\articles\InformationController@index')->name('home');
Route::get('/universities','frontend\country\poland\articles\UniversityController@index')->name('universities');
Route::get('/ivac-procedure','frontend\country\poland\articles\IVACProcedureController@index')->name('ivac.procedure');
Route::get('/vfs-procedure','frontend\country\poland\articles\VFSProcedureController@index')->name('vfs.procedure');
Route::get('/banking-procedure','frontend\country\poland\articles\BankingProcedureController@index')->name('banking.procedure');
Route::get('/univerisity-fee-vs-embassy-money','frontend\country\poland\articles\UniversityFeeVsEmbassyMoneyController@index')->name('university.embassy.money');

#certificate
Route::get('/tin-certificate','frontend\certificate\TinCertificateController@index')->name('tin.certificate');
Route::get('/zero-return-certificate','frontend\certificate\EReturnCertificateController@zeroReturnCertificate')->name('zero.return.certificate');
Route::get('/manual-process-e-return-certificate','frontend\certificate\EReturnCertificateController@manualeProcessEReturnCertificate')->name('manual.e.return.certificate');

#scholarship
Route::get('/scholarship','frontend\country\poland\articles\scholarship\ScholarshipController@index')->name('scholarship');

#levels
Route::get('/levels/{name}','frontend\articles\levels\AcademicLevelController@index')->name('academic.levels');

#search
Route::get('/search','frontend\SearchController@index')->name('search');

# institute details
Route::get('/university/name','frontend\institute\UniversityDetailsController@index')->name('university.details');

# become a  member
Route::get('members-list', 'frontend\global\BecomeAMemberController@index')->name('members.list');
Route::post('become-a-member-modal-open', 'frontend\global\BecomeAMemberController@becomeAMemberModal')->name('become.a.member.modal.open');
Route::post('become-a-member', 'frontend\global\BecomeAMemberController@becomeAMember')->name('become.a.member');


#frontend user comment
Route::post('frontend-user-comment', 'frontend\global\UserCommentController@comment')->name('frontend-user-comment');
Route::post('frontend-user-comment-reply', 'frontend\global\UserCommentController@reply')->name('frontend-user-comment-reply');
Route::post('load-more-comments', 'frontend\global\UserCommentController@loadMoreComments')->name('load.more.comments');
Route::post('submit-feedback', 'frontend\global\UserCommentController@submitFeedback')->name('submit-feedback');

// demo purpose admin panel . This  will change one after one
Route::get('/demo-1','website\WebsiteController@demo')->name('notice-board');
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
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','Blade','XSS'])->group(function () {

    Route::get('members-list', 'employee\AttendanceController@index')->name('members.list');

    Route::get('country', 'admin\generalSettings\CountryController@index')->name('country.index');
    Route::get('country-datatable', 'admin\generalSettings\CountryController@datatable')->name('country.datatable');

    Route::get('city', 'admin\generalSettings\CityController@index')->name('city.index');
    Route::get('city-datatable', 'admin\generalSettings\CityController@datatable')->name('city.datatable');
    Route::post('saving-city/{id?}', 'admin\generalSettings\CityController@save')->name('city.save');
    Route::get('city-edit/{id}', 'admin\generalSettings\CityController@edit')->name('city.edit');
    Route::get('block-city/{id}', 'admin\generalSettings\CityController@block')->name('city.block');
    Route::get('unblock-city/{id}', 'admin\generalSettings\CityController@unblock')->name('city.unblock');

    Route::get('tawk-to-chat', 'admin\generalSettings\PluginController@tawkTo')->name('tawk.to.index');
    Route::post('tawk-to-chat-update', 'admin\generalSettings\PluginController@tawkToUpdate')->name('tawk.to.update');


    
    #academic section

    #university
    Route::get('university-list','admin\academicSection\UniversityController@index')->name('university.index');
    Route::get('university/{id?}','admin\academicSection\UniversityController@university')->name('university.university');
    Route::post('university-store','admin\academicSection\UniversityController@store')->name('university.store');
    Route::get('university-datatable', 'admin\academicSection\UniversityController@datatable')->name('university.datatable');

    #university subject
    Route::get('university-subject-list','admin\academicSection\UniversitySubjectController@index')->name('academic-subject.index');
    Route::get('university-subject/{id?}','admin\academicSection\UniversitySubjectController@universitySubject')->name('academic-subject.universitySubject');
    Route::post('university-subject-save/{id?}','admin\academicSection\UniversitySubjectController@save')->name('academic-subject.store');
    Route::get('university-subject-datatable', 'admin\academicSection\UniversitySubjectController@datatable')->name('academic-subject.datatable');
    Route::get('university-subject-block/{id}', 'admin\academicSection\UniversitySubjectController@block')->name('acadmic-subject.block');
    Route::get('university-subject-unblock/{id}', 'admin\academicSection\UniversitySubjectController@unblock')->name('acadmic-subject.unblock');
    
    
    #frontend

    #articles
    Route::get('frontend-articles','admin\frontend\ArticleController@index')->name('frontend.article.index');
    Route::get('frontend-articles/{id?}','admin\frontend\ArticleController@frontendArticle')->name('frontend-article.frontendArticle');
    Route::post('frontend-articles-save/{id?}','admin\frontend\ArticleController@save')->name('frontend-article.save');
    Route::get('frontend-articles-datatable', 'admin\frontend\ArticleController@datatable')->name('frontend.article.datatable');
    Route::get('frontend-articles-block/{id}', 'admin\frontend\ArticleController@block')->name('frontend-article.block');
    Route::get('frontend-articles-unblock/{id}', 'admin\frontend\ArticleController@unblock')->name('frontend-article.unblock');
    
    #common search
    Route::get('ajaxSelectCityGetCity','admin\common\AjaxSearchController@ajaxSelectCountryGetCity')->name('ajaxSelectCountryGetCity');
});