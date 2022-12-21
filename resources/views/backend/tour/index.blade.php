@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tour.tour-report'))

@section('breadcrumb-links')
    @include('backend.tour.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
 <div class="card-body">
<div class="row">

<div class="col-sm-5">
    <h4 class="card-title mb-0">
        {{ __('labels.backend.access.tour.tour-report') }}
         <small class="text-muted">{{ __('labels.backend.access.tour.active') }}</small>
    </h4>
</div><!--col-->

<div class="col-sm-7">
    @include('backend.tour.includes.header-buttons')
</div><!--col-->

</div><!--row-->

<div class="row mt-4">
  <div class="col">
    <div class="table-responsive">

					<table class="table">
					<thead>
					<th>@lang('labels.backend.access.tour.table.sno')</th>
					<th>@lang('labels.backend.access.tour.table.title')</th>
					<th>@lang('labels.backend.access.tour.table.description')</th>
					<th>@lang('labels.backend.access.tour.table.rate')</th>
					<th>@lang('labels.backend.access.tour.table.banner')</th>
					<th>@lang('labels.backend.access.tour.table.cost')</th>
					<th>@lang('labels.backend.access.tour.table.review')</th>
					<th>@lang('labels.backend.access.tour.table.created_date')</th>
					<th>@lang('labels.general.actions')</th>
					</thead>
					<tbody>
					@php $sno=1 @endphp
					@foreach($tours as $tour_row)
					<tr>
					<td>{{ $sno++ }}</td>
					<td>{{ $tour_row->title }}</td>
					<td>{!! $tour_row->description !!}</td>
					<td>$ {{ $tour_row->rate }}</td>
					<td><img src="{{ url('/img/backend/tour/banner').'/'.$tour_row->banner }}" / width="70px" height="70px"></td>
					<td>{{ $tour_row->rating }}</td>
					<td>{!! $tour_row->review !!}</td>
					<td>{{ date('M d, Y', strtotime($tour_row->created_at)) }}</td>
					<td><a href="{{ Route('admin.tour.edit', $tour_row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="{{ Route('admin.tour.delete', $tour_row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</td>

					</tr>
					@endforeach
					</tbody>
					</table>

</div>
</div>
</div>

</div>
</div>
</div>
@endsection
