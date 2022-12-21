<div class="row cost_summary_row" id="cost_summary_row{{$container_length}}" style="background-color: #FFF8DC;margin-top:30px">
  <div class="row">
    <div class="col-md-11"></div>
    <div class="col-md-1">
      <div class="form-group">
          <a href="javascript:void(0)" class="remove_cost_button" onclick="remove_this_container({{$container_length}})"> - </a>
      </div>
    </div>
  </div>
  
  <div class="row" style="width: 80%">
    <div class="col-md-3">
      <div class="form-group">
        <label>Select Costs Type</label>
        <select class="form-control" name="component_name[]" maxlength="191" required="" id="vector_{{$container_length}}" onchange="load_sub_vector(this)">
        <option value="">Select Costs Type</option>
        @foreach($travel_vectors as $key => $no_of_carriers_row)  
          <option value="{{$key}}">
            {{$no_of_carriers_row}}
          </option>
        @endforeach
        </select>
      </div>
    </div>
  
    <div class="col-md-4 travellerSub">
      <div class="form-group">
        <label>Select Sub Costs Type</label>
        <select class="form-control" name="sub_component_name[]" maxlength="191" id="sub_vector_{{$container_length}}">
  
        
        </select>
      </div>
    </div>
  
    <div class="col-md-3">
      <div class="form-group">
      <label>Individual Costs</label>
      {{ Form::number('individual_cost[]', null, ['class'=>'form-control i_cost', 'id' => 'total_cost_'.$container_length, 'onBlur' => 'calculate_i_cost()']) }}
      </div>
    </div>
  
    <div class="col-md-3">
      <div class="form-group">
        <label>Triplannerr Travel PRO</label>
        {{-- {{
          html()->select('travel_pro[]', $travel_pro->prepend('Select Travel Pro', ''), null)
            ->class('form-control')
            ->required(false)
        }} --}}
        <input type="text" class="form-control select_travel_pro" name="travel_pro[]" id="{{'select_travel_pro_'.$container_length}}" valNumber="{{$container_length}}" hidden>
        <input type="text" class="form-control select_travelpro" id="{{'select_travelpro_'.$container_length}}" valNumber="{{$container_length}}">
  
        <div style="background-color: white;z-index:100;border:1px solid #ced4da" class="list-travel-pro" id="{{'list-travel-pro_'.$container_length}}" valNumber="{{$container_length}}">
          @foreach($travel_pro as $key=>$value)
              <div style="margin-left: 5px" id="{{$key}}" val="{{$value}}">
                {{$value}}
              </div>  
          @endforeach                                                   
        </div>
      </div>
    </div>
  
    <div class="col-md-3">
      <div class="form-group">
        <label>Travel PRO Name</label>
        <input type="text" class="form-control" name="travel_pro_name[{{$container_length-1}}][]" id="travel_pro_name_{{$container_length}}">
      </div>
    </div>
    <div class="col-md-1" style="margin-top:42px"><a class="add_cost_button" href="javascript:void(0)" data-id="{{$container_length}}">+</a></div>
  </div>

  
  {{--   
  <div class="col-md-2">
    <div class="form-group">
    <label>Total Cost</label>
    {{ Form::number('individual_cost[]', null, ['class'=>'form-control', 'id' => 'total_cost_'.$container_length]) }}

    {{ html()->number('total_cost[]')
            ->class('form-control')
            ->required() }}
    </div>
  </div>
  --}}
</div>