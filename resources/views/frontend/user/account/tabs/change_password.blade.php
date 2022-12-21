@extends('frontend.layouts.travelmaker')

@section('content')
<div class="login-form">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col col-sm-6">
            <div class="card" style="margin-top: 90px;">
                <div class="card-body">
                    <h3 style="text-align: center; margin-bottom: 25px; color: #0198cd;">Change Password</h3>
            {{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                            {{ html()->password('old_password')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.old_password'))
                                ->autofocus()
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
                        <div class="form-group mb-0 clearfix">
                            {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password'))->class('more_btn')}}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                
            {{ html()->form()->close() }}
            </div>
          </div>
        </div>
      </div>
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