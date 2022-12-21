<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TourController;
use App\Http\Controllers\Backend\ToursController;
use App\Http\Controllers\Backend\TravelcategoryController;
use App\Http\Controllers\Backend\StaticpageController;
use App\Http\Controllers\Backend\TourCarrierController;
use App\Http\Controllers\Backend\TravelReportController;
use App\Http\Controllers\Backend\PlanController;
use App\Http\Controllers\Backend\PlanFeatureController;
use App\Http\Controllers\Backend\PlanPrivilegeController;
use App\Http\Controllers\Backend\Auth\Role\RoleController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\RequestController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\DestinationController;
use App\Http\Controllers\Backend\SlideAudioController;
use App\Http\Controllers\Backend\SocialSettingController;
use App\Http\Controllers\Backend\EmailSettingController;
use App\Http\Controllers\Backend\TravelVectorController;
use App\Http\Controllers\Backend\PlanMonthController;


// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*****************code edit by durgesh(19-02-2020)**************/

// route define for travel category
Route::get('travelcateg', [TravelcategoryController::class, 'index'])->name('travelcateg');
Route::get('travelcateg/add', [TravelcategoryController::class, 'create'])->name('travelcateg.add');
Route::post('travelcateg/store', [TravelcategoryController::class, 'store'])->name('travelcateg.store');
Route::get('travelcateg/show/{id}', [TravelcategoryController::class, 'show'])->name('travelcateg.show');
Route::get('travelcateg/edit/{id}', [TravelcategoryController::class, 'edit'])->name('travelcateg.edit');
Route::post('travelcateg/update/{id}', [TravelcategoryController::class, 'update'])->name('travelcateg.update');
Route::get('travelcateg/delete/{id}', [TravelcategoryController::class, 'destroy'])->name('travelcateg.delete');
Route::get('travelcateg/deleted/', [TravelcategoryController::class, 'getDeleted'])->name('travelcateg.deleted');
Route::get('travelcateg/restore/{id}', [TravelcategoryController::class, 'restore'])->name('travelcateg.restore');


//route define for static page
Route::get('staticpage', [StaticpageController::class, 'index'])->name('staticpage');

Route::get('staticpage/add', [StaticpageController::class, 'create'])->name('staticpage.add');
Route::post('staticpage/store', [StaticpageController::class, 'store'])->name('staticpage.store');
Route::get('staticpage/show/{id}', [StaticpageController::class, 'show'])->name('staticpage.show');
Route::get('staticpage/edit/{id}', [StaticpageController::class, 'edit'])->name('staticpage.edit');
Route::post('staticpage/update/{id}', [StaticpageController::class, 'update'])->name('staticpage.update');
Route::get('staticpage/delete/{id}', [StaticpageController::class, 'destroy'])->name('staticpage.delete');
Route::get('staticpage/deleted/', [StaticpageController::class, 'getDeleted'])->name('staticpage.deleted');
Route::get('staticpage/restore/{id}', [StaticpageController::class, 'restore'])->name('staticpage.restore');



//route define for social settings
Route::get('social_settings', [SocialSettingController::class, 'index'])->name('social_settings');

Route::get('social_settings/edit', [SocialSettingController::class, 'create'])->name('social_settings.add');
Route::post('social_settings/store', [SocialSettingController::class, 'store'])->name('social_settings.store');
Route::get('social_settings/show/{id}', [SocialSettingController::class, 'show'])->name('social_settings.show');
Route::get('social_settings/edit/{id}', [SocialSettingController::class, 'edit'])->name('social_settings.edit');
Route::post('social_settings/update/{id}', [SocialSettingController::class, 'update'])->name('social_settings.update');
Route::get('social_settings/delete/{id}', [SocialSettingController::class, 'destroy'])->name('social_settings.delete');

// route define for Tour
Route::get('tour', [TourController::class, 'index'])->name('tour');
Route::get('tour/add', [TourController::class, 'create'])->name('tour.add');
Route::post('tour/store', [TourController::class, 'store'])->name('tour.store');
Route::get('tour/edit/{id}', [TourController::class, 'edit'])->name('tour.edit');
Route::post('tour/update/{id}', [TourController::class, 'update'])->name('tour.update');
Route::get('tour/delete/{id}', [TourController::class, 'destroy'])->name('tour.delete');
Route::get('tour/imgdelete/{id}', [TourController::class, 'deleteimg'])->name('tour.imgdelete');

Route::post('tour/imgcount', [TourController::class, 'countimg'])->name('tour.imgcount');


