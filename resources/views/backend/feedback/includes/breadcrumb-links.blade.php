<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.feedback.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.feedback') }}">@lang('menus.backend.access.feedback.all')</a>
                <a class="dropdown-item" href="{{ route('admin.feedback.create') }}">@lang('menus.backend.access.feedback.create')</a>
                <a class="dropdown-item" href="{{ route('admin.feedback.deactivated') }}">@lang('menus.backend.access.feedback.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.feedback.deleted') }}">@lang('menus.backend.access.feedback.deleted')</a>
            </div>
        </div><!--dropdown-->
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
