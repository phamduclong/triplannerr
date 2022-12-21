@extends('backend.layouts.app')

@section('title', __('labels.backend.access.slider_audio.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.slider_audio.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->modelForm($audiodata, 'PATCH', route('admin.slider_audio.update', $id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.slider_audio.management')
                        <small class="text-muted">@lang('labels.backend.access.slider_audio.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.slider_audio.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                            <input class="form-control" type="text" name="title" id="title" value="{{$audiodata->title}}" placeholder="Title" maxlength="191" required="" autofocus="" disabled="disabled">
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.slider_audio.slider_image'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                            
                                {{ html()->file('slide_audio')
                                                ->class('form-control')
                                               
                                                ->autofocus()
                                        }}
                                <br>
                                <p class="m-0 font-weight-normal">{{ $audiodata->slide_audio }}</p>
                                 <audio style="padding-top:8px"controls src="{{url('/audio/backend/',$audiodata->slide_audio)}}"></audio>
                            </div><!--col-->
                           
                            <input type="hidden" name="oldaudio" value="{{$audiodata->slide_audio}}">
                        </div><!--form-group-->
                    </div><!--col-->
                    </div><!--col-->
                </div><!--row-->
            
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.slider_audio'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    function deletetravelimg(id){
     
       if(confirm("Are you sure you want to delete this?"))
       {
         $.ajax({
            url :"<?= url('admin/travel_report/deletetravelimg/&ids='); ?>" +id,
            method : 'GET',
            data:{ids:id},
            success:function(data){
          $('#remove_div'+id).remove();
            }
          });
        }
       else {
            return false;
        }
    }
  
</script>

<script>
    function deletegalleryimg(id){
     
       if(confirm("Are you sure you want to delete this?"))
       {
         $.ajax({
            url :"<?= url('admin/travel_report/deletegalleryimg/&ids='); ?>" +id,
            method : 'GET',
            data:{ids:id},
            success:function(data){
          $('#remove_div'+id).remove();
            }
          });
        }
       else {
            return false;
        }
    }
  
</script>

<script>
    function deletecomponent(id){
     
       if(confirm("Are you sure you want to delete this?"))
       {
         $.ajax({
            url :"<?= url('admin/travel_report/deletecomponent/&ids='); ?>" +id,
            method : 'GET',
            data:{ids:id},
            success:function(data){
          $('#remove_div'+id).remove();
            }
          });
        }
       else {
            return false;
        }
    }
  
</script>

<style type="text/css">
    .form-group .cross-bar
    {
        padding: 0px 5px;
        background: #efebeb;
        position: absolute;
        right: 13px;
        color: #FFF;
        border-radius: 10px;
        border-color: red;
    }
</style>
@endsection
