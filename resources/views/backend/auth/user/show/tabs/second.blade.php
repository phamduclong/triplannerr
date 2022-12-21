<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">

           @if(!empty($data)  && isset($data->role_type) && ($data->role_type=='traveler'))
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.phone_no')</th>
                <td>{{ isset( $data ) ? $data->phone_no  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.birth_place')</th>
                <td>{{date('d-m-Y', strtotime(isset( $data ) ? $data->birth_place  : '')) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sex')</th>
                <td>{{ isset( $data ) ? $data->sex  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.place_of_residence')</th>
                <td>{{ isset( $data ) ? $data->place_of_residence  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation')</th>
                <td>{{ isset( $data ) ? $data->fav_nation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation_want')</th>
                <td>{{ isset( $data ) ? $data->fav_nation_want  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.pdf_doc')</th>
                <td>

                @if(!empty($data->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$data->identity_document)) )
                    <a class="click_btn" href="{{url('uploads/frontend/doc/'.$data->identity_document)}}" target="_blank">Download</a>
                    @else
                      <p>No Document Found</p>
                @endif 
                </td>
            </tr>
            @else
            <p>No data found</p>

            @endif
            @if(!empty($data)  && isset($data->role_type) &&  $data->role_type=='travel_maker')

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.phone_no')</th>
                <td>{{ isset( $data ) ? $data->phone_no  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.birth_place')</th>
                <td>{{date('d-m-Y', strtotime(isset( $data ) ? $data->birth_place  : '')) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sex')</th>
                <td>{{ isset( $data ) ? $data->sex  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.place_of_residence')</th>
                <td>{{ isset( $data ) ? $data->place_of_residence  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation')</th>
                <td>{{ isset( $data ) ? $data->fav_nation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation_want')</th>
                <td>{{ isset( $data ) ? $data->fav_nation_want  : '' }}</td>
            </tr>
              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.classification_travel_report')</th>
                <td>{{ isset( $data ) ? $data->classification_travel_report  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.front_identity_doc')</th>
                <td>
                     @if(!empty($data->front_identity_doc) && file_exists(public_path('/img/frontend/user/cover'.'/'.$data->front_identity_doc)))

                     <a class="click_btn" href="{{url('uploads/frontend/doc/'.$data->front_identity_doc)}}" target="_blank">Download</a>
     
                 @else
                   <p>No Document Found</p>
                 @endif 

                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.back_identity_doc')</th>
                <td>
                    @if(!empty($data->back_identity_doc) && file_exists(public_path('uploads/frontend/doc'.'/'.$data->back_identity_doc)))

                     <a class="click_btn" href="{{url('uploads/frontend/doc/'.$data->back_identity_doc)}}" target="_blank">Download</a>
     
                    @else
                       <p>No Document Found</p>
                    @endif 
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.signed_doc')</th>
                <td>
                    <a class="click_btn" href="{{url('uploads/frontend/pdf/'.$data->signed_doc)}}" target="_blank">Download</a>
                   
                </td>
            </tr>

            @else

            @endif
            @if(!empty($data)  && isset($data->role_type) && $data->role_type=='travel_blogger')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.phone_no')</th>
                <td>{{ isset( $data ) ? $data->phone_no  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.birth_place')</th>
                <td>{{date('d-m-Y', strtotime(isset( $data ) ? $data->birth_place  : '')) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sex')</th>
                <td>{{ isset( $data ) ? $data->sex  : '' }}</td>
            </tr>

              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.place_of_residence')</th>
                <td>{{ isset( $data ) ? $data->place_of_residence  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation')</th>
                <td>{{ isset( $data ) ? $data->fav_nation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation_want')</th>
                <td>{{ isset( $data ) ? $data->fav_nation_want  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.pdf_doc')</th>
                <td>

                @if(!empty($data->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$data->identity_document)) )
                    <a class="click_btn" href="{{url('uploads/frontend/doc/'.$data->identity_document)}}" target="_blank">Download</a>
                    @else
                      <p>No Document Found</p>
                @endif 
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.telephone_number')</th>
                <td>{{ isset( $data ) ? $data->telephone_number  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.vat_number')</th>
                <td>{{ isset( $data ) ? $data->vat_number  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.personal_website')</th>
                <td>{{ isset( $data ) ? $data->personal_website  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fb_link')</th>
                <td>{{ isset( $data ) ? $data->fb_link  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.twitter_link')</th>
                <td>{{ isset( $data ) ? $data->twitter_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.insta_link')</th>
                <td>{{ isset( $data ) ? $data->insta_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.pinterest_link')</th>
                <td>{{ isset( $data ) ? $data->pinterest_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.tiktok_link')</th>
                <td>{{ isset( $data ) ? $data->tiktok_link  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.signed_doc')</th>
                <td>
                    <a class="click_btn" href="{{url('uploads/frontend/pdf/'.$data->signed_doc)}}" target="_blank">Download</a>
                   
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.blogger_service')</th>
                <td>{{ isset( $data ) ? $data->blogger_service  : '' }}</td>
            </tr>

            @else

            @endif

            @if(!empty($data)  && isset($data->role_type) && $data->role_type=='travel_agency')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.phone_no')</th>
                <td>{{ isset( $data ) ? $data->phone_no  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.birth_place')</th>
                <td>{{date('d-m-Y', strtotime(isset( $data ) ? $data->birth_place  : '')) }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sex')</th>
                <td>{{ isset( $data ) ? $data->sex  : '' }}</td>
            </tr>

              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.place_of_residence')</th>
                <td>{{ isset( $data ) ? $data->place_of_residence  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation')</th>
                <td>{{ isset( $data ) ? $data->fav_nation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fav_nation_want')</th>
                <td>{{ isset( $data ) ? $data->fav_nation_want  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.fb_link')</th>
                <td>{{ isset( $data ) ? $data->fb_link  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.twitter_link')</th>
                <td>{{ isset( $data ) ? $data->twitter_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.insta_link')</th>
                <td>{{ isset( $data ) ? $data->insta_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.pinterest_link')</th>
                <td>{{ isset( $data ) ? $data->pinterest_link  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.tiktok_link')</th>
                <td>{{ isset( $data ) ? $data->tiktok_link  : '' }}</td>
            </tr>

            <tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.vat_number')</th>
                <td>{{ isset( $data ) ? $data->vat_number  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.agency_name')</th>
                <td>{{ isset( $data ) ? $data->agency_name  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.agency_website')</th>
                <td>{{ isset( $data ) ? $data->agency_website  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.agency_address')</th>
                <td>{{ isset( $data ) ? $data->agency_address  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.license_detail')</th>
                <td>{{ isset( $data ) ? $data->license_detail  : '' }}</td>
            </tr>

            <th>@lang('labels.backend.access.users.tabs.content.overview.signed_doc')</th>
                <td>
                    <a class="click_btn" href="{{url('uploads/frontend/pdf/'.$data->signed_doc)}}" target="_blank">Download</a>
                   
                </td>
            </tr>
            @else
            @endif            
        </table>
    </div>
</div><!--table-responsive-->
