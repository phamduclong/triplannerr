<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.access.slider_audio.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.slider_audio') }}">@lang('menus.backend.access.slider_audio.all')</a>
                <a class="dropdown-item" href="{{ route('admin.slider_audio.create') }}">@lang('menus.backend.access.slider_audio.create')</a>
                <a class="dropdown-item" href="{{ route('admin.slider_audio.deactivated') }}">@lang('menus.backend.access.slider_audio.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.slider_audio.deleted') }}">@lang('menus.backend.access.slider_audio.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
