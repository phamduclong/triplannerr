  <header class="driver-header notranslate">
  <div class="container-fluid">
    <div class="header-menu">
        @php
            if(isset($logged_in_user) && $logged_in_user->role_type) {
                $role_type = $logged_in_user->role_type;
            }
            switch($role_type ?? '') {
                case 'traveler':
                    $logo = 'logo-triplannerr-traveler.png';
                break;
                case 'travel_maker':
                    $logo = 'logo-triplannerr-travel-maker.png';
                break;
                case 'travel_blogger':
                    $logo = 'logo-triplannerr-travel-blogger.png';
                break;
                case 'travel_agency':
                    $logo = 'logo-triplannerr-travel-pro.png';
                break;
                default:
                    $logo = 'logo-triplannerr.png';
                break;
            }
        @endphp
      <!-- @if(isset(Auth::user()->id))
        <div class="left-menu">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('contact') }}">Contact Us</a>
            <a href="{{url('pages/about-us')}}">About Us</a>
            <a href="{{url('pages/discover')}}">Discover</a>
            <a href="{{url('pages/why_travel')}}">Why Travel Maker</a>
            <a href="{{url('pages/policy')}}">Privacy Policy</a>
          </div>
          <span class="menu-icon" onclick="openNav()"><img src="{{ url('img/frontend/menu2.png') }}" ></span>
        </div>
      @endif -->

      <div class="left-menu">
        @if(Auth::check())
          <a href="{{ url('/') }}"><img src="{{ url('img/frontend/'.$logo) }}" ></a>
        @else
          <img id="messageLogin" src="{{ url('img/frontend/logo-triplannerr.png') }}" >
        @endif
      </div>
      <div class="right-menu" id="profile_page">
        <div class="login-btn mobile-hide">
          <ul class="navbar-nav">
            @if(config('locale.status') && count(config('locale.languages')) > 1)
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                  @lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})
                </a>
                @include('includes.partials.lang')
              </li>
            @endif
            @auth

             @if($logged_in_user->role_type=='admin' && Request::path() == '/')
              <li class="nav-item text-button trav_btn raise">
                  <a href="{{route('admin.dashboard',encrypt_decrypt('encrypt',$logged_in_user->id))}}" class="nav-link inner-menu {{ active_class(Route::is('admin.dashboard',$logged_in_user->id))}}">
                    @lang('Dashboard')
                  </a>
                </li>
             @endif

              <?php //@if(Request::path() == '/' && $logged_in_user->role_type!='admin') ?>
                <li class="nav-item text-button trav_btn raise">
                  <a href="/" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',[$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id]))}}">
                    <i class="fas fa-home fa-2x"></i>
                  </a>
                </li>
                <li class="nav-item text-button trav_btn raise">
                  <a href="{{route('frontend.my_profile',[$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id])}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id))}}">
                    <i class="fas fa-user fa-2x"></i>
                  </a>
                </li>
               <?php //@else ?>

              <?php //@endif ?>
            @endauth


            @guest
              @if(Request::path() == 'login' || Request::path() == 'main-login')
                <li class="nav-item" style="display: none">
                  <a href="{{ url('/main-login') }}" class="raise trav_btn">@lang('navs.frontend.login')</a>
                </li>
              @else
                <li class="nav-item">
                  <a href="{{ url('/main-login') }}" class="raise trav_btn">@lang('navs.frontend.login')</a>
                </li>
              @endif

              @if (Request::path() == 'register' || Request::path() == 'main-register')
                <li class="nav-item" style="display: none">
                  <a href="{{ url('/main-register') }}" class="raise trav_btn" style="display: none">@lang('navs.frontend.register')</a>
                </li>
              @else
                @if(config('access.registration') )
                  <li class="nav-item">
                  <a href="{{ url('/main-register') }}" class="raise trav_btn">@lang('navs.frontend.register')</a>
                  </li>
                @endif
              @endif
            @else {{-- Guest else --}}
              <li class="nav-item dropdown text-button trav_btn raise">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog fa-2x"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser" style="position: absolute;
                transform: translate3d(-13px, 36px, 0px);
                top: 2px;
                left: -200px;
                will-change: transform;">
                  @can('view backend')
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                  @endcan

                  <a href="{{ route('frontend.auth.change-password.update') }}" class="dropdown-item {{ active_class(Route::is('frontend.auth.change-password.update')) }}">@lang('navs.frontend.user.change_password')</a>
                  <a href="{{ route('frontend.user.control_panel') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.control_panel')) }}">@lang('navs.frontend.user.control_panel')</a>
                  <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                  {{-- @if($logged_in_user->role_type=='travel_maker')
                  <a href="{{ route('frontend.user.public_card') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.public_card')) }}">@lang('navs.frontend.user.public_card')</a>
                  @endif --}}
                  @if($logged_in_user->role_type=='travel_agency')
                  <a href="{{ route('frontend.user.advertisement') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.advertisement')) }}">@lang('Advertisements')</a>
                  @endif
                  @if($logged_in_user->role_type=='travel_blogger' || $logged_in_user->role_type=='travel_agency')
                    <a href="{{ route('frontend.user.conversations') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.conversations')) }}">@lang('navs.frontend.user.conversations')</a>
                  @endif
                  <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                </div>
              </li>
            @endguest
          </ul>
        </div>


        <div class="login-btn mobile-show">
          <div class="mobile-menu">
            <button type="button" class="btn" data-toggle="collapse" data-target="#menu-btn">
              <i class="fa fa-user"></i>
            </button>
            <div id="menu-btn" class="collapse">
              <ul class="navbar-nav">
                @if(config('locale.status') && count(config('locale.languages')) > 1)
                  <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false">
                      @lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})
                    </a>
                    @include('includes.partials.lang')
                  </li>
                @endif
                @auth
                  @if(Request::path()== '/')
                    <li class="nav-item">
                      <a href="{{route('frontend.user.dashboard')}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.user.dashboard')) }}">
                        @lang('navs.frontend.dashboard')
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{route('frontend.my_profile',[$logged_in_user->role_type,strtolower($logged_in_user->first_name.$logged_in_user->last_name),$logged_in_user->id])}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',[$logged_in_user->role_type,strtolower($logged_in_user->first_name.$logged_in_user->last_name),$logged_in_user->id]))}}">
                        <i class="fas fa-user fa-2x"></i>
                      </a>
                    </li>
                  @else
                    <li class="nav-item">
                      <a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Route::is('frontend.user.dashboard')) }}">
                        @lang('navs.frontend.dashboard')
                      </a>
                    </li>
                    <li class="nav-item">
                      {{-- <a href="{{route('frontend.my_profile',encrypt_decrypt('encrypt',$logged_in_user->id))}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',$logged_in_user->id))}}">
                        <i class="fas fa-user fa-2x"></i>
                      </a> --}}
                      <a href="{{route('frontend.my_profile',[$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id])}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',[$logged_in_user->role_type,strtolower($logged_in_user->first_name.$logged_in_user->last_name),$logged_in_user->id]))}}">
                        <i class="fas fa-user fa-2x"></i>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('frontend.contact')}}" class="nav-link {{ active_class(Route::is('frontend.contact')) }}">
                        @lang('navs.frontend.contact')
                      </a>
                    </li>
                  @endif
                @endauth

                @guest
                  @if(Request::path() == 'login' || Request::path() == 'main-login')
                    <li class="nav-item" style="display: none">
                      <a href="{{ url('/main-login') }}" class="raise trav_btn">@lang('navs.frontend.login')</a>
                    </li>
                  @else
                    <li class="nav-item">
                      <a href="{{ url('/main-login') }}" class="raise trav_btn">@lang('navs.frontend.login')</a>
                    </li>
                  @endif

                  @if (Request::path() == 'register' || Request::path() == 'main-register')
                    <li class="nav-item" style="display: none">
                      <a href="{{ url('/main-register') }}" class="raise trav_btn" style="display: none">
                        @lang('navs.frontend.register')
                      </a>
                    </li>
                  @else
                    @if(config('access.registration') )
                      <li class="nav-item">
                        <a href="{{ url('/main-register') }}" class="raise trav_btn">
                          @lang('navs.frontend.register')
                        </a>
                      </li>
                    @endif
                  @endif
                @else
                  <li class="nav-item dropdown text-button trav_btn raise">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ $logged_in_user->name }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                      @can('view backend')
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                          @lang('navs.frontend.user.administration')
                        </a>
                      @endcan
                      <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.account')) }}">
                        @lang('navs.frontend.user.account')
                      </a>
                      <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">
                        @lang('navs.general.logout')
                      </a>
                    </div>
                  </li>
                @endguest
              </ul>
            </div>
          </div>
        </div>
      </div>

      @if(Auth::check())
        @if(isset($user_id) && Auth::user()->id != $user_id)
          <div>
            <div class="login-btn mobile-hide">
              <ul class="navbar-nav" style="margin-top: -100px !important">
                <li class="nav-item text-button trav_btn raise">
                  <a href="/" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',[$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id]))}}">
                    <i class="fas fa-home fa-2x"></i>
                  </a>
                </li>
                <li class="nav-item text-button trav_btn raise">
                  <a href="{{route('frontend.my_profile',[$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id])}}" class="nav-link inner-menu {{ active_class(Route::is('frontend.my_profile',$logged_in_user->role_type, strtolower($logged_in_user->first_name.$logged_in_user->last_name), $logged_in_user->id))}}">
                    <i class="fas fa-user fa-2x"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        @endif
      @endif
    </div>
  </div>
</header>

<style>
  .login-btn .navbar-nav li .lang-btn {
    padding: 7px 20px !important;
    font-size: 14px !important;
}
</style>

<script>
  $(document).ready(function(){
    $('#messageLogin').click(function(){
      alert('To continue browsing the site you must log in or register');
    });
  });
</script>