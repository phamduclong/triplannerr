@extends('frontend.layouts.travelmaker')

@section('content')
<style>
    input.error {
        border-color: red;
    }
    label.error {
        color: red !important;
        margin-top: 5px;
        font-size: 12px !important;
    }
    .tb-services {
        font-weight: initial;
    }
</style>
@php
    $role = Auth::user()->role_type;
@endphp

<div class="account-section mx-50">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col col-sm-10">
            <div class="card" style="margin-top:90px;">
                <div class="card-body">
                    <h3 style="text-align: center; margin-bottom: 25px; color: #0198cd;">Edit Account</h3>
                    <div class="account-form">

                       {{ html()->modelForm($user_data, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->id('myform')->attribute('enctype', 'multipart/form-data')->open() }} 
                       @method('PATCH')

                            <div class="row"> 
                                <!-- Tab panes -->
                                <div class="tab-content" style="width: 100%;">

                                    <!-- INIZIO PRIMO STEP -->
                                    <div class="container stepper" id="first_step">
                                        <div class="row">
                                            <div class="col-12 form-group travel-info">
                                                {!!__('general.frontend.intro.'.$role)!!}
                                            </div>
                                            
                                            @foreach($formFields['first_step'] as $name => $formField) 
                                                @php
                                                    if(isset($formField['parent'])) {
                                                        $value = $user_data[$formField['parent']][$name] ?? '';
                                                    } else {
                                                        $value = $user_data[$name] ?? '';
                                                    }
                                                @endphp

                                                <div class="{{$formField['wrapper_classes']}}">
                                                    <label for="{{$name}}">
                                                        {{$formField['label']}}
                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                    </label>
                                                    @switch($formField['type'])
                                                        @case('text')
                                                            <label for="{{$name}}">
                                                                {{-- {{$formField['label']}} --}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            <input class="{{$formField['classes']}}" 
                                                                type="{{$formField['type']}}" 
                                                                name="{{$formField['name']??''}}" 
                                                                id="{{$formField['id']??''}}" 
                                                                placeholder="{{isset($formField['placeholder']) ? $formField['placeholder'] : ''}}" 
                                                                value="{{$value}}" 
                                                                @if(isset($formField['required'])) required @endif
                                                            />
                                                            <div id="errorLinkedIn" style="color: red"></div>
                                                        @break
                                                        @case('textarea')
                                                            <textarea class="{{$formField['classes']}}"  
                                                                name="{{$name}}" 
                                                                id="{{$formField['id']}}" 
                                                                placeholder="{{isset($formField['placeholder']) ? $formField['placeholder'] : ''}}">{{$value}}</textarea>
                                                        @break
                                                        @case('file')
                                                            <div class="row">
                                                                <div class="{{$formField['classes']}}">
                                                                    @if(isset($value))
                                                                        <label id="{{'label'. $formField['id']}}" for="{{$formField['id']}}" class="btn btn-light" style="color: black;border: 1px solid gray;text-align:left">
                                                                            <span class="btn btn-secondary">Choosen file</span>
                                                                            <span>{{strlen($value) < 20 ? $value : substr($value, 0, 20) . '...'}}</span>
                                                                        </label>
                                                                        <input class="form-control @if(isset($formField['to_crop']) && $formField['to_crop'])to_crop @endif @if(isset($formField['preview']) && $formField['preview'])preview @endif"  
                                                                            type="file" 
                                                                            name="{{$formField['name']}}" 
                                                                            id="{{$formField['id']}}" 
                                                                            accept="image/*" 
                                                                            data-id="{{$formField['name']}}_id" 
                                                                            data-height="{{isset($formField['height']) ? $formField['height'] : ''}}"
                                                                            data-width="{{isset($formField['width']) ? $formField['width'] : ''}}"
                                                                            data-container="{{$formField['name']}}_container" 
                                                                            data-dimension="{{isset($formField['dimensionTemplate']) ? $formField['dimensionTemplate'] : ''}}"
                                                                            style="display: none"
                                                                        >
                                                                    @else
                                                                        <input class="form-control @if(isset($formField['to_crop']) && $formField['to_crop'])to_crop @endif @if(isset($formField['preview']) && $formField['preview'])preview @endif"  
                                                                            type="file" 
                                                                            name="{{$formField['name']}}" 
                                                                            id="{{$formField['id']}}" 
                                                                            accept="image/*" 
                                                                            data-id="{{$formField['name']}}_id" 
                                                                            data-height="{{isset($formField['height']) ? $formField['height'] : ''}}"
                                                                            data-width="{{isset($formField['width']) ? $formField['width'] : ''}}"
                                                                            data-container="{{$formField['name']}}_container" 
                                                                            data-dimension="{{isset($formField['dimensionTemplate']) ? $formField['dimensionTemplate'] : ''}}"
                                                                        >
                                                                    @endif
                                                                    <input type="hidden" name="{{$formField['name']}}_name" id="{{$formField['name']}}_id" >
                                                                    @if(isset($formField['validate']) && $formField['validate'])
                                                                        <p id="{{$formField['name']}}_err" class="text-danger"></p>
                                                                        <p style="color: red;">Image resolution should be minimum {{$formField['width']}}x{{$formField['height']}}</p>
                                                                    @endif
                                                                </div>
                                                                @if(isset($formField['preview']) && $formField['preview'])
                                                                    <div class="col-md-6 form-group">
                                                                        @if(!empty($value) && file_exists(public_path('img/frontend/user/'.$value)) )
                                                                            <img src="{{url('img/frontend/user/'.$value)}}" class="img-responsive" id="{{$formField['name']}}_container" height="100">
                                                                        @else
                                                                            <img src="{!! URL::to('img/frontend/demo.png') !!}" class="img-responsive" id="{{$formField['name']}}_container" height="100">
                                                                        @endif 
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @break
                                                    @endswitch
                                                </div>
                                            @endforeach
                                        </div>

                                        <ul class="nav nav-tabs border-0">
                                            <li class="nav-item ml-auto">
                                                <a class="nav-link" href="#second_step" onClick="nextStep(second_step, 2)"><i class="fa fa-arrow-right"></i>Go To Second Page</a>
                                                {{-- <a class="nav-link" href="#second_step"><i class="fa fa-arrow-right"></i>Go To Second Page</a> --}}
                                            </li>
                                        </ul> 
                                    </div>
                                    <!-- FINE PRIMO STEP -->
                                    
                                    <!-- INIZIO SECONDO STEP -->
                                    <div class="container stepper d-none" id="second_step">
                                        <div class="row">
                                            @foreach($formFields['second_step'] as $name => $formField) 
                                                @php 
                                                    if(isset($formField['parent'])) {
                                                        $value = $user_data[$formField['parent']][$name] ?? '';
                                                    } else {
                                                        $value = $user_data[$name] ?? '';
                                                    }
                                                    if($formField['type'] == 'date' && $user_data->userdetail) {
                                                        $value=date('Y-m-d',strtotime($user_data->userdetail->birth_place));
                                                    }
                                                @endphp

                                                <div class="{{$formField['wrapper_classes']}}">
                                                    @switch($formField['type'])
                                                        @case('select')
                                                            <label for="{{$name}}">
                                                                {{$formField['label']}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            <select class="{{$formField['classes']}}" name="{{$formField['name']}}" id="{{$formField['id']}}">
                                                                <option selected disabled>Select {{$formField['label']}}</option>
                                                                @foreach($formField['options'] as $option)
                                                                    <option 
                                                                        value="{{$option['label']}}"
                                                                        @if($value === $option['label']) selected @endif
                                                                        @if(isset($option['disabled'])) disabled @endif
                                                                    >
                                                                            {{$option['label']}}
                                                                    </option>  
                                                                @endforeach                                                   
                                                            </select>
                                                        @break
                                                        @case('text_auto_search')
                                                            <label for="{{$name}}">
                                                                {{$formField['label']}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            <input type="text" class="{{$formField['classes']}}" name="{{$formField['name']}}" id="{{$formField['id']}}" value="{{isset($value) ? $value : ''}}">
                                                            {{-- <select class="{{$formField['classes']}}" name="{{$formField['name']}}" id="list-countries">
                                                                <option selected disabled>Select {{$formField['label']}}</option>
                                                                @foreach($formField['options'] as $option)
                                                                    <option 
                                                                        value="{{$option['label']}}"
                                                                        @if($value === $option['label']) selected @endif
                                                                        @if(isset($option['disabled'])) disabled @endif
                                                                    >
                                                                            {{$option['label']}}
                                                                    </option>  
                                                                @endforeach                                                   
                                                            </select> --}}
                                                            <div style="background-color: white;z-index:100;border:1px solid #ced4da" name="{{$formField['name']}}" id="list-countries">
                                                                {{-- <option selected disabled>Select {{$formField['label']}}</option> --}}
                                                                @foreach($formField['options'] as $option)
                                                                    <div
                                                                        style="margin-left: 5px"
                                                                        id="{{$option['label']}}"
                                                                        onclick="changeCountry(this)"
                                                                        {{-- value="{{$option['label']}}"
                                                                        @if($value === $option['label']) selected @endif
                                                                        @if(isset($option['disabled'])) disabled @endif --}}
                                                                    >
                                                                            {{$option['label']}}
                                                                    </div>  
                                                                @endforeach                                                   
                                                            </div>
                                                        @break
                                                        @case('textarea')
                                                            <label for="{{$name}}">
                                                                {{$formField['label']}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            <textarea class="{{$formField['classes']}}"  
                                                                name="{{$name}}" 
                                                                id="{{$formField['id']}}" 
                                                                placeholder="{{isset($formField['placeholder']) ? $formField['placeholder'] : ''}}">{{$value}}</textarea>
                                                        @break
                                                        @case('file')
                                                            <label for="{{$name}}">
                                                                @if($formField['name'] == 'front_identity_doc')
                                                                    @if($role == 'traveler')
                                                                        <div>Optional</div>
                                                                    @else
                                                                        <div>Obligatory</div>
                                                                    @endif
                                                                    <div>
                                                                        {{$formField['label']}}
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </div>
                                                                @else
                                                                    <div style="margin-top: 23px">
                                                                        {{$formField['label']}}
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </div>
                                                                @endif
                                                                
                                                            </label>
                                                            <div class="row">
                                                                <div class="{{$formField['classes']}}">
                                                                    @if(!empty($value))
                                                                        <label id="{{'label'. $formField['id']}}" for="{{$formField['id']}}" class="btn btn-light" style="color: black;border: 1px solid gray;text-align:left">
                                                                            <span class="btn btn-secondary">Choosen file</span>
                                                                            <span>{{ strlen($value) < 20 ? $value : substr($value, 0, 20) . '...' }}</span>
                                                                        </label>
                                                                        <input class="form-control @if(isset($formField['to_crop']) && $formField['to_crop'])to_crop @endif @if(isset($formField['preview']) && $formField['preview'])preview @endif"
                                                                            type="file" 
                                                                            name="{{$formField['name']??''}}" 
                                                                            id="{{$formField['id']??''}}" 
                                                                            accept="image/*" 
                                                                            data-id="{{$formField['name']}}_id" 
                                                                            data-height="{{isset($formField['height']) ? $formField['height'] : ''}}"
                                                                            data-width="{{isset($formField['width']) ? $formField['width'] : ''}}"
                                                                            data-container="{{$formField['name']}}_container" 
                                                                            data-dimension="{{isset($formField['dimensionTemplate']) ? $formField['dimensionTemplate'] : ''}}"
                                                                            @if(isset($formField['required'])) required @endif
                                                                            style="display: none"
                                                                        >
                                                                    @else
                                                                        <input class="form-control @if(isset($formField['to_crop']) && $formField['to_crop'])to_crop @endif @if(isset($formField['preview']) && $formField['preview'])preview @endif"
                                                                            type="file" 
                                                                            name="{{$formField['name']??''}}" 
                                                                            id="{{$formField['id']??''}}" 
                                                                            accept="image/*" 
                                                                            data-id="{{$formField['name']}}_id" 
                                                                            data-height="{{isset($formField['height']) ? $formField['height'] : ''}}"
                                                                            data-width="{{isset($formField['width']) ? $formField['width'] : ''}}"
                                                                            data-container="{{$formField['name']}}_container" 
                                                                            data-dimension="{{isset($formField['dimensionTemplate']) ? $formField['dimensionTemplate'] : ''}}"
                                                                            @if(isset($formField['required'])) required @endif
                                                                        >
                                                                    @endif
                                                                    <input type="hidden" name="{{$formField['name']}}_name" id="{{$formField['name']}}_id" >
                                                                    @if(isset($formField['validate']) && $formField['validate'])
                                                                        <p id="{{$formField['name']}}_err" class="text-danger"></p>
                                                                        <p style="color: red;">Image resolution should be minimum {{$formField['width']}}x{{$formField['height']}}</p>
                                                                    @endif
                                                                </div>
                                                                @if(isset($formField['preview']) && $formField['preview'])
                                                                    <div class="col-md-6 form-group">
                                                                        @if(!empty($value) && file_exists(public_path('img/frontend/user/'.$value)) )
                                                                            <img src="{{url('img/frontend/user/'.$value)}}" class="img-responsive" id="{{$formField['name']}}_container" height="100">
                                                                        @else
                                                                            <img src="{!! URL::to('img/frontend/demo.png') !!}" class="img-responsive" id="{{$formField['name']}}_container" height="100">
                                                                        @endif 
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @break
                                                        @case('multicheckbox')
                                                            <label for="{{$name}}">
                                                                {{$formField['label']}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            @foreach($formField['options'] as $option)
                                                                <div class="input-sec">
                                                                    <input 
                                                                        type="checkbox" 
                                                                        name="{{$formField['name']}}" 
                                                                        value="{{$option['value']}}" 
                                                                        @if($user_data->userdetail && str_contains($user_data->userdetail->$name??'', $option['value'])) 
                                                                            checked 
                                                                        @endif
                                                                    >
                                                                        <span>{{$option['label']}}</span>
                                                                    </input>
                                                                </div>
                                                            @endforeach
                                                        @break
                                                        @case('checkbox')
                                                        @if(empty($value))
                                                            <div class="checkbox-wrapper d-flex align-items-baseline">
                                                                <input class="mr-2" 
                                                                    type="checkbox" 
                                                                    name="{{$formField['name']??''}}" 
                                                                    id="{{$formField['id']??''}}"
                                                                    @if(isset($formField['required'])) required @endif
                                                                >  
                                                                @if($formField['id'] == 'travel_commitment')
                                                                    <label for="" class="m-0" id="label_travel_commitment">
                                                                        <a href="{{url('travel_commitment')}}" target="_blank">{{$formField['label']}}</a>
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </label> 
                                                                @elseif($formField['id'] == 'tour_leader_commitment')
                                                                    <label for="" class="m-0" id="label_tour_leader_commitment">
                                                                        <a href="{{url('tour_leader_commitment')}}" target="_blank">{{$formField['label']}}</a>
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </label>     
                                                                @elseif($formField['id'] == 'accept_travel_maker')
                                                                    <label for="" class="m-0" id="label_accept_travel_maker">
                                                                        <a href="{{url('accept_travel_maker')}}" target="_blank">{{$formField['label']}}</a>
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </label>
                                                                @else
                                                                    <label for="{{$name}}" class="m-0">
                                                                        {{$formField['label']}}
                                                                        @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                                    </label>
                                                                @endif                                                      
                                                            </div>
                                                            <div id="errorAcceptTravelMaker" style="color: red"></div>
                                                        @endif
                                                        @break
                                                        @case('text' || 'date' || 'textarea')
                                                            {{-- @if(Auth::user()->role_type =='travel_agency' && $formField['name'] == 'linkedin_link')
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                                {{ html()->label(__('validation.attributes.frontend.agency_name'))->for('agency_name') }}
                                                                                {{ html()->text('userdetail.agency_name')
                                                                                                ->class('form-control')
                                                                                                ->autofocus() }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                                {{ html()->label(__('validation.attributes.frontend.agency_website'))->for('agency_website') }}
                                                                                {{ html()->text('userdetail.agency_website')
                                                                                                ->class('form-control')
                                                                                                ->autofocus() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                                {{ html()->label(__('validation.attributes.frontend.agency_address'))->for('agency_address') }}
                                                                                {{ html()->textarea('userdetail.agency_address')
                                                                                    ->class('form-control')
                                                                                    ->placeholder(__('validation.attributes.frontend.agency_address'))
                                                                                    ->attribute('maxlength', 191)
                                                                                    ->autofocus() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            {{ html()->label(__('validation.attributes.frontend.license_detail'))->for('license_detail') }}
                                                                            {{ html()->textarea('userdetail.license_detail')
                                                                                ->class('form-control')
                                                                                ->placeholder(__('validation.attributes.frontend.license_detail'))
                                                                                ->attribute('maxlength', 191)
                                                                                ->autofocus() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif --}}
                                                            <label for="{{$name}}">
                                                                {{$formField['label']}}
                                                                @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                            </label>
                                                            <input class="{{$formField['classes']}}" 
                                                                type="{{$formField['type']}}" 
                                                                name="{{$formField['name']??''}}" 
                                                                id="{{$formField['id']??''}}" 
                                                                placeholder="{{isset($formField['placeholder']) ? $formField['placeholder'] : ''}}" 
                                                                value="{{$value}}" 
                                                                @if(isset($formField['required'])) required @endif
                                                            />
                                                            @if($formField['name'] == 'linkedin_link')
                                                                <div id="errorLinkedIn" style="color: red"></div>
                                                            @endif
                                                            @if($formField['id'] == 'search_data1')
                                                                <div id="errorNationWant" style="color: red"></div>
                                                            @endif
                                                        @break
                                                    @endswitch
                                                </div>
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="role_type" value="{{Auth::user()->role_type}}">
                                        <div class="row">
                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#first_step" onClick="prevStep(first_step)"><i class="fa fa-arrow-left"></i> Back</a>
                                                </li>

                                                <li class="nav-item ml-auto" id="buttonGoToThirdStep">
                                                    {{-- <a class="nav-link" href="#third_step" onClick="nextStep(third_step, 3)"><i class="fa fa-arrow-right"></i> Go To Third Page</a> --}}
                                                    <a class="nav-link" href="#third_step"><i class="fa fa-arrow-right"></i> Go To Third Page</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- FINE SECONDO STEP -->

                                    <!-- INIZIO TERZO STEP -->
                                    @if($role =='traveler' || $role =='travel_maker' || $role =='travel_blogger')
                                        <div class="container stepper d-none" id="third_step">   
                                            <div class="row">
                                                @foreach($formFields['third_step'] as $name => $formField) 
                                                    <div class="{{$formField['wrapper_classes']}}">
                                                        <label for="{{$name}}">
                                                            {{$formField['label']}}
                                                            @if(isset($formField['required']) && $formField['required'])<span style="color: red">*</span>@endif
                                                        </label>
                                                        @switch($formField['type'])
                                                            @case('multicheckbox')
                                                                @foreach($formField['options'] as $option)
                                                                    <div class="input-sec">
                                                                        <input 
                                                                            type="checkbox" 
                                                                            name="{{$formField['name']}}" 
                                                                            value="{{$option['label']}}" 
                                                                            @if($user_data->userdetail && str_contains($user_data->userdetail->$name??'', $option['label'])) 
                                                                                checked 
                                                                            @endif
                                                                        >
                                                                            <span>{{$option['label']}}</span>
                                                                        </input>
                                                                    </div>
                                                                @endforeach
                                                            @break
                                                            @case('radio')
                                                                @foreach($formField['options'] as $option)
                                                                    <div class="input-sec">
                                                                        <input 
                                                                            type="radio" 
                                                                            name="{{$formField['name']}}" 
                                                                            value="{{$option['label']}}" 
                                                                            @if($user_data->userdetail && $user_data->userdetail->$name == $option['label']) checked @endif
                                                                        >
                                                                            {{$option['label']}}
                                                                        </input>
                                                                    </div>
                                                                @endforeach
                                                            @break
                                                        @endswitch
                                                    </div>
                                                @endforeach
                                            </div>

                                            <ul class="nav nav-tabs border-0">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#second_step" onClick="prevStep(second_step)"><i class="fa fa-arrow-left"></i> Back</a>
                                                </li>
                                                <li class="nav-item ml-auto">
                                                    <div class="form-group mb-0 clearfix">
                                                        {{ form_submit(__('labels.general.buttons.update'))->class('more_btn m-0') }}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- FINE TERZO STEP -->

                                    @if(Auth::user()->role_type =='travel_agency')
                                        <div class="container stepper d-none" id="third_step">
                                            @include('frontend.travelpro.account.tabs.third_step')
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if ($logged_in_user->canChangeEmail())
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                                        </div>

                                        <div class="form-group">
                                            {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                            {{ html()->email('email')
                                                ->class('form-control')
                                                ->placeholder(__('validation.attributes.frontend.email'))
                                                ->attribute('maxlength', 191)
                                                ->required() }}
                                        </div><!--form-group-->
                                    </div><!--col-->
                                </div><!--row-->
                            @endif
   
                        {{ html()->closeModelForm() }}

                        <div id="uploadimageModal" class="modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Crop Image</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div id="image_demo"></div>
                                                <input type="hidden" data-id="" id="preview-container-id" />
                                                <input type="hidden" data-id="" id="image_container" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success crop_image" type="button">Crop</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @push('after-styles')
                            {!! script('js/frontend/jquery.min.js') !!}
                            <link rel="stylesheet" href="{{ url('css/croppie.css')}}" />
                            <style type="text/css">
                                .modal-dialog {
                                    max-width: 80%;
                                    margin: 1.75rem auto;
                                }
                                .modal-body{overflow: scroll;}
                            </style>
                        @endpush  

                        @push('after-scripts')

                            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
                            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
                            <script src="{{ url('js/croppie.js')}}"></script>

                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('#search_data').tokenfield({
                                        autocomplete :{
                                            source: [<?php echo '"' .implode( '", "', $countries ). '"' ?>],
                                            delay: 100
                                        }
                                    });

                                    $('#search').click(function(){
                                        $('#country_name').text($('#search_data').val());
                                    });

                                    $('#search_data1').tokenfield({
                                        autocomplete :{
                                            source: [<?php echo '"' .implode( '", "', $countries ). '"' ?>],
                                            delay: 100
                                        }
                                    });

                                    $('#search').click(function(){
                                        $('#country_name1').text($('#search_data1').val());
                                    });

                                    $('#label_accept_travel_maker').hover(function(){
                                        $(this).css('text-decoration', 'underline');
                                    },function(){
                                        $(this).css('text-decoration', 'none');
                                    });

                                    $('#label_tour_leader_commitment').hover(function(){
                                        $(this).css('text-decoration', 'underline');
                                    },function(){
                                        $(this).css('text-decoration', 'none');
                                    });

                                    $('#label_travel_commitment').hover(function(){
                                        $(this).css('text-decoration', 'underline');
                                    },function(){
                                        $(this).css('text-decoration', 'none');
                                    });

                                    $('#buttonGoToThirdStep').click(function(){
                                        if ($('#accept_travel_maker').length){
                                            if($('#accept_travel_maker')[0].checked){
                                                $('#errorAcceptTravelMaker').html('');
                                                nextStep(third_step, 3);
                                            }else{
                                                $('#errorAcceptTravelMaker').html('This field is required.');
                                                return;
                                            }
                                        }
                                        if($('#linkedin_link').val()){
                                            var valueLinkedIn = $('#linkedin_link').val().replace(/\s/g, '');
                                            if(valueLinkedIn){
                                                if(!validURL(valueLinkedIn)){
                                                    $('#errorLinkedIn').html('LinkedIn must a URL');
                                                }else if(valueLinkedIn.length > 191){
                                                    $('#errorLinkedIn').html('Max lenght is 191 characters');
                                                }else{
                                                    $('#errorLinkedIn').html('');
                                                    nextStep(third_step, 3);
                                                }
                                                
                                                // $('html, body').animate({
                                                //     scrollTop: 40
                                                // }, 300);
                                            }else{
                                                $('#errorLinkedIn').html('');
                                                nextStep(third_step, 3);
                                            }
                                        }else if($('#search_data1').val()){
                                            var countryResidence = $('#place_of_residence').val();
                                            var countryVisited = $('#search_data').val().split(", ");
                                            var countryWant = $('#search_data1').val().split(", ");
                                            var check = true;
                                            for(var i = 0; i < countryWant.length; ++i){
                                                if(countryWant[i] == countryResidence || countryVisited.indexOf(countryWant[i]) >= 0){
                                                    check = false;
                                                    break;
                                                }
                                            }
                                            if(check){
                                                $('#errorNationWant').html('');
                                                nextStep(third_step, 3);
                                            }else{
                                                $('#errorNationWant').html('The "Favorite Nations you want to visit" can not have the same options with the "Place of residence/Favorite Nations you visited"');
                                                $('html, body').animate({
                                                    scrollTop: 40
                                                }, 300);
                                            }
                                        }else{
                                            nextStep(third_step, 3);
                                        }
                                    });

                                    $('#cover').change(function(){
                                        $('#labelcover').hide();
                                        $(this).show();
                                    });
                                    $('#profile').change(function(){
                                        $('#labelprofile').hide();
                                        $(this).show();
                                    });

                                    $('#front_identity_doc').change(function(){
                                        $('#labelfront_identity_doc').hide();
                                        $(this).show();
                                    });
                                    $('#back_identity_doc').change(function(){
                                        $('#labelback_identity_doc').hide();
                                        $(this).show();
                                    });
                                });

                                function validURL(str) {
                                    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                                        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                                        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                                        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                                        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                                        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
                                    return !!pattern.test(str);
                                }

                                $("#list-countries").hide();
                                $("#place_of_residence").on("keyup", function() {
                                    $("#list-countries").show();
                                    var value = $(this).val().toLowerCase();
                                    $("#list-countries div").filter(function() {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                                function changeCountry(country) {
                                    $("#place_of_residence").val(country.getAttribute('id'));
                                    $("#list-countries").hide();
                                }
                                

                                function prevStep(stepId) {
                                    $(".stepper").addClass("d-none");
                                    $(stepId).removeClass("d-none");
                                }

                                function nextStep(stepId, nextStepNumber='') {
                                    $("#myform").validate({
                                        ignore: ":hidden",
                                        errorPlacement: function(error, element) {
                                            if (element.attr("name") == "travel_commitment" || element.attr("name") == "tour_leader_commitment" ) {
                                                // error.insertAfter("#lastname");
                                                error.insertAfter( element.parent("div") );
                                            } else {
                                                error.insertAfter(element);
                                            }
                                        },
                                        invalidHandler: function(form, validator) {
                                            if (!validator.numberOfInvalids())
                                                return;

                                            $('html, body').animate({
                                                scrollTop: $(validator.errorList[0].element).offset().top - 40
                                            }, 300);
                                        }
                                    });
                                    var isValid = $("#myform").valid();
                                    if(isValid) {
                                        $(".stepper").addClass("d-none");
                                        $(stepId).removeClass("d-none");
                                    }
                                }

                            </script>

                            <script type="text/javascript">

                                function readImageURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        var previewContainer = $(input).data('container');
                                        reader.onload = function (e) {
                                            $('#'+previewContainer).attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $(".preview").not(".to_crop").on('change', function(){
                                    readImageURL(this);
                                });

                                var $image_crop = '';
                                var cOldImg = $('#cover_image_container').attr('src');
                                var pOldImg = $('#profile_image_container').attr('src');
                                var logoOldImg = $('#userdetail_agency_logo_container').attr('src');
                                $(document).ready(function(){
                                    $('.to_crop').on('change', function(){
                                        inputId = $(this).attr('id');
                                        $that = this;
                                        var isErr = true;
                                        $("#image_demo").html('');
                                        var desired_height = $(this).data('height');
                                        var desired_width = $(this).data('width');
                                        var dimensions = $(this).data('dimension');
                                        var container_id = $(this).data('id');
                                        var image_container = $(this).data('container');
                                        var _URL = window.URL || window.webkitURL;
                                        var file, img;
                                        if ((file = this.files[0])) {
                                            img = new Image();
                                            img.onload = function() {
                                            // alert(this.width+"--"+this.height);
                                            if (desired_width <= this.width && desired_height <= this.height) {
                                                isErr = false;
                                                $('#'+inputId).removeClass('error');
                                                $image_crop = $('#image_demo').croppie({
                                                    enableExif: true,
                                                    viewport: {
                                                        width:desired_width,
                                                        height:desired_height,
                                                        type:'square' //circle
                                                    },
                                                    boundary:{
                                                        width:(desired_width+50),
                                                        height:(desired_height + 50)
                                                    }
                                                });
                                            } else {
                                                $('#'+inputId).addClass('error');
                                                // msg="Image resolution should be minimum "+desired_width+'x'+desired_height;
                                                return;
                                            }
                                        };
                                        img.src = _URL.createObjectURL(file);
                                    }

                                    setTimeout(function(){
                                        if(typeof $image_crop !== 'string' && isErr === false){
                                            var reader = new FileReader();
                                            reader.onload = function (event) {
                                                $image_crop.croppie('bind', {
                                                    url: event.target.result
                                                }).then(function(){
                                                    console.log('jQuery bind complete');
                                                });
                                            }

                                            reader.readAsDataURL($that.files[0]);
                                            $("#preview-container-id").val(container_id);
                                            $("#image_container").val(image_container);
                                            $('#uploadimageModal').modal('show');
                                        }
                                    },300);
                                });

                                    $('.crop_image').click(function(event){
                                        var filename = $('#profile').val().replace(/C:\\fakepath\\/i, '')
                                        $image_crop.croppie('result', {
                                            type: 'canvas',
                                            size: 'viewport'
                                        }).then(function(response){
                                            $.ajax({
                                                url:"{{ route('frontend.crop_image') }}",
                                                type: "POST",
                                                data:{"image": response, '_token': '{{ csrf_token() }}'},
                                                success:function(data)
                                                {
                                                    var response = JSON.parse(data); 
                                                    console.log(response);
                                                    if(response.status == 200){
                                                        $("#"+$("#preview-container-id").val()).val(response.image);
                                                        $('#uploadimageModal').modal('hide');
                                                        $('#'+$("#image_container").val()).attr('src', response.image_url);

                                                        $('#AGENCY_LOGO_PREVIEW_IMG').attr('src', response.image_url);
                                                        $('#AGENCY_LOGO').hide();
                                                        $('#AGENCY_LOGO_PREVIEW').show();
                                                        
                                                    }
                                                }
                                            });
                                        });
                                    });


                                    $("input[name='preferred_travel_category[]']").change(function () {
                                        var maxAllowed = 3;
                                        var cnt = $("input[name='preferred_travel_category[]']:checked").length;
                                        if (cnt > maxAllowed) {
                                            $(this).prop("checked", "");
                                            alert('You can select maximum ' + maxAllowed + ' Value!!');
                                        }
                                    });

                                    $("input[name='type_of_accommodation[]']").change(function () {
                                        var maxAllowed = 3;
                                        var cnt = $("input[name='type_of_accommodation[]']:checked").length;
                                        if (cnt > maxAllowed) {
                                            $(this).prop("checked", "");
                                            alert('You can select maximum ' + maxAllowed + ' Value!!');
                                        }
                                    });

                                    $("input[name='vector_type[]']").change(function () {
                                        var maxAllowed = 3;
                                        var cnt = $("input[name='vector_type[]']:checked").length;
                                        if (cnt > maxAllowed) {
                                            $(this).prop("checked", "");
                                            alert('You can select maximum ' + maxAllowed + ' Value!!');
                                        }
                                    });

                                    $("input[name='type_of_participants[]']").change(function () {
                                        var maxAllowed = 3;
                                        var cnt = $("input[name='type_of_participants[]']:checked").length;
                                        if (cnt > maxAllowed) {
                                            $(this).prop("checked", "");
                                            alert('You can select maximum ' + maxAllowed + ' Value!!');
                                        }
                                    });

                                    $("input[name='type_of_fav_meals[]']").change(function () {
                                        var maxAllowed = 3;
                                        var cnt = $("input[name='type_of_fav_meals[]']:checked").length;
                                        if (cnt > maxAllowed) {
                                            $(this).prop("checked", "");
                                            alert('You can select maximum ' + maxAllowed + ' Value!!');
                                        }
                                    });
                                });
                            
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
