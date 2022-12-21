@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">

                <div class="col">
                   @if($user->role_type =='administrator' || $user->role_type =='admin')
                        <div class="form-group row">
                            {{ html()->label(__('Avatar image'))->class('col-md-2 form-control-label')->for('image') }}
                        <div class="col-md-10">
                            <input type="file" name="avatar">
                            <br/>

                            @if(file_exists(public_path('img/frontend/'.$user->avatar_location)) && !empty($user->avatar_location))
                            <br/>
                                <img width="100px" height="80px" src="{{url('img/frontend/'.$user->avatar_location)}}">

                            @endif
                        </div><!--col-->
                    </div><!--form-group-->
                   @endif 
                    

                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                     <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.username'))->class('col-md-2 form-control-label')->for('username') }}

                        <div class="col-md-10">
                            {{ html()->text('user_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.username'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                   <div class="form-group row">
                        {{ html()->label(__('labels.backend.access.users.table.roles'))->class('col-md-2 form-control-label')->for('roles') }}
                            <div class="col-md-10">

                                {{ html()->select('roles')
                                    ->class('form-control')
                                    ->options($role)
                                    ->attribute('onChange', 'laod_role_container(this)')
                                    ->value($user->role_type)
                                }}
                                
                            </div><!--col-->
                        </div><!--form-group-->
                      
                       @if(isset($user) && ($user->role_type == 'travel_agency'))
                         <div class="form-group row">
                         {{ html()->label(__('labels.backend.access.users.table.travel_agency'))->class('col-md-2 form-control-label')->for('roles') }}
                          
                            <div class="col-md-10">
                                <input type="radio" name="content" id="content" value="day_trip" {{($user->travel_agency=='day_trip')?'checked':''}}> Day Trip  <input type="radio" name="content" id="content" value = "standerd"  {{($user->travel_agency=='standerd')?'checked':''}}> Standerd 
                            </div>
                        </div>
                        @else
                        
                       @endif

                        <div class="form-group row" id="roleId">
                        </div>

                    {{--<div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                            {{ html()->label(
                                                             html()->radio('roles[]', in_array($role->name, $userRoles), $role->name)->class('switch-input')->id('role-'.$role->id). '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                            ->class('switch switch-label switch-pill switch-primary mr-2')->for('role-'.$role->id) }}
                                                            {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($role->id != 1)
                                                                @if($role->permissions->count())
                                                                    @foreach($role->permissions as $permission)
                                                                    <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    @lang('labels.general.none')
                                                                @endif
                                                            @else
                                                                @lang('labels.backend.access.users.all_permissions')
                                                            @endif
                                                        </div>
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox d-flex align-items-center">
                                                        {{ html()->label(
                                                            html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)->class('switch-input')->id('permission-'.$permission->id). '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')->class('switch switch-label switch-pill switch-primary mr-2')
                                                            ->for('permission-'.$permission->id) }}
                                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div>--}}<!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

<script type="text/javascript">
        $('#roleId').html('');
         function laod_role_container(obj){

            var content_value = $(obj).val();
            if(content_value == 'travel_agency'){
                $('#roleId').html('<label class="col-md-2 form-control-label" for="content">Travel Agency</label><div class="col-md-10"><input type="radio" name="content" id="content" value="day_trip" {{($user->travel_agency=='day_trip')?'checked':''}}> Day Trip  <input type="radio" name="content" id="content" value = "standerd" {{($user->travel_agency=='standerd')?'checked':''}}> Standerd </div>');
            }
            
            else{
                $('#roleId').html('');
            }
        }
    </script>
@endsection
 