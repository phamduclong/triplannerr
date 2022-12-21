<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.email_setting.user_actions')">
     <a href="{{ route('admin.emailsettings.edit', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('admin.emailsettings.deleted_data', $user) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
        <i class="fas fa-trash"></i>
    </a> 
</div>
   
