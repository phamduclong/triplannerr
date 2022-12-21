@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.plan_feature.management'))

@section('breadcrumb-links')
    @include('backend.plan_feature.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.plan_feature.management') }} <small class="text-muted">{{ __('labels.backend.access.plan_feature.deactivated') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.plan_feature.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.plan_feature.table.id')</th>
                            <th>@lang('labels.backend.access.plan_feature.table.feature_name')</th>
                            <th>@lang('labels.backend.access.plan_feature.table.plan_privilege_id')</th>
                            <th>@lang('labels.backend.access.plan_feature.table.occurence')</th>
                            <th>@lang('labels.backend.access.plan_feature.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($plan_feature as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->feature_name }}</td>
                                <td>{{ isset( $user->PrivilegeName ) ? $user->PrivilegeName->name : '' }}</td>
                                <td>{{ $user->occurence }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.plan_feature.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.plan_feature.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td">@include('backend.plan_feature.includes.actions', ['user' => $user])</td>
                            </tr>
                           <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
