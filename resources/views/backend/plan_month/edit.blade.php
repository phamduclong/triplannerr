@extends('backend.layouts.app')

@section('title', __('labels.backend.access.plan_month.management') . ' | ' . __('labels.backend.access.plan_month.edit'))

@section('breadcrumb-links')
    @include('backend.plan_month.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($data, 'PATCH', route('admin.plan_month.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.plan_month.management')
                        <small class="text-muted">@lang('labels.backend.access.plan_month.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
                <div class="row mt-4 mb-4">
                    <div class="col"> {{--$data--}}
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_month.name'))->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_month.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_month.no_of_month'))->class('col-md-2 form-control-label')->for('no_of_month') }}

                            <div class="col-md-10">
                               {{ html()->text('no_of_month')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_month.no_of_month'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan_month.discount'))->class('col-md-2 form-control-label')->for('discount') }}

                            <div class="col-md-10">
                               {{ html()->text('discount')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan_month.discount'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.plan_month'), __('buttons.general.cancel')) }}
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
        $('#tour_carriers_file').html('');
         function laod_plan_month(obj){
            $("#Paid").hide();
            var content_value = $(obj).val();
            // if(content_value == 'Free'){
            //     $('#tour_carriers_file').html('<label class="col-md-2 form-control-label"for="content">Free</label>                            <div class="col-md-10"><input class="form-control" type="text" name="amount" disabled id="free" placeholder="--" value="--" maxlength="191"></div>');
            // }
            // else
             if(content_value == 'Paid'){
                $('#tour_carriers_file').html('<label class="col-md-2 form-control-label" for="file_name">Paid</label><div class="col-md-10"><input type="text" class="form-control" placeholder="Amount" name="amount" value="{{$data->amount}}"></div>');
            }
            else{
                $('#tour_carriers_file').html('');
            }
        }
    </script>
@endsection
