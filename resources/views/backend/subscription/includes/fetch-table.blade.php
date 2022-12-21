<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
       <th>@lang('labels.backend.access.subscription.table.id')</th>
       <th>@lang('labels.backend.access.subscription.table.user_name')</th>
       <th>@lang('Email')</th>
       <th>@lang('labels.backend.access.subscription.table.plan')</th>
       <th>@lang('labels.backend.access.subscription.table.plan_amount')</th>
       <th>@lang('labels.backend.access.subscription.table.payment_status')</th>
       <th>Start Date</th>
       <th>End Date</th>
       <th>@lang('labels.general.actions')</th>
     </tr>
    </thead>
    <tbody>
    
       @foreach($subscription_data as $key=> $user)
          <tr>
            <td>{{ $key+1}}</td>
            <td> @if(!empty($user->user_id)){{ getUserdata($user->user_id) }}@endif
           </td>
           <td> @if(!empty($user->user_id)){{ getUserEmail($user->user_id) }}@endif
           </td>
            <td>{{ isset( $user ) ? $user->plan_name : '' }}</td>
            <td>{{ isset( $user ) ? $user->plan_amount : '' }}</td>
            <td>{{ isset( $user ) ? $user->payment_status : '' }}</td>
            <td>{{ !empty( $user->subs_start_date ) ? Carbon\Carbon::parse($user->subs_start_date)->format('Y/m/d') : '' }}</td>
            <td>{{ !empty( $user->subs_end_date ) ? Carbon\Carbon::parse($user->subs_end_date)->format('Y/m/d') : '' }}</td>
            <td class="btn-td">@include('backend.subscription.includes.actions', ['user' => $user])</td>
           </tr>
         
        @endforeach
    </tbody> 
</table>