Route::get('tour-carriers', [TourCarrierController::class, 'index'])->name('tour_carriers');
Route::get('tour_carriers/create', [TourCarrierController::class, 'create'])->name('tour_carriers.create');
Route::post('tour_carriers/store1', [TourCarrierController::class, 'store1'])->name('tour_carriers.store1');
Route::get('tour_carriers/edit/{id}', [TourCarrierController::class, 'edit'])->name('tour_carriers.edit');
Route::patch('tour_carriers/update/{id}', [TourCarrierController::class, 'update'])->name('tour_carriers.update');
Route::get('tour_carriers/deleted_data/{id}', [TourCarrierController::class, 'destroy'])->name('tour_carriers.deleted_data');
Route::get('tour_carriers/deactivated/', [TourCarrierController::class, 'getDeactivated'])->name('tour_carriers.deactivated');
Route::get('tour_carriers/deleted/', [TourCarrierController::class, 'getDeleted'])->name('tour_carriers.deleted');
Route::get('status/{status}', [TourCarrierController::class, 'status'])->name('tour_carriers.status');
Route::get('tour_carriers/restore/{id}', [TourCarrierController::class, 'restore'])->name('tour_carriers.restore');

Route::get('slideaudio', [SlideAudioController::class, 'index'])->name('slider_audio');
Route::get('slideaudio/create', [SlideAudioController::class, 'create'])->name('slider_audio.create');
Route::post('slideaudio/store', [SlideAudioController::class, 'store'])->name('slider_audio.store');
Route::get('slideaudio/edit/{id}', [SlideAudioController::class, 'edit'])->name('slider_audio.edit');
Route::get('slideaudio/deleted_data/{id}', [SlideAudioController::class, 'destroy'])->name('slider_audio.deleted_data');
Route::patch('slideaudio/update/{id}', [SlideAudioController::class, 'update'])->name('slider_audio.update');
Route::get('slideaudio/deactivated/', [SlideAudioController::class, 'getDeactivated'])->name('slider_audio.deactivated');
Route::get('slideaudio/deleted/', [SlideAudioController::class, 'getDeleted'])->name('slider_audio.deleted');
 Route::get('slideaudio/{status}', [SlideAudioController::class, 'status'])->name('slider_audio.status');
Route::get('slideaudio/restore/{id}', [SlideAudioController::class, 'restore'])->name('slider_audio.restore');
Route::get('slideaudio/deletetravelimg/{id}', [SlideAudioController::class, 'deletetravelimg'])->name('slider_audio.deletetravelimg');
Route::get('slideaudio/deletegalleryimg/{id}', [SlideAudioController::class, 'deletegalleryimg'])->name('slider_audio.deletegalleryimg');
Route::get('slideaudio/deletecomponent/{id}', [SlideAudioController::class, 'deletecomponent'])->name('slider_audio.deletecomponent');

Route::get('travel-report', [TravelReportController::class, 'index'])->name('travel_report');
Route::get('travel-report/create', [TravelReportController::class, 'create'])->name('travel_report.create');
Route::post('travel_report/store', [TravelReportController::class, 'store'])->name('travel_report.store');
Route::get('travel_report/edit/{id}', [TravelReportController::class, 'edit'])->name('travel_report.edit');

Route::patch('travel_report/update/{id}', [TravelReportController::class, 'update'])->name('travel_report.update');
Route::get('travel_report/deleted_data/{id}', [TravelReportController::class, 'destroy'])->name('travel_report.deleted_data');
Route::post('travel-report', [TravelReportController::class, 'warning'])->name('travel_report.warning');
Route::get('travel_report/deactivated/', [TravelReportController::class, 'getDeactivated'])->name('travel_report.deactivated');
Route::get('travel_report/deleted/', [TravelReportController::class, 'getDeleted'])->name('travel_report.deleted');
 Route::get('travel_report/{status}', [TravelReportController::class, 'status'])->name('travel_report.status');
Route::get('travel_report/restore/{id}', [TravelReportController::class, 'restore'])->name('travel_report.restore');
Route::get('travel_report/deletetravelimg/{id}', [TravelReportController::class, 'deletetravelimg'])->name('travel_report.deletetravelimg');
Route::get('travel_report/deletegalleryimg/{id}', [TravelReportController::class, 'deletegalleryimg'])->name('travel_report.deletegalleryimg');
Route::get('travel_report/deletecomponent/{id}', [TravelReportController::class, 'deletecomponent'])->name('travel_report.deletecomponent');

