@extends('frontend.layouts.travelmaker')

@section('content')
  
<div class="inner-banner">
          @if(!empty($user_data->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$user_data->cover_image)) )
           <img src="{{url('img/frontend/user/cover/'.$user_data->cover_image)}}" class="img-responsive" width="100" height="100">
           @else
            <img src="{{url('img/frontend/inner-banner.jpg')}}">
            @endif    
</div> 
<div class="login-form">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col col-sm-6">
            <div class="card">
                <div class="card-body">
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
                                ->placeholder(__('validation.attributes.frontend.password'))
                                ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                            {{ html()->password('password_confirmation')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

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
