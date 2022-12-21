@extends('backend.layouts.app')

@section('title', __('labels.backend.access.advertisements.management') . ' | ' . __('labels.backend.access.advertisements.create'))

@section('breadcrumb-links')
      @include('backend.emailsettings.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.emailsettings.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.email_setting.management')
                            <small class="text-muted">@lang('labels.backend.access.email_setting.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.type'))->class('col-md-2 form-control-label')->for('title') }} 
                            <div class="col-md-10">
                               <select class="form-control" name="type">
                                   <option>Select</option>
                                   <option value="Request the Download of the Travel Diary">Request the Download of the Travel Diary</option>
                                   <option value="Book or Request Information">Book or Request Information</option>
                                   <option value="Triggered Alert">Triggered Alert</option>
                                   <option value="I am Interested">I'm Interested</option>
                                   <option value="I am Participate">I'm Participate</option>
                               </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.subject'))->class('col-md-2 form-control-label')->for('subject') }} 
                            <div class="col-md-10">
                                {{ html()->textarea('subject')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.subject'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.content'))->class('col-md-2 form-control-label')->for('content') }} 
                            <div class="col-md-10">
                                {{ html()->textarea('content')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.content'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>
                        {{--<div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.sent_to'))->class('col-md-2 form-control-label')->for('sent_to') }} 
                              <div class="col-md-10">
                                {{ html()->text('sent_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.sent_to'))
                                    ->attribute('maxlength', 191)
                                   }}
                              </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.sent_from'))->class('col-md-2 form-control-label')->for('sent_from') }} 
                              <div class="col-md-10">
                                {{ html()->text('sent_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.sent_from'))
                                    ->attribute('maxlength', 191)
                                     }}
                             </div><!--col-->
                         </div>--}}
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
