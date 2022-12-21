@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | edit travel report')

@section('content')

<div class="inner-banner control-banner">
    @include('frontend.profile-banner')
  {{-- <img src="{{url('img/frontend/profile-banner.jpg')}}">
  <div class="container-fluid">
    <p class="banner-txt">"Start uploading your Travel Reports to mark the countries you have visited on Blue; activate the Alerts on the countries you want to visit to color the countries in red."</p>
  </div>

 <div class="badge-icon chagecss">
    @if(!empty($roledata->image) && file_exists(public_path('img/backend/traveler_image'.'/'.$roledata->image)) )
      <img src="{{url('img/backend/traveler_image/'.$roledata->image)}}" class="img-responsive">
    @else
      <img src="{{url('img/frontend/user.png')}}">
    @endif
  </div> --}}
</div>

<div class="account-section mx-50">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-sm-12 align-self-center">
        <div class="card">
          <div class="account-form travelreport-form">
            <div class="card-body">
              <!-- {{ html()->form('POST', route('frontend.update-reports'))->attribute('enctype','multipart/form-data')->id('formID')->open()}} -->
              {{ html()->form('POST', route('frontend.update-reports'))->attribute('enctype','multipart/form-data')->open()}}
              <input type="hidden" name="report_id" value="{{$report->id}}">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    {{
                      Form::label('name', trans('validation.attributes.frontend.travel_report.travel_report_name'))
                    }}

                    {{
                      Form::text('travel_report_name', $report->title, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.travel_report.travel_report_name'), 'required' => 'required', 'max-length' => 191, 'id' => 'travel_report_name'])
                    }}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group" id="travel_report_category_div">
                    {{
                      html()->label(__('validation.attributes.frontend.travel_report.travel_report_category'))->for('travel_report_category')
                    }}
                    @php
                    $selected_cats = explode(',', $report->category_id);
                    @endphp
                    {{
                      // Form::select('travel_report_category[]', $travelcateg_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_report_category', 'multiple'=>'multiple'])
                      Form::select('travel_report_category[]', $travelcateg_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_report_category'])
                    }}
                  </div>
                </div>
               </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                          $startDate = date('d-m-Y', strtotime($report->report_startdate));

                          $endDate = date('d-m-Y', strtotime($report->report_enddate));

                          $age = date('d-m-Y', strtotime($report->birth_place));

                      ?>
                      {{ html()->label(__('validation.attributes.frontend.travel_report.trip_start_date'))->for('trip_start') }}

                      <input class="form-control" type="text" name="trip_start" id="datepicker" required="required" value="{{$startDate}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.trip_end_date'))->for('trip_end') }}
                      {{
                        Form::text('trip_end', $endDate, ['class'=> 'form-control', 'required' => 'required', 'id'=> 'datepicker1'])
                      }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.country_departure1'))->for('travel_report_country') }}
                      {{
                        Form::select('country_departure', ['' => 'Select country'] + $country_arr, $report->country_departure, ['class' => 'form-control', 'required' => 'required', 'id'=> 'country_departure'])
                      }}
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group" id="country_destination_div">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.country_destination1'))->for('travel_report_country') }}
                      @php
                      $selected_country = explode(',', $report->country_destination)
                      @endphp
                      {{
                        Form::select('country_destination[]',  $country_arr, $selected_country, ['class' => 'form-control', 'required' => 'required', 'id'=> 'country_destination', 'multiple'=> 'multiple'])
                      }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.no_of_participants'))->for('total_travel_time') }}

                      {{
                        Form::number('no_of_participants', $report->no_of_participants, ['class'=> 'form-control', 'id'=> 'no_of_participants', 'required'=> 'required'])
                      }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group senti-list">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.security_option')) }}

                      <div class="row">
                        <div class="col-md-3">
                          <div class="input-sec">
                            <input type="radio" name="security_option" value="private" class="security_option" @if($report->security_option=='private') checked @endif>
                            Private
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="input-sec">
                            <input type="radio" name="security_option"  value="public" class="security_option" @if($report->security_option=='public') checked @endif>Public
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="input-sec" id="divReserved" Reserved="{{ $travel_report_reserved }}">
                            <input type="radio" name="security_option" value="reserved" onclick="report_reserved(this)" class="security_option1"  @if($report->security_option=='reserved') checked @endif>
                            Reserved
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.extended_descriptive_text'))->for('extended_descriptive') }}

                      {{ Form::textarea('report_description', $report->description, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.travel_report.extended_descriptive_text'), 'required' => 'required', 'max-length' => '1000']) }}
                    </div>
                  </div>
                </div>

                @if(Auth::user()->role_type=='travel_agency')
                  <div class="row">
                    {{-- <div class="col-md-6">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.agency_logo'))->for('agency_logo') }}
                          @if(!empty($report->agency_logo))
                            {{
                              html()->file('agency_logo')->class('form-control')->attribute('accept','image/*')->autofocus()
                            }}
                              <img src="{{ url('/img/frontend/travel_report/agency_logo/'.$report->agency_logo) }}" class="img-responsive" style="max-width: 100px" />
                          @else
                            {{
                              html()->file('agency_logo')->class('form-control')->attribute('accept','image/*')->required()->autofocus()
                            }}
                          @endif
                      </div>
                    </div> --}}
                    @if(!empty($userdata->agency_logo))
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.agency_logo'))->for('agency_logo') }}
                        <img src="{{ url('/img/frontend/user/'.$userdata->agency_logo) }}" class="img-responsive" style="max-width: 100px" />
                      </div>
                    </div>
                    @endif

                    <div class="col-md-12">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.agency_context'))->for('agency_context') }}

                        {{ Form::textarea('agency_context', $report->agency_context, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.travel_report.agency_context')]) }}
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row">
                    <div class="col-md-12">
                      <div class="form-group senti-list" id="link_rows">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.links'))->for('links') }}

                          @if(!empty($report->links))
                            @php
                              $links = explode(',', $report->links)
                            @endphp
                            @foreach($links as $key => $link)
                              @if(!empty($link))
                              <div class="row link_row"  id="link_row_{{ $key+1 }}" @if($key > 0) style="margin-top:15px;" @endif>
                                <div class="col-md-11" style="float:left">
                                  {{ Form::text('links[]', $link, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.travel_report.links')]) }}
                                </div>
                                <div class="col-md-1" style="float:left">
                                  @if($key == 0)
                                    <a onclick="add_social_link(this)" class="btn btn-sm add-icon" data-id = "{{ count($links) }}"><i class="fa fa-plus" title="Add New link"></i></a>
                                  @else
                                    <a onclick="remove_social_link(//= //$key+1)" class="btn btn-sm add-icon"><i class="fa fa-minus" title="Remove link"></i></a>
                                  @endif
                                </div>
                              </div>
                              @endif
                            @endforeach
                          @else
                          <div class="col-md-11" style="float:left">
                            {{ Form::text('links[]', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.travel_report.links')]) }}
                          </div>
                          <div class="col-md-1" style="float:left">
                            <a onclick="linkclick(this)" class="btn btn-sm add-icon"><i class="fa fa-plus" title="Add New Image Row"></i></a>
                          </div>
                          @endif
                      </div>
                    </div>
                  </div> --}}
                <?php $totalKeys=count($report->components);?>
                <input type="hidden" name="report_option" value="report">
                <div class="row">
                    <div class="col-md-11"><label>Cost Summary</label></div>
                    <div class="col-md-1 ">
                      <a class="add_cost_button" href="javascript:void(0)" data-id="{{$totalKeys}}">+</a>
                    </div>
                </div>

                <div id="data_grid_row" class="data_grid_show" numberOfCompoment="{{count($report->components)}}">
                    @forelse($report->components as $key => $component)

                      <div class="row cost_summary_row" id="cost_summary_row{{ ($key+1) }}" style="background-color: #FFF8DC;margin-top:20px">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Select Costs type</label>
                            {{
                              Form::select('component_name[]',  $carrierg_arr, $component->component_name, ['class' => 'form-control', 'required' => 'required', 'id'=> 'vector_'.($key+1), 'onchange' => 'load_sub_vector(this)'])
                            }}

                            <input type="hidden" name="component_id[]" value="{{ $component->id }}" id="component_id_{{($key+1)}}"/>
                          </div>
                        </div>
                        @php
                          $sub_components = get_sub_vectors($component->component_name);
                          $style="display:block;";
                        @endphp

                        <?php
                           if(empty($sub_components)) {
                              $style="display:none;";
                           }
                        ?>
                        <div class="col-md-4 travellerSub" style="{{$style}}">
                          <div class="form-group">

                            <label>Select Sub Costs Type</label>
                            {{
                            Form::select('sub_component_name[]',  $sub_components, $component->sub_component_id, ['class' => 'form-control', 'id'=> 'sub_vector_'.($key+1)])
                            }}
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                          <label>Individual Costs</label>
                          {{ Form::number('individual_cost[]', $component->individual_cost, ['class'=>'form-control i_cost', 'id' => 'total_cost_1'.($key+1), 'onBlur' => 'calculate_i_cost()']) }}
                          </div>
                        </div>

                        {{-- <div class="col-md-3">
                          <div class="form-group">
                            <label>Travel Pro</label>
                            {{
                              Form::select('travel_pro[]', $travel_pro, $component->travel_pro, ['class' => 'form-control', 'id' => 'travel_pro_'.($key+1)])
                            }}
                          </div>
                        </div> --}}
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Triplannerr Travel PRO</label>
                            {{
                              Form::select('travel_pro[]', $travel_pro->prepend('Select Travel Pro', ''), $component->travel_pro, ['class' => 'form-control', 'id' => 'travel_pro_'.($key+1)])
                            }}
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Travel PRO Name</label>
                            <input type="text" class="form-control" name="travel_pro_name[{{$key}}][]" id="travel_pro_name_{{$key+1}}" value="{{$component->travel_pro_name}}">
                            {{-- {{ Form::text('travel_pro_name[0][]', $component->travel_pro_name, ['class'=>'form-control', 'id' => 'travel_pro_name_1'.($key+1)]) }} --}}
                          </div>
                        </div>

                        <div class="col-md-1" style="margin-top: 42px">
                          @if($key != 0)
                            <a href="javascript:void(0)" class="remove_cost_button" onclick="remove_this_container(<?= ($key+1) ?>)"> - </a>
                          @endif
                        </div>
                        <div class="col-md-1" style="margin-top: 42px"><a class="add_cost_button" href="javascript:void(0)" data-id="{{$key+1}}">+</a></div>
                      </div>
                    @empty

                    @endforelse
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->for('total_cost_of_trip') }}

                      {{ html()->number('total_cost_of_trip')->class('form-control')->placeholder(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->attribute('maxlength', 191)->value($report->travel_cost)->required()->autofocus() }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.currency'))->for('currency') }}

                      {{ Form::select('currency_id', $currency_arr, $report->currency_id, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
                </div>


                  <div class="row">
                     @php
                       if($report->birth_place){
                       $birth_date=date("m/d/Y", strtotime($report->birth_place));
                       }
                      @endphp
                    <div class="col-md-4">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.pro_offer'))->for('cost_individual_component') }}
                     {{ Form::select('offer', $agency_option, $report->travel_offer, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Age of the Participants in the Trip</label>
                        <select name="birth_place" class="form-control">
                          <option value="">Select age</option>
                          <option value="1" {{$report->birth_place == 1 ? 'selected' : ''}}>18-25</option>
                          <option value="2" {{$report->birth_place == 2 ? 'selected' : ''}}>26-35</option>
                          <option value="3" {{$report->birth_place == 3 ? 'selected' : ''}}>36-45</option>
                          <option value="4" {{$report->birth_place == 4 ? 'selected' : ''}}>46-55</option>
                          <option value="5" {{$report->birth_place == 5 ? 'selected' : ''}}>56-65</option>
                          <option value="6" {{$report->birth_place == 6 ? 'selected' : ''}}>OVER 65</option>
                        </select>
                       </div>
                    </div>

                   {{-- <div class="col-md-4">
                    <div class="form-group" id="travel_pro_div">
                      {{
                        html()->label(__('validation.attributes.frontend.travel_report.select_travel_pro'))->for('select_travel_pro')
                      }}
                      @php
                      $selected_cats = explode(',', $report->travel_pro);
                      @endphp
                      {{
                        Form::select('pro_travel[]', $travelpro_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_pro', 'multiple'=>'multiple'])
                      }}
                    </div>
                  </div> --}}
                 </div>


                @endif
                <?php $totalKeys=count($report->components);?>

                @if(Auth::user()->role_type=='travel_maker')

                <div class="row">
                  <div class="col-md-11"><label>Cost Summary</label></div>
                  <div class="col-md-1 ">
                    <a class="add_cost_button" href="javascript:void(0)" data-id="{{$totalKeys}}">+</a>
                  </div>
                </div>

                <div id="data_grid_row" class="data_grid_show" numberOfCompoment="{{count($report->components)}}">
                    @forelse($report->components as $key => $component)
                      <div class="row cost_summary_row" id="cost_summary_row{{ ($key+1) }}" style="background-color: #FFF8DC;margin-top:20px">
                        <div class="col-md-3 travellerSub">
                          <div class="form-group">
                            <label>Select Costs type</label>
                            {{
                              Form::select('component_name[]',  $carrierg_arr, $component->component_name, ['class' => 'form-control', 'required' => 'required', 'id'=> 'vector_'.($key+1), 'onchange' => 'load_sub_vector(this)'])
                            }}

                            <input type="hidden" name="component_id[]" value="{{ $component->id }}" id="component_id_{{($key+1)}}"/>
                          </div>
                        </div>
                         @php
                            $sub_components = get_sub_vectors($component->component_name);
                            $style="display:block;";
                          @endphp
                          <?php
                             if(empty($sub_components)) {
                                $style="display:none;";
                             }
                          ?>
                        <div class="col-md-4 travellerSub" style="{{$style}}">
                          <div class="form-group">
                            <label>Select Sub Costs Type</label>
                            {{
                            Form::select('sub_component_name[]',  $sub_components, $component->sub_component_id, ['class' => 'form-control', 'id'=> 'sub_vector_'.($key+1)])
                            }}
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                          <label>Individual Costs</label>
                            {{ Form::number('individual_cost[]', $component->individual_cost, ['class'=>'form-control i_cost', 'id' => 'total_cost_1'.($key+1), 'onBlur' => 'calculate_i_cost()']) }}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Triplannerr Travel PRO</label>
                            {{
                              Form::select('travel_pro[]', $travel_pro->prepend('Select Travel Pro', ''), $component->travel_pro, ['class' => 'form-control', 'id' => 'travel_pro_'.($key+1)])
                            }}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Travel PRO Name</label>
                            <input type="text" class="form-control" name="travel_pro_name[{{$key}}][]" id="travel_pro_name_{{$key+1}}" value="{{$component->travel_pro_name}}">
                            {{-- {{ Form::text('travel_pro_name[0][]', $component->travel_pro_name, ['class'=>'form-control', 'id' => 'travel_pro_name_1'.($key+1)]) }} --}}
                          </div>
                        </div>
                        <div class="col-md-1" style="margin-top: 42px">
                          @if($key != 0)
                            <a href="javascript:void(0)" class="remove_cost_button" onclick="remove_this_container(<?= ($key+1) ?>)"> - </a>
                          @endif
                        </div>
                        <div class="col-md-1" style="margin-top: 42px"><a class="add_cost_button" href="javascript:void(0)" data-id="{{$key+1}}">+</a></div>
                      </div>
                    @empty

                    @endforelse
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->for('total_cost_of_trip') }}

                      {{ html()->number('total_cost_of_trip')->class('form-control')->placeholder(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->attribute('maxlength', 191)->value($report->travel_cost)->required()->autofocus() }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.currency'))->for('currency') }}

                      {{ Form::select('currency_id', $currency_arr, $report->currency_id, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group senti-list">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.option')) }}
                        <div class="row">
                          <div class="col-md-3">
                            <div class="input-sec">
                              <input type="radio" name="report_option" value="report" @if($report->report_option=='report') checked @endif>
                              Travel Report
                            </div>
                          </div>
                          {{-- <div class="col-md-3">
                            <div class="input-sec">
                              <input type="radio" name="report_option" value="diary" @if($report->report_option=='diary') checked @endif>
                              Travel Report with Diary
                            </div>
                          </div> --}}
                          <div class="col-md-3">
                            <div class="input-sec">
                              <input type="radio" name="report_option" value="offer" @if($report->report_option=='offer') checked @endif>
                              Travel Report with Travel Offert
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row" >
           <!--        <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.pro_offer'))->for('cost_individual_component') }}
                     {{ Form::select('offer', $agency_option, $report->travel_offer, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
 -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Age of the Participants in the Trip</label>
                      <select name="birth_place" class="form-control">
                        <option value="">Select age</option>
                        <option value="1" {{$report->birth_place == 1 ? 'selected' : ''}}>18-25</option>
                        <option value="2" {{$report->birth_place == 2 ? 'selected' : ''}}>26-35</option>
                        <option value="3" {{$report->birth_place == 3 ? 'selected' : ''}}>36-45</option>
                        <option value="4" {{$report->birth_place == 4 ? 'selected' : ''}}>46-55</option>
                        <option value="5" {{$report->birth_place == 5 ? 'selected' : ''}}>56-65</option>
                        <option value="6" {{$report->birth_place == 6 ? 'selected' : ''}}>OVER 65</option>
                      </select>
                     </div>
                  </div>

                  {{-- <div class="col-md-6">
                    <div class="form-group" id="travel_pro_div">
                      {{
                        html()->label(__('validation.attributes.frontend.travel_report.select_travel_pro'))->for('select_travel_pro')
                      }}
                      @php
                      $selected_cats = explode(',', $report->travel_pro);
                      @endphp
                      {{
                        Form::select('pro_travel[]', $travelpro_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_pro', 'multiple'=>'multiple'])
                      }}
                    </div>
                  </div> --}}
                 </div>
                @endif
                @if(Auth::user()->role_type =='traveler')
                <input type="hidden" name="report_option" value="report">
                <div class="row">
                    <div class="col-md-11"><label>Cost Summary</label></div>
                    <div class="col-md-1 ">
                      <a class="add_cost_button" href="javascript:void(0)" data-id="{{$totalKeys}}">+</a>
                    </div>
                </div>

                <div id="data_grid_row" class="data_grid_show" numberOfCompoment="{{count($report->components)}}">
                    @forelse($report->components as $key => $component)
                      <div class="row cost_summary_row" id="cost_summary_row{{ ($key+1) }}" style="background-color: #FFF8DC;margin-top:20px">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Select Costs type</label>
                            {{
                              Form::select('component_name[]',  $carrierg_arr, $component->component_name, ['class' => 'form-control', 'required' => 'required', 'id'=> 'vector_'.($key+1), 'onchange' => 'load_sub_vector(this)'])
                            }}

                            <input type="hidden" name="component_id[]" value="{{ $component->id }}" id="component_id_{{($key+1)}}"/>
                          </div>
                        </div>
                        @php
                          $sub_components = get_sub_vectors($component->component_name);
                          $style="display:block;";
                        @endphp
                        <?php
                           if(empty($sub_components)) {
                              $style="display:none;";
                           }
                        ?>
                        <div class="col-md-4 travellerSub" style="{{$style}}">
                          <div class="form-group">
                            <label>Select Sub Costs Type</label>
                            {{
                            Form::select('sub_component_name[]',  $sub_components, $component->sub_component_id, ['class' => 'form-control', 'id'=> 'sub_vector_'.($key+1)])
                            }}

                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                          <label>Individual Costs</label>
                          {{ Form::number('individual_cost[]', $component->individual_cost, ['class'=>'form-control i_cost', 'id' => 'total_cost_1'.($key+1), 'onBlur' => 'calculate_i_cost()']) }}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Triplannerr Travel PRO</label>
                            {{
                              Form::select('travel_pro[]', $travel_pro->prepend('Select Travel Pro', ''), $component->travel_pro, ['class' => 'form-control', 'id' => 'travel_pro_'.($key+1)])
                            }}
                          </div>
                        </div>
                        
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Travel PRO Name</label>
                            <input type="text" class="form-control" name="travel_pro_name[{{$key}}][]" id="travel_pro_name_{{$key+1}}" value="{{$component->travel_pro_name}}">
                            {{-- {{ Form::text('travel_pro_name[0][]', $component->travel_pro_name, ['class'=>'form-control', 'id' => 'travel_pro_name_1'.($key+1)]) }} --}}
                          </div>
                        </div>

                        <div class="col-md-1" style="margin-top: 42px">
                         @if($key != 0)
                          <a href="javascript:void(0)" class="remove_cost_button" onclick="remove_this_container(<?= ($key+1) ?>)"> - </a>
                         @endif
                        </div>
                        <div class="col-md-1" style="margin-top: 42px"><a class="add_cost_button" href="javascript:void(0)" data-id="{{$key+1}}">+</a></div>
                      </div>
                    @empty

                    @endforelse
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->for('total_cost_of_trip') }}

                      {{ html()->number('total_cost_of_trip')->class('form-control')->placeholder(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->attribute('maxlength', 191)->value($report->travel_cost)->required()->autofocus() }}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.currency'))->for('currency') }}

                      {{ Form::select('currency_id', $currency_arr, $report->currency_id, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
                </div>

                 <div class="row">
                   <!--  <div class="col-md-12">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.pro_offer'))->for('cost_individual_component') }}
                       </div>
                    </div>
                  </div> -->
                </div>
                <div id="offergrid_row">
                    <div class="row" >
                      <!-- <div class="col-md-6">
                        <div class="form-group">
                          {{ html()->label(__('validation.attributes.frontend.travel_report.pro_offer'))->for('cost_individual_component') }}
                          {{ Form::select('offer', $agency_option, $report->travel_offer, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                        </div>
                      </div> -->

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Age of the Participants in the Trip</label>
                          <select name="birth_place" class="form-control">
                            <option value="">Select age</option>
                            <option value="1" {{$report->birth_place == 1 ? 'selected' : ''}}>18-25</option>
                            <option value="2" {{$report->birth_place == 2 ? 'selected' : ''}}>26-35</option>
                            <option value="3" {{$report->birth_place == 3 ? 'selected' : ''}}>36-45</option>
                            <option value="4" {{$report->birth_place == 4 ? 'selected' : ''}}>46-55</option>
                            <option value="5" {{$report->birth_place == 5 ? 'selected' : ''}}>56-65</option>
                            <option value="6" {{$report->birth_place == 6 ? 'selected' : ''}}>OVER 65</option>
                          </select>
                        </div>
                      </div>

                      {{-- <div class="col-md-6">
                        <div class="form-group" id="travel_pro_div">
                          {{
                            html()->label(__('validation.attributes.frontend.travel_report.select_travel_pro'))->for('select_travel_pro')
                          }}
                          @php
                          $selected_cats = explode(',', $report->travel_pro);
                          @endphp
                          {{
                            Form::select('pro_travel[]', $travelpro_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_pro', 'multiple'=>'multiple'])
                          }}
                        </div>
                      </div> --}}

                    </div>
                  </div>
                @endif

                @if(Auth::user()->role_type =='travel_blogger')
                <input type="hidden" name="report_option" value="report">
                <div class="row">
                  <div class="col-md-11"><label>Cost Summary</label></div>
                  <div class="col-md-1 ">
                      <a class="add_cost_button" href="javascript:void(0)" data-id="{{$totalKeys}}">+</a>
                    </div>
                </div>

                <div id="data_grid_row" class="data_grid_show" numberOfCompoment="{{count($report->components)}}">
                    @forelse($report->components as $key => $component)
                      <div class="row cost_summary_row" id="cost_summary_row{{ ($key+1) }}" style="background-color: #FFF8DC;margin-top:20px">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Select Costs type</label>
                            {{
                              Form::select('component_name[]',  $carrierg_arr, $component->component_name, ['class' => 'form-control', 'required' => 'required', 'id'=> 'vector_'.($key+1), 'onchange' => 'load_sub_vector(this)'])
                            }}

                            <input type="hidden" name="component_id[]" value="{{ $component->id }}" id="component_id_{{($key+1)}}"/>
                          </div>
                        </div>
                        @php
                            $sub_components = get_sub_vectors($component->component_name);
                            $style="display:block;";
                        @endphp
                        <?php
                           if(empty($sub_components)) {
                              $style="display:none;";
                           }
                        ?>
                        <div class="col-md-4 travellerSub" style="{{$style}}">
                          <div class="form-group">

                            <label>Select Sub Costs Type</label>
                            {{
                            Form::select('sub_component_name[]',  $sub_components, $component->sub_component_id, ['class' => 'form-control', 'id'=> 'sub_vector_'.($key+1)])
                            }}
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                          <label>Individual Costs</label>
                            {{ Form::number('individual_cost[]', $component->individual_cost, ['class'=>'form-control i_cost', 'id' => 'total_cost_1'.($key+1), 'onBlur' => 'calculate_i_cost()']) }}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Triplannerr Travel PRO</label>
                            {{
                              Form::select('travel_pro[]', $travel_pro->prepend('Select Travel Pro', ''), $component->travel_pro, ['class' => 'form-control', 'id' => 'travel_pro_'.($key+1)])
                            }}
                          </div>
                        </div>
                        
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Travel PRO Name</label>
                            <input type="text" class="form-control" name="travel_pro_name[{{$key}}][]" id="travel_pro_name_{{$key+1}}" value="{{$component->travel_pro_name}}">
                            {{-- {{ Form::text('travel_pro_name[0][]', $component->travel_pro_name, ['class'=>'form-control', 'id' => 'travel_pro_name_1'.($key+1)]) }} --}}
                          </div>
                        </div>
                        <div class="col-md-1" style="margin-top: 42px">
                          @if($key != 0)
                            <a class="remove_cost_button" onclick="remove_this_container(<?= ($key+1) ?>)" style = "color:#fff;"> - </a>
                          @endif
                        </div>
                        <div class="col-md-1" style="margin-top: 42px"><a class="add_cost_button" href="javascript:void(0)" data-id="{{$key+1}}">+</a></div>
                      </div>
                    @empty

                    @endforelse
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->for('total_cost_of_trip') }}

                        {{ html()->number('total_cost_of_trip')->class('form-control')->placeholder(__('validation.attributes.frontend.travel_report.total_cost_of_trip'))->attribute('maxlength', 191)->value($report->travel_cost)->required()->autofocus() }}

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.currency'))->for('currency') }}

                      {{ Form::select('currency_id', $currency_arr, $report->currency_id, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
                </div>

                <div class="row" >
                 <!--  <div class="col-md-6">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.pro_offer'))->for('cost_individual_component') }}
                     {{ Form::select('offer', $agency_option, $report->travel_offer, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                  </div>
 -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Age of the Participants in the Trip</label>
                      <select name="birth_place" class="form-control">
                        <option value="">Select age</option>
                        <option value="1" {{$report->birth_place == 1 ? 'selected' : ''}}>18-25</option>
                        <option value="2" {{$report->birth_place == 2 ? 'selected' : ''}}>26-35</option>
                        <option value="3" {{$report->birth_place == 3 ? 'selected' : ''}}>36-45</option>
                        <option value="4" {{$report->birth_place == 4 ? 'selected' : ''}}>46-55</option>
                        <option value="5" {{$report->birth_place == 5 ? 'selected' : ''}}>56-65</option>
                        <option value="6" {{$report->birth_place == 6 ? 'selected' : ''}}>OVER 65</option>
                      </select>
                    </div>
                  </div>

                  {{-- <div class="col-md-6">
                    <div class="form-group" id="travel_pro_div">
                      {{
                        html()->label(__('validation.attributes.frontend.travel_report.select_travel_pro'))->for('select_travel_pro')
                      }}
                      @php
                      $selected_cats = explode(',', $report->travel_pro);
                      @endphp
                      {{
                        Form::select('pro_travel[]', $travelpro_arr, $selected_cats, ['class' => 'form-control tags box-size', 'required' => 'required', 'id'=> 'travel_pro', 'multiple'=>'multiple'])
                      }}
                    </div>
                  </div> --}}
                </div>

                @endif

                <div id="cover_image_container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.cover_photo_trip'))->for('cover_photo_trip') }}
                        @if(!empty($report->cover_photo))
                          <input class="form-control" type="file" name="cover_photo_trip" id="cover1" accept="image/*" autofocus="" data-id="cover1" data-height="500" data-width="500" data-container="cover_image_container" data-dimension="cover1">
                          <p id="coverErr" class="text-danger coverErr"></p>
                          <img src="{{ url('/img/frontend/travel_report/coverphoto/'.$report->cover_photo) }}" id="blah" style="max-width: 150px;">

                        @else
                          {{
                            html()->file('cover_photo_trip')->class('form-control')->attribute('accept','image/*')->required()->autofocus()
                          }}
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" >
                    {{-- <div class="col-md-3">
                      <div class="form-group">
                        <label>Relationship Status</label>
                        {{
                          html()->select('sentimental_situation', $travel_situation, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->sentimental_situation)

                       }}
                      </div>
                    </div> --}}

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Preferred type of travel</label>
                        {{
                          html()->select('type_of_travel', $travel_type, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->type_of_travel)
                       }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Type of Accommodation</label>
                        {{
                          html()->select('type_of_accommodation', $travel_accommodation, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->type_of_accommodation)
                       }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Vector Type</label>
                        {{
                          html()->select('vector_type', $travel_vector, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->vector_type)
                       }}
                      </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Type of Participants</label>
                        {{
                          html()->select('type_of_participants', $travel_participate, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->type_of_participants)
                       }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Travel Budget</label>
                        {{
                          html()->select('preferred_travel_budget', $travel_budget, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->preferred_travel_budget)
                       }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Type of Formula</label>
                        {{
                          html()->select('preferred_type', $travel_formula, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->preferred_type)
                       }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Favorite Meals</label>
                        {{
                          html()->select('type_of_fav_meals', $travel_favoritemealtype, null)
                           ->class('form-control')
                           ->required()
                           ->value($report->travel_favoritemealtype)
                       }}
                      </div>
                    </div>
                </div>


                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      {{ html()->label(__('Slideshow Image Section'))->for('gallery_image') }}
                      <p style="font-size: 12px; color: red">Image resolution should be minimum 1000x350</p>
                    </div>
                  </div>
                  <div class="col-md-6" style="font-size: 12px;color:red">
                    For best results, we recommend not inserting vertical and horizontal format images together in the same "Slide Show".
                    For the best possible result we recommend that you include only vertical photos or only horizontal photos in the slide show. Do not put both formats in the same "Slide Show".
                    For better viewing on smartphones, we recommend the vertical format.
                    For a better PC view we recommend the horizontal format.
                    The recommended dimensions for the vertical format minimum are: 350x1600 pixels
                    The recommended dimensions for the horizontal format minimum are: 1000x350 pixels
                    By inserting both formats (vertical and horizontal) in the same Slide Show you may have display problems using some Smartphone models.
                    <div>
                       Click this button to quickly resize your photos :
                       <button class="btn btn-primary">
                          <a style="color: white" target="blank" href="https://www.faststone.org/FSResizerDetail.htm">Change size image</a>
                       </button>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <a class="add-gallery-icon" data-id='{{count($report->gallery) + 1}}'>
                          +
                        </a>
                  </div>
                </div>

                <div id="gallery_row_container" class="sorting_in_gallery">
                  @forelse($report->gallery as $g_row => $g_image)
                  <div class="row gallery_row" id="gallery_row_{{ ($g_row + 1) }}">
                    <div class="col-md-3">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_photo'))->for('gallery_photo') }}
                        <input type="hidden" name="gallery_id[]" id="gallery_id_{{ ($g_row+1) }}" value="{{ $g_image->id }}" required="">
                        @if(!empty($g_image->gallery_image))
                          <input class="form-control to_crop" type="file" name="gallery_photo[]" id="gallery_photo_{{($g_row + 1)}}" accept="image/jpg" autofocus="" onchange="find_image_location(this)" data-height="350" data-width="1000" data-container="gallery_row_container" data-dimension="cover" data-id="userdetail_cover_image">

                          <input type="hidden" name="crop_photo[]" id="crop_photo_{{($g_row + 1)}}" value="">

                          <p id="galleryErr" class="text-danger galleryErr"></p>

                          @if(!empty($g_image->gallery_image))
                            <img src="{{ url('/crop_images/'.$g_image->gallery_image) }}" id="gallery_row_container" class="slider_show" style="max-width: 150px;">
                            @else
                            <p></p>
                          @endif

                          <input type="hidden" name="userdetail_cover_image" id="userdetail_cover_image" id="gallery_row_container">

                        @else
                          <input class="form-control to_crop" type="file" name="gallery_photo[]" id="gallery_photo_{{($g_row + 1)}}" accept="image/jpg" autofocus="" onchange="find_image_location(this)" required="required" data-height="350" data-width="1000" data-container="gallery_row_container" data-dimension="cover">

                          <input type="hidden" name="crop_photo[]" id="crop_photo_{{($g_row + 1)}}" value="">

                          <p id="galleryErr" class="text-danger galleryErr"></p>

                          <input type="hidden" name="gallery_photo[]" id="userdetail_cover_image" id="gallery_row_container">
                        @endif
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_caption'))->for('gallery_caption') }}
                        {{ Form::text('gallery_caption[]', $g_image->image_caption, ['class' => 'form-control', 'id' => 'gallery_caption_'.($g_row+1), 'max-length' => 250]) }}
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.location_of_shot'))->for('location_of_shot') }}

                        {{ Form::text('location_of_shot[]', $g_image->image_location, ['class' => 'form-control', 'id' => 'location_of_shot_'.($g_row+1)]) }}
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.sorting_in_gallery'))->for('sorting_in_gallery') }}

                        {{
                          Form::number('sorting_in_gallery[]',$g_image->image_sorting, ['class' => 'form-control', 'id' => 'sorting_in_gallery_1'.($g_row+1), 'readonly'])
                        }}


                        <input type="hidden" name="image_lat[]" id="image_lat_{{($g_row+1)}}" value="{{ $g_image->image_lat }}">
                        <input type="hidden" name="image_long[]" id="image_long_{{($g_row+1)}}" value="{{ $g_image->image_long }}">
                        <input type="hidden" id="res_status_{{($g_row+1)}}" value="0">
                      </div>
                    </div>
                    @if($g_row == 0)
                    <div class="col-md-1">
                      <div class="form-group">
                        <br/><br/>
                       <a class="remove-gallery-icon"  onclick="remove_gallery(<?= ($g_row+1) ?>)">-</a>
                      </div>
                    </div>
                    @else
                    <div class="col-md-1">
                      <div class="form-group">
                        <br/><br/>
                        <a class="remove-gallery-icon" onclick="remove_gallery(<?= ($g_row+1) ?>)">-</a>
                      </div>
                    </div>
                    @endif
                    <div class="col-md-1" style="margin-top: 42px">
                      <a class="add-gallery-icon" data-id='{{count($report->gallery) + 1}}'>
                        +
                      </a>
                    </div>
                  </div>
                  @empty
                  <div class="row gallery_row">
                    <div class="col-md-3">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_photo'))->for('gallery_photo') }}
                        <!-- <input class="form-control to_crop" type="file" name="gallery_photo[]" id="gallery_photo_1" accept="image/*" autofocus="" data-id="gallery_photo_1" data-height="350" data-width="1350" data-container="gallery_photo_1_container" data-dimension="gallery_photo_1">
                        <p id="galleryErr" class="text-danger"></p> -->
                        <input class="form-control to_crop" type="file" name="gallery_photo[]" id="gallery_photo_1" accept="image/jpg" autofocus="" onchange="find_image_location(this)" required="required" data-height="350" data-width="1000" data-container="gallery_row_container" data-dimension="cover" >
                          <p id="galleryErr" class="text-danger galleryErr"></p>
                          <input type="hidden" name="userdetail_cover_image" id="userdetail_cover_image" id="gallery_row_container">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.gallery_caption'))->for('gallery_caption') }}
                        {{ Form::text('gallery_caption[]', null, ['class' => 'form-control', 'id' => 'gallery_caption_1', 'required' => 'required']) }}
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.location_of_shot'))->for('location_of_shot') }}

                        {{ Form::text('location_of_shot[]', null, ['class' => 'form-control', 'id' => 'location_of_shot_1']) }}
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.travel_report.sorting_in_gallery'))->for('sorting_in_gallery') }}

                        {{
                          Form::number('sorting_in_gallery[]',1, ['class' => 'form-control', 'id' => 'sorting_in_gallery_1', 'readonly'])
                        }}

                        <input type="hidden" name="image_lat[]" id="image_lat_1" value="">
                        <input type="hidden" name="image_long[]" id="image_long_1" value="">
                        <input type="hidden" name="crop_photo[]" id="crop_photo_1" value="">
                        <input type="hidden" id="res_status_1" value="0">
                      </div>
                    </div>
                    <!-- <div class="col-md-1">
                      <div class="form-group">
                        <br/><br/>
                        <a class="add-gallery-icon" data-id='1'>
                          +
                        </a>
                      </div>
                    </div> -->
                  </div>
                  @endforelse
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                       <label>Slider Soundtracks</label>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: -37px">
                @foreach($slide_data as $key=>$slide_audio)
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="input-sec">
                        <input class="form-audio" type="radio" name="image_audio" required="required" value="{{$key}}" @if($slide_audio == $report->image_audio) checked @endif> <audio style="padding-top:30px;" controls src="{{url('/audio/backend/',$slide_audio)}}"></audio>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      {{ html()->label(__('validation.attributes.frontend.travel_report.slide_type'))->for('slideshow_with_audio') }}

                      <select class="form-control myselect" id="myselect" name="slider_type" maxlength="191" >
                          <option value="" >select</option>
                          <option value="fade" >fade</option>
                          <option value="backSlide" >backSlide</option>
                          <option value="goDown" >goDown</option>
                          <option value="fadeUp" >fadeUp</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">

                      {{ html()->label(__('validation.attributes.frontend.travel_report.slide_video'))->for('slide_video') }}

                      @php
                          $graphic_type_arr = [''=>'Select Video Type', 'link'=>'Link', 'image'=>'Video'];
                       @endphp
                       <?php if($report->slider_video == ''){
                        $value = '';
                       }else{
                        $value = $report->slider_video_type;
                       } ?>
                      <div class="form-group row">
                          <div class="col-md-10">

                            {{ html()->select('slider_video_type')
                                 ->class('form-control')
                                 ->options($graphic_type_arr)
                                 ->attribute('onchange', 'load_graphic_content(this.value)')
                                 ->value($value)
                             }}
                          </div><!--col-->
                      </div><!--form-group-->

                       <div class="form-group row" id="categ_content_id">
                        @if(!empty($report->slider_video))
                          @if($report->slider_video_type == 'image')
                            <video width="150" height="150" controls style="background-color: #000;"><source src="{{url('video/frontend/travel_report/slidervideo/'.$report->slider_video)}}" type="video/mp4" id="source_id"></video>

                            @else

                            <iframe width="250" height="150" src="{{url('https://www.youtube.com/embed/'.$report->slider_video)}}" id="iframe_id">
                           </iframe>
                          @endif
                        @endif
                       </div><!--form-group-->
                    </div>
                  </div>
                </div>
                <div class="row slider_row">
                  <div id="owl-report-demo" class="owl-carousel owl-theme">

                  </div>
                </div>
                <div  class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1" role="dialog" id="security_option_modal1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" style="height: 500px">
                    <div class="modal-header">
                      <h5 class="modal-title">Choose the users you want to share the Travel Report with</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    <div class="modal-body" id="security_option_modal_body1">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              @if(Auth::user()->role_type =='travel_agency')
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0 clearfix login-fbtn">
                          <!-- {{ Form::button('Update Travel Offert', array('class' => 'more_btn submit btn btn-primary', 'type' => 'button','data-id'=>$id))}} -->

                            {{ form_submit(__('Update Travel Offert'))->class('more_btn')->id('upload')}}
                        </div>
                    </div>
                </div>
                @else
                 <div class="row">
                    <div class="col">
                        <div class="form-group mb-0 clearfix login-fbtn">
                            <!-- {{ Form::button('Update Travel Report', array('class' => 'more_btn submit btn btn-primary', 'type' => 'button','data-id'=>$id))}} -->

                            {{ form_submit(__('Update Travel Report'))->class('more_btn')->id('upload')}}
                        </div>
                    </div>
                </div>
                @endif
              {{ html()->form()->close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@php
  if(!empty(Auth::user())){

       $auth=Auth::user()->id;
   }else{

     $auth='0';
   }
@endphp

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
                <button class="btn btn-success" id="rotateLeft" data-deg="-90">Rotate Left</button>
                <button class="btn btn-success" id="rotateRight" data-deg="90">Rotate Right</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success crop_image" id="myBtn" data-hidden="0" type="button" data-status="">Crop</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- dfhdhg -->
<!-- <script type="text/javascript">
  $(document).ready(function () {

    $("#myBtn").click(function(){
         $('#lat_long_model').modal('show');
    });
});
</script> -->


<!-- fjfkjg -->
<div  class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1" role="dialog" id="security_option_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="security_option_modal_body">

      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary">OK</button>
        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
      </div>
    </div>
  </div>
</div>


<div  class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1" role="dialog" id="lat_long_model" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="latlong_container">
        <div class="form-group">

          <div class="col-sm-8">
           <input type="text" name="location" id="searchTextField">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-8">

            <input type="hidden" id="image_container_id" name="image_container_id">
            <input type="text" name="image_latitude" id="image_latitude" placeholder="Enter latitude">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-8">
            <input type="text" name="image_longitude" id="image_longitude" placeholder="Enter longitude">
          </div>
        </div>

        <div id="map_canvas" style="height: 250px;"></div>
        <div class="form-group">
          <div class="col-sm-8">
            <button type="button" class="btn btn-primary" onclick="save_image_lat_lng()">Save location</button>
          </div>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<?php
   $path = url('/video/frontend/travel_report/slidervideo/');
?>
 <script type="text/javascript">
    $(document).ready(function() {
    $("#myselect").change(function(){
      var content = '';
      var newValue = $(this).val();
      var slider_images = $(".gallery_row").find("input:file");

      $.each(slider_images, function (key, image_file) {
        if (image_file.files && image_file.files[0]) {
          content += '<div class="item"><img src="'+ window.URL.createObjectURL(image_file.files[0]) +'"></div>';
        }
      });
      //alert(vslider_images);

      $('.slider_show').each(function(){
         content += '<div class="item"><img height="550" src="'+ $(this).attr('src') +'"></div>';
      })

     if($('#iframe_id').length > 0 && $('#iframe_id').val() != ''){

        var vslider_images = $("#categ_content_id").find("input:file");
        var vslider_images = document.getElementById("iframe_id").value;
        var uld = vslider_images.split("?v=");
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        var match = vslider_images.match(regExp);

        var geturl= (match&&match[7].length==11)? match[7] : '';

        var url = 'https://www.youtube.com/embed/';

        if(vslider_images){
          content += '<iframe width="1100" height="550" src="'+url+geturl+'">';
        }

      }else{
          $('#iframe_id').each(function(){

          content += '<div class="item"><iframe width="1100" height="550" src="'+ $(this).attr('src') +'"></div>';
       })

      }

      if($('#source_id').length > 0 && $('#source_id').val() != ''){
        var cslider_images = $("#categ_content_id").find("input:file");
        var cslider_images = document.getElementById("source_id").value;
        var currentLocation = '<?php echo $path ?>';
        var file = $('#source_id')[0].files[0];
        var name = file.name;
        var url = currentLocation+'/'+name;
       // alert(url);
        if(cslider_images){
          content += '<video width="1100" height="550" controls style="background-color: #000;"><source src="'+url+'"></video>'
        }

      }else{
         $('#source_id').each(function(){
         content += '<div class="item"><video width="1100" height="550" controls style="background-color: #000;"><source src="'+ $(this).attr('src') +'"></video></div>';
       })
      }

      $('.slider_row').html('<div id="owl-report-demo" class="owl-carousel"></div>');
      $(".owl-carousel").append(content);
      var owl = $("#owl-report-demo");
      owl.owlCarousel({
          navigation : true,
          singleItem : true,
          loop:true,
          autoPlay: 3000,
          autoplayHoverPause: true,
          autoplayTimeout:1000,
          pause: "hover",
          transitionStyle : newValue

      });
      owl.trigger("owl.next");
      $('.owl-theme').show();
    });
  });
    </script>
    <script src="/js/mapInput.js"></script>

@endsection

@push('after-styles')
    {!! script('js/frontend/jquery.min.js') !!}
    <link rel="stylesheet" href="{{ url('css/croppie.css')}}" />
    <style type="text/css">
        .modal-dialog {
            max-width: 80%;
            margin: 1.75rem auto;
        }
        .modal-body{overflow: scroll;}

         .pac-container {
        z-index: 10000 !important;
    }
    .ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front {
      z-index: 1051;
      overflow-y: scroll;
      height: 300px;
    }
    </style>
@endpush

@push('after-scripts')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
<?php

$a = Auth::user()->role_type;
$b = Auth::user()->role_type;

?>

@if($a == 'traveler')
<script>
  CKEDITOR.replace( 'report_description1' );
</script>
@endif
@if($a == 'travel_maker')
<script>
  CKEDITOR.replace( 'report_description1' );
</script>

@endif
@if($a == 'travel_blogger')
<script>
  CKEDITOR.replace( 'report_description' );
</script>

@endif

@if($a == 'travel_agency')
<script>
  CKEDITOR.replace( 'report_description' );
</script>

@endif
<script>
  function save_image_lat_lng(){
    var image_container_id  = $("#image_container_id").val();
    var image_latitude      = $("#image_latitude").val();
    var image_longitude     = $("#image_longitude").val();

    var url = 'https://www.google.com/maps/search/?api=1&query='+image_latitude+','+image_longitude;
    $("#location_of_shot_"+image_container_id).val(url);
    $("#image_lat_"+image_container_id).val(image_latitude);
    $("#image_long_"+image_container_id).val(image_longitude);

    $("#image_container_id").val('');
    $("#image_latitude").val('');
    $("#image_longitude").val('');
    $("#lat_long_model").modal('hide');

  }

// var select=new MSFmultiSelect(
//   document.querySelector('#travel_report_category'),
//   {
//       onChange:function(checked,value,instance){
//         console.log(checked,value,instance);
//       },
//       selectAll:true,
//       appendTo:'#travel_report_category_div',
//   }
// );

// var select=new MSFmultiSelect(
//   document.querySelector('#travel_pro'),
//   {
//       onChange:function(checked,value,instance){
//         console.log(checked,value,instance);
//       },
//       selectAll:true,
//       appendTo:'#travel_pro_div',
//   }
// );

var select1 = new MSFmultiSelect(
  document.querySelector('#country_destination'),
  {
      onChange:function(checked,value,instance){
        console.log(checked,value,instance);
      },
      selectAll:false,
      appendTo:'#country_destination_div',
  }
);
</script>

<script>
  function calculate_i_cost(){
    var total_i_cost = 0;
    $.each( $(".i_cost"), function() {
      total_i_cost += parseInt($(this).val());
    });
    $("#total_cost_of_trip").val(total_i_cost);
  }

  $(document).on('click', '.add_cost_button', function(){
  // $(".add_cost_button").on('click', function(){
    var container_length = $(this).attr('data-id');
    var new_length = parseInt(container_length) + 1;
    $.ajax({
        data:{container_length:container_length, '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/travel_report/get_travel_cost_summary_edit") }}',
        success: function(data){
          $('#data_grid_row').append(data);
          var valNum = parseInt(container_length) + 1;
          $("#travel_pro_"+valNum).change(function(){
            if($(this).val() != ''){
                $('#travel_pro_name_'+valNum).prop('disabled', true);
            }else{
              $('#travel_pro_name_'+valNum).prop('disabled', false);
            }
            
          });


          $('#travel_pro_name_'+valNum).change(function(){
            if($('#travel_pro_name_'+valNum).val() != ''){
              $("#travel_pro_"+valNum).prop('disabled', true);
            }else{
              $("#travel_pro_"+valNum).prop('disabled', false);
            }
          });
          $(".add_cost_button").attr('data-id', new_length);
        },
    });
      value = 0;
      $('.sorting_in_gallery :input[type="number"]').each(function(index){
          value++;
          $(this).val(value);
           // This is the jquery object of the input, do
        });
  });

  // $("#travel_pro_1").change(function(){
  //   if($(this).val() != ''){
  //       $('#travel_pro_name_1').prop('disabled', true);
  //     }else{
  //       $('#travel_pro_name_1').prop('disabled', false);
  //     }
      
  // });


  // $('#travel_pro_name_1').change(function(){
  //   if($('#travel_pro_name_1').val() != ''){
  //     $("#travel_pro_1").prop('disabled', true);
  //   }else{
  //     $("#travel_pro_1").prop('disabled', false);
  //   }
  // });

  var numberOfCompoment = $('#data_grid_row').attr('numberOfCompoment');

  $(":input").change(function(){
    var id = $(this).attr('id');
    for(var j = 1 ; j <= numberOfCompoment; ++j){
      var travel_pro = 'travel_pro_' + j;
      var travel_pro_name = 'travel_pro_name_' + j;
      if(id == travel_pro){
        if($(this).val() != ''){
          $('#travel_pro_name_'+j).prop('disabled', true);
        }else{
          $('#travel_pro_name_'+j).prop('disabled', false);
        }
      }
      if(id == travel_pro_name){
        if($('#travel_pro_name_'+j).val() != ''){
          $("#travel_pro_"+j).prop('disabled', true);
        }else{
          $("#travel_pro_"+j).prop('disabled', false);
        }
      }
    }
  });

  $(document).on('click', '.add-gallery-icon', function(){
  // $(".add-gallery-icon").on('click', function(){
    var container_length = $(this).attr('data-id');
    var new_length = parseInt(container_length) + 1;
    $.ajax({
        data:{container_length:container_length, '_token' : '{{ csrf_token()}}'},
        type:'get',
        url:'{{url("/travel_report/get_image_sections") }}',
        success: function(data){
          $('#gallery_row_container').append(data);
          $(".add-gallery-icon").attr('data-id', new_length);
        value = 0;
        $('.sorting_in_gallery :input[type="number"]').each(function(index){
            value++;
            $(this).val(value);
             // This is the jquery object of the input, do
          });
        },
    });
  });

$(".security_option").on('click', function(){
    var option_value = $(this).val();
    $("#security_option_modal").modal('show');
    if(option_value == 'public'){
      html = 'Visible to all members of the site.';
    }

    else{
      html = 'Only visible to the author';
    }
    $("#security_option_modal_body").html(html);
  });


// $(".security_option1").on('click', function(obj){
//       var id = $(obj).data('id');
//       var user_id = '<?php echo $auth; ?>';
//       var option_value = $(this).val();

//        $.ajaxSetup({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//        });

//        $.ajax({
//               type:'get',
//               url:'{{ url('/reserved_report') }}',
//               data:{userid:user_id},
//               success:function(response){
//               $("#security_option_modal1").modal('show');
//                $("#security_option_modal_body1").empty();
//               if(option_value == 'reserved'){
//                 var result = jQuery.parseJSON(response);
//                 if(response==0){

//                 var html = '';
//                 var html = '<p style="text-align:center"><b>No Data</b></p>';
//                  $("#security_option_modal_body1").html(html);
//                  $('.selected').css({"background": "#005ca9","color": "#fff"});
//                  }else{
//                    $("#security_option_modal1").modal('show');
//                     $("#security_option_modal_body1").empty();
//                     var html = '';


//                     $.each(result, function( index, value ) {
//                         html += '<input type="checkbox" value="'+value.id+'" name="user_id_checked[]:checked" id="check-'+value.id+'"> '+value.title+'<br/>'
//                     });

//                     $.each(result, function( index, value ) {
//                         $("#security_option_modal_body1-"+value.id).prop('checked',true);
//                     });

//                     $("#security_option_modal_body1").html(html);
//                     $('.selected').css({"background": "#fff","color": "#005ca9"});
//                  }
//                }
//              }
//            });

//         $("#security_option_modal_body1").html(html);
//       });

$(".security_option1").on('click', function(obj){
    $("#security_option_modal_body1").empty();
    var html = 'No record found';
    var user_id = '{{ Auth::user()->id }}';
    var option_value = $(this).val();
    var user_role = '{{ Auth::user()->role_type }}';
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });

    $.ajax({
      type:'get',
      url:'{{ url('/reserved_report') }}',
      data:{userid:user_id, user_role:user_role},
      success:function(response){
        if(option_value == 'reserved'){
          var result = JSON.parse(response);
          var html = '';
          if(result != '' || result != undefined){

            var Reserved = $('#divReserved').attr('Reserved');console.log(Reserved);
            
            html = `<input type="text" class="form-group" id="user_id_checked" name="user_id_checked[]" `
            +`value="` + Reserved + `"/>`;

            $("#security_option_modal1").modal('show');
            $("#security_option_modal_body1").html(html);
            
            $('#user_id_checked').tokenfield({
                autocomplete :{
                    source: Object.values(result),
                    delay: 100
                }
            });
          }
        }
      }
    });
  });
</script>

<script>
  function load_sub_vector(obj){
    var html = '<option value="">Select Sub Cost</option>'
    var vector_id = $(obj).val();
    var id = $(obj).attr('id');
    var ids = id.split("_");
    var container_id = ids[(ids.length)-1];
    if(vector_id != ''){
      $.ajax({
          data:{vector_id:vector_id, '_token' : '{{ csrf_token()}}'},
          type:'get',
          url:'{{url("/travel_report/get_sub_vectors") }}',
          success: function(data){
            if(data != ''){
              $("#sub_vector_"+container_id).parents('.travellerSub').show();
              resposne = JSON.parse(data);
              $.each( resposne, function( key, value ) {
                  html += '<option value="'+key+'">'+value+'</option>';
              });
              $("#sub_vector_"+container_id).html(html);
            } else {
              $("#sub_vector_"+container_id).parents('.travellerSub').hide();
            }
          },
      });
    }
    else{
      $("#sub_vector_"+container_id).html(html);
    }
  }

  function remove_this_container(id){
    if(id != ''){
      var vector_id = $("#component_id_"+id).val();
      if(typeof vector_id != 'undefined'){
      $.ajax({
          data:{vector_id:vector_id, '_token' : '{{ csrf_token()}}'},
          type:'get',
          url:'{{url("/travel_report/remove_travel_report_component") }}',
          success: function(data){
            if(data == 1){
              if($("#cost_summary_row"+id).length > 0){
                $("#cost_summary_row"+id).remove();
              }
              var total_i_cost = 0;
              $.each($(".i_cost"), function() {
                total_i_cost += parseInt($(this).val());
              });
               $("#total_cost_of_trip").val(total_i_cost);
            }
          },
      });
    }else{
       if($("#cost_summary_row"+id).length > 0){
          $("#cost_summary_row"+id).remove();
        }
        var total_i_cost = 0;
        $.each($(".i_cost"), function() {
          total_i_cost += parseInt($(this).val());
        });
         $("#total_cost_of_trip").val(total_i_cost);
    }
  }
}

 function remove_gallery(id){
    if(id != ''){
      var gallery_id = $("#gallery_id_"+id).val();
      if(typeof gallery_id != 'undefined'){
          $.ajax({
              data:{gallery_id:gallery_id, '_token' : '{{ csrf_token()}}'},
              type:'get',
              url:'{{url("/travel_report/remove_gallery") }}',
              success: function(data){
                if(data == 1){
                  if($("#gallery_row_"+id).length > 0){
                    $("#gallery_row_"+id).remove();
                  }
                }

                value = 0;
                $('.sorting_in_gallery :input[type="number"]').each(function(index){
                  value++;
                  $(this).val(value);
                   // This is the jquery object of the input, do
                });
              },
          });
         }else{

         if($("#gallery_row_"+id).length > 0){
            $("#gallery_row_"+id).remove();
            // $("#wrap_preview_gallery_"+id).remove();
          }
      }
      value = 0;
      $('.sorting_in_gallery :input[type="number"]').each(function(index){
          value++;
          $(this).val(value);
           // This is the jquery object of the input, do
      });
    }
  }

  function find_image_location(obj)
  {
    var desired_height = $(obj).data('height');
    var desired_width = $(obj).data('width');
    var inputId = $(obj).attr('id');
    var gOldImg = $('#gallery_row_container').attr('src');
    var _URL = window.URL || window.webkitURL;
    var file, img;
    var err = false;
    $('.galleryErr').html('');
    $('#galleryErr').html('');
    if ((file = obj.files[0])) {
        img = new Image();
        img.onload = function() {
            // if (desired_width <= this.width && desired_height <= this.height) {
            //alert(this.width+"--"+this.height);
                var id = $(obj).attr('id');
                var ids = id.split("_");
                var container_id = ids[(ids.length)-1];
                var file_data = $(obj).prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                $.ajax({
                  url: "{{ url('/get_image_location') }}",
                  dataType: 'text',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(php_script_response){
                    var resposne = JSON.parse(php_script_response);
                    if(resposne.status == 1 || resposne.status == 2){
                      var url = 'https://www.google.com/maps/search/?api=1&query='+resposne.lat+','+resposne.lng;
                      //alert(url);
                        $("#location_of_shot_"+container_id).val(url);
                        $("#image_lat_"+container_id).val(resposne.lat);
                        $("#image_long_"+container_id).val(resposne.lng);
                    }
                    else{
                        $("#image_container_id").val(container_id);
                        //$("#lat_long_model").modal('show');
                    }
                    $("#res_status_"+container_id).val(resposne.status);
                  }
                });

            //   } else {
            //   msg="Please enter correct resolution Of image "+desired_width+'x'+desired_height;
            //   $(obj).next('.galleryErr').html(msg);
            //   $(obj).next().next('.galleryErr').html(msg);
            //   $(obj).val('');
            //   err = true;
            //   return;
            // }
        };
        img.src = _URL.createObjectURL(file);
    }
  }

  function add_social_link(obj){
    var link_number = $(obj). data('id');
    if($(".link_row").length < 3 ){
      var html = '<div class="row link_row" style="margin-top: 15px"  id="link_row_'+(link_number+1)+'"><div class="col-md-11" style="float:left"><input class="form-control box-size" placeholder="Website or Social Links" id="link_'+(link_number+1)+'" name="links[]" type="text"></div><div class="col-md-1" style="float:left"><a onclick="remove_social_link('+(link_number+1)+')" class="btn btn-sm add-icon"><i class="fa fa-minus" title="Remove link"></i></a></div></div>';
      $("#link_rows").append(html);
      $(obj).attr('data-id', (link_number+1));
    }
    else{
      alert("You can add max 3 links");
    }
  }

  function remove_social_link(link_number){
      $("#link_row_"+link_number).remove();
  }

  function add_offer_row(obj){
    var offer_row = $(obj).attr('data-id');
    if(offer_row != ''){
      var html = '<div class="row" id="offer_row_'+(offer_row+1)+'"><div class="col-md-5"><div class="form-group"><input type="hidden" name="offer_id[]" value="">';

      html += '{{ Form::select('offer[]', ['' => 'Select offer'] + $agency_option, null, ['class'=> 'form-control', 'required' => 'required']) }}';

      html += '</div></div><div class="col-md-6"><div class="form-group">';

      html += '{{ Form::number('offer_cost[]', null, ['class' => 'form-control', 'required' => 'required'])}}';

       html += '</div></div><div class="col-md-1"><div class="form-group"><a onclick="remove_offer_row('+(offer_row+1)+')" class="btn btn-sm add-icon" data-id="1"><i class="fa fa-minus" title="Remove offer row"></i></a></div></div></div>';
      $("#offergrid_row").append(html);
    }
  }

  function remove_offer_row(id){
    if(id != ''){
      if($("#offer_row_"+id).length != -1){
        $("#offer_row_"+id).remove();
      }
    }
  }

</script>

 <script src="{{ url('js/croppie.js')}}"></script>
    <script type="text/javascript">
    var $image_crop = '';
    var cOldImg = $('#gallery_row_container').attr('src');
    var cgOldImg = $('#cover_image_container').attr('src');
    var containerId = 1;
    $(document).on('change','.to_crop', function(){
        inputId = $(this).attr('id');
        containerId = $(this).attr('containerId');
        $that = this;
        var isErr = true;
        $("#image_demo").html('');
        var desired_height = $(this).data('height');
        var desired_width = $(this).data('width');
        var dimensions = $(this).data('dimension');
        var input_id = $(this).attr('id');
        var ids = input_id.split("_");
        var container_id = ids[(ids.length)-1];
        var hiddenId = 'crop_photo_'+input_id.replace('gallery_photo_','');
        var image_container = $(this).data('container');
        var _URL = window.URL || window.webkitURL;
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                // alert(this.width+"--"+this.height);
                // if (desired_width <= this.width && desired_height <= this.height) {
                    isErr = false;
                    $('#galleryErr').html('');
                    $('#coverErr').html('');
                    if(dimensions == 'cover'){
                        vanilla = $('#image_demo').croppie({
                              enableExif: true,
                              enableResize: true,
                              viewport: {
                                  width:desired_width,
                                  height:desired_height,
                                  type:'square' //circle

                              },
                              boundary:{
                                  width:(desired_width+50),
                                  height:(desired_height + 50)
                              },
                              enableOrientation: true,
                              enableExif: true,
                          });
                        }
                    // } else {
                    //     msg="Image resolution should be minimum "+desired_width+'x'+desired_height;
                    //     if(inputId == 'cover' && cOldImg){
                    //         $('#gallery_row_container').attr('src',cOldImg);

                    //     }

                    //     if(inputId == 'cover1' && cgOldImg){
                    //         $('#cover_image_container').attr('src',cgOldImg);

                    //     }
                    //     if(inputId == 'cover'){
                    //         $('#galleryErr').html(msg);
                    //         $('#cover').val('');
                    //     }
                    //     if(inputId == 'cover1'){
                    //         $('#coverErr').html(msg);
                    //         $('#cover1').val('');
                    //     }
                    //     return;
                    // }
            };
            img.src = _URL.createObjectURL(file);
        }
        setTimeout(function(){
            if(typeof vanilla !== 'string' && isErr === false){
                var reader = new FileReader();
                reader.onload = function (event) {
                    vanilla.croppie('bind', {
                        url: event.target.result
                    }).then(function(){

                    });
                }
                reader.readAsDataURL($that.files[0]);
                $("#preview-container-id").val(container_id);
                $("#image_container").val(image_container);
                $('#uploadimageModal').find('button.crop_image').attr('data-hidden',hiddenId);
                $('#uploadimageModal').find('button.crop_image').data('hidden',hiddenId);
                $('#uploadimageModal').modal('show');
            }
        },500);
    });
    $(document).on('click','.crop_image', function(event){
        var hiddenVal = $(this).data('hidden');
        vanilla.croppie('result', {
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
                    if(response.status == 200){
                      $('#preview_gallery_'+containerId).attr('src', response.image_url);
                        //$('#'+$("#preview-container-id").val()).val(response.image);
                        if($('#'+hiddenVal).length) {
                            $('#'+hiddenVal).val(response.image);
                        }
                        $('#uploadimageModal').modal('hide');
                        $('#'+$("#image_container").val()).attr('src', response.image_url);
                        var container_id=hiddenVal.replace("crop_photo_","");
                        setTimeout(function(){
                            var resStatus=$("#res_status_"+container_id).val();
                            //alert(resStatus);
                            if(resStatus=='' || resStatus==0) {
                                alert("Your image has no geo information please enter location latitude longitude manually.");
                                $("#lat_long_model").modal('show');
                            }
                        },500);
                    }
                }
            });
        });
    });

    $("#rotateLeft").click(function() {
      vanilla.croppie('rotate', parseInt($(this).data('deg')));
    });

    $("#rotateRight").click(function() {
      vanilla.croppie('rotate', parseInt($(this).data('deg')));
    });


    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#cover1").change(function() {
    readURL(this);
  });

</script>
@push('after-styles')
<script type="text/javascript" src="{{ url('/js/MSFmultiSelect.js') }}"></script>
<script type="text/javascript" src="{{ url('/css/MSFmultiSelect.css') }}"></script>

<link rel="stylesheet" href="{{url('css/frontend/carousel.css')}}">
<link rel="stylesheet" href="{{url('css/frontend/theme.css')}}">
<script src="http://www.landmarkmlp.com/js-plugin/owl.carousel/assets/js/jquery-1.9.1.min.js"></script>
<script src="{{url('js/frontend/owl.carousel.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<style>
   #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
</style>
<script>
  function load_graphic_content(content_value){

    //alert(videoUpload);
    if(content_value == 'link'){
       $('#categ_content_id').html('<div class="col-md-10"><input class="form-control" type="text" name="slider_video" placeholder="Add Link" maxlength="191" id="iframe_id"><p style="color:#ada5a5;">example : https://www.youtube.com/watch?v=tkzwXX53qQ8</p></div>');
    }
    else if(content_value == 'image'){
      $('#categ_content_id').html('<div class="col-md-10"><input type="file" name="slider_video" id="source_id" accept="video/*"> <p>(mp4 format)</p></div>');
    }
    else{
      $('#categ_content_id').html('');
    }
 }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0MTBvY8lI0_2G7vCCgzJttxo5I_qx94c&libraries=places"></script>

<script>
    window.onload=function(){
        var map;
        var location_lat  = '51.11253853708109';
        var location_long  = "10.476520950000008";
        function initialize()
        {
          var imgicon = '';
          var myLatlng = new google.maps.LatLng(location_lat, location_long);
          var infowindow = new google.maps.InfoWindow();
          var myOptions = {
                zoom: 6,
                mapTypeId: 'roadmap',
                center: myLatlng
          };
          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
          var marker = new google.maps.Marker({
                draggable: true,
                position: myLatlng,
                icon:imgicon,
                map: map,
                title: "Your location"
          });
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);

          google.maps.event.addListener(autocomplete, 'place_changed', function (event) {

                //infowindow.close();
                var place = autocomplete.getPlace();
                console.log(place);
                if (typeof place.geometry.viewport != 'undefined') {
                map.fitBounds(place.geometry.viewport);
                } else {
                map.setCenter(place.geometry.location);
                map.setZoom(6);
                }
                var myLatlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                var myOptions = {
                  zoom: 6,
                  mapTypeId: 'roadmap',
                  center: myLatlng
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                var marker = new google.maps.Marker({
                  draggable: true,
                  position: myLatlng,
                  icon:imgicon,
                  map: map,
                  title: "Your location"
                });

                $('#image_latitude').val(place.geometry.location.lat());
                $('#image_longitude').val(place.geometry.location.lng());

                var geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(marker, 'dragend', function (event)
                {
                  document.getElementById("image_latitude").value = event.latLng.lat();
                  document.getElementById("image_longitude").value = event.latLng.lng();
                  geocoder.geocode({
                        'latLng': event.latLng
                  }, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                              infowindow.setContent(results[0].formatted_address);
                              infowindow.open(map, marker);
                              document.getElementById("searchTextField").value = results[0].formatted_address;
                              $("#searchTextField").val(results[0].formatted_address);
                        }
                      }
                  });
                });

          });
          google.maps.event.addListener(map, 'click', function (event) {
            $('#image_latitude').val(event.latLng.lat());
            $('#image_longitude').val(event.latLng.lng());
            //infowindow.close();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
             "latLng":event.latLng
            }, function (results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
               var lat = results[0].geometry.location.lat(),
                   lng = results[0].geometry.location.lng(),
                   placeName = results[0].address_components[0].long_name,
                   latlng = new google.maps.LatLng(lat, lng);
                  moveMarker(placeName, latlng);
                  infowindow.setContent(results[0].formatted_address);
                  infowindow.open(map, marker);
               $("#searchTextField").val(results[0].formatted_address);
             }
            });
          });
          var geocoder = new google.maps.Geocoder();
          google.maps.event.addListener(marker, 'dragend', function (event)
          {
            document.getElementById("image_latitude").value = event.latLng.lat();
            document.getElementById("image_longitude").value = event.latLng.lng();
            geocoder.geocode({
              'latLng': event.latLng
            }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                  infowindow.setContent(results[0].formatted_address);
                  infowindow.open(map, marker);
                  document.getElementById("searchTextField").value = results[0].formatted_address;
                }
              }
            });
          });
        }
      google.maps.event.addDomListener(window, "load", initialize());
    }
</script>

@endpush
<style type="text/css">
  #msf_multiselect_1 {
    width: 100%;
  }
  .msf_multiselect_container textarea {
    width: 100% !important;
    height: 45px !important;
    border: 1px solid #ddd;
    padding: 10px;
    overflow-y: auto;
  }
  .msf_multiselect {
    position: absolute;
    background: #fff;
    box-shadow: 0 0 5px #ddd;
    width: 100% !important;
    max-width: 95%;
    overflow-y: scroll;
    height: 250px;
    padding: 10px 20px;
    z-index: 9;
  }

  .msf_multiselect li {
    display: inline-block;
    font-size: 13px;
  }
  .msf_multiselect li input {
    margin-right: 10px;
  }
  .add_cost_button {
    color: #FFF;
    background: #005cba;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }
  .add_cost_button:hover {
    color: #005cba;
    background: #FFF;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }

  .remove_cost_button {
    color: #FFF;
    background: #005cba;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }
  .remove_cost_button:hover {
    color: #005cba;
    background: #FFF;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }

  .add-gallery-icon {
    color: #FFF !important;
    background: #005cba;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }
  .add-gallery-icon:hover {
    color: #005cba !important;
    background: #FFF;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }

  .remove-gallery-icon {
    color: #FFF !important;
    background: #005cba;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }
  .remove-gallery-icon:hover {
    color: #005cba !important;
    background: #FFF;
    padding: 5px 10px;
    font-size: 18px;
    font-weight: 700;
  }

  a.add-gallery-icon {
    cursor: pointer;
 }

  a.remove-gallery-icon {
    cursor: pointer;
 }
</style>

<script type="text/javascript">
  $(document).on('keyup','#iframe_id',function(){
    var matches = $(this).val().match(/https:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
    //alert(matches);
  if (matches) {

  } else {
      alert('Invalid');
  }
  });

</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
$( function() {

    //call the function on page load
  $( "#datepicker" ).datepicker();
    //set the date format here
    $( "#datepicker" ).datepicker("option" , "dateFormat", "dd-mm-yy");

    // you also can use
    // yy-mm-dd
    // d M, y
    // d MM, y
    // DD, d MM, yy
    // &apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy (With text - 'day' d 'of' MM 'in the year' yy)
  } );

$( function() {
    //call the function on page load
  $( "#datepicker1" ).datepicker();
    //set the date format here
    $( "#datepicker1" ).datepicker("option" , "dateFormat", "dd-mm-yy");

    // you also can use
    // yy-mm-dd
    // d M, y
    // d MM, y
    // DD, d MM, yy
    // &apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy (With text - 'day' d 'of' MM 'in the year' yy)
  });

$( function() {
  $('#datepicker').val('<?=$startDate?>');
  $('#datepicker1').val('<?=$endDate?>');
  $('#datepicker2').val('<?=$age?>');
    //call the function on page load
  $( "#datepicker2" ).datepicker();
    //set the date format here
    $( "#datepicker2" ).datepicker("option" , "dateFormat", "dd-mm-yy");

    // you also can use
    // yy-mm-dd
    // d M, y
    // d MM, y
    // DD, d MM, yy
    // &apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy (With text - 'day' d 'of' MM 'in the year' yy)
  });


const input = document.getElementById('source_id');
const video = document.getElementById('categ_content_id');
const videoSource = document.createElement('source');

input.addEventListener('change', function() {
  const files = this.files || [];

  if (!files.length) return;

  const reader = new FileReader();

  reader.onload = function (e) {
    videoSource.setAttribute('src', e.target.result);
    video.appendChild(videoSource);
    video.load();
    video.play();
  };

  reader.onprogress = function (e) {
    console.log('progress: ', Math.round((e.loaded * 100) / e.total));
  };

  reader.readAsDataURL(files[0]);
});

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
 </script>

@endpush


