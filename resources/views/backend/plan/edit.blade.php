@extends('backend.layouts.app')

@section('title', __('labels.backend.access.plan.management') . ' | ' . __('labels.backend.access.plan.edit'))

@section('breadcrumb-links')
    @include('backend.plan.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($data, 'PATCH', route('admin.plan.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.plan.management')
                        <small class="text-muted">@lang('labels.backend.access.plan.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
                <div class="row mt-4 mb-4">
                    <div class="col"> {{--$data--}}
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.name'))->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.plan_type'))->class('col-md-2 form-control-label')->for('plan_type') }}

                            <div class="col-md-10">
                                @php
                                    $plan_type = ['' => 'select', 'Free' => 'Free', 'Paid' => 'Paid'];
                                @endphp
                           
                                {{ html()->select('plan_type')
                                    ->class('form-control')
                                    ->id('form-control')
                                    ->options($plan_type)
                                    ->value(ucfirst($data->plan_type))
                                    ->attribute('onChange', 'laod_plan(this)')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        @if($data->plan_type == 'Paid' || $data->plan_type == 'paid') 
                        <div class="form-group row" id="Paid">
                             {{ html()->label(__('validation.attributes.backend.access.plan.amount'))->class('col-md-2 form-control-label')->for('amount') }}

                            <div class="col-md-10">
                             
                              <input type="number" class="form-control" placeholder="Amount" name="amount" value="{{$data->amount}}">
                             
                           </div>
                        </div>
                        @endif
                      
                        <div class="form-group row" id="tour_carriers_file">
                        </div>

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.privilege_ids'))->class('col-md-2 form-control-label')->for('privilege_ids') }}

                            <div class="col-md-10">
                                {{ html()->select('privilege_ids')
                                    ->class('form-control')
                                    ->options($plan_privilege)
                                    ->value($data->privilege_ids)
                                }}
                                <!-- {{ html()->text('privilege_ids')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan.privilege_ids'))
                                    ->attribute('maxlength', 191)
                                    ->required()

                                    ->autofocus() }} -->
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                {{ html()->textarea('description')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.plan.description'))
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.plan.plan_feature_type'))->class('col-md-2 form-control-label')->for('plan_feature') }}

                            <div class="col-md-10">

                                @php
                                    $selected_feature = explode(',', $data->feature_ids);       
                                @endphp
                                 {{
                                  Form::select('feature_ids[]', $plan_featuresArr , $selected_feature, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'feature_ids', 'multiple'=>'multiple']) 
                                }}
                              
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.plan'), __('buttons.general.cancel')) }}
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
         function laod_plan(obj){
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
