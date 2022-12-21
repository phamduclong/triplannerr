<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('labels.backend.access.travelcateg.travelcategs')</a>
            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.travelcateg') }}"> @lang('labels.backend.access.travelcateg.travelcategs')</a>
				<a class="dropdown-item" href="{{ route('admin.travelcateg.add') }}"> @lang('labels.backend.access.travelcateg.create-travel')</a>
                <a class="dropdown-item" href="{{ route('admin.travelcateg.deleted') }}"> @lang('labels.backend.access.travelcateg.deleted')</a>

            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
