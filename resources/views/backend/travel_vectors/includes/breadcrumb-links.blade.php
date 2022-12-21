<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.travel_vectors.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.tour_carriers') }}">@lang('menus.backend.access.travel_vectors.all')</a>
                <a class="dropdown-item" href="{{ route('admin.tour_carriers.create') }}">@lang('menus.backend.access.travel_vectors.create')</a>
                <a class="dropdown-item" href="{{ route('admin.tour_carriers.deactivated') }}">@lang('menus.backend.access.travel_vectors.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.tour_carriers.deleted') }}">@lang('menus.backend.access.travel_vectors.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
