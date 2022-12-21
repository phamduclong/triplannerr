<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            @if(!empty($data)  && isset($data->role_type) && $data->role_type=='traveler')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sentimental_situation')</th>
                <td>{{ isset( $data ) ? $data->sentimental_situation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_category')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_category  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_travel')</th>
                <td>{{ isset( $data ) ? $data->type_of_travel  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_accommodation')</th>
                <td>{{ isset( $data ) ? $data->type_of_accommodation  : '' }}</td>
            </tr>
               <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.vector_type')</th>
                <td>{{ isset( $data ) ? $data->vector_type  : '' }}</td>
            </tr>
             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_participants')</th>
                <td>{{ isset( $data ) ? $data->type_of_participants  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_budget')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_budget  : '' }}</td>
            </tr>

              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_type')</th>
                <td>{{ isset( $data ) ? $data->preferred_type  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_fav_meals')</th>
                <td>{{ isset( $data ) ? $data->travel_favoritemealtype  : '' }}</td>
            </tr>
            @endif

            @if(!empty($data)  && isset($data->role_type) && $data->role_type=='travel_maker')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sentimental_situation')</th>
                <td>{{ isset( $data ) ? $data->sentimental_situation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_category')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_category  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_travel')</th>
                <td>{{ isset( $data ) ? $data->type_of_travel  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_accommodation')</th>
                <td>{{ isset( $data ) ? $data->type_of_accommodation  : '' }}</td>
            </tr>
               <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.vector_type')</th>
                <td>{{ isset( $data ) ? $data->vector_type  : '' }}</td>
            </tr>
             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_participants')</th>
                <td>{{ isset( $data ) ? $data->type_of_participants  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_budget')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_budget  : '' }}</td>
            </tr>

              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_type')</th>
                <td>{{ isset( $data ) ? $data->preferred_type  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_fav_meals')</th>
                <td>{{ isset( $data ) ? $data->travel_favoritemealtype  : '' }}</td>
            </tr>
            @endif

            @if(!empty($data)  && isset($data->role_type) && $data->role_type=='travel_blogger')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sentimental_situation')</th>
                <td>{{ isset( $data ) ? $data->sentimental_situation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_category')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_category  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_travel')</th>
                <td>{{ isset( $data ) ? $data->type_of_travel  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_accommodation')</th>
                <td>{{ isset( $data ) ? $data->type_of_accommodation  : '' }}</td>
            </tr>
               <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.vector_type')</th>
                <td>{{ isset( $data ) ? $data->vector_type  : '' }}</td>
            </tr>
             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_participants')</th>
                <td>{{ isset( $data ) ? $data->type_of_participants  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_budget')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_budget  : '' }}</td>
            </tr>

              <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_type')</th>
                <td>{{ isset( $data ) ? $data->preferred_type  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_fav_meals')</th>
                <td>{{ isset( $data ) ? $data->travel_favoritemealtype  : '' }}</td>
            </tr>
            @endif

             @if(!empty($data)  && isset($data->role_type) && $data->role_type=='travel_agency')
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.sentimental_situation')</th>
                <td>{{ isset( $data ) ? $data->sentimental_situation  : '' }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.preferred_travel_category')</th>
                <td>{{ isset( $data ) ? $data->preferred_travel_category  : '' }}</td>
            </tr>
             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.identification_option')</th>
                <td>{{ isset( $data ) ? $data->identification_option  : '' }}</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.local_operator')</th>
                <td>{{ isset( $data ) ? $data->local_operator  : '' }}</td>
            </tr>

             <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.tourist_facility')</th>
                <td>{{ isset( $data ) ? $data->tourist_facility  : '' }}</td>
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
                <th>@lang('labels.backend.access.users.tabs.content.overview.type_of_fav_meals')</th>
                <td>{{ isset( $data ) ? $data->travel_favoritemealtype  : '' }}</td>
            </tr>
           
            @endif
        </table>
    </div>
</div><!--table-responsive-->
