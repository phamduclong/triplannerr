@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report.management'))

@section('breadcrumb-links')
    @include('backend.book_information.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.book_information.management') }} <small class="text-muted">{{ __('labels.backend.access.book_information.active') }}</small>
					</h4>
				</div><!--col-->
			</div><!--row-->
            <div class="row mt-3">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" id="travel">
                          <option value="">All</option>
                          <option value="travel_agency">Travel PRO</option>
                          <option value="travel_maker">Travel Maker</option>
                        </select>
                      </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" id="budget">
                          <option value="">All</option>
                          <option value="from 50 to 200 €">from 50 to 200 €</option>
                          <option value="from 200 to 500 €">from 200 to 500 €</option>
                          <option value="from 500 to 1000 €">from 500 to 1000 €</option>
                          <option value="from 1000 to 3000 €">from 1000 to 3000 €</option>
                          <option value="from 3000 to 6000 €">from 3000 to 6000 €</option>
                          <option value="over 6000 €">over 6000 €</option>
                        </select>
                      </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="destination" placeholder="Destination">
                      </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="category" placeholder="Category">
                      </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <div class="table-responsive position-relative">
                        <div class="onload w-100 h-100 position-absolute">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div id="fetch-table">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>@lang('labels.backend.access.book_information.table.id')</th>
                                    <th>@lang('labels.backend.access.book_information.table.title')</th>
                                    <th>@lang('labels.backend.access.book_information.table.report_user')</th>
                                    <th>@lang('labels.backend.access.book_information.table.report_user_email')</th>
                                    <th>@lang('labels.backend.access.book_information.table.request_user')</th>
                                    <th>@lang('labels.backend.access.book_information.table.request_user_email')</th>
                                    <th>@lang('labels.backend.access.book_information.table.date')</th>
                                    <th>@lang('labels.backend.access.book_information.table.status')</th>
                                 </tr>
                                </thead>
                                <tbody>
                                
                                   @foreach($bookdata as $key => $book)
                                      <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ isset( $book ) ? @getreport_data($book->report_id)->title  : '' }}</td>
                                        <td>{{ isset( $book ) ? @getuser_data(getreport_data($book->report_id)->user_id)->user_name : '' }}</td>
                                        <td>{{ isset( $book ) ? @getuser_data(getreport_data($book->report_id)->user_id)->email : '' }}</td>
                                        <td>{{ isset( $book ) ? @getuser_data($book->user_id)->user_name  : '' }}</td>
                                        <td>{{ isset( $book ) ? @getuser_data($book->user_id)->email  : '' }}</td>
                                        <td>{{ date('m-d-Y', strtotime(isset( $book ) ? $book->created_at  : '')) }}</td>
                                        <td><?php if($book->status==0){ ?>
                                                <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                                <?php } 
                                                else{ ?>
                                                <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                            <?php } ?></td>
                                       </tr>
                                     
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script>
    $(document).ready( function () {
        $('#example').DataTable();
    });

    function getBookInfor(data) {
        return  $.ajax({
                url: "{{ route('admin.list_book_information') }}",
                method: 'GET',
                data: data
            }).then( result => {
                $('#fetch-table').html(result.html);
                $('#example').DataTable();
                $('.onload').hide()
            });
    }

    function getdata() {
        let travel = $('#travel').val();
        let destination = $('#destination').val();
        let category = $('#category').val();
        let budget = $('#budget').val();

        return {
            travel : travel,
            destination : destination,
            category : category,
            budget : budget
        }
    }

    $(document).on('change', '#travel', function(){
            $('.onload').show()
            let data = getdata();
            getBookInfor(data)
    });

    $(document).on('change', '#budget', function(){
            $('.onload').show()
            let data = getdata();
            getBookInfor(data)
    });

    $(document).on('keyup', '#destination', $.debounce(400, function(){
            $('.onload').show()
            let data = getdata();
            getBookInfor(data)
    }))

    $(document).on('keyup', '#category', $.debounce(400, function(){
            $('.onload').show()
            let data = getdata();
            getBookInfor(data)
    }));
    </script>
@endsection