<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.user_level_request.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.user_level_request') }}">@lang('menus.backend.access.user_level_request.all')</a>
               <!--  <a class="dropdown-item" href="{{ route('admin.user_level_request.create') }}">@lang('menus.backend.access.user_level_request.create')</a> -->
                <a class="dropdown-item" href="{{ route('admin.user_level_request.pending') }}">@lang('menus.backend.access.user_level_request.pending')</a>
                <a class="dropdown-item" href="{{ route('admin.user_level_request.approved') }}">@lang('menus.backend.access.user_level_request.approved')</a>
                 <a class="dropdown-item" href="{{ route('admin.user_level_request.not_approved') }}">@lang('menus.backend.access.user_level_request.not_approved')</a>
                 <a class="dropdown-item" href="{{ route('admin.user_level_request.cancelled') }}">@lang('menus.backend.access.user_level_request.cancelled')</a>
                <a class="dropdown-item" href="{{ route('admin.user_level_request.deleted') }}">@lang('menus.backend.access.user_level_request.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
