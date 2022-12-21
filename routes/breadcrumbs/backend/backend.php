<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

/*****************code edit by durgesh(19-02-2020)**************/

//define for Tour
Breadcrumbs::for('admin.tour', function ($trail) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour'));
});
Breadcrumbs::for('admin.tour.add', function ($trail) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour.add'));
});
Breadcrumbs::for('admin.tour.store', function ($trail) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour.store'));
});
Breadcrumbs::for('admin.tour.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour.edit', $id));
});
Breadcrumbs::for('admin.tour.update', function ($trail, $id) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour.update', $id));
});
Breadcrumbs::for('admin.tour.delete', function ($trail, $id) {
    $trail->push(__('strings.backend.tour.title'), route('admin.tour.delete', $id));
});

//define for travel category
Breadcrumbs::for('admin.travelcateg', function ($trail) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg'));
});
Breadcrumbs::for('admin.travelcateg.add', function ($trail) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg.add'));
});
Breadcrumbs::for('admin.travelcateg.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg.edit', $id));
});
Breadcrumbs::for('admin.travelcateg.update', function ($trail, $id) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg.update', $id));
});
Breadcrumbs::for('admin.travelcateg.delete', function ($trail, $id) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg.delete', $id));
});

Breadcrumbs::for('admin.travelcateg.deleted', function ($trail) {
    $trail->push(__('strings.backend.travelcateg.title'), route('admin.travelcateg.deleted'));
});

//define for email settings
Breadcrumbs::for('admin.emailsettings', function ($trail) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings'));
});
Breadcrumbs::for('admin.emailsettings.add', function ($trail) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings.add'));
});
Breadcrumbs::for('admin.emailsettings.create', function ($trail) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings.create'));
});
Breadcrumbs::for('admin.emailsettings.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings.edit', $id));
});
Breadcrumbs::for('admin.emailsettings.update', function ($trail, $id) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings.update', $id));
});
Breadcrumbs::for('admin.emailsettings.deleted', function ($trail) {
    $trail->push(__('strings.backend.emailsettings.title'), route('admin.emailsettings.deleted'));
});



//define for Static Page
Breadcrumbs::for('admin.staticpage', function ($trail) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage'));
});
Breadcrumbs::for('admin.staticpage.add', function ($trail) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage.add'));
});
Breadcrumbs::for('admin.staticpage.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage.edit', $id));
});
Breadcrumbs::for('admin.staticpage.update', function ($trail, $id) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage.update', $id));
});
Breadcrumbs::for('admin.staticpage.delete', function ($trail, $id) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage.delete', $id));
});
Breadcrumbs::for('admin.staticpage.deleted', function ($trail) {
    $trail->push(__('strings.backend.staticpage.title'), route('admin.staticpage.deleted'));
});



//define for Static Page
Breadcrumbs::for('admin.social_settings', function ($trail) {
    $trail->push(__('strings.backend.social_settings.title'), route('admin.social_settings'));
});
Breadcrumbs::for('admin.social_settings.add', function ($trail) {
    $trail->push(__('strings.backend.social_settings.title'), route('admin.social_settings.add'));
});
Breadcrumbs::for('admin.social_settings.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.social_settings.title'), route('admin.social_settings.edit', $id));
});
Breadcrumbs::for('admin.social_settings.update', function ($trail, $id) {
    $trail->push(__('strings.backend.social_settings.title'), route('admin.social_settings.update', $id));
});
Breadcrumbs::for('admin.social_settings.delete', function ($trail, $id) {
    $trail->push(__('strings.backend.social_settings.title'), route('admin.social_settings.delete', $id));
});

Breadcrumbs::for('admin.tour_carriers', function ($trail) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers'));
});
Breadcrumbs::for('admin.tour_carriers.create', function ($trail) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.create'));
});
Breadcrumbs::for('admin.tour_carriers.store', function ($trail) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.store'));
});
Breadcrumbs::for('admin.tour_carriers.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.edit', $id));
});
Breadcrumbs::for('admin.tour_carriers.update', function ($trail, $id) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.update', $id));
});
Breadcrumbs::for('admin.tour_carriers.deactivated', function ($trail) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.deactivated'));
});
Breadcrumbs::for('admin.tour_carriers.deleted', function ($trail) {
    $trail->push(__('strings.backend.tour_carriers.title'), route('admin.tour_carriers.deleted'));
});



Breadcrumbs::for('admin.travel_report', function ($trail) {
    $trail->push(__('strings.backend.tour_report.title'), route('admin.travel_report'));
});
Breadcrumbs::for('admin.travel_report.create', function ($trail) {
    $trail->push(__('strings.backend.travel_report.title'), route('admin.travel_report.create'));
});
Breadcrumbs::for('admin.travel_report.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.travel_report.title'), route('admin.travel_report.edit', $id));
});
Breadcrumbs::for('admin.travel_report.update', function ($trail, $id) {
    $trail->push(__('strings.backend.travel_report.title'), route('admin.travel_report.update', $id));
});
Breadcrumbs::for('admin.travel_report.deactivated', function ($trail) {
    $trail->push(__('strings.backend.travel_report.title'), route('admin.travel_report.deactivated'));
});
Breadcrumbs::for('admin.travel_report.deleted', function ($trail) {
    $trail->push(__('strings.backend.travel_report.title'), route('admin.travel_report.deleted'));
});

