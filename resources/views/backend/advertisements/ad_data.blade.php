@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.advertisements.management'))

@section('breadcrumb-links')
    @include('backend.advertisements.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-10">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.advertisements.management') }} <small class="text-muted">{{ __('labels.backend.access.advertisements.active') }}</small>
					</h4>
				</div><!--col-->

			
                <!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.advertisements.table.id')</th>
                            <th>@lang('labels.backend.access.advertisements.table.title')</th>
                            <th>@lang('labels.backend.access.advertisements.table.total_click')</th>
                         </tr>
                        </thead>
                        <tbody>
                        
                        <?php $i=1 ?>
                           @foreach($ad_data as $user)
                          
                              <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->ads->title }}</td>
                                <td>{{ get_click_count($user->ad_id) }}</td>
                                <td class="btn-td">@include('backend.advertisements.includes.actions', ['user' => $user])</td>
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
