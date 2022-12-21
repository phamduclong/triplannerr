<?php
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TourReportController;
use App\Http\Controllers\Frontend\Travelreport\TravelReportController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\SubscriptionController;

/*
* Frontend Controllers
* All route names are prefixed with 'frontend.'.
*/
Route::get('', [HomeController::class, 'index'])->name('index');

Route::post('/crop_cover_image', [HomeController::class, 'cropImage'])->name('crop_image');




// new
//Route::post('/crop_cover_image', [TravelReportController::class, 'cropImage1'])->name('crop_image');

//end



Route::get('characteristics-conditions/{role}', [HomeController::class, 'Characteristics_conditions'])->name('characteristics_conditions');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('about-us',[HomeController::class,'staticPages'])->name('about-us');
Route::get('discover',[HomeController::class,'staticPages'])->name('discover');
Route::get('why_travel',[HomeController::class,'staticPages'])->name('why_travel');
Route::get('travel_commitment',[HomeController::class,'staticPages'])->name('travel_commitment');
Route::get('tour_leader_commitment',[HomeController::class,'staticPages'])->name('tour_leader_commitment');
Route::get('accept_travel_maker',[HomeController::class,'staticPages'])->name('accept_travel_maker');
Route::get('pages/{pageslug}',[HomeController::class,'staticPage'])->name('pageSlug');
Route::get('configcontact1', [HomeController::class, 'configcontact1'])->name('configcontact1');

Route::get('configcontact1', [ProfileController::class, 'configcontact1'])->name('configcontact1');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Account Specific
        Route::get('account', [AccountController::class, 'index'])->name('account');
        Route::post('get-conversation', [AccountController::class, 'getConversation'])->name('get-conversation');
        // User Account Specific
        Route::get('conversations', [AccountController::class, 'conversations'])->name('conversations');

        Route::get('public_card', [AccountController::class, 'public_card'])->name('public_card');
        Route::post('public_card/save', [AccountController::class, 'public_card_save'])->name('public_card.save');
        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::post('img/blogger/{id}', [ProfileController::class, 'Deletebloggerimg'])->name('img_delete');
        //Route::get('profile', [ProfileController::class, 'myProfile'])->name('my_profile');
        Route::get('control-panel', [ProfileController::class, 'controlpanel'])->name('control_panel');
        Route::get('advertisement', [ProfileController::class, 'advertisement'])->name('advertisement');
        Route::post('advertisement/store', [ProfileController::class, 'advertisementStore'])->name('advertisement.store');
        Route::get('collaboration/{id}', [ProfileController::class, 'collaboration'])->name('collaboration');
        Route::post('request/collaboration', [ProfileController::class, 'collaboration_request'])->name('collaboration_request');
         Route::post('save/same_trip', [ProfileController::class, 'same_trip_data'])->name('same_trip_data');
          Route::post('delete/same_trip', [ProfileController::class, 'same_trip_delete'])->name('same_trip_delete');
        Route::post('follow', [ProfileController::class, 'follow'])->name('follow');
        Route::get('travel-action', [ProfileController::class, 'travel_action'])->name('travel_action');

        Route::get('/edit/travel_report/{id}', [TravelReportController::class, 'edit'])->name('edit_travel_report');
        Route::get('/travel_report', [TravelReportController::class, 'create'])->name('travel_report');

        Route::get('/travel_report/get_travel_cost_summary', [TravelReportController::class, 'travelCostSummary'])->name('travel_report.travel_cost_summary');
        Route::get('/travel_report/get_travel_cost_summary_edit', [TravelReportController::class, 'travelCostSummaryEdit'])->name('travel_report.travel_cost_summary_edit');

        Route::get('/travel_report/get_sub_vectors', [TravelReportController::class, 'getSubVectors'])->name('travel_report.get_sub_vectors');

        Route::get('/travel_report/get_travelpro', [TravelReportController::class, 'getTravelPro'])->name('travel_report.get_travelpro');

        Route::get('/travel_report/check_report_title', [TravelReportController::class, 'check_report_title'])->name('travel_report.check_report_title');

        Route::get('/travel_report/get_image_sections', [TravelReportController::class, 'getImageSections'])->name('travel_report.get_image_sections');

        Route::get('/travel_report/remove_travel_report_component', [TravelReportController::class, 'removeTravelReportComponent'])->name('travel_report.remove_travel_report_component');

        Route::get('/travel_report/remove_gallery', [TravelReportController::class, 'removeGallery'])->name('travel_report.remove_gallery');

        Route::get('/sendbasicemail/', [TravelReportController::class, 'basic_email'])->name('sendbasicemail');
        Route::get('same-trip/{id}', [TravelReportController::class, 'sameTrip'])->name('same-trip');
        Route::get('travel_report/deletegalleryimg', [TravelReportController::class, 'deleteGalleryimg'])->name('travel_report.deletegalleryimg');
        Route::get('/add-booking/{id}', [TravelReportController::class, 'create_booking'])->name('create_booking');
        Route::get('/requestcontent/{id}/{userid}', [TravelReportController::class, 'requestcontent'])->name('requestcontent');
        Route::get('/request_diary/{id}/{userid}', [TravelReportController::class, 'request_diary'])->name('request_diary');
        Route::get('/request_information/{id}/{userid}', [TravelReportController::class, 'request_information'])->name('request_information');
        Route::get('/search-reports-pannel', [ProfileController::class, 'reportsearchfilter'])->name('filtersearchreport');
        Route::get('/subscribe_page', [TravelReportController::class, 'subscribemailchimp'])->name('subscribemailchimp');
        /*Route::post('/request_content/{id}/{slug}/{userid}', [TravelReportController::class, 'reportcontent_request'])->name('request_content');*/
        Route::post('/request_content', [TravelReportController::class, 'reportcontent_request'])->name('request_content');
        Route::post('/request-invitation', [TravelReportController::class, 'requestInvitation'])->name('request_invitation');
        Route::get('/participate/{id}', [TravelReportController::class, 'listParticipate'])->name('list_participate');

        // Route::post('save/travel', [TravelReportController::class, 'same_trip_data'])->name('same_trip_data');

    });
});


