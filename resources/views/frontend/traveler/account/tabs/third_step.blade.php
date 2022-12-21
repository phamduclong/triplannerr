 {{-- @php
    if($user_data->userdetail){
       $explode_data=explode(',',$user_data->userdetail->sentimental_situation);
     }
 @endphp
 <div class="row">
     <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.sentimental_situation'))->for('sentimental_situation') }}
            @foreach($travel_situation as $situation)
               <div class="input-sec">
                <input type="radio" name="sentimental_situation" value="{{$situation}}"@if($user_data->userdetail) @if($user_data->userdetail->sentimental_situation==$situation) checked="" @endif @endif>{{$situation}}
            </div>
            @endforeach
         </div>
      </div>
  </div> --}}
  <div class="row">
      <div class="col">
          <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.preferred_travel_category'))->for('preferred_travel_category') }}
              @php
               if($user_data->userdetail){
                 $explode_preferred_travel_category=explode(',',$user_data->userdetail->preferred_travel_category);
                }
              @endphp
              @foreach($travel_category as $category)
                  <div class="input-sec">
                   <input type="checkbox" name="preferred_travel_category[]" placeholder="validation.attributes.frontend.preferred_travel_category" value="{{$category}}" @if($user_data->userdetail) @if(in_array($category,$explode_preferred_travel_category)) checked="" @endif @endif>{{$category}}
                   </div>
              @endforeach
           </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
      <div class="col">
          <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.preferred_type_of_travel'))->for('preferred_type_of_travel') }}
              @foreach($travel_type as $type)
                 <div class="input-sec">
                   <input type="radio" name="type_of_travel" placeholder="validation.attributes.frontend.preferred_type_of_travel" value="{{$type}}"  @if($user_data->userdetail) @if($user_data->userdetail->type_of_travel==$type) checked=""  @endif @endif>{{$type}}
                 </div>
               @endforeach
           </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
       <div class="col">
          <div class="form-group senti-list">
               {{ html()->label(__('validation.attributes.frontend.preferred_type_of_accommodation'))->for('preferred_type_of_accommodation') }}
          @php
          if($user_data->userdetail){
             $explode_accommodation=explode(',',$user_data->userdetail->type_of_accommodation);
           }
          @endphp
          @foreach($travel_accommodation as $accommodation)
           <div class="input-sec">
              <input type="checkbox" name="type_of_accommodation[]" value="{{$accommodation}}" @if($user_data->userdetail) @if(in_array($accommodation,$explode_accommodation)) checked="" @endif @endif>{{$accommodation}}
          </div>
          @endforeach
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
       <div class="col">
          <div class="form-group senti-list">
               {{ html()->label(__('validation.attributes.frontend.vector_type'))->for('vector_type') }}
          @php
           if($user_data->userdetail){
             $explode_vector_type=explode(',',$user_data->userdetail->vector_type);
            }
          @endphp
          @foreach($travel_vector as $vector)
          <div class="input-sec">
              <input type="checkbox" name="vector_type[]" value="{{$vector}}" @if($user_data->userdetail) @if(in_array($vector,$explode_vector_type)) checked="" @endif @endif>{{$vector}}
          </div>
          @endforeach
          </div><!--form-group-->
        </div><!--col-->
   </div><!--row-->

   <div class="row">
     <div class="col">
        <div class="form-group senti-list">
             {{ html()->label(__('validation.attributes.frontend.type_of_participants'))->for('type_of_participants') }}
        @php
        if(isset($user_data->userdetail)){
           $explode_participants=explode(',',$user_data->userdetail->type_of_participants);
         }
        @endphp
        @foreach($travel_participate as $participate)
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="{{$participate}}" @if($user_data->userdetail) @if(in_array($participate,$explode_participants)) checked="" @endif @endif>{{$participate}}
        </div>
        @endforeach
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_travel_budget'))->for('preferred_travel_budget') }}
            @foreach($travel_budget as $budget)
                <div class="input-sec">
                 <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="{{$budget}}"@if($user_data->userdetail) @if($user_data->userdetail->preferred_travel_budget==$budget) checked=""  @endif @endif>{{$budget}}
                 </div>
            @endforeach
            </div><!--form-group-->
        </div><!--col-->
 </div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_type'))->for('preferred_type') }}
            @foreach($travel_formula as $formula)
              <div class="input-sec">
                 <input type="radio" name="preferred_type" value="{{$formula}}" placeholder="validation.attributes.frontend.preferred_type" @if($user_data->userdetail) @if($user_data->userdetail->preferred_type==$formula) checked=""  @endif @endif>{{$formula}}
              </div>
            @endforeach
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.type_of_fav_meals'))->for('type_of_fav_meals') }}
             @php
            if(isset($user_data->userdetail)){
               $explode_meals=explode(',',$user_data->userdetail->travel_favoritemealtype);
             }
            @endphp
            @foreach($travel_favoritemealtype as $meals)
              <div class="input-sec">
                 <input type="checkbox" name="type_of_fav_meals[]" value="{{$meals}}" @if($user_data->userdetail) @if(in_array($meals,$explode_meals)) checked="" @endif @endif>{{$meals}}
              </div>
            @endforeach
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <ul class="nav nav-tabs"  >
    <li class="nav-item">
        <a class="nav-link" href="#second_step" onClick="changeStep(second_step)"><i class="fa fa-arrow-left"></i> Back</a>
    </li>
    <li class="nav-item ml-auto">
        <div class="form-group mb-0 clearfix">
            {{ form_submit(__('labels.general.buttons.update'))->class('more_btn m-0') }}
        </div>
    </li>
</ul>

<script type="text/javascript">

   $(document).ready(function () {
    $("input[name='preferred_travel_category[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='preferred_travel_category[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});


   $(document).ready(function () {
    $("input[name='type_of_accommodation[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='type_of_accommodation[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

   $(document).ready(function () {
    $("input[name='vector_type[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='vector_type[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

    $(document).ready(function () {
    $("input[name='type_of_participants[]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='type_of_participants[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' Value!!');
        }
    });
});

$(document).ready(function () {
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


