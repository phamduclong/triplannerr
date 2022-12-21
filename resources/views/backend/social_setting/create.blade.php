@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.social_settings.create-page'))

@section('breadcrumb-links')
    @include('backend.social_setting.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.social_settings.store'))->class('form-horizontal')->open() }}
<div class="card">


<div class="card-body">
  <div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            @lang('labels.backend.access.social_settings.social_settings')
            <small class="text-muted"> @lang('labels.backend.access.social_settings.edit-page')</small>
        </h4>
    </div><!--col-->
</div><!--row-->
<div class="row mt-4 mb-4">
    <div class="col">
        <div class="form-group row">
        {{ html()->label(__('validation.attributes.backend.access.social_setting.fb_url'))->class('col-md-2 form-control-label')->for('fb_url') }}

           <div class="col-md-10">
                <input type="text" class="form-control" name="fb_url" value="@if(!empty($social_setting)){{isset($social_setting->fb_url)?$social_setting->fb_url:''}}@endif"> 
               
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
        {{ html()->label(__('validation.attributes.backend.access.social_setting.twitter_url'))->class('col-md-2 form-control-label')->for('twitter_url') }}
            <div class="col-md-10">
               <input type="text" class="form-control" name="twitter_url" value="@if(!empty($social_setting)){{isset($social_setting->twitter_url)?$social_setting->twitter_url:''}}@endif"> 
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
        {{ html()->label(__('validation.attributes.backend.access.social_setting.instagram_url'))->class('col-md-2 form-control-label')->for('instagram_url') }}
            <div class="col-md-10">
               <input type="text" class="form-control" name="instagram_url" value="@if(!empty($social_setting)){{isset($social_setting->instagram_url)?$social_setting->instagram_url:''}}@endif"> 
            </div><!--col-->
           </div><!--form-group-->

        <div class="form-group row">
        {{ html()->label(__('validation.attributes.backend.access.social_setting.you_tube'))->class('col-md-2 form-control-label')->for('tiktok_url') }}

            <div class="col-md-10">
               <input type="text" class="form-control" name="tiktok_url" value="@if(!empty($social_setting)){{isset($social_setting->tiktok_url)?$social_setting->tiktok_url:''}}@endif"> 
            </div><!--col-->
        </div><!--form-group-->
    </div>
</div>

<div class="card-footer clearfix">
<div class="row">
<div class="col">
    {{ form_cancel(route('admin.social_settings'), __('buttons.general.cancel')) }}
</div><!--col-->

<div class="col text-right">
    {{ form_submit(__('buttons.general.crud.update')) }}
</div><!--col-->
</div><!--row-->
</div><!--card-footer-->

</div>
{{ html()->form()->close() }}



@endsection
