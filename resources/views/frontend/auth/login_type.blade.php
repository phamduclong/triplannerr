@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
  <?php // @include('frontend.includes.travelmaker.home_slider') ?>

<div class="inner-banner">
    <img src="{{url('img/frontend/banner-img.png')}}">
    <!-- <h1>Login</h1> -->
</div> 

<div class="login-form">
  <div class="container">
    <div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 align-self-center">
        <div class="card">
            <!-- <div class="card-header">
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
                                    ->placeholder(__('validation.attributes.frontend.password'))
                                    ->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="checkbox">
                                    {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                </div>
                            </div>
                        </div>
                    </div>

                  <input type="hidden" name="role_type" value="@if($role_type){{isset($role_type)?$role_type:''}}@endif">
                    <div class="row">
                        <div class="col">
                            <div class="form-group clearfix login-fbtn">
                                {{ form_submit(__('labels.frontend.auth.login_button')) }}
                            </div>
                        </div>
                    </div>

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
