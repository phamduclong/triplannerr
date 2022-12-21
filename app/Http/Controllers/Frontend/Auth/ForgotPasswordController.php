<?php

namespace App\Http\Controllers\Frontend\Auth;

use Auth;
use App\Auth\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\ForgetPassword\SendForgetPasswordRequest;
use App\Mail\Frontend\ForgetPassword\ForgetPassword;
use Illuminate\Support\Facades\Mail;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('frontend.auth.passwords.email');
    }


    public function send(SendForgetPasswordRequest $request)
    {
        ///dd($request->all());
        Mail::send(new ForgetPassword($request));

        //check the auth user email fount or not found
        //if(Auth::User()){
        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent'));
        //}
        //else {
        // echo 'email id not found';
       // }

    }
}
