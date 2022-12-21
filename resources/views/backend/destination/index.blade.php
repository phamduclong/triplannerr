@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.destination.destination'))

@section('breadcrumb-links')
@include('backend.destination.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
  <div class="card-body">

    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          {{ __('labels.backend.access.destination.destination') }} <small class="text-muted">{{ __('labels.backend.access.destination.active') }}</small>
        </h4>
      </div><!--col-->
      <div class="col-sm-7">
        @include('backend.destination.includes.header-buttons')
      </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
      <div class="col">
        <div class="tabel-responsive">
          <table class="table">
            <thead>
              <th>@lang('labels.backend.access.destination.table.sno')</th>
              <th>@lang('labels.backend.access.destination.table.name')</th>
              <th style="width:300px; text-align:justify;">
              @lang('labels.backend.access.destination.table.description')
              </th>
              <th>@lang('labels.backend.access.destination.table.lattitude')
              </th>
              <th>@lang('labels.backend.access.destination.table.longitude')
              </th>
              <th>@lang('labels.general.actions')</th>
            </thead>
            <tbody>
              @php $sno=0 @endphp
                @foreach($destination as $desti_row)
                  @php $sno++ @endphp
                  <tr>
                    <td>{{ $sno }}</td>
                    <td>{{ $desti_row->name }}</td>
                    <td>{!! ($desti_row->description) !!}</td>
                    <td>{{ $desti_row->lattitude }}</td>
                    <td>{{ $desti_row->longitude }}</td>
                    <td><a href="{{ url('admin/destination/edit', $desti_row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="{{ url('admin/destination/delete', $desti_row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
          {{ $destination->total() }} records found.
        </div>
      </div>
      <div class="col-5">
        <div class="float-right">
        {{ $destination->links() }}
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
