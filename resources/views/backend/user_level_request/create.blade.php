@extends('backend.layouts.app')

@section('title', __('labels.backend.access.user_level_request.management') . ' | ' . __('labels.backend.access.user_level_request.create'))

@section('breadcrumb-links')
    @include('backend.user_level_request.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.user_level_request.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.user_level_request.management')
                            <small class="text-muted">@lang('labels.backend.access.user_level_request.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
               <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">

                            {{ html()->label(__('validation.attributes.backend.access.user_level_request.current_role_id'))->class('col-md-2 form-control-label')->for('user_level_request_type') }}

                            <div class="col-md-10">
                               {{ html()->text('current_role_id')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.user_level_request.current_role_id'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.user_level_request.new_role_id'))->class('col-md-2 form-control-label')->for('content') }}

                           <div class="col-md-10">
                                {{ html()->text('new_role_id')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.user_level_request.new_role_id'))
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
