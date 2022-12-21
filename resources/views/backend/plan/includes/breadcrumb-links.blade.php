<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.plan.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.plan') }}">@lang('menus.backend.access.plan.all')</a>
                <a class="dropdown-item" href="{{ route('admin.plan.create') }}">@lang('menus.backend.access.plan.create')</a>
                <a class="dropdown-item" href="{{ route('admin.plan.deactivated') }}">@lang('menus.backend.access.plan.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.plan.deleted') }}">@lang('menus.backend.access.plan.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
