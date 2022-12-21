<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('labels.backend.access.book_information.book_information')</a>
            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
            <a class="dropdown-item" href="{{ route('admin.book_information') }}"> @lang('labels.backend.access.book_information.all')</a>
			<a class="dropdown-item" href="{{ route('admin.book_information.getDeactivated_book') }}"> @lang('labels.backend.access.book_information.deactivate')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
  