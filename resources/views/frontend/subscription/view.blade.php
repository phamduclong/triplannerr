@extends('frontend.layouts.travelmaker')
@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

@include('frontend.includes.travelmaker.home_slider')
<style>
.service-box{
margin: 15px auto 80px;
padding: 0 78px;
/*height: 440px;*/
height: auto;

text-align: center;
}
.pattern_img h2 {
font-size: 25px;
color: #005ca9;
margin: 15px auto;
}
.pattern_img h4 {
font-size: 25px;
color: #005ca9;
margin: 15px auto;
}
</style>

<div class="login-section login_option">
  <div class="container">
    <ul class="nav nav-tabs pkg-tabs">
        @forelse($plan_months as $key => $month)
            <li class="nav-item">
                <a class="nav-link {{ ($key == 0) ? 'active' : '' }}" data-toggle="tab" href="#tab_{{ $month->id }}">{{ $month->name }}</a>
            </li>
        @empty

        @endforelse
      <!-- <li class="nav-item">
        <a class="nav-link active" id="monthly" data-toggle="tab" href="#tab1">Monthly</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="half-yearly" data-toggle="tab" href="#tab2">Half-Yearly</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="yearly" data-toggle="tab" href="#tab3">Yearly</a>
      </li> -->
    </ul>
    <div class="tab-content">
    @forelse($plan_months as $key => $month)
      <div id="tab_{{$month->id}}" class="tab-pane fade show {{ ($key == 0) ? 'active' : '' }}"  role="tabpanel" aria-labelledby="home-tab">
            <div class="row"> <?php //echo $ids;?>
              @forelse($plandata as $key1 => $plan)
                    @if($month->no_of_month != 1 && $plan->plan_type == 'free')
                        @continue
                    @endif
                    @if($month->no_of_month == 1)
                      <div class="col-md-4 pd5">
                        <div class="boarding_effect">
                        @else
                             <div class="col-md-4 pd5">
                                <div class="boarding_effect">
                                     @endif
                                      <div class="pattern_img">
                                        <h2>{{$plan->name}}</h2>
                                        <hr/>
                                        <h4>
                                           @if($month->no_of_month == 1)
                                            <span class="fst-price">
                                                {{ ($plan->plan_type != 'free') ? $plan->amount.' $' : 'Free' }}
                                            </span>
                                             @else
                                                <span>
                                                    <strike>
                                                        {{ 
                                                            ($plan->amount * $month->no_of_month)
                                                        }}
                                                        
                                                    </strike>
                                                </span>
                                                <span> 
                                                    {{ 
                                                        ($plan->amount - ($plan->amount * $month->discount /100 )) * $month->no_of_month
                                                    }} 
                                                    $
                                                </span>
                                                @endif
                                              </h4>
                                          </div>
                                          <div class="service-box">
                                            @foreach($plan_features as $value)
                                            <p>{{$value->feature_name}}</p>
                                              @endforeach
                                          </div>
                               <!--  @php
                                echo $userid = $ids;
                                @endphp; -->
                              <div class="pkg-btn-div">
                                <a href="{{ url('purchase-plan/'.encrypt_decrypt('encrypt', $plan->id).'/'.slugify($plan->name).'/'.$userid)}}" class="btn user_login gr-btn">Select</a>
                              </div>
                            </div>
                          </div>
              @endforeach
            </div>    
        </div>
        @empty

        @endforelse      
    </div>
  </div>
</div>
@endsection



