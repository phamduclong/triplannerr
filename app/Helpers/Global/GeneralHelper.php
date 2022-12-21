<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            }

            return 'frontend.user.account';
        }

        return 'frontend.index';
    }
}

if (! function_exists('after_login_url')) {

    function after_login_url($logged_in_user)
    {
        //Se è un admin lo ridireziono sul pannello di admin
        if ($logged_in_user->can('view backend')) {
            return 'admin/dashboard';
        }

        //Se l'utente non ha terminato la registrazione
        if(!$logged_in_user->registration_completed) {
            return 'account';
        }
        
        $fullname = strtolower($logged_in_user->first_name.$logged_in_user->last_name);
        return 'profile/'.$logged_in_user->role_type.'/'.$fullname.'/'.$logged_in_user->id;
    }
    
}