@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.destination.create-destination'))

@section('breadcrumb-links')
    @include('backend.destination.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->form('POST', route('admin.destination.store'))->class('form-horizontal')->open() }}

<div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-sm-5">
          <h4 class="card-title mb-0">
            @lang('labels.backend.access.destination.destination')
            <small class="text-muted"> @lang('labels.backend.access.destination.create-destination')
            </small>
          </h4>
        </div><!--col-->
      </div><!--row-->

      <div class="row mt-4 mb-4">
        <div class="col">

          <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.destination_id'))->class('col-md-2 form-control-label')->for('destination_id') }}
              <div class="col-md-10">
                <input type="text" name="destination_id" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

          <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.access.destination.name'))->class('col-md-2 form-control-label')->for('name') }}
              <div class="col-md-10">
                <input type="text" name="name" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

          <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.page_description'))->class('col-md-2 form-control-label')->for('page_description') }}
              <div class="col-md-10">
                  <textarea name="page_description" class="form-control">
                 </textarea>
              </div><!--col-->
          </div><!--form-group-->

	        <div class="form-group row">
          {{ html()->label(__('validation.attributes.backend.access.destination.country'))->class('col-md-2 form-control-label')->for('country') }}
              <div class="col-md-10">
                <select name="country" class="form-control" onchange="getcountry(this.value,1)">
                  <option vlaue="">-Select Country-</option>
                  @foreach(@$country_arr as $country_row)
                  <option value="{{ $country_row->id }}">{{ $country_row->name }}
                  </option>
                  @endforeach
                </select>
              </div><!--col-->
          </div><!--form-group-->

	        <div class="form-group row">
          {{ html()->label(__('validation.attributes.backend.access.destination.state'))->class('col-md-2 form-control-label')->for('state') }}
              <div class="col-md-10">
                <select name="state" class="form-control" onchange="getstate(this.value,1)">
                    <option value="">-Select State-</option>
                </select>
              </div><!--col-->
          </div><!--form-group-->

	        <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.city'))->class('col-md-2 form-control-label')->for('city') }}
              <div class="col-md-10">
                <select name="city" class="form-control">
                  <option value="">-Select City-</option>
                </select>
              </div><!--col-->
          </div><!--form-group-->


	        <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.wheather'))->class('col-md-2 form-control-label')->for('wheather') }}
              <div class="col-md-10">
                <input type="text" name="wheather" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

          <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.popular'))->class('col-md-2 form-control-label')->for('popular') }}
              <div class="col-md-10">
                <input type="text" name="popular" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->


          <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.visits'))->class('col-md-2 form-control-label')->for('visits') }}
              <div class="col-md-10">
                <input type="text" name="visits" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

          <div class="form-group row">
           {{ html()->label(__('validation.attributes.backend.access.destination.lattitude'))->class('col-md-2 form-control-label')->for('lattitude') }}
              <div class="col-md-10">
                <input type="text" name="lattitude" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

          <div class="form-group row">
          {{ html()->label(__('validation.attributes.backend.access.destination.longitude'))->class('col-md-2 form-control-label')->for('longitude') }}
              <div class="col-md-10">
                <input type="text" name="longitude" class="form-control"/>
              </div><!--col-->
          </div><!--form-group-->

        </div>
      </div>
    </div>

	  <div class="card-footer clearfix">
      <div class="row">
        <div class="col">
         {{ form_cancel(route('admin.destination'), __('buttons.general.cancel')) }}
        </div><!--col-->
        <div class="col text-right">
          {{ form_submit(__('buttons.general.crud.create')) }}
        </div><!--col-->
      </div><!--row-->
    </div><!--card-footer-->

</div>
{{ html()->form()->close() }}
@endsection
