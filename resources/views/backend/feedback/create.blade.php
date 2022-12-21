@extends('backend.layouts.app')

@section('title', __('labels.backend.access.feedback.management') . ' | ' . __('labels.backend.access.feedback.create'))

@section('breadcrumb-links')
    @include('backend.feedback.includes.breadcrumb-links')
@endsection
 
@section('content')
    {{ html()->form('POST', route('admin.feedback.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.feedback.management')
                            <small class="text-muted">@lang('labels.backend.access.feedback.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">

                            {{ html()->label(__('validation.attributes.backend.access.feedback.feedback_type'))->class('col-md-2 form-control-label')->for('feedback_type') }}

                            <div class="col-md-10">
                                @php
                                    $feedback_type = ['' => 'Select Feedback Type', 'user' => 'user', 'tour_report' => 'tour_report'];
                                @endphp

                                 {{ html()->select('feedback_type')
                                    ->class('form-control')
                                    ->options($feedback_type)
                                }}
                               
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.content'))->class('col-md-2 form-control-label')->for('content') }}

                           <div class="col-md-10">
                                {{ html()->text('content')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.content'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type1'))->class('col-md-2 form-control-label')->for('rating_type1') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type1')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type1'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type2'))->class('col-md-2 form-control-label')->for('rating_type2') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type2')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type2'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type2'))->class('col-md-2 form-control-label')->for('rating_type3') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type3')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type3'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type4'))->class('col-md-2 form-control-label')->for('rating_type4') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type4')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type4'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type5'))->class('col-md-2 form-control-label')->for('rating_type5') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type5')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type5'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                         <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type6'))->class('col-md-2 form-control-label')->for('rating_type6') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type6')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type6'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.feedback.rating_type7'))->class('col-md-2 form-control-label')->for('rating_type7') }}

                           <div class="col-md-10">
                                {{ html()->text('rating_type7')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.feedback.rating_type7'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
               </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.plan_privilege'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
