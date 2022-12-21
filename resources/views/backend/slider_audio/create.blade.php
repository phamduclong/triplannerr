@extends('backend.layouts.app')

@section('title', __('labels.backend.access.travel_report.management') . ' | ' . __('labels.backend.access.travel_report.create'))

@section('breadcrumb-links')
    @include('backend.slider_audio.includes.breadcrumb-links')
@endsection

@section('content')
<style>
  .col-md-3 {
    max-width: 30%;
    float: left;
}
</style>
    {{ html()->form('POST', route('admin.slider_audio.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.slider_audio.management')
                            <small class="text-muted">@lang('labels.backend.access.slider_audio.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.slider_audio.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.slider_audio.title'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                     </div><!--col-->
                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.slider_audio.slider_image'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                               
                                {{ html()->file('slide_audio')
                                    ->class('form-control')
                                    
                                    ->required()
                                    ->autofocus()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                     </div><!--col-->
                </div><!--row-->

            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.slider_audio'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

 
@endsection
