@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
    <div class="row d-flex align-items-center px-md-5" style="margin-top: 90px;">
        <div class="col-12 col-md-6">
          <img src="{{ url('img/frontend/banner-img.png') }}" style="width: 100%;">
          <div style="text-align: center; margin: 30px 0px;">
            <h5>The only tool you need to travel around the world</h5>
            <h6>Discover new destinations, suggestions and useful information to organize trips and holidays.</h6>
          </div>
        </div>
        @php     
            if(isset($request_data['role_type']) && !empty($request_data['role_type']))
            {
                $role_type =$request_data['role_type'];           
            }
            $subscription_id=0;
        @endphp 
             
        <div class="col-12 col-md-6 align-self-center">
            <div class="login-form">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                {{ html()->form('POST', route('frontend.auth.register.post'))->id('register_form')->open() }}
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">
                                                    First Name
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }} --}}
        
                                                {{ html()->text('first_name')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.first_name'))
                                                    ->attribute('maxlength', 191)
                                                    ->value(isset($request_data['first_name']) ?$request_data['first_name'] : '')
                                                    ->required() }}
                                            </div>
                                        </div>
        
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">
                                                    Last Name
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }} --}}
        
                                                {{ html()->text('last_name')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.last_name'))
                                                    ->attribute('maxlength', 191)
                                                    ->value(isset($request_data['last_name']) ?$request_data['last_name'] : '')
                                                    ->required() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label for="user_name">
                                                    User Name
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.user_name'))->for('user_name') }} --}}
        
                                                {{ html()->text('user_name')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.user_name'))
                                                    ->attribute('maxlength', 191)
                                                    ->value(isset($request_data['user_name']) ?$request_data['user_name'] : '')
                                                    ->required() }}
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email">
                                                    E-mail Address
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }} --}}
        
                                                {{ html()->email('email')
                                                    ->class('form-control')
                                                    ->placeholder(__('validation.attributes.frontend.email'))
                                                    ->attribute('maxlength', 191)
                                                    ->value(isset($request_data['email']) ?$request_data['email'] : '')
                                                    ->required() }}
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="password">
                                                    Password
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }} --}}
        
                                                {{ html()->password('password')
                                                    ->class('form-control')
                                                    ->id('myPassword')
                                                    ->placeholder(__('validation.attributes.frontend.password'))
                                                    ->value(isset($request_data['password']) ?$request_data['password'] : '')
                                                    ->required() }}
                                            </div>
                                        </div>
                                    </div>
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
                                                <label for="password_confirmation">
                                                    Password Confirmation
                                                    <span style="color: red">*</span>
                                                </label>
                                                {{-- {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }} --}}
        
                                                {{ html()->password('password_confirmation')
                                                    ->class('form-control')
                                                    ->id('passwordConfirm')
                                                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                                    ->value(isset($request_data['password_confirmation']) ?$request_data['password_confirmation'] : '')
                                                    ->required() }}
                                                
                                                <input type="hidden" name="role_type" value="{{ isset($request_data['role_type']) ?$request_data['role_type'] : $role_type}}">
                                                <input type="hidden" name="approval_status" value="{{ isset($request_data['approval_status']) ?$request_data['approval_status'] : 0}}">
                                            </div>
                                        </div>
                                    </div>
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
                                        <div class="col-12 col">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                       <input type="checkbox" name="privacy_policy" required="true" id="policy" <?php if( isset($request_data['approval_status']) && $request_data['approval_status'] == 1 ){ echo 'checked="checked"'; }?>> 
                                                        
                                                        <!-- <a href="{{url('/characteristics-conditions',$role_type)}}">I agree Travelmaker's Terms  & Conditions and Privacy Notice.</a> -->
                                                        You must read and accept <a href="{{url('/characteristics-conditions',$role_type)}}" target="_blank" class="accpet_tc">Travelmaker's Terms & Conditions and Privacy Notice</a> before proceeding.
        
                                                    </label>
                                                </div> 
                                            </div>
                                        </div>
                                    </div> 
        
                                    @if(config('access.captcha.registration'))
                                        <div class="row">
                                            <div class="col">
                                                @captcha
                                                {{ html()->hidden('captcha_status', 'true') }}
                                            </div>
                                        </div>
                                    @endif
        
                                    @if($role_type=='traveler')
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group clearfix login-tbtn gr-btn">
                                                     <button id="register-btn" class="btn btn-success btn-sm pull-right" type="submit">Register</button>
                                                  </div>
                                            </div>
                                        </div>
                                    @elseif($role_type=='travel_maker')
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group clearfix login-tbtn bl-btn">
                                                    <button id="register-btn" class="btn btn-success btn-sm pull-right" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($role_type=='travel_blogger')
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group clearfix login-tbtn pur-btn">
                                                 <button id="register-btn" class="btn btn-success btn-sm pull-right" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($role_type=='travel_agency')
                                        <input type="hidden" name="subscription_id" value="{{$subscription_id}}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group clearfix login-tbtn sk-btn">
                                                    <button id="register-btn" class="btn btn-success btn-sm pull-right" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                   
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
        </div>
    </div>
@endsection

@push('after-scripts')
  
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->

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

    function showPasswordConfirm(){
        var x = document.getElementById("passwordConfirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
