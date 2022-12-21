<div class="booking_section">
    <div class="container-fluid">
        <form id="booking_form" class="booking_form" method="post" action="{{ Route('frontend.filterreport')}}">
            @csrf
            <div class="nav">
                <ul class="nav__list">
                    <li class="nav__menu">
                      <a id="country_a" href="javascript:void(0)" ><?php echo (isset($parameters['country']) && !empty($parameters['country'])) ? $country_arr[$parameters['country']] : 'Country' ?></a>
                      {{ Form::select('country', ['' => 'Country']+$country_arr, $parameters['country'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'country', 'onChange' =>'load_data(this)']) }}
                      <ul class="nav__menu-lists nav__menu--1-lists home_filters">                        
                          @forelse($country_arr  as $key => $value)
                          <li class="nav__menu-items" data-id="{{ $key }}" data-email="country_a" data-select="country">
                              {{ $value }}
                          </li>
                          @empty 

                          @endforelse
                      </ul>
                    </li>
           
                    <li class="nav__menu">
                        <a id="age_a" href="javascript:void(0)" ><?php echo (isset($parameters['age']) && !empty($parameters['age'])) ? $travel_ages[$parameters['age']] : 'Age' ?></a>
                        {{Form::select('age', ['' => 'Age']+$travel_ages, $parameters['age'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'age', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">                       
                            @forelse($travel_ages  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="age_a" data-select="age">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="travel_categ_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_categ']) && !empty($parameters['travel_categ'])) ? $travel_categ[$parameters['travel_categ']] : 'Travel Category' ?></a>
                        {{ Form::select('travel_categ', ['' => 'Travel Category']+$travel_categ, $parameters['travel_categ'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'travel_categ', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_categ  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="travel_categ_a" data-select="travel_categ">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="travel_type_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_type']) && !empty($parameters['travel_type'])) ? $travel_types[$parameters['travel_type']] : 'Travel Type' ?></a>
                        {{ Form::select('travel_type', ['' => 'Travel Type']+$travel_types, $parameters['travel_type'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'travel_type', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_types  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="travel_type_a" data-select="travel_type">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="vector_type_a" href="javascript:void(0)" ><?php echo (isset($parameters['vector_type']) && !empty($parameters['vector_type'])) ? $travel_vectors[$parameters['vector_type']] : 'Vector Type' ?></a>
                        {{ Form::select('vector_type', ['' => 'Vector Type']+$travel_vectors, $parameters['vector_type'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'vector_type', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_vectors  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="vector_type_a" data-select="vector_type">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="type_of_accommodation_a" href="javascript:void(0)" ><?php echo (isset($parameters['type_of_accommodation']) && !empty($parameters['type_of_accommodation'])) ? $travel_accommodations[$parameters['type_of_accommodation']] : 'Type of Accomodation' ?></a>
                        {{ Form::select('type_of_accommodation', ['' => 'Type of Accomodation']+$travel_accommodations, $parameters['travel_accommodations'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'type_of_accommodation', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_accommodations  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="type_of_accommodation_a" data-select="type_of_accommodation">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="type_of_participants_a" href="javascript:void(0)" ><?php echo (isset($parameters['type_of_participants']) && !empty($parameters['type_of_participants'])) ? $travel_participates[$parameters['type_of_participants']] : 'Type of Partecipants' ?></a>
                        {{ Form::select('type_of_participants', ['' => 'Type of Partecipants']+$travel_participates, $parameters['travel_participates'] ?? null, ['class' => 'form-control tags box-size home-select', 'id' => 'type_of_participants', 'onChange' =>'load_data(this)']) }}
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_participates  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="type_of_participants_a" data-select="type_of_participants" style="font-size:10px">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="preferred_type_formula_a" href="javascript:void(0)" ><?php echo (isset($parameters['preferred_type_formula']) && !empty($parameters['preferred_type_formula'])) ? $travel_formula[$parameters['preferred_type_formula']] : 'Preferred Stay Formula' ?></a>
                        <select id="preferred_type_formula" name="preferred_type_formula" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                            <option value="">Preferred Stay Formula</option>
                            @if(@$travel_formula)
                                @foreach($travel_formula as $key_formula=>$pref_type_formula_row)
                                    @if(isset($parameters['preferred_type_formula']) &&  $parameters['preferred_type_formula'] == $key_formula)
                                        <option value="{{$key_formula}}" selected="">
                                    @else
                                        <option value="{{$key_formula}}">
                                    @endif
                                        {{$pref_type_formula_row}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_formula  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_type_formula_a" data-select="preferred_type_formula">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                    <li class="nav__menu">
                        <a id="preferred_travel_budget_a" href="javascript:void(0)" ><?php echo (isset($parameters['preferred_travel_budget']) && !empty($parameters['preferred_travel_budget'])) ? $travel_budget[$parameters['preferred_travel_budget']] : 'Budget' ?></a>
                        <select id="preferred_travel_budget" name="preferred_travel_budget" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                            <option value="">Select Budget</option>
                            @if(@$travel_budget)
                              @foreach($travel_budget as $key => $pref_travel_budget_row)
                                  @if(isset($parameters['preferred_travel_budget']) && $parameters['preferred_travel_budget']  == $key)
                                      <option value="{{$key}}" selected="">
                                  @else
                                      <option value="{{$key}}">
                                  @endif
                                  {{$pref_travel_budget_row}}
                                  </option>
                              @endforeach
                            @endif
                        </select>
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_budget  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_travel_budget_a" data-select="preferred_travel_budget">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>
                    <li class="nav__menu">
                        <a id="preferred_travel_mealtype_a" href="javascript:void(0)" ><?php echo (isset($parameters['travel_favoritemealtype']) && !empty($parameters['travel_favoritemealtype'])) ? $travel_budget[$parameters['travel_favoritemealtype']] : 'Type of favorite Meals' ?></a>
                        <select id="preferred_travel_mealtype" name="preferred_travel_mealtype" onChange = 'load_data(this)' class="form-control tags box-size home-select">
                            <option value="">Select Budget</option>
                            @if(@$travel_mealtype)
                              @foreach($travel_mealtype as $key => $pref_travel_mealtype_row)
                                  @if(isset($parameters['preferred_travel_mealtype']) && $parameters['preferred_travel_mealtype']  == $key)
                                      <option value="{{$key}}" selected="">
                                  @else
                                      <option value="{{$key}}">
                                  @endif
                                  {{$pref_travel_mealtype_row}}
                                  </option>
                              @endforeach
                            @endif
                        </select>
                        <ul class="nav__menu-lists nav__menu--1-lists home_filters">
                            @forelse($travel_mealtype  as $key => $value)
                            <li class="nav__menu-items" data-id="{{ $key }}" data-email="preferred_travel_mealtype_a" data-select="preferred_travel_mealtype">
                                {{ $value }}
                            </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>

                </ul>
                <div class="clear" style="clear: both; height: 0px"></div>
            </div>
            <div class="row">
                <div class="form-group mx-auto">
                    <div class=" col-6 btn_srch form_srch" style="float:left;">
                        <button type="button" name="filter_report_btn" class="btn search_btn form_btn filter_report_btn" id="filter_report_btn">Search</button>
                    </div>
                    <div class=" col-6 btn_srch form_srch"  style="float:left;">   
                        <button type="button" class="btn search_btn form_btn filter_report_btn" style="float:left;" id="reset_btn">Reset</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="row" id="prepand_data">
            <div id='loader' style='display: none;'>
                <img src='{{ url('img/frontend/loader.gif') }}' width="32px" height="32px">
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(".filter_report_btn").on('click', function(){
    //alert(querystring);
    var country = $('#country').val();
    var age = $('#age').val();
    var travel_categ = $('#travel_categ').val();
    var travel_type = $('#travel_type').val();
    var vector_type = $('#vector_type').val();
    var type_of_participants = $('#type_of_participants').val();
    var type_of_accommodation = $('#type_of_accommodation').val();
    var preferred_type_formula = $('#preferred_type_formula').val();
    var preferred_travel_budget = $('#preferred_travel_budget').val();
    var preferred_travel_mealtype = $('#preferred_travel_mealtype').val();
    var querystring = "{{ url('/search-reports') }}?country="+country+"&age="+age+"&travel_categ="+travel_categ+"&travel_type="+travel_type+"&vector_type="+vector_type+"&type_of_participants="+type_of_participants+"&type_of_accommodation="+type_of_accommodation+"&preferred_type_formula="+preferred_type_formula+"&preferred_travel_budget="+preferred_travel_budget+"&preferred_travel_mealtype="+preferred_travel_mealtype

    window.location = querystring;
});

$('#reset_btn').on('click',function(){
    var querystring = "{{url('/')}}"; //alert(querystring);
    window.location = querystring;
    
})
</script>

<script>
    function load_data(obj)
    {
        var id = $(obj).attr('id');
        var text = $( "#"+id+" option:selected" ).text();
        var value = $(obj).val();
        $('#'+id+'_a').html(text);
    }
</script>

<script>
    $(document).ready(function(){
        $(".home_filters li").click(function(){
            var li_text       = $(this).html();
            var li_value      = $(this).data('id');
            var anc_id        = $(this).data('email');
            var select_id     = $(this).data('select');
            $("#"+anc_id).html(li_text);
            $("#"+select_id).val(li_value);
        })
    });
</script>

@endpush