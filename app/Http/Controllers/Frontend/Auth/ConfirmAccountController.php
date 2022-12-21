<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Models\Auth\User;

/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function confirm($token)
    {  
        $user_data=User::where('confirmation_code',$token)->first();
        $user = $this->user->confirm($token);
        $role_type=$user_data->role_type;
        $emailConfirm = $user_data->email;
        
        return redirect()->route('frontend.auth.login',compact('role_type', 'emailConfirm'))->withSuccess('Your account has been successfully confirmed!');
        //return view('frontend.auth.login',compact('role_type'))->withFlashSuccess(__('exceptions.frontend.auth.confirmation.success'));
    }

    /**
     * @param $uuid
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function sendConfirmationEmail($uuid)
    {
        //$user_data=User::where('uuid',$uuid)->first();
        //dd($user_data->role_type);
        $user = $this->user->findByUuid($uuid);
        $role_type=$user->role_type;
         //dd($user);
        if ($user->isConfirmed()) {
            return redirect()->route('frontend.auth.login', compact('role_type'))->withFlashSuccess(__('exceptions.frontend.auth.confirmation.already_confirmed'));
             
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->route('frontend.auth.login', compact('role_type'))->withFlashSuccess(__('exceptions.frontend.auth.confirmation.resent'));
    }
}
