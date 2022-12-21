<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>@lang('labels.frontend.user.profile.profile_image')</th>
           <!--  <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" /></td> -->
           @if(!empty($user_data->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$user_data->profile_image)) )
               <td> 
              <img src="{{url('img/frontend/user/profile/'.$user_data->profile_image)}}" class="img-responsive" width="100" height="100">
             </td>
              @else
              <td> 
              <img src="{!! URL::to('img/frontend/demo.png') !!}">
             </td>
           @endif
             
       
       
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->created_at) }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->updated_at) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>
