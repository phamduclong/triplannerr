<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.travel_vectors.user_actions')">
       
       
     <a href="{{ route('admin.travel_vectors.edit', $vector) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('admin.travel_vectors.deleted_data', $vector) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.travel_vectors.deleted')">
        <i class="fas fa-trash"></i>
    </a>
</div>
   