Route::get('book_information', [TravelReportController::class, 'book_information'])->name('book_information');
Route::get('book_information/list', [TravelReportController::class, 'listBookInformation'])->name('list_book_information');
 Route::get('book_information/{status_book}', [TravelReportController::class, 'status_book'])->name('book_information.status_book');
 Route::get('book_information/deactivated', [TravelReportController::class, 'getDeactivated_book'])->name('book_information.getDeactivated_book');

Route::get('travel_report_trip_page', [TravelReportController::class, 'travel_report_trip_page'])->name('travel_report_trip_page');

Route::get('travel_report_trip_page/show', [TravelReportController::class, 'travel_report_trip_page'])->name('travel_report_trip_page.show');

Route::get('/trip_page/{id}', [TravelReportController::class, 'trip_page'])->name('trip_page');

Route::get('plan', [PlanController::class, 'index'])->name('plan');
Route::get('plan/create', [PlanController::class, 'create'])->name('plan.create');
Route::post('plan/store', [PlanController::class, 'store'])->name('plan.store');
Route::get('plan/edit/{id}', [PlanController::class, 'edit'])->name('plan.edit');
Route::patch('plan/update/{id}', [PlanController::class, 'update'])->name('plan.update');
Route::get('plan/deleted_data/{id}', [PlanController::class, 'destroy'])->name('plan.deleted_data');
Route::get('plan/deactivated/', [PlanController::class, 'getDeactivated'])->name('plan.deactivated');
Route::get('plan/deleted/', [PlanController::class, 'getDeleted'])->name('plan.deleted');
Route::get('plan/{status}', [PlanController::class, 'status'])->name('plan.status');
Route::get('plan/restore/{id}', [PlanController::class, 'restore'])->name('plan.restore');

Route::get('subscription', [PlanController::class, 'subscription'])->name('subscription');
Route::get('subscription/list', [PlanController::class, 'listSubscription'])->name('list_subscription');
Route::get('subscription/show/{id}', [PlanController::class, 'show'])->name('subscription.show');


//Plan Feature Controller

Route::get('plan-feature', [PlanFeatureController::class, 'index'])->name('plan_feature');
Route::get('plan-feature/create', [PlanFeatureController::class, 'create'])->name('plan_feature.create');
Route::post('plan_feature/store', [PlanFeatureController::class, 'store'])->name('plan_feature.store');
Route::get('plan_feature/edit/{id}', [PlanFeatureController::class, 'edit'])->name('plan_feature.edit');
Route::patch('plan_feature/update/{id}', [PlanFeatureController::class, 'update'])->name('plan_feature.update');
Route::get('plan_feature/deleted_data/{id}', [PlanFeatureController::class, 'destroy'])->name('plan_feature.deleted_data');
Route::get('plan-feature/deactivated/', [PlanFeatureController::class, 'getDeactivated'])->name('plan_feature.deactivated');
Route::get('plan-feature/deleted/', [PlanFeatureController::class, 'getDeleted'])->name('plan_feature.deleted');
Route::get('plan_feature/{status}', [PlanFeatureController::class, 'status'])->name('plan_feature.status');
Route::get('plan_feature/restore/{id}', [PlanFeatureController::class, 'restore'])->name('plan_feature.restore');


Route::get('plan-privilege', [PlanPrivilegeController::class, 'index'])->name('plan_privilege');
Route::get('plan-privilege/create', [PlanPrivilegeController::class, 'create'])->name('plan_privilege.create');
Route::post('plan_privilege/store', [PlanPrivilegeController::class, 'store'])->name('plan_privilege.store');
Route::get('plan-privilege/edit/{id}', [PlanPrivilegeController::class, 'edit'])->name('plan_privilege.edit');
Route::patch('plan_privilege/update/{id}', [PlanPrivilegeController::class, 'update'])->name('plan_privilege.update');
Route::get('plan_privilege/deleted_data/{id}', [PlanPrivilegeController::class, 'destroy'])->name('plan_privilege.deleted_data');
Route::get('plan-privilege/deactivated/', [PlanPrivilegeController::class, 'getDeactivated'])->name('plan_privilege.deactivated');
Route::get('plan-privilege/deleted/', [PlanPrivilegeController::class, 'getDeleted'])->name('plan_privilege.deleted');
Route::get('status_plan_privilege/{status}', [PlanPrivilegeController::class, 'status_plan_privilege'])->name('plan_privilege.status_plan_privilege');
Route::get('plan_privilege/restore/{id}', [PlanPrivilegeController::class, 'restore'])->name('plan_privilege.restore');

