
@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tours.tour'))

@section('breadcrumb-links')
@include('backend.tours.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
       <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.tours.tour') }} <small class="text-muted">{{ __('labels.backend.access.tours.active') }}</small>
            </h4>
          </div><!--col-->
          <div class="col-sm-7">
           @include('backend.tours.includes.header-buttons')
          </div><!--col-->
       </div><!--row-->
       <div class="row mt-4">
          <div class="col">
            <div class="tabel-responsive">
              <table class="table">
                <thead>
                  <th>@lang('labels.backend.access.tours.table.sno')</th>
                  <th>@lang('labels.backend.access.tours.table.title')</th>
                  <th>@lang('labels.backend.access.tours.table.description')
                  </th>
				          <th>@lang('labels.backend.access.tours.table.banner')</th>
                  <th>@lang('labels.backend.access.tours.table.no_of_day')
                  </th>
                  <th>@lang('labels.backend.access.tours.table.no_of_night')
                  </th>
				          <th>@lang('labels.backend.access.tours.table.start_date_time')
                  </th>
				          <th>@lang('labels.backend.access.tours.table.end_date_time')
                  </th>
				          <th>@lang('labels.backend.access.tours.table.cost')</th>
                  <th>@lang('labels.general.actions')</th>
                </thead>
			          <tbody>
                  @php $sno=0 @endphp
                    @foreach($tours as $tours_row)
                      @php $sno++ @endphp
                        <tr>
                          <td>{{ $sno }}</td>
                          <td>{{ $tours_row->title }}</td>
                          <td>{!! ($tours_row->description) !!}</td>
					                <td><img src="{{ url('/img/backend/tours/banner').'/'.$tours_row->banner }}" / width="70px" height="70px"></td>
                          <td>{{ $tours_row->no_of_days }}</td>
                          <td>{{ $tours_row->no_of_nights }}</td>
					                <td>{{ date('M d, Y', strtotime($tours_row->start_date_time)) }}</td>
					                <td>{{ date('M d, Y', strtotime($tours_row->end_date_time)) }}</td>
					                <td>{{ $tours_row->cost }}</td>
                          <td>
                            <a href="{{ url('admin/tours/edit', $tours_row->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i>
                            </a>&nbsp;&nbsp;
                            <a href="{{ url('admin/tours/delete', $tours_row->id) }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-7">
      <div class="float-left">
		    {{ $tours->total() }} Record Found
      </div>
    </div>
    <div class="col-5">
      <div class="float-right">
        {{ $tours->links() }}
      </div>
    </div>
  </div>
</div>
</div>
@endsection
