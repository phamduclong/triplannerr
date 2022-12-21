@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')

   @include('frontend.includes.travelmaker.home_slider')
<div class="login-form">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card">
                <!--<div class="card-header">
                    <strong>
                        @lang('labels.frontend.passwords.reset_password_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open() }}
                        {{ html()->hidden('token', $token) }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->value($email)
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->id('myPassword')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-7">
                                {{-- <i class="fa fa-eye" aria-hidden="true"></i>
                                <i class="fa fa-eye-slash" aria-hidden="true"></i> --}}
                                <input type="checkbox" onclick="showPassword()">
                                <span style="font-size: 15px">Show Password</span>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->id('passwordConfirm')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-7">
                                {{-- <i class="fa fa-eye" aria-hidden="true"></i>
                                <i class="fa fa-eye-slash" aria-hidden="true"></i> --}}
                                <input type="checkbox" onclick="showPasswordConfirm()">
                                <span style="font-size: 15px">Show Password Confirm</span>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix ">
                                    {{ form_submit(__('labels.frontend.passwords.reset_password_button'))->class('more_btn') }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-6 -->
    </div><!-- row -->
</div>
</div>
@endsection
<script>
    function showPassword(){
        var x = document.getElementById("myPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function showPasswordConfirm(){
        var x = document.getElementById("passwordConfirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>