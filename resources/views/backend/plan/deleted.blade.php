@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.plan.management'))

@section('breadcrumb-links')
    @include('backend.plan.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.plan.management') }} <small class="text-muted">{{ __('labels.backend.access.plan.deleted') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.plan.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.plan.table.id')</th>
                            <th>@lang('labels.backend.access.plan.table.name')</th>
                          <!--   <th>@lang('labels.backend.access.plan.table.description')</th> -->
                            <th>@lang('labels.backend.access.plan.table.plan_type')</th>
                            <th>@lang('labels.backend.access.plan.table.amount')</th>
                            <th>@lang('labels.backend.access.plan.table.privilege_ids')</th>
                            <th>@lang('labels.backend.access.plan.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($plan as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->plan_type }}</td>
                                <td>{{ $user->amount }}</td>
                                <td>{{ isset( $user->PrivilegeName ) ? $user->PrivilegeName->name : '' }}</td>
                                <td><?php if($user->status==0){ ?>
                                  <a href="{{ route('admin.plan.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                  <?php } 
                                  else{ ?>
                                  <a href="{{ route('admin.plan.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td"> <a href="{{ route('admin.plan.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.plan.restore_user')"  data-trans-title="@lang('buttons.backend.access.plan.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.plan.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.plan.confirm')">
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
                   {{$plan->total()}} Found Record 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{$plan->render()}} 
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
