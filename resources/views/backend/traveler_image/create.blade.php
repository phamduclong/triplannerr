@extends('backend.layouts.app')

@section('title', __('labels.backend.access.plan_feature.management') . ' | ' . __('labels.backend.access.plan_feature.create'))

@section('breadcrumb-links')
    @include('backend.plan_feature.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.plan_feature.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                           Traveler Image
                            <small class="text-muted">Create Traveler Image</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_feature.feature_name'))->class('col-md-2 form-control-label')->for('feature_name') }}

                            <div class="col-md-10">
                                {{ html()->file('feature_name')
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
                        {{ form_cancel(route('admin.plan_feature'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
