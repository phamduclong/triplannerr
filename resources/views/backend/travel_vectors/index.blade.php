@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Vector management'))

@section('breadcrumb-links')
    @include('backend.travel_vectors.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('Costs Type management') }} <small class="text-muted">{{ __('Active vector') }}</small>
					</h4>
				</div><!--col-->

				<div class="col-sm-7">
					@include('backend.travel_vectors.includes.header-buttons')
				</div><!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>{{__('SN')}}</th>
                            <th>{{__('Name')}}</th>
                          <!--   <th>@lang('labels.backend.access.travel_vectors.table.description')</th> -->
                            <th>{{__('Parent')}}</th>
                             <th>{{__('Costs type')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                         @foreach($travel_vectors as $vector)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $vector->name }}</td>
                                <td>{{ !empty($vector->parent) ? $vector->parent->name : 'Root' }}</td>
                                <td>{{ $vector->vector_type }}</td>
                                <td><?php if($vector->status==0){ ?>
                                      <a href="{{ route('admin.travel_vectors.status', $vector) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                      <?php } 
                                      else{ ?>
                                      <a href="{{ route('admin.travel_vectors.status', $vector) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td">@include('backend.travel_vectors.includes.actions', ['vector' => $vector])</td>
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
                    {{$travel_vectors->total()}} Found Record
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   {{$travel_vectors->render()}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
