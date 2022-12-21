<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.advertisements.user_actions')">
	 <a href="{{url('view/travel_report/'.$travel_report->slug)}}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
         <i class="fas fa-eye"></i>
     </a>

     <a href="{{url('edit/travel_report',$travel_report->slug)}}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{url('delete/travel_report',$travel_report->slug)}}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" onclick="return myFunction();">
        <i class="fas fa-trash"></i>
    </a>

    <script>
	  function myFunction() {
	      if(!confirm("Are You Sure to delete this"))
	      event.preventDefault();
	  }
	</script>
</div>
