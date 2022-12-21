@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report_trip_page.management'))

@section('breadcrumb-links')
    @include('backend.travel_report_trip_page.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.travel_report_trip_page.management') }} <small class="text-muted">{{ __('labels.backend.access.travel_report_trip_page.active') }}</small>
					</h4>
				</div><!--col-->

				<div class="col-sm-7">
                  
                </div><!--col-->
                <!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                        	<th>ID</th>
                            <th>Travel Report</th>
                            <th>Super</th>
                            <th>Alert</th>
                            <th>Same Trip Page</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach($sametrip_data as $travel_report)
                            <tr >
                                <td>{{$i}}</td>
                                <td>@if($travel_report->report_id == $trip_id)
				                    {{ get_report($travel_report->same_trip_id)->title }}
				                @else
				                    {{ get_report($travel_report->report_id)->title }}
				                @endif
				               </td>
                                <td> @if($travel_report->report_id == $trip_id)
				                   {{get_superdata($travel_report->same_trip_id)}}
				                 @else
				                   {{get_superdata($travel_report->report_id)}}
				                 @endif</td>
                                <td>@if($travel_report->report_id == $trip_id)
				                   {{get_alertdata($travel_report->same_trip_id)}}
				                 @else
				                   {{get_alertdata($travel_report->report_id)}}
				                 @endif
                                </td>
                                <td>@if($travel_report->report_id == $trip_id)
				                   {{get_sametrip($travel_report->same_trip_id)}}
				                 @else
				                   {{get_sametrip($travel_report->report_id)}}
				                 @endif</td>
                            </tr>
                           <?php $i++; ?>
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
