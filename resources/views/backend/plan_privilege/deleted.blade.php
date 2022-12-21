@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.plan_privilege.management'))

@section('breadcrumb-links')
    @include('backend.plan_privilege.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.plan_privilege.management') }} <small class="text-muted">{{ __('labels.backend.access.plan_privilege.deleted') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.plan_privilege.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.plan_privilege.table.id')</th>
                            <th>@lang('labels.backend.access.plan_privilege.table.name')</th>
                            <th>@lang('labels.backend.access.plan_privilege.table.controller')</th>
                            <th>@lang('labels.backend.access.plan_privilege.table.action')</th>
                            <th>@lang('labels.backend.access.plan_privilege.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($plan_privilege as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->controller }}</td>
                                <td>{{ $user->action }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.plan_privilege.status_plan_privilege', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.plan_privilege.status_plan_privilege', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td"> <a href="{{ route('admin.plan_privilege.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.plan_privilege.restore_user')"  data-trans-title="@lang('buttons.backend.access.plan_privilege.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.plan_privilege.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.plan_privilege.confirm')">
                                <i class="fas fa-sync"></i>
                                </a>
                                </td>
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
