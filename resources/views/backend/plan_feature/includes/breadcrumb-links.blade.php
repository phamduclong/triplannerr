<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.plan_feature.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.plan_feature') }}">@lang('menus.backend.access.plan_feature.all')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_feature.create') }}">@lang('menus.backend.access.plan_feature.create')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_feature.deactivated') }}">@lang('menus.backend.access.plan_feature.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.plan_feature.deleted') }}">@lang('menus.backend.access.plan_feature.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
