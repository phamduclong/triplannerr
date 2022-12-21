@extends('backend.layouts.app')

@section('title', __('labels.backend.access.plan_privilege.management') . ' | ' . __('labels.backend.access.plan_privilege.create'))

@section('breadcrumb-links')
    @include('backend.plan_privilege.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.plan_privilege.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.plan_privilege.management')
                            <small class="text-muted">@lang('labels.backend.access.plan_privilege.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_privilege.name'))->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_privilege.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_privilege.controller'))->class('col-md-2 form-control-label')->for('controller') }}

                           <div class="col-md-10">
                                {{ html()->text('controller')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_privilege.controller'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_privilege.action'))->class('col-md-2 form-control-label')->for('action') }}

                            <div class="col-md-10">
                                {{ html()->text('action')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_privilege.action'))
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