Route::get('travel-image', [RoleController::class, 'travel_image_index'])->name('travel_image');
Route::get('travel-image/create', [RoleController::class, 'travel_image_create'])->name('travel_image.create');

// Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::get('feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('feedback/edit/{id}', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::patch('feedback/update/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::get('feedback/deleted_data/{id}', [FeedbackController::class, 'destroy'])->name('feedback.deleted_data');
Route::get('feedback/deactivated/', [FeedbackController::class, 'getDeactivated'])->name('feedback.deactivated');
Route::get('feedback/deleted/', [FeedbackController::class, 'getDeleted'])->name('feedback.deleted');
Route::get('feedback/{status}', [FeedbackController::class, 'status'])->name('feedback.status');
Route::get('feedback/restore/{id}', [FeedbackController::class, 'restore'])->name('feedback.restore');


Route::get('user-level-request', [RequestController::class, 'index'])->name('user_level_request');
Route::get('user-level-request/create', [RequestController::class, 'create'])->name('user_level_request.create');
Route::post('user_level_request/store', [RequestController::class, 'store'])->name('user_level_request.store');
Route::get('user-level-request/edit/{id}', [RequestController::class, 'edit'])->name('user_level_request.edit');
Route::patch('user_level_request/update/{id}', [RequestController::class, 'update'])->name('user_level_request.update');
Route::get('user-level-request/deleted_data/{id}', [RequestController::class, 'destroy'])->name('user_level_request.deleted_data');
Route::get('user-level-request/deleted/', [RequestController::class, 'getDeleted'])->name('user_level_request.deleted');
Route::get('user_level_request/pending/', [RequestController::class, 'getPending'])->name('user_level_request.pending');
Route::get('user_level_request/approved/', [RequestController::class, 'getApproved'])->name('user_level_request.approved');
Route::get('user_level_request/not-approved/', [RequestController::class, 'getNotApproved'])->name('user_level_request.not_approved');
Route::get('user_level_request/cancelled/', [RequestController::class, 'getCancelled'])->name('user_level_request.cancelled');
Route::get('user_level_request/restore/{id}', [RequestController::class, 'restore'])->name('user_level_request.restore');

