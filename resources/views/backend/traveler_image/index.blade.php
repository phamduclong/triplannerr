@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.plan_feature.management'))

@section('breadcrumb-links')
    @include('backend.plan_feature.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						Travel Icon <small class="text-muted">Travel Icon Active</small>
					</h4>
				</div><!--col-->

				<div class="col-sm-7">
					@include('backend.traveler_image.includes.header-buttons')
				</div><!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>ID</th>
                            <th>Image</th>
                           
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                    
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
