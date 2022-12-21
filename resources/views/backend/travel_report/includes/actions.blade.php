<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.travel_report.user_actions')">
     
     <a href="{{route('admin.travel_report_trip_page', $user)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.travel_report.same_trip')" style="background-color: #168394; border-color: #168394; " >
        <i class="fas fa-plane" ></i>
    </a>

     <a href="{{ route('admin.travel_report.edit', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>

    <a href="{{ route('admin.travel_report.deleted_data', $user) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.travel_report.deleted')">
        <i class="fas fa-trash"></i>
    </a>

   <!--  <a class="btn btn-warning" data-toggle="modal" onclick="showmodel(<?php echo $user->user_id ?>)" data-placement="top" title="@lang('buttons.backend.access.travel_report.warning')">
        <i class="fas fa-warning"></i>
    </a>  
 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <center> <b>Hi, User </b></center>
        <form  method="post" action="{{ route('admin.travel_report.warning') }}">
          {{csrf_field()}}
	        <div class="modal-body">
	           <textarea name="warning_massage" class="form-control"></textarea>
             <input type="hidden" name="warning_id" id="warning_id">
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	         <button type="submit" class="btn btn-primary">Send Warning</button>
	        </div>
    	</form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function showmodel(id){
    $('#warning_id').val(id);
    $('#myModal').modal('show');
  }
</script>
   
