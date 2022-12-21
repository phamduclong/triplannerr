<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.plan.user_actions')">
       
     <a href="{{ route('admin.plan_month.edit', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('admin.plan_month.deleted_data', $user) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.plan_month.deleted')">
        <i class="fas fa-trash"></i>
    </a>
</div>
   
