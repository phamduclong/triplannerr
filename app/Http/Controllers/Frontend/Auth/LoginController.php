<?php

namespace App\Http\Controllers\Frontend\Auth;
use Auth;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Models\Advertisement;
/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function credentials(Request $request)
    {

     // dd($request->all());
      return $request->only($this->username(), 'password','role_type','first_name','last_name');
    }

    public function login(Request $request)
    {
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        if ($this->attemptLogin($request) && $request->role_type='traveler') {
            if(str_replace(url('/'), '', url()->previous()) == '/main-login'){
                $first_name = Auth::user()->first_name;
                $last_name = Auth::user()->last_name;
                $role_type = Auth::user()->role_type;
                $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . Auth::user()->id;

                if(Auth::user()->security_user == 'pending'){
                    $link = 'control-panel';
                }
                if(Auth::user()->security_user == 'cancel'){
                    $this->logout($request);
                    return redirect()->back()->withFlashWarning("These credentials do not match our records");
                }

                $request->session()->regenerate();
                $this->clearLoginAttempts($request);
                return $this->authenticated($request, $this->guard()->user())
                            ? redirect()->to($link) : redirect()->intended($this->redirectPath());

                // return redirect()->to($link);
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        $logged_in_user= auth::user();
        if (auth()->check()) {
            return url(after_login_url($logged_in_user));
        }
        return route('frontend.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showLoginFormwithtype($type)
    {
        $role_type = $type;
        return view('frontend.auth.login_type',compact('role_type'));
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => PasswordRules::login(),
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Check to see if the users account is confirmed and active
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
        }

        if (! $user->isActive()) {
            auth()->logout();

            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        if (config('access.users.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }
        // die('bevkuf');
        // dd($this->redirectPath());
        return redirect($this->redirectPath());
        // return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Fire event, Log out user, Redirect
        event(new UserLoggedOut($request->user()));

        // Laravel specific logic
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }


    public function main_login()
    {
        return view('frontend.main_login');
    }

}
