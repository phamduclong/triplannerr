@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.social_settings.social_settings'))

@section('breadcrumb-links')
    @include('backend.social_setting.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
 <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.social_settings.social_settings') }} <small class="text-muted">{{ __('labels.backend.access.social_settings.active') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.social_setting.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->



            <div class="row mt-4">
              <div class="col">
                <div class="table-responsive">
                         <table class="table">
                         <thead>
                           <th>@lang('labels.backend.access.social_settings.table.sno')</th>
                             <th>@lang('labels.backend.access.social_settings.table.fb_url')</th>

                             <th>@lang('labels.backend.access.social_settings.table.twitter_url')</th>
                             <th>@lang('labels.backend.access.social_settings.table.instagram_url')</th>
                             <th>@lang('labels.backend.access.social_settings.table.tiktok_url')</th>
                          
                             <th>@lang('labels.general.actions')</th>
                         </thead>
                         <tbody>
                           
                         </tbody>
                     </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