Route::post('travelreport/save/', [TravelReportController::class, 'store'])->name('travelreport.save');

Route::get('reserved_report', [TravelReportController::class, 'reservedreport'])->name('reserved_report');
// Route::get('profile/{role}/{id}', [ProfileController::class, 'myProfile'])->name('my_profile');
Route::get('profile/{role}/{user_name}/{id}', [ProfileController::class, 'myProfile'])->name('my_profile');
Route::get('/profile/get_more_travel_report', [ProfileController::class, 'getMoreTravelReport'])->name('get_more_travel_report');
// Route::get('profile/{role}/{id}', [ProfileController::class, 'index'])->name('profile');
Route::post('updateCoverImage', [ProfileController::class, 'updateCoverImage'])->name('updateCoverImage');
Route::post('updateProfileImage', [ProfileController::class, 'updateProfileImage'])->name('updateProfileImage');
Route::post('sendMessage', [ProfileController::class, 'sendMessage'])->name('sendMessage');

Route::get('/search', [ProfileController::class, 'search'])->name('search');
//Route::post('forgetpassword/send', [ForgotPasswordController::class, 'send'])->name('forgetpassword.send');
Route::post('update-reports', [TravelReportController::class, 'update'])->name('update-reports');
Route::post('delete_slide', [TravelReportController::class, 'delete_slide'])->name('delete-slide');
Route::post('delete_gallery_row', [TravelReportController::class, 'delete_gallery_row'])->name('delete-galleryrow');
Route::post('delete_datagrid_row', [TravelReportController::class, 'removedatagridrow'])->name('delete-datagrid');
Route::post('view-reports', [TravelReportController::class, 'All_reports_data'])->name('All_reports_data');
Route::post('/show_slider', [TravelReportController::class, 'showslider'])->name('show_slider');


Route::get('/getlocation', [TravelReportController::class, 'getlocation'])->name('getlocation');
Route::get('/search-reports', [HomeController::class, 'getfiltertravelreport'])->name('filterreport');
Route::get('/home/show-more-reports', [HomeController::class, 'showMoreReportsForHome'])->name('showMoreReportsForHome');

Route::get('/tour_report_list', [TourReportController::class, 'index'])->name('tour_report_list');

Route::get('/view/travel_report/{slug}', [TravelReportController::class, 'view'])->name('view_travel_report');
Route::get('/view/travel_report_dairy/{slug}', [TravelReportController::class, 'travel_report_dairy'])->name('view_travel_report_dairy');
Route::get('/view/travel_report_proposal/{slug}', [TravelReportController::class, 'travel_report_proposal'])->name('view_travel_report_proposal');
Route::get('/delete/travel_report/{slug}', [TravelReportController::class, 'delete'])->name('delete_travel_report');


Route::get('reserved_user', [TravelReportController::class, 'reserved_user'])->name('reserved_user');

Route::post('/store-booking', [TravelReportController::class, 'store_booking'])->name('tripbooking.save');

Route::post('send_content', [TravelReportController::class, 'report_send_content'])->name('send_content');

// Route::get('/view-plans/{id}', [SubscriptionController::class, 'index'])->name('view.plans');
Route::get('/view-plans/{id}', [SubscriptionController::class, 'index1'])->name('view.plans');
Route::get('/purchase-plan/{id}/{slug}/{userid}', [SubscriptionController::class, 'purchasePlan'])->name('plans.purchase-plans');
Route::get('/plan/success/{id}/{invoice_id}', [SubscriptionController::class, 'success'])->name('plans.success');
Route::get('/plan/cancel', [SubscriptionController::class, 'cancel'])->name('plans.cancel');

Route::get('same_trip_report', [ProfileController::class, 'tripreport'])->name('same_trip_report');
Route::post('ads/save', [HomeController::class, 'ads_click'])->name('ads_click');

Route::get('loadmoredata', [HomeController::class, 'loadmoredata'])->name('loadmoredata');

Route::get('loadmoredata1', [ProfileController::class, 'loadmoredata1'])->name('loadmoredata1');

Route::post('get_image_location', [TravelReportController::class, 'imageLocation'])->name('get_image_location');


Route::get('/delete_video/travel_report/{id}', [TravelReportController::class, 'delete_video'])->name('delete_video');

Route::post('/delete_account', [AccountController::class, 'deleteAccount'])->name('delete_account');
Route::get('/reactive_account', [AccountController::class, 'reactiveAccount'])->name('reactive_account');

Route::get('/add_new_invitation', [TravelReportController::class, 'addNewInvitation'])->name('add_new_invitation');
Route::post('/sendInvitation', [TravelReportController::class, 'sendInvitation'])->name('sendInvitation');
Route::get('/check_type_voucher', [TravelReportController::class, 'checkTypeVoucher'])->name('check_type_voucher');
//travel report create


