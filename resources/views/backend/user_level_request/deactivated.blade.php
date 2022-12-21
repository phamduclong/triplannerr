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
                        {{ __('labels.backend.access.user_level_request.management') }} <small class="text-muted">{{ __('labels.backend.access.user_level_request.deactivated') }}</small>
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
                                <td>{{ $user->current_role_id }}</td>
                                <td>{{ $user->new_role_id }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.user_level_request.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.user_level_request.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td">@include('backend.user_level_request.includes.actions', ['user' => $user])</td>
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
