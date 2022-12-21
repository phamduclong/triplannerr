@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email_setting.management') . ' | ' . __('labels.backend.access.email_setting.edit'))

@section('breadcrumb-links')
        @include('backend.emailsettings.includes.breadcrumb-links')
@endsection

@section('content')

{{ html()->modelForm($data, 'PATCH', route('admin.emailsettings.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.email_setting.management')
                        <small class="text-muted">@lang('labels.backend.access.email_setting.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
                      <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.type'))->class('col-md-2 form-control-label')->for('title') }} 
                            <div class="col-md-10">
                               <select class="form-control" name="type">
                                   <option>Select</option>
                                   <option value="Request the Download of the Travel Diary" @if($data->type=='Request the Download of the Travel Diary') selected='' @endif>Request the Download of the Travel Diary</option>
                                   <option value="Book or Request Information" @if($data->type=='Book or Request Information') selected='' @endif>Book or Request Information</option>
                                   <option value="Triggered Alert" @if($data->type=='Triggered Alert') selected='' @endif>Triggered Alert</option>
                                   <option value="I am Interested" @if($data->type=='I am Interested') selected='' @endif>I'm Interested</option>
                                   <option value="I am Participate" @if($data->type=='I am Participate') selected='' @endif>I'm Participate</option>
                               </select>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.subject'))->class('col-md-2 form-control-label')->for('subject') }} 
                            <div class="col-md-10">
                                {{ html()->textarea('subject')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.subject'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.content'))->class('col-md-2 form-control-label')->for('content') }} 
                            <div class="col-md-10">
                                {{ html()->textarea('content')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.content'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>
                    {{-- <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.sent_to'))->class('col-md-2 form-control-label')->for('sent_to') }} 
                              <div class="col-md-10">
                                {{ html()->text('sent_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.sent_to'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                              </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.emailsettings.sent_from'))->class('col-md-2 form-control-label')->for('sent_from') }} 
                              <div class="col-md-10">
                                {{ html()->text('sent_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.emailsettings.sent_from'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                             </div><!--col-->
                         </div>
                --}}
               </div><!--row-->
      

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.advertisements'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        /*$('#tour_carriers_file').html('');*/
         function laod_advertisement(obj){
            $("#paid").hide();
            var content_value = $(obj).val();
            var type_value = $(obj).data('value');
           
            if(content_value == 'image'){
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Image</label><div class="col-md-10"><input type="file" name="type_file"></div>');
            }
            else if(content_value == 'video'){
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Type Video</label><div class="col-md-4"><input type="radio" onchange="laod_advertisement(this)" name="xyz" value="embedded" data-value="embedded"> Embedded Video</div><div class="col-md-4"><input type="radio" name="xyz" onchange="laod_advertisement(this)" data-value="upload" value="upload"> Upload Video</div>');
            }
            else if(type_value == 'embedded'){
               $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Embedded URL</label><div class="col-md-10"><input type="text" name="embedded_link" class="form-control" value=""></div>');
            }
            else if(type_value == 'upload'){
                $('#carriers_value_show').html('<label class="col-md-2 form-control-label" for="file_name">Graphic Video</label><div class="col-md-10"><input type="file" name="type_file" value="">(only accept mp4)</div>');
            }
            else{
                $('#tour_carriers_file').html('');
                $('#carriers_value_show').html('');
            }

        }
    </script>
@endsection
