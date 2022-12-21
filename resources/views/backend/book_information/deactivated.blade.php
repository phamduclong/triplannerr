@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report.management'))

@section('breadcrumb-links')
    @include('backend.book_information.includes.breadcrumb-links')
@endsection

@section('content')

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />

<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.book_information.management') }} <small class="text-muted">{{ __('labels.backend.access.book_information.deactive') }}</small>
					</h4>
				</div><!--col-->

			
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.book_information.table.id')</th>
                           <th>@lang('labels.backend.access.book_information.table.title')</th>
                           <th>@lang('labels.backend.access.book_information.table.report_user')</th>
                           <th>@lang('labels.backend.access.book_information.table.report_user_email')</th>
                           <th>@lang('labels.backend.access.book_information.table.request_user')</th>
                           <th>@lang('labels.backend.access.book_information.table.request_user_email')</th>
                           <th>@lang('labels.backend.access.book_information.table.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                         
                        <?php $i=1 ?>
                           @foreach($travel_report as $book)
                              <tr>
                                <td>{{ $i}}</td>
                                 {{--<td>{{ isset( $book ) ? getuser_data($book->reportuser->user_id)->user_name  : '' }}</td>
                                <td>{{ isset( $book ) ? getuser_data($book->reportuser->user_id)->email  : '' }}</td>
                                <td>{{ isset( $book ) ? $book->requestuser->user_name  : '' }}</td>
                                <td>{{ isset( $book ) ? $book->requestuser->email  : '' }}</td>
                                <td>{{ isset( $book ) ? $book->status  : '' }}</td>
                                <td>{{ isset( $book ) ? $book->status  : '' }}</td>--}}
                               
                                <td>{{ isset( $book ) ? getreport_data($book->report_id)->title  : '' }}</td>
                                <td>{{ isset( $book ) ? getuser_data(getreport_data($book->report_id)->user_id)->user_name : '' }}</td>
                                <td>{{ isset( $book ) ? getuser_data(getreport_data($book->report_id)->user_id)->email : '' }}</td>
                                <td>{{ isset( $book ) ? getuser_data($book->user_id)->user_name  : '' }}</td>
                                <td>{{ isset( $book ) ? getuser_data($book->user_id)->email  : '' }}</td>
                                 <td><?php if($book->status==0){ ?>
                                          <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
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
@push('after-scripts')
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.jqueryui.min.js"></script>
<script>
$(document).ready( function () {
    $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, "All"]]
    });
});
</script>
@endpush