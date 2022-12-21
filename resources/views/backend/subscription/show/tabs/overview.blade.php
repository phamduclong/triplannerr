<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.user_name')</th>
                <td> @if(!empty($user->user_id)){{ getUserdata($user->user_id) }}@endif</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.plan_name')</th>
                <td>{{ $user->plan_name }}</td>
                
            </tr>

            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.plan_amount')</th>
                <td>{{ $user->plan_amount }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.quantity')</th>
               <td>{{ $user->quantity }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.invoice_id')</th>
                <td>{{ $user->invoice_id }}</td>
                
            </tr>

            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.invoice_description')</th>
                <td>{{ $user->invoice_description }}</td>
                
            </tr>

            <tr>
                <th>@lang('labels.backend.access.subscription.tabs.content.overview.payment_status')</th>
                <td>{{ $user->payment_status }}</td>
                
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
