<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdatePasswordRequest;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Models\UserDetails;
use App\Models\Countries\Countries;
use Auth;

/**
 * Class UpdatePasswordController.
 */
class UpdatePasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
         $this->redirectTo=route('frontend.index');
    }


    /**
     * @param UpdatePasswordRequest $request
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function update(UpdatePasswordRequest $request)
    {
        
        $this->userRepository->updatePassword($request->only('old_password', 'password'));
        // return view('frontend.main_login');
        
        return redirect()->back()->withFlashSuccess(__('strings.frontend.user.password_updated'));
    }

    public function change_pwd(){
          $id = Auth::user()->id;
          $user_data = UserDetails::with('user.user_images')->where('user_id',$id)->first();
          $countries = Countries::select('name', 'id')
                ->pluck('name', 'id')
                ->toArray();
        return view('frontend.user.account.tabs.change_password',compact('user_data', 'countries'));
    }  
}  
