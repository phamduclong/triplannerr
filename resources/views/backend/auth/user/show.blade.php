@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.users.management')
                    <small class="text-muted">@lang('labels.backend.access.users.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    
                   @if($user->role_type=='admin')
                   <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>

                    </li>
                   @else
                   <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.first')</a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.second')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.third')</a>
                    </li>
                    
                   @endif
                </ul>

                <div class="tab-content">
                     @if($user->role_type=='admin')
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.overview')
                    </div><!--tab-->
                      @else
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.overview')
                    </div><!--tab-->
                    <div class="tab-pane" id="first" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.first')
                    </div><!--tab-->
                    <div class="tab-pane" id="second" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.second')
                    </div><!--tab-->
                    <div class="tab-pane" id="third" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.third')
                    </div><!--tab-->
                   @endif
                </div><!--tab-content-->

              
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($user->created_at) }} ({{ $user->created_at->diffForHumans() }}),
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($user->updated_at) }} ({{ $user->updated_at->diffForHumans() }})
                    @if($user->trashed())
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($user->deleted_at) }} ({{ $user->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
