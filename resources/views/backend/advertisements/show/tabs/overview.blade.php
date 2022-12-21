<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.title')</th>
                <td>{{ $user->title }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.description')</th>
                <td class="btn-td">{{ strip_tags($user->description) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.view')</th>
                <td>{{ $user->view }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.location')</th>
                <td>{{ $user->location }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.type')</th>
                <td>{{ $user->type }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.type_file')</th>
                <td>
                   @if($user->type=='image')
                     @if(!empty($user->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$user->type_file)) )
                      <img src="{{url('img/backend/advertisement/'.$user->type_file)}}" style="height: 250px; width: 250px;">
                      @else
                      <img src="{{url('img/frontend/inner-banner.jpg')}}" style="height: 100px; width: 100px;">
                     @endif
                    @endif
                    @if($user->type=='video')
                       @if(!empty($user->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$user->type_file)) )
                        <video width="400" controls>
                        <source src="{{url('img/backend/advertisement/'.$user->type_file)}}" type="video/mp4">
                        </video>
                        @endif
                        <iframe width="400" src=" {{isset($user->embedded_link)?$user->embedded_link:''}}">
                       </iframe>
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.advertisements.tabs.content.overview.ad_url')</th>
                <td>{{ $user->ad_url }}</td>
            </tr>

            <?php $i=1 ?>
               @foreach($ad_data as $ad_click)
                  <tr>
                   <th>@lang('labels.backend.access.advertisements.tabs.content.overview.total_click')</th>
                    <td>{{ get_click_count($ad_click->ad_id) }}</td>
                  </tr>
                <?php $i++ ?>
               @endforeach
        </table>
    </div>
</div><!--table-responsive-->
