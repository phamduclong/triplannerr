<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off' => '(If confirmed is off)',
                'no_deactivated' => 'There are no deactivated users.',
                'no_deleted' => 'There are no deleted users.',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],

        'dashboard' => [
            'title' => 'Dashboard',
            'welcome' => 'Welcome',
        ],

		/*****************code edit by durgesh(19-02-2020)**************/
        'travelcateg' => [
            'title' => 'Travel Category',
            'welcome' => 'Welcome',
        ],
         'emailsettings' => [
            'title' => 'Email Settings',
            'welcome' => 'Welcome',
        ],
       'staticpage' => [
            'title' => 'Static Page',
            'welcome' => 'Welcome',
        ],
        'social_settings' => [
            'title' => 'Social Settings',
            'welcome' => 'Welcome',
        ],
        'slider_audio' => [
            'title' => 'Slider Audio',
            'welcome' => 'Welcome',
        ],
        'subscription' => [
            'title' => 'Subscription Plans',
            'welcome' => 'Welcome',
        ],
        'book_information' => [
            'title' => 'Book Information',
            'welcome' => 'Welcome',
        ],
		'tour' => [
            'title' => 'Tour Report',
            'welcome' => 'Welcome',
        ],
        'services' => [
            'title' => 'Services',
            'welcome' => 'Welcome',
        ],
        'destination' => [
            'title' => 'Destination',
            'welcome' => 'Welcome',
        ],
        'tours' => [
            'title' => 'Tours',
            'welcome' => 'Welcome',
        ],

        'tour_carriers' => [
            'title' => 'Tour Carriers',
            'welcome' => 'Welcome',
        ],

        'tour_report' => [
            'title' => 'Travel Report',
            'welcome' => 'Welcome',
        ],

         'travel_report' => [
            'title' => 'Travel Report',
            'welcome' => 'Welcome',
        ],

       
        'plan' => [
            'title' => 'Plan',
            'welcome' => 'Welcome',
        ],

        'plan_feature' => [
            'title' => 'Plan Feature',
            'welcome' => 'Welcome',
        ],

        'plan_privilege' => [
            'title' => 'Plan Privileges',
            'welcome' => 'Welcome',
        ],


        'feedback' => [
            'title' => 'Feedback',
            'welcome' => 'Welcome',
        ],

        'user_level_request' => [
            'title' => 'Request',
            'welcome' => 'Welcome',
        ],

        'advertisements' => [
            'title' => 'Advertisements',
            'welcome' => 'Welcome',
        ],

        'travel_report_trip_page' => [
            'title' => 'Travel Report Trip Page',
            'welcome' => 'Welcome',
        ],

        'travel_vectors' => [
            'title' => 'Travel Vector',
            'welcome' => 'Welcome',
        ],

        'plan_month' => [
            'title' => 'Plan Month',
            'welcome' => 'Welcome',
        ],

        'trip_page' => [
            'title' => 'Trip Page',
            'welcome' => 'Welcome',
        ],
        /*****************code edit by durgesh(19-02-2020)**************/

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure' => 'Are you sure you want to do this?',
            'boilerplate_link' => 'Laravel Boilerplate',
            'continue' => 'Continue',
            'member_since' => 'Member since',
            'minutes' => ' minutes',
            'search_placeholder' => 'Search...',
            'timeout' => 'You were automatically logged out for security reasons since you had no activity in ',

            'see_all' => [
                'messages' => 'See all messages',
                'notifications' => 'View all',
                'tasks' => 'View all tasks',
            ],

            'status' => [
                'online' => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages' => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks' => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty' => 'Please enter a search term.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title' => 'Search Results',
            'results' => 'Search Results for :query',
        ],

        'welcome' => 'Welcome to the Dashboard',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'Your account has been confirmed.',
            'error' => 'Whoops!',
            'greeting' => 'Hello!',
            'regards' => 'Regards,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',

            'password_reset_subject' => 'Reset Password',
            'password_cause_of_email' => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password' => 'Click here to reset your password',

            'click_to_confirm' => 'Click here to confirm your account:',
        ],

        'contact' => [
            'email_body_title' => 'You have a new contact form request: Below are the details:',
            'subject' => 'A new :app_name contact form submission!',
        ],
    ],

    'frontend' => [
        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined' => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'If you change your e-mail you will be logged out until you confirm your new e-mail address.',
            'email_changed_notice' => 'You must confirm your new e-mail address before you can log in again.',
            'profile_updated' => 'Profile successfully updated.',
            'password_updated' => 'Password successfully updated.',
        ],

        'welcome_to' => 'Welcome to :place',
    ],
];
