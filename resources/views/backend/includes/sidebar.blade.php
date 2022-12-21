<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>  
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{
                    active_class(Route::is('admin/user_level_request'))
                }}" href="{{ route('admin.user_level_request') }}">
                  <i class="nav-icon fa fa-paper-plane" aria-hidden="true"></i> 
                 @lang('menus.backend.sidebar.user_level_request')
                    </a>
                </li>

                
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/travel_carriers'), 'open')
                 }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/travel_carriers'))
                    }}" href="#">
                        <i class="nav-icon far fa-file"></i> @lang('menus.backend.sidebar.master')
                    </a>

                    <ul class="nav-dropdown-items">
                        <!-- <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/plan'))
                        }}" href="{{ route('admin.plan') }}">
                            @lang('menus.backend.sidebar.plan')
                            </a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/plan_feature'))
                        }}" href="{{ route('admin.plan_feature') }}">
                              @lang('menus.backend.sidebar.plan_feature')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/plan_privilege'))
                        }}" href="{{ route('admin.plan_privilege') }}">
                              @lang('menus.backend.sidebar.plan_privilege')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{active_class(Route::is('admin/plan_month'))
                        }}" href="{{ route('admin.plan_month') }}">
                              @lang('menus.backend.sidebar.plan_month')
                            </a>
                        </li> -->


                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/travelcateg'))
                        }}" href="{{ route('admin.travelcateg') }}">
                             @lang('menus.backend.travel-categ.dashboard')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/travel_vectors'))
                        }}" href="{{ route('admin.travel_vectors') }}">
                        {{__('Costs Type Management')}}
                                <!-- {{__('Travel Vectors')}} -->
                            </a> 
                        </li>
                        {{-- 
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/tour_carriers'))
                        }}" href="{{ route('admin.tour_carriers') }}">
                                @lang('menus.backend.sidebar.tour_carriers')
                            </a> 
                        </li>
                        --}}

                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/travel_report'))
                        }}" href="{{ route('admin.travel_report') }}">
                             @lang('menus.backend.sidebar.travel_report')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/slider_audio'))
                        }}" href="{{ route('admin.slider_audio') }}">
                             @lang('menus.backend.sidebar.slider_audio')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/book_information'))
                        }}" href="{{ route('admin.book_information') }}">
                             @lang('menus.backend.sidebar.book_information')
                            </a>
                        </li>
                    </ul>
                </li>
            
                <li class="divider"></li>
             
                <li class="nav-item">
                    <a class="nav-link {{
                    active_class(Route::is('admin/subscription'))
                }}" href="{{ route('admin.subscription') }}">
                        <i class="nav-icon fa fa-newspaper-o" aria-hidden="true"></i> 
                        @lang('menus.backend.sidebar.subscription')
                    </a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link {{
                    active_class(Route::is('admin/advertisements'))
                }}" href="{{ route('admin.advertisements') }}">
                        <i class="nav-icon fa fa-newspaper-o" aria-hidden="true"></i> 
                        @lang('menus.backend.sidebar.advertisements')
                    </a>
                </li>

                <li class="divider"></li>
               <!--  <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/advertisements'), 'open')
                 }}">
                    <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/advertisements'))
                        }}" href="#">
                        <i class="nav-icon fa fa-newspaper-o" aria-hidden="true"></i>@lang('menus.backend.sidebar.advertisements')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/advertisements'))
                        }}" href="{{ route('admin.advertisements') }}">
                            @lang('menus.backend.sidebar.create_ads')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/ads_details'))
                        }}" href="{{ route('admin.ads_details') }}">
                            @lang('menus.backend.sidebar.ads_details')
                            </a>
                        </li>
                    </ul>
                </li>
 -->
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/advertisements'), 'open')
                 }}">
                    <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/advertisements'))
                        }}" href="#">
                        <i class="nav-icon fa fa-cog" aria-hidden="true"></i>@lang('menus.backend.sidebar.settings')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/staticpage'))
                                   }}" href="{{ route('admin.staticpage') }}">
                                <i class="nav-icon fa fa-file-text" aria-hidden="true"></i> 
                               @lang('menus.backend.static-page.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/social_settings/add'))
                                   }}" href="{{ route('admin.social_settings.add') }}">
                                <i class="nav-icon fa fa-cogs" aria-hidden="true"></i> 
                               @lang('menus.backend.social_settings.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/emailsettings'))
                                   }}" href="{{ route('admin.emailsettings') }}">
                                <i class="nav-icon fa fa-cogs" aria-hidden="true"></i> 
                               @lang('menus.backend.emailsettings.dashboard')
                            </a>
                        </li>
                    </ul>
                </li>

              

                {{-- <li class="nav-item">
                    <a class="nav-link {{
                    active_class(Route::is('admin/feedback'))
                }}" href="{{ route('admin.feedback') }}">
                        <i class="nav-icon fa fa-comments-o" aria-hidden="true"></i> 
                        @lang('menus.backend.sidebar.feedback')
                    </a>
                </li> --}}

            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
