@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.general.home'))

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

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">
      <img src="{{ url('img/frontend/banner-img.png') }}" style="width: 100%; margin-top: 85px;">
      <div style="text-align: center; margin: 30px 0px;">
        <h5>The only tool you need to travel around the world</h5>
        <h6>Discover new destinations, suggestions and useful information to organize trips and holidays.</h6>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 align-self-center" style="margin: 60px auto;">
      <div class="card">
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
            

        
            <div class="row">
                <div class="col">
                    <div class="form-group clearfix login-tbtn bl-btn">
                        <button class="btn btn-sm" type="submit">Login</button>
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