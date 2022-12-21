@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-10">
                    <div class="d-inline-block">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                        </h4>
                    </div>
                    <div class="d-inline-block ml-3">
                        <a href="{{ route('admin.auth.user.index') }}" class="btn btn-info">All</a>
                        <a href="{{ route('admin.auth.user.index', ['type' => 'traveler']) }}" class="btn btn-info">Traveler</a>
                        <a href="{{ route('admin.auth.user.index', ['type' => 'travel_maker']) }}" class="btn btn-info">Travel Maker</a>
                        <a href="{{ route('admin.auth.user.index', ['type' => 'travel_blogger']) }}" class="btn btn-info">Travel Blogger</a>
                        <a href="{{ route('admin.auth.user.index', ['type' => 'travel_agency']) }}" class="btn btn-info">Travel PRO</a>
                    </div>
				</div><!--col-->
                {{-- <div class="col-sm-6">
                </div> --}}

				<div class="col-sm-2">
					@include('backend.auth.user.includes.header-buttons')
				</div><!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <!--<th>@lang('labels.backend.access.users.table.sno')</th>-->
                            <th>@lang('labels.backend.access.users.table.first_name')</th>
                            <th>@lang('labels.backend.access.users.table.last_name')</th>
                            <th>@lang('labels.backend.access.users.table.user_name')</th>
                            <th>@lang('labels.backend.access.users.table.email')</th>
                            <th>@lang('labels.backend.access.users.table.confirmed')</th>
                            <th>Trial Date</th>
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                            <!--<th>@lang('labels.backend.access.users.table.other_permissions')</th>
                            <th>@lang('labels.backend.access.users.table.social')</th>-->
                            <th>@lang('labels.backend.access.users.table.last_updated')</th>
                            <th>Invitation</th>
                            <th>Activation Date</th>
                            <th>Request Date</th>
                            <th>Interval Time</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sno = 1 @endphp

                        @foreach($users as $user)

                            <tr>
                               <!-- <td>{{-- $sno++ --}}</td>-->
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>
                                <td>@include('backend.auth.user.includes.trial-date', ['user' => $user])</td>
                                <td>{{ $user->role_type }}</td>
                               <!--  <td>{{ isset( $user->role_name ) ? $user->role_name->name : '' }}</td> -->
                                <!--<td>{{-- $user->permissions_label --}}</td>
                                <td>@include('backend.auth.user.includes.social-buttons', ['user' => $user])</td>-->
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>@include('backend.auth.user.includes.active-invitation', ['user' => $user])</td>
                                <td>{{ !empty( $user->accept_invitation_date ) ? Carbon\Carbon::parse($user->accept_invitation_date)->format('d/m/Y') : '' }}</td>
                                <td>{{ !empty( $user->request_invitation_date ) ? Carbon\Carbon::parse($user->request_invitation_date)->format('d/m/Y') : '' }}</td>
                                <td>@include('backend.auth.user.includes.invitation-interval', ['user' => $user])</td>
                                <td class="btn-td">@include('backend.auth.user.includes.actions', ['user' => $user])</td>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('after-scripts')

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '#invitation', function(){
        let url = $(this).data('route');
        let invitation = $(this).val();
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                invitation: invitation,
            },
        }).then( result => {
            toastr.success('Update Status Successfully!');
        });

    })

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $('input[name="invitation_interval"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY',
        },
    });

    $('input[name="trial-date"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY',
        },
    });

    $('input[name="invitation_interval"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        let dates = $(this).val();
        let url = $(this).data('route');
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                dates: dates,
            },
        }).then( result => {
            toastr.success('Update Status Successfully!');
        });
    })

    $('input[name="trial-date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
        let date = $(this).val();
        let url = $(this).data('route');
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                date: date,
            },
        }).then( result => {
            toastr.success('Update Status Successfully!');
        });
    })
</script>
@endsection