@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tours.create-tour'))

@section('breadcrumb-links')
    @include('backend.tours.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->form('POST', route('admin.tours.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

<div class="card">
    <div class="card-body">
        <div class="row">
           <div class="col-sm-5">
                <h4 class="card-title mb-0">
                  @lang('labels.backend.access.tours.tour')
                  <small class="text-muted"> @lang('labels.backend.access.tours.create-tour')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
          <div class="col">
			      <div class="form-group row">
             {{ html()->label(__('validation.attributes.backend.access.tours.departure_id'))->class('col-md-2 form-control-label')->for('departure_id') }}
				       <div class="col-md-4">
                 <select name="departure_id" class="form-control">
					          <option value="">-Select Departure-</option>
					           @foreach($destination as $destination_row)
					             <option value="{{ @$destination_row->id }}">{{ @$destination_row->name }}
                       </option>
					            @endforeach
					       </select>
               </div><!--col-->

				       {{ html()->label(__('validation.attributes.backend.access.tours.destination'))->class('col-md-2 form-control-label')->for('destination') }}
				         <div class="col-md-4">
                   <select name="destination[]" class="form-control" multiple>
					            <option value="">-Select Destination-</option>
                       @foreach($destination as $destination_row)
					             <option value="{{ @$destination_row->id }}">{{ @$destination_row->name }}
                       </option>
					             @endforeach
					         </select>
                  </div><!--col-->
              </div><!--form-group-->

                <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.title'))->class('col-md-2 form-control-label')->for('title') }}
                  <div class="col-md-10">
                    <input type="text" name="title" class="form-control"/>
                  </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.description'))->class('col-md-2 form-control-label')->for('description') }}
                  <div class="col-md-10">
                    <textarea name="page_description" class="form-control"></textarea>
                  </div><!--col-->
                </div><!--form-group-->

				        <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.tours.start_date_time'))->class('col-md-2 form-control-label')->for('start_date_time') }}
                    <div class="col-md-4">
                       <input type="date" name="start_date_time" class="form-control"/>
                     </div><!--col-->
				            {{ html()->label(__('validation.attributes.backend.access.tours.end_date_time'))->class('col-md-2 form-control-label')->for('end_date_time') }}
                    <div class="col-md-4">
                        <input type="date" name="end_date_time" class="form-control"/>
                    </div><!--col-->
                </div><!--form-group-->

				        <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.no_of_days'))->class('col-md-2 form-control-label')->for('no_of_days') }}
                  <div class="col-md-4">
                      <input type="number" name="no_of_days" class="form-control"/>
                  </div><!--col-->
				            {{ html()->label(__('validation.attributes.backend.access.tours.no_of_nights'))->class('col-md-2 form-control-label')->for('no_of_nights') }}
                   <div class="col-md-4">
                      <input type="number" name="no_of_nights" class="form-control"/>
                   </div><!--col-->
                </div><!--form-group-->

	            <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.services'))->class('col-md-2 form-control-label')->for('services') }}
				           @foreach($service as $service_row)
				              <div class="col-md-2">
                         <input type="checkbox" name="services[]" value="{{ @$service_row->id }}"> {{ @$service_row->title }}</option>
                       </div><!--col-->
				           @endforeach
               </div><!--form-group-->

				       <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.cost'))->class('col-md-2 form-control-label')->for('cost') }}
				          <div class="col-md-2">
                    <select name="currency" class="form-control">
					             <option value="">-Select Currency-</option>
					              @foreach($currency as $currency_row)
					                 <option value="{{ @$currency_row->code }}">{{ @$currency_row->code }}
                          </option>
					               @endforeach
					          </select>
				          </div><!--col-->
				          <div class="col-md-8">
					           <input type="text" id="cost" name="cost" class="form-control"/>
                  </div><!--col-->
                </div><!--form-group-->

				        <div class="form-group row">
                     {{ html()->label(__('validation.attributes.backend.access.tours.banner'))->class('col-md-2 form-control-label')->for('banner') }}
                  <div class="col-md-10">
                    <input type="file" name="banner" class="form-control"/>
                  </div><!--col-->
                </div><!--form-group-->

				        <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.other_image'))->class('col-md-2 form-control-label')->for('other_image') }}
                   <div class="col-md-10">
                     <input type="file" name="other_image[]" class="form-control" multiple/>
                   </div><!--col-->
                </div><!--form-group-->

				       <div class="form-group row">
                   {{ html()->label(__('validation.attributes.backend.access.tours.meta_title'))->class('col-md-2 form-control-label')->for('meta_title') }}
                  <div class="col-md-10">
                    <input type="text" name="meta_title" class="form-control"/>
                  </div><!--col-->
               </div><!--form-group-->

              <div class="form-group row">
                  {{ html()->label(__('validation.attributes.backend.access.tours.meta_keywords'))->class('col-md-2 form-control-label')->for('meta_keywords') }}
                  <div class="col-md-10">
                    <input type="text" name="meta_keywords" class="form-control"/>
                  </div><!--col-->
              </div><!--form-group-->

              <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.tours.meta_descirption'))->class('col-md-2 form-control-label')->for('meta_descirption') }}
                  <div class="col-md-10">
                    <input type="text" name="meta_descirption" class="form-control"/>
                  </div><!--col-->
              </div><!--form-group-->
            </div>
          </div>
    </div>
	  <div class="card-footer clearfix">
      <div class="row">
        <div class="col">
         {{ form_cancel(route('admin.tours'), __('buttons.general.cancel')) }}
        </div><!--col-->
        <div class="col text-right">
          {{ form_submit(__('buttons.general.crud.create')) }}
        </div><!--col-->
      </div><!--row-->
    </div><!--card-footer-->
 </div>
{{ html()->form()->close() }}
@endsection
