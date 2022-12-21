<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.plan_privilege.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.plan_privilege') }}">@lang('menus.backend.access.plan_privilege.all')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_privilege.create') }}">@lang('menus.backend.access.plan_privilege.create')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_privilege.deactivated') }}">@lang('menus.backend.access.plan_privilege.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_privilege.deleted') }}">@lang('menus.backend.access.plan_privilege.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
