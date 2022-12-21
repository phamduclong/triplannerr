@extends('backend.layouts.app')

@section('title', __('labels.backend.access.user_level_request.management') . ' | ' . __('labels.backend.access.user_level_request.edit'))

@section('breadcrumb-links')
    @include('backend.user_level_request.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($data, 'PATCH', route('admin.user_level_request.update', $data->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.user_level_request.management')
                        <small class="text-muted">@lang('labels.backend.access.user_level_request.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
               <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.user_level_request.current_role_id'))->class('col-md-2 form-control-label')->for('user_level_request_type') }}

                            <div class="col-md-10">
                                 <select name="current_role_id" class="form-control" id="current_role_id">
                                      <option value="{{$data->current_role_id}}">{{ isset( $data->RoleName ) ? $data->RoleName->name : '' }}</option>
                                  
                                    @foreach ($role as $role_name)        
                                        <option value="{{ $role_name->id}}">{{$role_name->name}} </option>
                                    @endforeach
                                </select>
                             
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.user_level_request.new_role_id'))->class('col-md-2 form-control-label')->for('new_role_id') }}

                            <div class="col-md-10">
                                 <select name="new_role_id" class="form-control" id="new_role_id">
                                      <option value="{{$data->new_role_id}}">{{ isset( $data->RoleNewName ) ? $data->RoleNewName->name : '' }}</option>
                                  
                                    @foreach ($role as $role_name)        
                                        <option value="{{ $role_name->id}}">{{$role_name->name}} </option>
                                    @endforeach
                                </select>
                             
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.user_level_request.status'))->class('col-md-2 form-control-label')->for('status') }}

                            <div class="col-md-10">
                                <input type="radio" name="status" value="approved" {{ ($data->status=="approved")? "checked" : "" }}> Approved
                                &nbsp;&nbsp;
                                <input type="radio" name="status" value="not_approved" {{ ($data->status=="not_approved")? "checked" : "" }}> Not Approved
                                &nbsp;&nbsp;
                                <input type="radio" name="status" value="cancelled" {{ ($data->status=="cancelled")? "checked" : "" }}> Cancel
                             
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
               </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.user_level_request'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
