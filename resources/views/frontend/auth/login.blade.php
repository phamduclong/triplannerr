@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
   @include('frontend.includes.travelmaker.home_slider')

 @php if(isset($_GET['role_type']) && !empty($_GET['role_type']))
{
$role_type =$_GET['role_type'];
}   
@endphp

@php if(isset($_GET['emailConfirm']) && !empty($_GET['emailConfirm']))
{
$emailConfirm =$_GET['emailConfirm'];
}   
@endphp

@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif
<!-- <div class="inner-banner">
<img src="{{url('img/frontend/login.jpg')}}">

</div>
 -->
<div class="login-form">
  <div class="container">
    <div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 align-self-center">
        <div class="card">
           <!--  <div class="card-header">
                <strong>
                    @lang('labels.frontend.auth.login_box_title')
                </strong>
            </div> -->

            <div class="card-body">
                {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.email'))
                                    ->attribute('maxlength', 191)
                                    ->value(isset($emailConfirm) ? $emailConfirm : '')
                                    ->required() }}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                {{ html()->password('password')
                                    ->class('form-control')
                                    ->id('myPassword')
                                    ->placeholder(__('validation.attributes.frontend.password'))
                                    ->required() }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-7">
                            {{-- <i class="fa fa-eye" aria-hidden="true"></i>
                            <i class="fa fa-eye-slash" aria-hidden="true"></i> --}}
                            <input type="checkbox" onclick="showPassword()">
                            <span style="font-size: 15px">Show Password</span>
                        </div>
                    </div>

                <!--     <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="checkbox">
                                    {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="checkbox agree_msg">
                                <input type="checkbox" name="" required="">
                                <ul>
                                    <li>I agree to receive periodic communications from "Travel Maker.info" relating to:</li>
                                    <li>- information on website updates</li>
                                    <li>- communications regarding the activities carried out by me within the platform </li>
                                   <li> - commercial proposals</li>
                                </ul>
                                 </div>
                            </div>
                        </div>
                    </div>-->
                  <input type="hidden" name="role_type" value="{{isset($role_type)?$role_type:'admin'}}">
            @if($role_type=='traveler')
                    <div class="row">
                        <div class="col">
                            <div class="form-group clearfix login-tbtn gr-btn">
                                <button class="btn btn-sm pull-right" type="submit">Login</button>
                              </div>
                        </div>
                    </div>
           @elseif($role_type=='travel_maker')
                  <div class="row">
                        <div class="col">
                            <div class="form-group clearfix login-tbtn bl-btn">
                                <button class="btn btn-sm pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
            @elseif($role_type=='travel_blogger')
                  <div class="row">
                        <div class="col">
                            <div class="form-group clearfix login-tbtn pur-btn">
                              <button class="btn btn-sm pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
            @elseif($role_type=='travel_agency')
                  <div class="row">
                        <div class="col">
                            <div class="form-group clearfix login-tbtn sk-btn">
                              <button class="btn btn-sm pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
            @endif
            @if(config('access.captcha.login'))
                        <div class="row">
                            <div class="col">
                                @captcha
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="form-group text-right forget-msg">
                                <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}

                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            @include('frontend.auth.includes.socialite')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@push('after-scripts')
    @if(config('access.captcha.login'))
        @captchaScripts
    @endif
@endpush

<style type="text/css">
.ads_section1 p {
    font-size: 13px;
    background: #F1F1F1;
    line-height: 22px;
    padding: 10px;
    box-shadow: 0px 2px 5px #aaa;
    margin-top: -2px;
}
.ads_section1 a img {
    margin-bottom: 0px !important;
}

.ads_section1 p{
    width: 279px;
}

</style>
<script>
    function showPassword(){
        var x = document.getElementById("myPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>