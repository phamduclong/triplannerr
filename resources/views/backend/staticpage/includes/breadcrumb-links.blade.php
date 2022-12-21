<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('labels.backend.access.staticpage.staticpages')</a>
            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.staticpage') }}"> @lang('labels.backend.access.staticpage.staticpages')</a>
				<a class="dropdown-item" href="{{ route('admin.staticpage.add') }}"> @lang('labels.backend.access.staticpage.create-page')</a>
                <a class="dropdown-item" href="{{ route('admin.staticpage.deleted') }}"> @lang('labels.backend.access.staticpage.deleted')</a>
            </div> 
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group--> 
</li>
