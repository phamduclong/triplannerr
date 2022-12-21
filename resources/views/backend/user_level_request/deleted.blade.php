@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.user_level_request.management'))

@section('breadcrumb-links')
    @include('backend.user_level_request.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.user_level_request.management') }} <small class="text-muted">{{ __('labels.backend.access.user_level_request.deleted') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    
                </div><!--col-->
                <!--col-->
            </div><!--row-->
           <div class="row mt-4">
              <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.user_level_request.table.id')</th>
                            <th>@lang('labels.backend.access.user_level_request.table.current_role_id')</th>
                            <th>@lang('labels.backend.access.user_level_request.table.new_role_id')</th>
                            <th>@lang('labels.backend.access.user_level_request.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($user_level_request as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ isset( $user->RoleName ) ? $user->RoleName->name : '' }}</td>
                                <td>{{ isset( $user->RoleNewName ) ? $user->RoleNewName->name : '' }}</td>
                                <td>{{ $user->status }}</td>
                                <td class="btn-td"> <a href="{{ route('admin.user_level_request.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.user_level_request.restore_user')"  data-trans-title="@lang('buttons.backend.access.user_level_request.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.user_level_request.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.user_level_request.confirm')">
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
                    {{$user_level_request->total()}} Found Record
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{$user_level_request->render()}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
