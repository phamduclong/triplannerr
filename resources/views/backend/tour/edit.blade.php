@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tour.edit-tour'))

@section('breadcrumb-links')
    @include('backend.tour.includes.breadcrumb-links')
@endsection

@section('content')

<style type="text/css">
    .form-group .cross-bar
    {
        padding: 5px 10px;
        background: #000;
        position: absolute;
        right: 13px;
        color: #FFF;
    }
</style>

{{ html()->form('POST', route('admin.tour.update', $tour->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-sm-5">

            <h4 class="card-title mb-0">
                @lang('labels.backend.access.tour.tour-report')
                <small class="text-muted"> @lang('labels.backend.access.tour.edit-tour')</small>
            </h4>

        </div><!--col-->
    </div><!--row-->


    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.tour.title'))->class('col-md-2 form-control-label')->for('title') }}

                <div class="col-md-10">
                    {{ html()->text('title')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.backend.access.tour.title'))
                    ->attribute('maxlength', 191)
                    ->attribute('value', $tour->title)
                    ->required()
                    ->autofocus() }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.tour.description'))->class('col-md-2 form-control-label')->for('description') }}
                <div class="col-md-10">

                    <textarea class="form-control" name="tour_description" maxlength= "191" placeholder="{{ __('validation.attributes.backend.access.tour.description') }}" required>{!! $tour->description !!}
                    </textarea>

                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
               {{ html()->label(__('validation.attributes.backend.access.tour.rate'))->class('col-md-2 form-control-label')->for('rate') }}
                  <div class="col-md-10">

                     <input type="number" class="form-control"  onKeyPress="if(this.value.length==10) return false;"  name="rate" min="1" max="5000" value="{{ $tour->rate }}" placeholder="{{ __('validation.attributes.backend.access.tour.rate') }}" required >

                   </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.tour.banner'))->class('col-md-2 form-control-label')->for('banner') }}
                <div class="col-md-10">

                    <input type="file" id="edit_tour_banner_image" name="banner_image" value="{{ $tour->banner}}"><img id="blah" src="{{ url('/img/backend/tour/banner') .'/'.$tour->banner }}" / width="100px" height="100px">

                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ html()->label(__('validation.attributes.backend.access.tour.multiple_image'))->class('col-md-2 form-control-label')->for('multiple_image') }}
                <div class="col-md-10">

                    <input required type="file" id="multiple_image" class="form-control" name="multiple_image[]" multiple onchange="file_limit_check()">

                     <div class="alert alert-danger validation" style="display:none;"> Upload Max 6  Files allowed
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                     </div>

                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
            @forelse($tour->tour_images as $image)
                <div class="col-md-3" id="remove_div{{ $image->id }}">
                    <a class="cross-bar" href="javascript:void(0)" data-id="{{ $image->id }}" onclick="deleteimg('{{ $image->id }}')"> X </a>
                    <img src="{{ url('img/backend/tour/multiple_image/'.$image->img_name) }}" alt="Tour image" style="width: 100%">

                </div>
            @empty

            @endforelse
            </div><!--form-group-->

            <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.access.tour.cost'))->class('col-md-2 form-control-label')->for('cost') }}
            <div class="col-md-10">
            <input type="number" class="form-control"  onKeyPress="if(this.value.length==1) return false;"  name="cost" min="1" max="5" placeholder="{{ __('validation.attributes.backend.access.tour.cost') }}" value="{{ $tour->rating }}"required >
            </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.access.tour.review'))->class('col-md-2 form-control-label')->for('review') }}
            <div class="col-md-10">
            <textarea class="form-control" name="review">{!! $tour->review !!}</textarea>
            </div><!--col-->
            </div><!--form-group-->

        </div>
    </div>
</div>

<div class="card-footer clearfix">
<div class="row">

<div class="col">
    {{ form_cancel(route('admin.tour'), __('buttons.general.cancel')) }}
</div><!--col-->

<div class="col text-right">
    {{ form_submit(__('buttons.general.crud.update')) }}
</div><!--col-->

</div><!--row-->
</div><!--card-footer-->

</div>
{{ html()->form()->close() }}
@endsection
