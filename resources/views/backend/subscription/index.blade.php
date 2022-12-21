@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report.management'))

@section('content')
<div class="card">
    <div class="card-body position-relative">
            <div class="onload w-100 h-100 position-absolute">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.subscription.management') }} 
					</h4>
				</div><!--col-->
                <div class="col-sm-7">
                    <div class="w-50">
                        <select name="travel_pro" class="form-control change-status" id="travel-pro">
                            <option value="">Choose Travel Pro</option>
                            @foreach ($travelPros as $travelPro)
                                <option value="{{ $travelPro->id }}">{{ $travelPro->full_name }}</option>
                            @endforeach
                            {{-- <option value="notAccept" {{ (empty($user->request_active_invitation) || $user->request_active_invitation == 'notAccept') ? 'selected' : '' }}>Not Accept</option> --}}
                        </select>
                    </div>
                </div>
			</div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive" id="fetch-table">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.subscription.table.id')</th>
                           <th>@lang('labels.backend.access.subscription.table.user_name')</th>
                           <th>@lang('Email')</th>
                           <th>@lang('labels.backend.access.subscription.table.plan')</th>
                           <th>@lang('labels.backend.access.subscription.table.plan_amount')</th>
                           <th>@lang('labels.backend.access.subscription.table.payment_status')</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>@lang('labels.general.actions')</th>
                         </tr>
                        </thead>
                        <tbody>
                        
                           @foreach($subscription_data as $key=> $user)
                              <tr>
                                <td>{{ $key+1}}</td>
                                <td> @if(!empty($user->user_id)){{ getUserdata($user->user_id) }}@endif
                               </td>
                               <td> @if(!empty($user->user_id)){{ getUserEmail($user->user_id) }}@endif
                               </td>
                                <td>{{ isset( $user ) ? $user->plan_name : '' }}</td>
                                <td>{{ isset( $user ) ? $user->plan_amount : '' }}</td>
                                <td>{{ isset( $user ) ? $user->payment_status : '' }}</td>
                                <td>{{ !empty( $user->subs_start_date ) ? Carbon\Carbon::parse($user->subs_start_date)->format('Y/m/d') : '' }}</td>
                                <td>{{ !empty( $user->subs_end_date ) ? Carbon\Carbon::parse($user->subs_end_date)->format('Y/m/d') : '' }}</td>
                                <td class="btn-td">@include('backend.subscription.includes.actions', ['user' => $user])</td>
                               </tr>
                             
                            @endforeach
                        </tbody> 
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->

@endsection

@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush

@section('after-scripts')

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

 $(document).ready(function() {
    let table = $('#example').DataTable();
});

$(document).on('change', '#travel-pro', function(){
        let travel_pro = $(this).val();
        $('.onload').show()
        $.ajax({
            url: "{{ route('admin.list_subscription') }}",
            method: 'GET',
            data: {
                travel_pro: travel_pro,
            },
        }).then( result => {
            $('#fetch-table').html(result.html);
            $('#example').DataTable();
            $('.onload').hide()

        });
})
</script>
@endsection
