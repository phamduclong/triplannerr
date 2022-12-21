@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report.management'))

@section('breadcrumb-links')
    @include('backend.travel_report.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.travel_report.management') }} <small class="text-muted">{{ __('labels.backend.access.travel_report.active') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.travel_report.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.travel_report.table.id')</th>
                            <th>@lang('labels.backend.access.travel_report.table.title')</th>
                          <!--   <th>@lang('labels.backend.access.travel_report.table.description')</th> -->
                             <th>@lang('labels.backend.access.travel_report.table.category_id')</th>
                            <th>@lang('labels.backend.access.travel_report.table.report_date')</th>
                            <th>@lang('labels.backend.access.travel_report.table.travel_time')</th>
                            <th>@lang('labels.backend.access.travel_report.table.report_country')</th>
                            <th>@lang('labels.backend.access.travel_report.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($travel_report as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->title }}</td>
                                <td>{{ isset( $user->CategoryName ) ? $user->CategoryName->name : '' }}</td>
                                <td>{{ $user->report_date }}</td>
                                <td>{{ $user->travel_time }}</td>
                                <td>{{ $user->report_country }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.travel_report.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.travel_report.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                       <td class="btn-td"> <a href="{{ route('admin.travel_report.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.travel_report.restore_user')"  data-trans-title="@lang('buttons.backend.access.travel_report.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.travel_report.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.travel_report.confirm')">
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
