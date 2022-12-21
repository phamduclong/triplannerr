@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.travel_report_trip_page.management'))

@section('breadcrumb-links')
    @include('backend.travel_report_trip_page.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.travel_report_trip_page.management') }} <small class="text-muted">{{ __('labels.backend.access.travel_report_trip_page.active') }}</small>
					</h4>
				</div><!--col-->

				<div class="col-sm-7">
                    @include('backend.travel_report_trip_page.includes.header-buttons')
                </div><!--col-->
                <!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.travel_report_trip_page.table.id')</th>
                           <th>@lang('labels.backend.access.travel_report_trip_page.table.travel_report')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.super')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.alert')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.same_trip')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.numbers_of_share_on_travel_maker')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.numbers_of_share_on_facebook')</th>
                            <th>@lang('labels.backend.access.travel_report_trip_page.table.numbers_of_share_on_twitter')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php $i=1 ?>
                            @foreach($report_data as $travel_report)
                            <tr >
                                <td>{{$i}}</td>
                                <td><a href="#">{{$travel_report->title}}</a></td>
                                <td>{{$travel_report->supers_count}}</td>
                                <td>{{$travel_report->alerts_count}}</td>
                                <td>{{get_sametrip($travel_report->id)}}
                                      <br><a href="{{url('/same-trip',$travel_report->id)}}">Trip Page</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            
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