// advertisements
Route::get('advertisements', [AdvertisementController::class, 'index'])->name('advertisements');
Route::get('advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
Route::post('advertisements/store', [AdvertisementController::class, 'store'])->name('advertisements.store');
Route::get('advertisements/edit/{id}', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
Route::patch('advertisements/update/{id}', [AdvertisementController::class, 'update'])->name('advertisements.update');
Route::get('advertisements/deleted_data/{id}', [AdvertisementController::class, 'destroy'])->name('advertisements.deleted_data');
Route::get('advertisements/deactivated/', [AdvertisementController::class, 'getDeactivated'])->name('advertisements.deactivated');
Route::get('advertisements/deleted/', [AdvertisementController::class, 'getDeleted'])->name('advertisements.deleted');
Route::get('advertisements/{status}', [AdvertisementController::class, 'status'])->name('advertisements.status');
Route::get('advertisements/restore/{id}', [AdvertisementController::class, 'restore'])->name('advertisements.restore');
Route::get('ads_details', [AdvertisementController::class, 'ads_details'])->name('ads_details');
Route::get('advertisements/show/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');

//emailsettings
Route::get('emailsettings', [EmailSettingController::class, 'index'])->name('emailsettings');
Route::get('emailsettings/create', [EmailSettingController::class, 'create'])->name('emailsettings.create');
Route::post('emailsettings/store', [EmailSettingController::class, 'store'])->name('emailsettings.store');
Route::get('emailsettings/edit/{id}', [EmailSettingController::class, 'edit'])->name('emailsettings.edit');
Route::patch('emailsettings/update/{id}', [EmailSettingController::class, 'update'])->name('emailsettings.update');
Route::get('emailsettings/deleted', [EmailSettingController::class, 'getDeleted'])->name('emailsettings.deleted');
Route::get('emailsettings/deleted_data/{id}', [EmailSettingController::class, 'destroy'])->name('emailsettings.deleted_data');
Route::get('emailsettings/restore/{id}', [EmailSettingController::class, 'restore'])->name('emailsettings.restore');


// route define for Tour
Route::get('tour', [TourController::class, 'index'])->name('tour');
Route::get('tour/add', [TourController::class, 'create'])->name('tour.add');
Route::post('tour/store', [TourController::class, 'store'])->name('tour.store');
Route::get('tour/edit/{id}', [TourController::class, 'edit'])->name('tour.edit');
Route::post('tour/update/{id}', [TourController::class, 'update'])->name('tour.update');
Route::get('tour/delete/{id}', [TourController::class, 'destroy'])->name('tour.delete');
Route::get('tour/imgdelete/{id}', [TourController::class, 'deleteimg'])->name('tour.imgdelete');
Route::post('tour/imgcount', [TourController::class, 'countimg'])->name('tour.imgcount');

// route define for Services
Route::get('services', [ServicesController::class, 'index'])->name('services');
Route::get('services/add', [ServicesController::class, 'create'])->name('services.add');
Route::post('services/store', [ServicesController::class, 'store'])->name('services.store');
Route::get('services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
Route::post('services/update/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::get('services/delete/{id}', [ServicesController::class, 'destroy'])->name('services.delete');
//Route::resource('services', 'ServicesController');


// route define for Destination
Route::get('destination', [DestinationController::class, 'index'])->name('destination');
Route::get('destination/add', [DestinationController::class, 'create'])->name('destination.add');
Route::post('destination/store', [DestinationController::class, 'store'])->name('destination.store');
Route::get('destination/edit/{id}', [DestinationController::class, 'edit'])->name('destination.edit');
Route::post('destination/update/{id}', [DestinationController::class, 'update'])->name('destination.update');
Route::get('destination/delete/{id}', [DestinationController::class, 'destroy'])->name('destination.delete');
Route::get('destination/getstate/{id}', [DestinationController::class, 'getallstate'])->name('destination.getstate');
Route::get('destination/getcity/{id}', [DestinationController::class, 'getallcity'])->name('destination.getcity');

// route define for Tours
Route::get('tours', [ToursController::class, 'index'])->name('tours');
Route::get('tours/add', [ToursController::class, 'create'])->name('tours.add');
Route::post('tours/store', [ToursController::class, 'store'])->name('tours.store');
Route::get('tours/edit/{id}', [ToursController::class, 'edit'])->name('tours.edit');
Route::post('tours/update/{id}', [ToursController::class, 'update'])->name('tours.update');
Route::get('tours/delete/{id}', [ToursController::class, 'destroy'])->name('tours.delete');
Route::get('tours/imgdelete/{id}', [ToursController::class, 'deletetourimg'])->name('tours.imgdelete');

/*****************code edit by durgesh(19-02-2020)**************/


Route::get('travel_vectors', [TravelVectorController::class, 'index'])->name('travel_vectors');
Route::get('travel_vectors/create', [TravelVectorController::class, 'create'])->name('travel_vectors.create');
Route::post('travel_vectors/store', [TravelVectorController::class, 'store'])->name('travel_vectors.store');
Route::get('travel_vectors/edit/{id}', [TravelVectorController::class, 'edit'])->name('travel_vectors.edit');
Route::patch('travel_vectors/update/{id}', [TravelVectorController::class, 'update'])->name('travel_vectors.update');
Route::get('travel_vectors/deleted_data/{id}', [TravelVectorController::class, 'destroy'])->name('travel_vectors.deleted_data');
Route::get('travel_vectors/deactivated/', [TravelVectorController::class, 'getDeactivated'])->name('travel_vectors.deactivated');
Route::get('travel_vectors/deleted/', [TravelVectorController::class, 'getDeleted'])->name('travel_vectors.deleted');
Route::get('travel_vectors/{status}', [TravelVectorController::class, 'status'])->name('travel_vectors.status');
Route::get('travel_vectors/restore/{id}', [TravelVectorController::class, 'restore'])->name('travel_vectors.restore');


Route::get('plan-month', [PlanMonthController::class, 'index'])->name('plan_month');
Route::get('plan-month/create', [PlanMonthController::class, 'create'])->name('plan_month.create');
Route::post('plan-month/store', [PlanMonthController::class, 'store'])->name('plan_month.store');
Route::get('plan-month/edit/{id}', [PlanMonthController::class, 'edit'])->name('plan_month.edit');
Route::patch('plan-month/update/{id}', [PlanMonthController::class, 'update'])->name('plan_month.update');
Route::get('status/{status}', [PlanMonthController::class, 'status'])->name('plan_month.status');
Route::get('plan-month/deleted/{id}', [PlanMonthController::class, 'destroy'])->name('plan_month.deleted_data');
Route::get('plan-month/deactivated/', [PlanMonthController::class, 'getDeactivated'])->name('plan_month.deactivated');
Route::get('plan-month/deleted/', [PlanMonthController::class, 'getDeleted'])->name('plan_month.deleted');
Route::get('plan-month/restore/{id}', [PlanMonthController::class, 'restore'])->name('plan_month.restore');




