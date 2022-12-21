
<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.advertisements.main')</a>
             <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.advertisements') }}">@lang('menus.backend.access.advertisements.all')</a>
                <a class="dropdown-item" href="{{ route('admin.advertisements.create') }}">@lang('menus.backend.access.advertisements.create')</a>
                <a class="dropdown-item" href="{{ route('admin.advertisements.deactivated') }}">@lang('menus.backend.access.advertisements.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.advertisements.deleted') }}">@lang('menus.backend.access.advertisements.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