Breadcrumbs::for('admin.travel_report_trip_page', function ($trail) {
    $trail->push(__('strings.backend.tour_report.title'), route('admin.travel_report_trip_page'));
});

Breadcrumbs::for('admin.travel_report_trip_page.show', function ($trail) {
    $trail->push(__('strings.backend.tour_report.title'), route('admin.travel_report_trip_page.show'));
});

Breadcrumbs::for('admin.subscription', function ($trail) {
    $trail->push(__('strings.backend.subscription.title'), route('admin.subscription'));
});

Breadcrumbs::for('admin.subscription.show', function ($trail, $id) {
    $trail->push(__('strings.backend.subscription.title'), route('admin.subscription.show', $id));
});

Breadcrumbs::for('admin.book_information', function ($trail) {
    $trail->push(__('strings.backend.book_information.title'), route('admin.book_information'));
});

Breadcrumbs::for('admin.slider_audio', function ($trail) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio'));
});
Breadcrumbs::for('admin.slider_audio.create', function ($trail) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio.create'));
});
Breadcrumbs::for('admin.slider_audio.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio.edit', $id));
});
Breadcrumbs::for('admin.slider_audio.update', function ($trail, $id) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio.update', $id));
});
Breadcrumbs::for('admin.slider_audio.deactivated', function ($trail) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio.deactivated'));
});
Breadcrumbs::for('admin.slider_audio.deleted', function ($trail) {
    $trail->push(__('strings.backend.slider_audio.title'), route('admin.slider_audio.deleted'));
});

Breadcrumbs::for('admin.plan', function ($trail) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan'));
});
Breadcrumbs::for('admin.plan.create', function ($trail) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan.create'));
});
Breadcrumbs::for('admin.plan.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan.edit', $id));
});
Breadcrumbs::for('admin.plan.update', function ($trail, $id) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan.update', $id));
});
Breadcrumbs::for('admin.plan.deactivated', function ($trail) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan.deactivated'));
});
Breadcrumbs::for('admin.plan.deleted', function ($trail) {
    $trail->push(__('strings.backend.plan.title'), route('admin.plan.deleted'));
});

// plan feature controller
Breadcrumbs::for('admin.plan_feature', function ($trail) {
    $trail->push(__('strings.backend.tour_report.title'), route('admin.plan_feature'));
});
Breadcrumbs::for('admin.plan_feature.create', function ($trail) {
    $trail->push(__('strings.backend.plan_feature.title'), route('admin.plan_feature.create'));
});
Breadcrumbs::for('admin.plan_feature.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_feature.title'), route('admin.plan_feature.edit', $id));
});
Breadcrumbs::for('admin.plan_feature.update', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_feature.title'), route('admin.plan_feature.update', $id));
});
Breadcrumbs::for('admin.plan_feature.deactivated', function ($trail) {
    $trail->push(__('strings.backend.plan_feature.title'), route('admin.plan_feature.deactivated'));
});
Breadcrumbs::for('admin.plan_feature.deleted', function ($trail) {
    $trail->push(__('strings.backend.plan_feature.title'), route('admin.plan_feature.deleted'));
});


// plan privilege

Breadcrumbs::for('admin.plan_privilege', function ($trail) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege'));
});
Breadcrumbs::for('admin.plan_privilege.create', function ($trail) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege.create'));
});
Breadcrumbs::for('admin.plan_privilege.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege.edit', $id));
});
Breadcrumbs::for('admin.plan_privilege.update', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege.update', $id));
});
Breadcrumbs::for('admin.plan_privilege.deactivated', function ($trail) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege.deactivated'));
});
Breadcrumbs::for('admin.plan_privilege.deleted', function ($trail) {
    $trail->push(__('strings.backend.plan_privilege.title'), route('admin.plan_privilege.deleted'));
});


Breadcrumbs::for('admin.feedback', function ($trail) {
    $trail->push(__('strings.backend.feedback.title'), route('admin.feedback'));
});
Breadcrumbs::for('admin.feedback.create', function ($trail) {
    $trail->push(__('strings.backend.feedback.title'), route('admin.feedback.create'));
});
Breadcrumbs::for('admin.feedback.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.feedback.title'), route('admin.feedback.edit', $id));

});
Breadcrumbs::for('admin.feedback.deactivated', function ($trail) {
    $trail->push(__('strings.backend.feedback.title'), route('admin.feedback.deactivated'));
});
Breadcrumbs::for('admin.feedback.deleted', function ($trail) {
    $trail->push(__('strings.backend.feedback.title'), route('admin.feedback.deleted'));
});


