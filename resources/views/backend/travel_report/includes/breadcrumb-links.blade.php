<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.travel_report.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.travel_report') }}">@lang('menus.backend.access.travel_report.all')</a>
                
               <!--  <a class="dropdown-item" href="{{ route('admin.travel_report.create') }}">@lang('menus.backend.access.travel_report.create')</a> -->
                <a class="dropdown-item" href="{{ route('admin.travel_report.deactivated') }}">@lang('menus.backend.access.travel_report.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.travel_report.deleted') }}">@lang('menus.backend.access.travel_report.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
