@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travelcateg.travelcategs'))

@section('breadcrumb-links')
    @include('backend.travelcateg.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.travelcateg.travelcategs') }}
                    <small class="text-muted">{{ __('labels.backend.access.travelcateg.deleted') }}</small>
                </h4>
            </div><!--col-->
            <div class="col-sm-7">
                @include('backend.travelcateg.includes.header-buttons')
            </div><!--col-->
        </div><!--row--> 

        <div class="row mt-4">
            <div class="col">
                <div class="tabel-responsive">
                    <table class="table">
						<thead>
							<th>@lang('labels.backend.access.travelcateg.table.sno')</th>
							<th>@lang('labels.backend.access.travelcateg.table.name')</th>
							<th>@lang('labels.backend.access.travelcateg.table.categ_type')</th>
							<th>@lang('labels.backend.access.travelcateg.table.categ_file')</th>
							<th>@lang('labels.general.actions')</th>
						</thead>

					    <tbody>
						@php $sno=1 @endphp
						@foreach($travelcategory as $categ_row)
						<tr>
							<td>{{ $sno++ }}</td>
							<td>{{ $categ_row->name }}</td>
							<td>{{ $categ_row->graphic_type }}</td>
							@if($categ_row->graphic_type == 'image')
							<td>
							    <img src="{{ url('/img/backend/travelcateg/'.$categ_row->graphic_type) .'/'.$categ_row->graphic_content }}" / width="70px" height="70px">
							</td>
							@else
							<td><i class="{!! $categ_row->graphic_content !!}" aria-hidden="true" style="font-size: 50px;"></i></td>
							@endif
							<td class="btn-td"> <a href="{{ route('admin.travelcateg.restore',$categ_row) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.travelcateg.restore_user')"  data-trans-title="@lang('buttons.backend.access.travelcateg.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.travelcateg.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.travelcateg.confirm')">
                            <i class="fas fa-sync"></i>
                            </a></td>
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
		    		{{ $travelcategory->total() }} Record Found
      			</div>
    		</div>
    		<div class="col-5">
      			<div class="float-right">
        			{{ $travelcategory->links() }}
            	</div>
       		</div>
    	</div>
	</div>
</div>
@endsection
