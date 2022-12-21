<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.profile_image')</th>
                <td>
                   @if(!empty($data->profile_image) && file_exists(public_path('/img/frontend/user/profile'.'/'.$data->profile_image)))
                      <img src="{{url('/img/frontend/user/profile/'.$data->profile_image)}}" class="img-responsive" style="height: 100px; width: 100px;">
                   @else
                      <img src="{!! URL::to('img/frontend/demo.png') !!}">
                   @endif 
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.cover_image')</th>
                <td>
                  @if(!empty($data->cover_image) && file_exists(public_path('/img/frontend/user/cover'.'/'.$data->cover_image)))
                    <img src="{{url('/img/frontend/user/cover/'.$data->cover_image)}}" class="img-responsive" style="height: 100px; width: 400px;">
                 @else
                   <img src="{!! URL::to('img/frontend/demo.png') !!}">
                 @endif 
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.profile_badge')</th>
                <td>
                    @if(!empty($data->profile_badge) && file_exists(public_path('/img/frontend/user/cover'.'/'.$data->profile_badge)))
                      <img src="{{url('/img/frontend/user/cover/'.$data->profile_badge)}}" class="img-responsive" style="height: 100px; width: 100px;">
                  @else
                    <img src="{!! URL::to('img/frontend/demo.png') !!}">
                  @endif 
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.describe_yourself')</th>
                <td>{{ isset( $data ) ? $data->describe_yourself  : '' }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
