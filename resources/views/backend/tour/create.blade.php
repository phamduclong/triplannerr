@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tour.create-tour'))

@section('breadcrumb-links')
    @include('backend.tour.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->form('POST', route('admin.tour.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.tour.tour-report')
                        <small class="text-muted">
                        @lang('labels.backend.access.tour.create-tour')
                        </small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.title'))->class('col-md-2 form-control-label')->for('title') }}
                            <div class="col-md-10">
                                {{ html()->text('title')
                                         ->class('form-control')
                                         ->placeholder(__('validation.attributes.backend.access.tour.title'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                            </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.description'))->class('col-md-2 form-control-label')->for('description') }}
                            <div class="col-md-10">
                                {{ html()->textarea('tour_description')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.tour.description'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                            </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.rate'))->class('col-md-2 form-control-label')->for('rate') }}
                            <div class="col-md-10">
                                <input type="number" class="form-control"  onKeyPress="if(this.value.length==10) return false;"  name="rate" min="1" max="5000" placeholder="{{ __('validation.attributes.backend.access.tour.rate') }}" required >
                            </div><!--col-->
                </div><!--form-group-->


                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.banner'))->class('col-md-2 form-control-label')->for('banner') }}
                            <div class="col-md-10">
                                {{ html()->file('banner_image')
                                        ->class('form-control')
                                        ->required() }}
                            </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.multiple_image'))->class('col-md-2 form-control-label')->for('multiple_image') }}
                            <div class="col-md-10">
                                <input required type="file" accept="image/png, image/jpeg" class="form-control" name="multiple_image[]" multiple>
                            </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.cost'))->class('col-md-2 form-control-label')->for('cost') }}
                            <div class="col-md-10">
                                <input type="number" class="form-control"  onKeyPress="if(this.value.length==1) return false;"  name="cost" min="1" max="5" placeholder="{{ __('validation.attributes.backend.access.tour.cost') }}" required >
                            </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tour.review'))->class('col-md-2 form-control-label')->for('review') }}
                            <div class="col-md-10">
                                <textarea class="form-control" name="review">
                                </textarea>
                            </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card-footer clearfix">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.tour'), __('buttons.general.cancel')) }}
            </div><!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.create')) }}
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->

</div>

{{ html()->form()->close() }}

@endsection