Breadcrumbs::for('admin.user_level_request', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request'));
});
Breadcrumbs::for('admin.user_level_request.create', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.create'));
});
Breadcrumbs::for('admin.user_level_request.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.edit', $id));

});
Breadcrumbs::for('admin.user_level_request.pending', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.pending'));
});
Breadcrumbs::for('admin.user_level_request.approved', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.approved'));
});
Breadcrumbs::for('admin.user_level_request.not_approved', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.not_approved'));
});
Breadcrumbs::for('admin.user_level_request.cancelled', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.cancelled'));
});
Breadcrumbs::for('admin.user_level_request.deleted', function ($trail) {
    $trail->push(__('strings.backend.user_level_request.title'), route('admin.user_level_request.deleted'));
});

Breadcrumbs::for('admin.ads_details', function ($trail) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.ads_details'));
});
//advertisements
Breadcrumbs::for('admin.advertisements', function ($trail) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements'));
});
Breadcrumbs::for('admin.advertisements.create', function ($trail) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements.create'));
});
Breadcrumbs::for('admin.advertisements.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements.edit', $id));

});
Breadcrumbs::for('admin.advertisements.show', function ($trail, $id) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements.show', $id));

});
Breadcrumbs::for('admin.advertisements.deactivated', function ($trail) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements.deactivated'));
});
Breadcrumbs::for('admin.advertisements.deleted', function ($trail) {
    $trail->push(__('strings.backend.advertisements.title'), route('admin.advertisements.deleted'));
});

//define for Services
Breadcrumbs::for('admin.services', function ($trail) {
    $trail->push(__('strings.backend.services.title'), route('admin.services'));
});
Breadcrumbs::for('admin.services.add', function ($trail) {
    $trail->push(__('strings.backend.services.title'), route('admin.services.add'));
});
Breadcrumbs::for('admin.services.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.services.title'), route('admin.services.edit', $id));
});
Breadcrumbs::for('admin.services.update', function ($trail, $id) {
    $trail->push(__('strings.backend.services.title'), route('admin.services.update', $id));
});

//define for Destination
Breadcrumbs::for('admin.destination', function ($trail) {
    $trail->push(__('strings.backend.destination.title  '), route('admin.destination'));
});
Breadcrumbs::for('admin.destination.add', function ($trail) {
    $trail->push(__('strings.backend.destination.title'), route('admin.destination.add'));
});
Breadcrumbs::for('admin.destination.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.destination.title'), route('admin.destination.edit', $id));
});
Breadcrumbs::for('admin.destination.update', function ($trail, $id) {
    $trail->push(__('strings.backend.destination.title'), route('admin.destination.update', $id));
});
Breadcrumbs::for('admin.trip_page', function ($trail, $id) {
    $trail->push(__('strings.backend.trip_page.title'), route('admin.trip_page', $id));
});


//define for Tours
Breadcrumbs::for('admin.tours', function ($trail) {
    $trail->push(__('strings.backend.tours.title'), route('admin.tours'));
});
Breadcrumbs::for('admin.tours.add', function ($trail) {
    $trail->push(__('strings.backend.tours.title'), route('admin.tours.add'));
});
Breadcrumbs::for('admin.tours.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.tours.title'), route('admin.tours.edit', $id));
});
Breadcrumbs::for('admin.tours.update', function ($trail, $id) {
    $trail->push(__('strings.backend.tours.title'), route('admin.tours.update', $id));
});
Breadcrumbs::for('admin.tours.delete', function ($trail, $id) {
    $trail->push(__('strings.backend.tours.title'), route('admin.tours.delete', $id));
});



//Breadcrumb travel vectors

Breadcrumbs::for('admin.travel_vectors', function ($trail) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors'));
});
Breadcrumbs::for('admin.travel_vectors.create', function ($trail) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.create'));
});
Breadcrumbs::for('admin.travel_vectors.store', function ($trail) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.store'));
});
Breadcrumbs::for('admin.travel_vectors.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.edit', $id));
});
Breadcrumbs::for('admin.travel_vectors.update', function ($trail, $id) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.update', $id));
});
Breadcrumbs::for('admin.travel_vectors.deactivated', function ($trail) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.deactivated'));
});
Breadcrumbs::for('admin.travel_vectors.deleted', function ($trail) {
    $trail->push(__('strings.backend.travel_vectors.title'), route('admin.travel_vectors.deleted'));
});

Breadcrumbs::for('admin.book_information.getDeactivated_book', function ($trail) {
    $trail->push(__('strings.backend.book_information.title'), route('admin.book_information.getDeactivated_book'));
});


Breadcrumbs::for('admin.plan_month', function ($trail) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month'));
});
Breadcrumbs::for('admin.plan_month.create', function ($trail) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.create'));
});
Breadcrumbs::for('admin.plan_month.store', function ($trail) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.store'));
});
Breadcrumbs::for('admin.plan_month.edit', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.edit', $id));
});
Breadcrumbs::for('admin.plan_month.deleted', function ($trail) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.deleted'));
});

Breadcrumbs::for('admin.plan_month.update', function ($trail, $id) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.update', $id));
});

Breadcrumbs::for('admin.plan_month.deactivated', function ($trail) {
    $trail->push(__('strings.backend.plan_month.title'), route('admin.plan_month.deactivated'));
});
/*****************code edit by durgesh(19-02-2020)**************/
require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
