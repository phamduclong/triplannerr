

<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.advertisements.user_actions')">
    @if(empty($report_type) || $report_type=='all')

	 <a href="{{url('view/travel_report', convertoToSlug($travel_report->title))}}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
         <i class="fas fa-eye"></i>
     </a>

     <a href="{{url('edit/travel_report',convertoToSlug($travel_report->title))}}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{url('delete/travel_report',convertoToSlug($travel_report->title))}}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" onclick="return myFunction();">
        <i class="fas fa-trash"></i>
    </a>
    <a href="javascript:void(0)"  class="btn btn-success" data-url="{{ route('frontend.user.list_participate', $travel_report->id) }}" id="list-par" data-toggle="tooltip" data-placement="top" title="Show the list of users who have requested information">
        <i class="fa fa-user-circle"></i>
    </a>
    <script>
	  function myFunction() {
	      if(!confirm("Are You Sure to delete this"))
	      event.preventDefault();
	  }
	</script>

    @endif



</div>


