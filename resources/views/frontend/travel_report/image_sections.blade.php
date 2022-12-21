<div class="row gallery_row" id="gallery_row_{{$container_length}}">
  <div class="col-md-3">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_photo'))->for('gallery_photo') }}
     
      <input class="form-control to_crop" type="file" name="gallery_photo[]" id="gallery_photo_{{$container_length}}" accept="image/*" autofocus="" onchange="find_image_location(this)" data-height="350" data-width="1000" data-container="gallery_row_container" data-dimension="cover" data-id="userdetail_cover_image" containerId="{{$container_length}}">
      {{-- <div hidden id='containerId' containerId="{{$container_length}}"></div> --}}
      <p id="galleryErr" class="text-danger galleryErr"></p>
      <input type="hidden" name="crop_photo[]" id="crop_photo_{{$container_length}}" value="" >

    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_caption'))->for('gallery_caption') }}
      {{ Form::text('gallery_caption[]', null, ['class' => 'form-control', 'id' => 'gallery_caption_'.$container_length]) }}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.travel_report.location_of_shot'))->for('location_of_shot') }}

      {{ Form::text('location_of_shot[]', null, ['class' => 'form-control', 'id' => 'location_of_shot_'.$container_length]) }}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      {{ html()->label(__('validation.attributes.frontend.travel_report.sorting_in_gallery'))->for('sorting_in_gallery') }}
      {{ 
        Form::number('sorting_in_gallery[]',$container_length, ['class' => 'form-control', 'id' => 'sorting_in_gallery_1', 'readonly'])
      }}
      <input type="hidden" name="image_lat[]" id="image_lat_{{ $container_length }}" value="">
      <input type="hidden" name="image_long[]" id="image_long_{{ $container_length }}" value="">
      <input type="hidden" id="res_status_{{ $container_length }}" value="0">
    </div>
  </div>
  <div class="col-md-2" style="margin-top: 40px">
    <span class="form-group">
      <a class="remove-gallery-icon" onclick="remove_gallery({{ $container_length }})">
        -
      </a>
    </span>
    <span class="form-group" style="margin-left: 5px">
      <a class="add-gallery-icon" data-id="{{ $container_length }}">
        +
      </a>
    </span>
  </div>
</div>
<div class="row" id="wrap_preview_gallery_{{$container_length}}">
  <div class="col-md-3">
    <img src="{{url('/img/unnamed.jpg')}}" id="preview_gallery_{{ $container_length }}" style="max-width: 150px;">
  </div>
  <div class="col-md-9"></div>
</div>