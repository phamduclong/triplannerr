@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.services.service'))

@section('breadcrumb-links')
    @include('backend.services.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
	    <div class="col-sm-5">
		<h4 class="card-title mb-0">
		{{ __('labels.backend.access.services.service') }} <small class="text-muted">{{ __('labels.backend.access.services.active') }}</small>
		</h4>
		</div><!--col-->
		<div class="col-sm-7">
		    @include('backend.services.includes.header-buttons')
		</div><!--col-->
	</div><!--row-->

	<div class="row mt-4">
	   <div class="col">
		 <div class="tabel-responsive">
			<table class="table">
			  <thead>
				<tr>
				  <th>@lang('labels.backend.access.services.table.sno')</th>
				  <th>@lang('labels.backend.access.services.table.title')</th>
				  <th>
				  	@lang('labels.backend.access.services.table.description')
				  </th>
				  <th>
				  @lang('labels.backend.access.services.table.slug')
				  </th>
				  <th>
				  @lang('labels.backend.access.services.table.graphic_type')
				  </th>
				  <th>
				  @lang('labels.backend.access.services.table.graphic_content')
				  </th>
				  <th>
				  @lang('labels.backend.access.services.table.created_date')
				  </th>
				  <th>
				  @lang('labels.general.actions')
				  </th>
				</tr>
			  </thead>
			  <tbody>
				@php $sno = 1 @endphp
				@foreach($service as $service_row)
				  <tr>
					<td><strong>{{ $sno++ }}</strong></td>
					<td>{{ $service_row->title }}</td>
					<td>{!! $service_row->description !!}</td>
					<td>{{ $service_row->slug }}</td>
					<td>{{ $service_row->graphic_type }}</td>
					@if($service_row->graphic_type == 'image')
                    <td>
                    <img src="{{ url('/img/backend/Services/'.$service_row->graphic_type) .'/'.$service_row->graphic_content }}"  width="70px" height="70px">
                    </td>
                    @else
                    <td>{!! $service_row->graphic_content !!}</td>
                    @endif
					<td>{{ date('M d, Y', strtotime($service_row->created_at)) }}
					</td>
					<td><a href="{{ url('admin/services/edit', $service_row->id) }}" class="btn btn-primary btn-sm">
					<i class="fa fa-edit"></i>
				    </a>&nbsp;&nbsp;
				    <a href="{{ url('admin/services/delete', $service_row->id) }}" class="btn btn-danger btn-sm">
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
				{{ $service->total() }} records found.
			</div>
			</div>
			<div class="col-5">
			  <div class="float-right">
				{{ $service->links() }}
			  </div>
			</div>
		</div>
	</div>

</div>
@endsection
