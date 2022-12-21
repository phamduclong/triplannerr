@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report.management'))

@section('breadcrumb-links')
    @include('backend.travel_report.includes.breadcrumb-links')
@endsection

@section('content') 
 <style>
 div.dataTables_wrapper div.dataTables_paginate {
    margin: 4px 252px !important;
    font-size: 16px !important;
}
li.paginate_button {
    padding: 7px !important;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.travel_report.management') }} <small class="text-muted">{{ __('labels.backend.access.travel_report.active') }}</small>
					</h4>
				</div><!--col-->

				{{--<div class="col-sm-7">
					@include('backend.travel_report.includes.header-buttons')
				</div>--}}<!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive" style="overflow-x:auto;">
                     <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.travel_report.table.id')</th>
                           <th>@lang('labels.backend.access.travel_report.table.title')</th>
                           <th>@lang('labels.backend.access.travel_report.table.user_id')</th>
                           <th>@lang('labels.backend.access.travel_report.table.email')</th>
                           <th>@lang('labels.backend.access.travel_report.table.category_id')</th>
                            <th>@lang('labels.backend.access.travel_report.table.start_date')</th>
                            <th>@lang('labels.backend.access.travel_report.table.end_date')</th>
                           
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
                                <td>{{ isset( $user ) ? $user->title  : '' }}</td>
                                <td>{{ isset( $user->UserName ) ? $user->UserName->first_name     : '' }}</td>
                                <td>{{ isset( $user->UserName ) ? $user->UserName->email     : '' }}</td>
                                
                                <td>{{ isset( $user->CategoryName ) ? $user->CategoryName->name : '' }}</td>
                                <td>{{($user->report_startdate !='')?date('d-m-Y', strtotime($user->report_startdate)):''}}</td>
                                <td>{{($user->report_enddate != '')?date('d-m-Y', strtotime($user->report_enddate)):''}}</td>
                                
                                <td>{{isset($user->country_destination) ? $user->country_destination : '-' }}</td>
                                <td><?php if($user->status==0){ ?>
                                      <a href="{{ route('admin.travel_report.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                      <?php } 
                                      else{ ?>
                                      <a href="{{ route('admin.travel_report.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td">@include('backend.travel_report.includes.actions', ['user' => $user])</td>
                            </tr>
                           <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
      
    </div><!--card-body-->
</div><!--card-->
@endsection
@section('after-scripts')

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>



@endsection
