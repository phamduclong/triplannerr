@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.email_settings.management'))

@section('breadcrumb-links')
    @include('backend.emailsettings.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.jqueryui.min.js"></script>
<div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-5">
          <h4 class="card-title mb-0">
            {{ __('labels.backend.access.email_setting.management') }}<small class="text-muted">{{ __('labels.backend.access.email_setting.deleted') }}</small>
          </h4>
        </div><!--col-->

       <div class="col-sm-7">
          @include('backend.emailsettings.includes.header-buttons')
      </div><!--col-->
      </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.email_setting.table.id')</th>
                           <th>@lang('labels.backend.access.email_setting.table.type')</th>
                           <th>@lang('labels.backend.access.email_setting.table.subject')</th>
                           <th>@lang('labels.backend.access.email_setting.table.content')</th>
                           <!-- <th>@lang('labels.backend.access.email_setting.table.sent_to')</th>
                           <th>@lang('labels.backend.access.email_setting.table.sent_from')</th> -->
                           <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                         <tbody>
                        <?php $i=1 ?>
                           @foreach($emailsettings as $user)
                              <tr>
                                <td>{{ $i}}</td>
                            
                                <td>{{ isset( $user ) ? $user->type  : '' }}</td>
                                <td>{{ isset( $user ) ? $user->subject : '' }}</td>
                                <td>{{ isset( $user ) ? $user->content : '' }}</td>
                                <td class="btn-td"> <a href="{{ route('admin.emailsettings.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.email_setting.restore_user')"  data-trans-title="@lang('buttons.backend.access.email_setting.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.email_setting.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.email_setting.confirm')">
                                  <i class="fas fa-sync"></i>
                                  </a>
                                  </td>
                               
                               </tr>
                              <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                  {{$emailsettings->total()}} Found Record
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   {{$emailsettings->render()}} 
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->


@endsection
@push('after-scripts')


<script>
$(document).ready( function () {
    $('#example').DataTable({

"lengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, "All"]]
    });
});
</script>