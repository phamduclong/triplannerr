<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('labels.backend.access.email_setting.email_setting')</a>
            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.emailsettings') }}"> @lang('labels.backend.access.email_setting.all')</a>
				<a class="dropdown-item" href="{{ route('admin.emailsettings.create') }}"> @lang('labels.backend.access.email_setting.create')</a>
                <a class="dropdown-item" href="{{ route('admin.emailsettings.deleted') }}">@lang('menus.backend.access.email_setting.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
