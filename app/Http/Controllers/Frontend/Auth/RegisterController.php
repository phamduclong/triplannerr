<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Plan;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Http\Request;
use App\Models\Advertisement;
/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    { 
        $request_data = $request->all();//dd($request_data);
        abort_unless(config('access.registration'), 404);
        return view('frontend.auth.register', compact('request_data'));
    }

    /**
     * @param RegisterRequest $request
     *
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    { 
        // if($request->role_type=='travel_agency'){ 
        //     abort_unless(config('access.registration'), 404);
        //     $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'password','user_name','role_type','subscription_id','approval_status'));
        //     if($user->active=='true'){
            
               
        //         auth()->login($user);
               
        //         return redirect(url('/view-plans/'.$user->id));
        //     }
        //     else{
        //         auth()->login($user);
        //         event(new UserRegistered($user));
        //         return redirect($this->redirectPath());
        //     }

        //   }else{
            abort_unless(config('access.registration'), 404);
            $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'password','user_name','role_type','approval_status'));
            if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
                event(new UserRegistered($user));
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
      
                return redirect()->guest('main-register')->withFlashSuccess(
                    config('access.users.requires_approval') ?
                        __('exceptions.frontend.auth.confirmation.created_pending') :
                        __('exceptions.frontend.auth.confirmation.created_confirm')
                );
            }
            auth()->login($user);
            event(new UserRegistered($user));
            return redirect($this->redirectPath());  
        // }
    }

     public function main_register()
    {

        return view('frontend.main_register');
    }
  
}
