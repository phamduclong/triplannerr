@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

    @include('frontend.includes.travelmaker.home_slider')

    <section class="main-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills travel_tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home"><img src="{{ url('/img/frontend/alert.png')}}">Alert</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu1"><img src="{{ url('/img/frontend/super.png')}}">Super</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div id="home" class="container tab-pane active"><br>
                <div class="row">

                @forelse($tours as $tour_row)
                  <div class="col-md-3">
                    <div class="travel_site">
                      <img src="{{ url('img/backend/tour/banner').'/'.$tour_row->banner }}">
                      <div class="site_text">
                        <h4>{{ $tour_row->title }}</h4>
                        <p>{!! $tour_row->description !!}</p>
                        <span>{{ date('M d, Y', strtotime($tour_row->created_at)) }}</span>
                      </div>
                      <hr>
                      <div class="site_bottom">
                        <h4>$ {{ $tour_row->rate }}</h4>
                        <a href="#"><img src="{{ url('img/frontend/arrow-right.png') }}"></a>
                      </div>
                    </div>
                  </div>

               @empty

               @endforelse

                </div>
                <!--<button class="btn more_btn">More Reports</button>-->
              </div>


              <div id="menu1" class="container tab-pane fade"><br>
                <div class="row">
               @forelse($tours as $tour_row)
                  <div class="col-md-4">
                    <div class="travel_site">
                      <img src="{{ url('img/backend/tour/banner').'/'.$tour_row->banner }}">
                      <div class="site_text">
                        <h4>{{ $tour_row->title }}</h4>
                        <p>{!! $tour_row->description !!}</p>
                        <span>{{ date('M d, Y', strtotime($tour_row->created_at)) }}</span>
                      </div>
                      <hr>
                      <div class="site_bottom">
                        <h4>$ {{ $tour_row->rate }}</h4>
                        <a href="#"><img src="{{ url('img/frontend/arrow-right.png') }}"></a>
                      </div>
                    </div>
                  </div>

               @empty

               @endforelse

                </div>
                <button class="btn more_btn">More Reports</button>
              </div>
            </div>
          </div>

          <!--<div class="col-md-3">
            <div class="ads_section">
              <a href="#"><img src="{{-- url('img/frontend/ads1.png') --}}"></a>
              <a href="#"><img src="{{-- url('img/frontend/ads2.png') --}}"></a>
              <a href="#"><img src="{{-- url('img/frontend/ads2.png') --}}"></a>
            </div>
          </div>-->

        </div>

      </div>
    </section>

@endsection
