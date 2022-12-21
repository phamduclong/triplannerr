{{ html()->modelForm($logged_in_user, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    @method('PATCH')
<!--
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                    <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar
                    <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload

                    @foreach($logged_in_user->providers as $provider)
                        @if(strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach
                </div>
            </div><!--form-group-->

            <!--<div class="form-group hidden" id="avatar_location">
                {{ html()->file('avatar_location')->class('form-control') }}
            </div><!--form-group-->
        <!--</div><!--col-->
   <!-- </div><!--row-->

@if(Auth::user()->role_type =='traveler')
<div class="row">
    <div class="col">
       <div class="form-group travel-info">
        <h4>Travel Info</h4>
        <p>The "Traveller" is the main user of "Travel Maker".</p>
        <p>He/She shares his/her Travels to inspire other travellers.</p>
        <p>He/She describes his/her travel experiences by uploading his/her photos.</p>
        <p>He/She searches for information about different types of travel to find inspiration, tips and advice on how to organize his/her holidays.</p>
        <p>Role:</p>
        <p>- Creates "Travel Reports" (offers tips and information to organize trips and holidays)<p>
        <p>- Shares "Travel Reports" with his Followers in Travel Maker and on Social Networks</p>
        <p>- Shares other users' "Travel Reports" on his profile (to maintain a record or communicate his/her travel preferences to other users)</p>
        <p>- Activates the "Alerts" on the most interesting trips (to receive notifications when trips with the same characteristics are posted)</p>
        <p>- Uses the "Same Trip" function to communicate to other users that they had similar travel experiences, express appreciation and compare the information</p>
        <p>- Uses Travel Maker filters to search for his/her ideal trip and to gather information to plan trips and holidays.</p>
         </div>
      </div>
  </div>
@endif
@if(Auth::user()->role_type =='travel_maker')
 <div class="row">
    <div class="col">
      <div class="form-group travel-info">
        <h4>Travel Info</h4>
       <p>The "Travel Maker" is a traveller who shares his/her travels and inspires other travellers. He/she shares a passion for travel and organizes holidays for his/her friends.</p>
       <p>He/She proposes travel itineraries, calculates the budget necessary to participate and the minimum and maximum number of participants. It is the Tour Leader of the trips he/she offers.</p>
       <p>He/She accesses all the features available for "Travelers" but in Travel Maker He/She is allowed to do much more:</p>
       <p>= He/She can post the "Travel Reports" exactly as the "Travelers" do but he/she can also decide to post the "Travel Diaries".</p>
       <p>What are "Travel Diaries"?</p>
       <p>They are detailed analytical documents which contain all the information necessary to faithfully replicate a travel experience:</p>
       <p>- the geographical references, the places they visited and the tracks of the GPS routes (if available or necessary)</p>
       <p>- the geographical references, the places they visited and the tracks of the GPS routes (if available or necessary)</p>
       <p>- the names and contact details of hotels, restaurants and service providers</p>
       <p>- contacts of tour guides, museums or theme parks, services and entertainment that characterized the holiday</p>
       <p>- all expenses in detail, from travel tickets to entertainment expenses</p>
       <p>- tips and useful information to repeat the travel experience in the best way</p>
       <p>While writing the "Travel Diaries", the "Travel Maker" may decide whether to make the collected information available to everyone for free or to ask for a payment of ??? 3.00 in order to download the document.</p>
       <p>The "Travel Maker" therefore also has the possibility to monetize his/her travel experiences.</p>
       <p>- suggesting his/her trips and look for travel partners.</p>
       <p>The "Travel Maker" is an experienced traveller who knows the places where he has traveled very well.</p>
       <p>When creating the "Travel Report" he/she can choose the "Search travel partners" option The "Travel Report" posted by him in this case becomes a travel proposal for the whole Community:</p>
       <p>The "Travel Maker" offers to become the Tour Leader of the trip he has planned and accompany the participants to repeat an experience that he has now consolidated.</p>
       <p>The "Travel Report - Seeking Travel Partners" will contain all the information to decide whether to accept the invitation, form the group of travellers and leave all together.</p>
           </div>
      </div>
  </div>
  @endif
@if(Auth::user()->role_type =='travel_blogger')
 <div class="row">
    <div class="col">
       <div class="form-group travel-info">
        <h4>Travel Info</h4>
        <p>The "Travel Blogger" is a professional who shares information and news.</p>
        <p>He/She Suggests new destinations and inspires the community to travel.</p>
        <p>He/She Accesses all the features available for the "Traveller"</p>
        <p>He/She shares Travel Reports with his Followers in Travel Maker and on Social Networks.</p>
        <p>He/She offers promotional services to "Travel Pros" suggesting collaborations:</p>
        <p>The "Travel Blogger" can send up to three requests per month to the "Travel Pro" from which, however, he can receive unlimited requests for collaboration.</p>
         </div>
      </div>
  </div>
  @endif
 @if(Auth::user()->role_type =='travel_agency')
  <div class="row">
    <div class="col">
      <div class="form-group travel-info">
        <h4>Travel Info</h4>
        <p>He/She shares his/her travel reports.</p>
        <p>He/She is a professional who shares information and news on the offers, products and services he offers.</p>
        <p>- Agencies:</p>
        <p>"Tour Operator" "Travel Agency" "Travel Agent" "Local Agent"</p>
        <p>- Local Operators:</p>
        <p>"Excursions" "Tour Guides" "Day Trips"</p>
        <p>- Tourist Services:</p>
        <p>"Hotels and overnight Accommodation" "Restaurants and Services" "Monuments and Institutional Sites" "Attractions and Entertainment"</p>
         </div>
      </div>
  </div>
  @endif
    <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.term_condition'))->for('term_condition') }}
              <textarea class="form-control" name="term_condition">@if($user_data){{isset($user_data->term_condition)?$user_data->term_condition:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
  <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.describe_yourself'))->for('describe_yourself') }}
              <textarea class="form-control" name="describe_yourself">@if($user_data){{isset($user_data->describe_yourself)?$user_data->describe_yourself:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
<!--  <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.profile_badge'))->for(' profile_badge') }}
              <input type="file" name="profile_badge" >
            </div>
          </div>
        <div class="col-lg-8 col-md-6">
            <div class="form-group">
    @if(!empty($user_data->profile_badge) && file_exists(public_path('img/frontend/user/profile_badge'.'/'.$user_data->profile_badge)) )
           <img src="{{url('img/frontend/user/profile_badge/'.$user_data->profile_badge)}}" class="img-responsive" width="100" height="100">
           @else
             <img src="{!! URL::to('img/frontend/demo.png') !!}">
            @endif

        </div>
      </div>
    </div> -->
      <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.cover_image'))->for('cover_image') }}
              <input type="file" name="cover_image" >
            </div>
          </div>
        <div class="col-lg-8 col-md-6">
            <div class="form-group">
    @if(!empty($user_data->cover_image) && file_exists(public_path('img/frontend/user/cover'.'/'.$user_data->cover_image)) )
           <img src="{{url('img/frontend/user/cover/'.$user_data->cover_image)}}" class="img-responsive" width="100" height="100">
           @else
             <img src="{!! URL::to('img/frontend/demo.png') !!}">
            @endif

        </div>
      </div>
   </div>

   <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.profile_image'))->for('profile_image') }}

              <input type="file" name="profile_image" >
            </div>
          </div>

        <div class="col-lg-8 col-md-6">
            <div class="form-group">
    @if(!empty($user_data->profile_image) && file_exists(public_path('img/frontend/user/profile'.'/'.$user_data->profile_image)) )
           <img src="{{url('img/frontend/user/profile/'.$user_data->profile_image)}}" class="img-responsive" width="100" height="100">
           @else
             <img src="{!! URL::to('img/frontend/demo.png') !!}">
            @endif

        </div>
      </div>
  </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->

        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.user_name'))->for('user_name') }}

                {{ html()->text('user_name')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.user_name'))
                     ->attribute('maxlength', 191)
                      }}
         </div><!--form-group-->
      </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.phone_no'))->for('phone_no') }}
             <input type="text" name="phone_no" value="@if($user_data){{isset($user_data->phone_no)?$user_data->phone_no:''}}@endif" placeholder="@lang('validation.attributes.frontend.phone_no')" class="form-control" >

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 @php
 if($user_data){
 $birth_date=date("m/d/Y", strtotime($user_data->birth_place));
 }
 @endphp
  <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.birth_place'))->for('birth_place') }}
            <input type="date" name="birth_place" value="@if($user_data){{isset($birth_date)?date('Y-m-d',strtotime($birth_date)):''}}@endif" placeholder="@lang('validation.attributes.frontend.birth_place')" class="form-control" date-format="mm/dd/yyyy">
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.sex'))->for('sex') }}
                <div class="input-sec">
                 <input type="radio" name="sex" value="Male" placeholder="validation.attributes.frontend.sex" @if($user_data) @if($user_data->sex=='male') checked=""  @endif @endif>Male

                </div>
                 <div class="input-sec">
                 <input type="radio" name="sex" value="Female" placeholder="validation.attributes.frontend.sex" @if($user_data) @if($user_data->sex=='female') checked=""  @endif @endif>Female

             </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.place_of_residence'))->for('place_of_residence') }}
              <textarea class="form-control" name="place_of_residence">@if($user_data){{isset($user_data->place_of_residence)?$user_data->place_of_residence:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
  <div class="col-md-8">
      <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.favorite_nations'))->for('favorite_nations') }}
          <div class="input-group">

              <input type="text" id="search_data" name="fav_nation[]" placeholder="" autocomplete="off" class="form-control input-lg" />
             <!--  <div class="input-group-btn">
                  <button type="button" class="btn btn-primary btn-lg" id="search">Get Value</button>
              </div> -->
          </div>
          <br />
          <span id="country_name"></span>
      </div>
  </div>
</div>
 @if(Auth::user()->role_type =='travel_maker')
   <input type="hidden" name="role_type" value="travel_maker">
  <div class="row">
    <div class="col">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.classification_of_travel_report'))->for('classification_of_travel_report') }}
         <textarea class="form-control" name="classification_travel_report">@if($user_data){{isset($user_data->classification_travel_report)?$user_data->classification_travel_report:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
     <div class="row">
       <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.photo_valid_identity_doc'))->for('photo_valid_identity_doc') }}
                </br>
               <input type="file" name="front_identity_doc" placeholder="validation.attributes.frontend.Upload_identity_document" value="">
               @if(!empty($user_data->front_identity_doc) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->front_identity_doc)) )
                  <a href="{{url('uploads/frontend/doc/'.$user_data->front_identity_doc)}}" target="_blank" class="click_btn">Click here</a>
                @endif
              <input type="hidden" name="front_identity_doc_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data){{isset($user_data->front_identity_doc)?$user_data->front_identity_doc:''}}@endif">
              </div>
            </div>
    <div class="col-md-6">
        <div class="form-group">
        </br>
               <input type="file" name="back_identity_doc" placeholder="validation.attributes.frontend.Upload_identity_document" value="">
                @if(!empty($user_data->back_identity_doc) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->back_identity_doc)) )
                  <a href="{{url('uploads/frontend/doc/'.$user_data->back_identity_doc)}}" target="_blank" class="click_btn">Click here</a>
                @endif
                 <input type="hidden" name="back_identity_doc_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data){{isset($user_data->back_identity_doc)?$user_data->back_identity_doc:''}}@endif">
          </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

<!-- <div class="row">
    <div class="col">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.pdf_doc'))->for('pdf_doc') }}
                </br>
               <input type="file" name="pdf_doc" placeholder="validation.attributes.frontend.pdf_doc" value="">

          </div><!--form-group-->
      <!--</div><!--col-->
<!-- </div><!--row-->

 <div class="row">
    <div class="col">
         <div class="form-group input-sec">
            <input type="checkbox" name="sign_organize" value="Commitment to organize travel" @if($user_data) @if($user_data->sign_organize=='Commitment to organize travel') checked=""  @endif @endif>  Signing of Commitment to organize travel only to share expenses with other travelers
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
    <div class="col">
         <div class="form-group input-sec">
            <input type="checkbox" name="sign_tour_leader" value="Commitment to be the groups" @if($user_data) @if($user_data->sign_tour_leader=='Commitment to be the groups') checked=""  @endif  @endif>  Signing of Commitment to be the groups tour leader during the trip
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
  <div class="row">
    <div class="col">
         <div class="form-group input-sec">
            <input type="checkbox" name="sign_agreement_recognize" value="agreement to recognize the site" @if($user_data) @if($user_data->sign_agreement_recognize=='agreement to recognize the site') checked=""  @endif @endif>  Signing of the agreement to recognize the site 2.5% of the travel fees paid by users who buy his tour
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
   <div class="row">
      <div class="col">
         <div class="form-group input-sec">
           {{ html()->label(__('validation.attributes.frontend.pdf_declaration_form'))->for('pdf_declaration_form') }}
           <div class="col-md-6" style="float:left">
            <button class="doc_download_btn"> <a href="{{ url('img/doc/TRAVELMAKER _Doc.pdf')}}" download target="_blank">Document download</a></button>
           </div>
           <div class="col-md-6" style="float:left">
          <!--   {{ html()->label(__('validation.attributes.frontend.signed_doc'))->for('signed_doc') }} -->
          <input type="file" name="signed_doc" value="">
           @if(!empty($user_data->signed_doc) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->signed_doc)) )
                  <a href="{{url('uploads/frontend/pdf/'.$user_data->signed_doc)}}" target="_blank" class="click_btn">Click here</a>
                @endif
         </div>
       </div>
     </div>
  </div>
 @endif
 @if(Auth::user()->role_type =='traveler')
  <input type="hidden" name="role_type" value="traveler">
 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.upload_identity_document'))->for('classification_of_travel_report') }}
                </br>
               <input type="file" name="identity_document" placeholder="validation.attributes.frontend.Upload_identity_document" value="">

         </div><!--form-group-->
      </div><!--col-->
      <div class="col-md-6">
        <div class="form-group">
            @if(!empty($user_data->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->identity_document)) )
            <a class="click_btn" href="{{url('uploads/frontend/doc/'.$user_data->identity_document)}}" target="_blank">Click here</a>
            @endif
        </div>
      </div>
 </div><!--row-->
     @endif
 @if(Auth::user()->role_type =='travel_blogger')
  <input type="hidden" name="role_type" value="travel_blogger">

 <div class="row">
   <div class="col-md-6">
        <div class="form-group">
          {{ html()->label(__('validation.attributes.frontend.upload_identity_document'))->for('classification_of_travel_report') }}
     @if(!empty($user_data->identity_document))
      <input type="file" name="identity_document" placeholder="validation.attributes.frontend.Upload_identity_document" value="@if($user_data){{isset($user_data->identity_document)?$user_data->identity_document:''}}@endif" >
     <input type="hidden" name="identity_document_hide" value="@if($user_data){{isset($user_data->identity_document)?$user_data->identity_document:''}}@endif">
     @if(!empty($user_data->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->identity_document)) )
        <a href="{{url('uploads/frontend/doc/'.$user_data->identity_document)}}" class="click_btn" target="_blank">Click here</a>
     @endif
     @else

      <input type="file" name="identity_document" placeholder="validation.attributes.frontend.Upload_identity_document" value="@if($user_data){{isset($user_data->identity_document)?$user_data->identity_document:''}}@endif" >
     @endif
   </div><!--form-group-->
  </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.telephone_number'))->for('telephone_number') }}
                <input type="text" name="telephone_number" class="form-control" value="@if($user_data){{isset($user_data->telephone_number)?$user_data->telephone_number:''}}@endif">

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.vat_number'))->for('vat_number') }}
                <input type="text" name="vat_number" class="form-control" value="@if($user_data){{isset($user_data->vat_number)?$user_data->vat_number:''}}@endif">
         </div><!--form-group-->
      </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.personal_website'))->for('personal_website') }}
                 <input type="text" class="form-control" name="personal_website" value="@if($user_data){{isset($user_data->personal_website)?$user_data->personal_website:''}}@endif">

         </div><!--form-group-->
      </div><!--col-->
  </div>
          @php
        if($user_data){
           $explode_service=explode(',',$user_data->blogger_service);
         }
         @endphp
 <div class="row">
      <div class="col">
          <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.service_term'))->for('service_term') }}
           <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Seo article" @if($user_data)  @if(in_array('Seo article',$explode_service)) checked="" @endif @endif>{{ html()->label(__('validation.attributes.frontend.seo_article'))->for('vat_number') }}
           </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Introduction" @if($user_data)  @if(in_array('Introduction',$explode_service)) checked="" @endif @endif>{{ html()->label(__('validation.attributes.frontend.introduction'))->for('vat_number') }}
            </div>
           <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Promotion Social" @if($user_data)  @if(in_array('Promotion Social',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.promotion_social'))->for('promotion_social') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Take Over" @if($user_data)  @if(in_array('Take Over',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.take_over'))->for('take_over') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Ad_hoc Format" @if($user_data)  @if(in_array('Ad_hoc Format',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.ad_hoc_format'))->for('ad_hoc_format') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Promotional Video" @if($user_data)  @if(in_array('Promotional Video',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.promotional_video'))->for('promotional_video') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="blogger images" @if($user_data)  @if(in_array('blogger images',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.blogger_images'))->for('blogger_images') }}
            </div>
           </div>
        </div>
   </div>
 @endif
   @if(Auth::user()->role_type =='travel_blogger' || Auth::user()->role_type =='travel_agency')
  <div class="row">
    <div class="col">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.social_link'))->for('social_link') }}
                </br>
                <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Facebook</label>
                           <input class="form-control" type="text" name="fb_link" placeholder="" value="@if($user_data){{isset($user_data->fb_link)?$user_data->fb_link:''}}@endif">
                      </div><!--form-group-->
                  </div><!--col-->

                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Twitter</label>

                          <input class="form-control" type="text" name="twitter_link" placeholder="" value="@if($user_data){{isset($user_data->twitter_link)?$user_data->twitter_link:''}}@endif">
                      </div><!--form-group-->
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="last_name">Instagram</label>
                          <input class="form-control" type="text" name="insta_link" placeholder="" value="@if($user_data){{isset($user_data->insta_link)?$user_data->insta_link:''}}@endif">
                      </div><!--form-group-->
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="last_name">Pinterest</label>

                          <input class="form-control" type="text" name="pinterest_link" placeholder="" value="@if($user_data){{isset($user_data->pinterest_link)?$user_data->pinterest_link:''}}@endif">
                      </div><!--form-group-->
                  </div><!--col-->
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Tiktok</label>
                           <input class="form-control" type="text" name="tiktok_link" placeholder="" value="@if($user_data){{isset($user_data->tiktok_link)?$user_data->tiktok_link:''}}@endif">
                      </div><!--form-group-->
                  </div><!--col-->
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Youtube</label>
                           <input class="form-control" type="text" name="youtube_link" placeholder="" value="@if($user_data){{isset($user_data->youtube_link)?$user_data->youtube_link:''}}@endif">
                      </div><!--form-group-->
                  </div><!--col-->
                </div>

          </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
  <div class="row">
      <div class="col">
         <div class="form-group input-sec">
           {{ html()->label(__('validation.attributes.frontend.pdf_declaration_form'))->for('pdf_declaration_form') }}
           <div class="col-md-6" style="float:left">
            <button class="doc_download_btn"> <a href="{{ url('img/doc/TRAVELMAKER _Doc.pdf')}}" download target="_blank">Document download</a></button>
           </div>
           <div class="col-md-6" style="float:left">
            {{ html()->label(__('validation.attributes.frontend.signed_doc'))->for('signed_doc') }}
          <input type="file" name="signed_doc" value="">
          @if(!empty($user_data->signed_doc) && file_exists(public_path('uploads/frontend/pdf/signdoc'.'/'.$user_data->signed_doc)) )
               <a href="{{url('uploads/frontend/pdf/signdoc/'.$user_data->signed_doc)}}" class="click_btn" target="_blank">Click here</a>
           @endif
         </div>
       </div>
     </div>
  </div>
@endif

<!-- @if(Auth::user()->role_type !='travel_agency' && Auth::user()->role_type !='travel_blogger')
        @php
        if($user_data){
           $explode_data=explode(',',$user_data->sentimental_situation);
         }
        @endphp -->
  <!-- <div class="row">
     <div class="col">
        <div class="form-group senti-list">
             {{ html()->label(__('validation.attributes.frontend.sentimental_situation'))->for('sentimental_situation') }}
         <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="single"  @if($user_data)  @if(in_array('single',$explode_data)) checked="" @endif @endif>Single
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="boyfriend"   @if($user_data) @if(in_array('boyfriend',$explode_data)) checked="" @endif @endif>Boyfriend
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="married" @if($user_data) @if(in_array('married',$explode_data)) checked="" @endif @endif>Married
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="separated" @if($user_data) @if(in_array('separated',$explode_data)) checked="" @endif @endif>Separated
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="divorced" @if($user_data) @if(in_array('divorced',$explode_data)) checked="" @endif @endif>Divorced
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="widowed" @if($user_data) @if(in_array('widowed',$explode_data)) checked="" @endif @endif>Widowed
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="civil union" @if($user_data) @if(in_array('civil union',$explode_data)) checked="" @endif @endif>Civil Union
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="living together" @if($user_data) @if(in_array('living together',$explode_data)) checked="" @endif @endif>Living together
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="open relationship" @if($user_data) @if(in_array('open relationship',$explode_data)) checked="" @endif @endif>Open relationship
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="complicated relationship" @if($user_data) @if(in_array('complicated relationship',$explode_data)) checked="" @endif @endif>Complicated relationship
        </div>
        <div class="input-sec">
            <input type="checkbox" name="sentimental_situation[]" value="stable relationship" @if($user_data) @if(in_array('stable relationship',$explode_data)) checked="" @endif @endif>Stable relationship
        </div>
         </div>
      </div>
 </div> -->
@endif
@if(Auth::user()->role_type !='travel_agency')
<div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_travel_category'))->for('preferred_travel_category') }}
                <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="adventure" @if($user_data) @if($user_data->preferred_travel_category=='adventure') checked=""  @endif  @endif>Adventure
                 </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="backpaker" @if($user_data) @if($user_data->preferred_travel_category=='backpaker') checked=""  @endif  @endif>backpaker
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="capital"
                 @if($user_data) @if($user_data->preferred_travel_category=='capital') checked=""  @endif @endif>Capitals / City
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="cultural" @if($user_data) @if($user_data->preferred_travel_category=='cultural') checked=""  @endif @endif>Cultural
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="experiential"
                @if($user_data) @if($user_data->preferred_travel_category=='experiential') checked=""  @endif @endif>Experiential
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="on the road"
                @if($user_data) @if($user_data->preferred_travel_category=='on the road') checked=""  @endif @endif>On the road
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="special events"
                @if($user_data) @if($user_data->preferred_travel_category=='special events') checked=""  @endif @endif>Special events
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="fun and nightlife" @if($user_data) @if($user_data->preferred_travel_category=='fun and nightlife') checked=""  @endif @endif>Fun and Nightlife
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="nature" @if($user_data) @if($user_data->preferred_travel_category=='nature') checked=""  @endif @endif>Nature
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="guided tours" @if($user_data) @if($user_data->preferred_travel_category=='guided tours') checked=""  @endif @endif>Guided Tours
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="wellness and relax" @if($user_data) @if($user_data->preferred_travel_category=='wellness and relax') checked=""  @endif @endif>Wellness and Relax
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="yacht cruise" @if($user_data) @if($user_data->preferred_travel_category=='yacht cruise') checked=""  @endif @endif>Yacht cruise
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="cruise on ship" @if($user_data) @if($user_data->preferred_travel_category=='cruise on ship') checked=""  @endif @endif>Cruise on ship
                  </div>
                 <div class="input-sec">
                 <input type="radio" name="preferred_travel_category" placeholder="validation.attributes.frontend.preferred_travel_category" value="mototurismo" @if($user_data) @if($user_data->preferred_travel_category=='mototurismo') checked=""  @endif @endif>Mototurismo
                  </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_type_of_travel'))->for('preferred_type_of_travel') }}
                <div class="input-sec">
                 <input type="radio" name="type_of_travel" placeholder="validation.attributes.frontend.preferred_type_of_travel" value="itinerant" @if($user_data) @if($user_data->type_of_travel=='itinerant') checked=""  @endif @endif>Itinerant
             </div>
             <div class="input-sec">
                 <input type="radio" name="type_of_travel" placeholder="validation.attributes.frontend.preferred_type_of_travel" value="living room" @if($user_data) @if($user_data->type_of_travel=='living room') checked=""  @endif @endif>Living room
             </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

  <div class="row">
     <div class="col">
        <div class="form-group senti-list">
             {{ html()->label(__('validation.attributes.frontend.preferred_type_of_accommodation'))->for('preferred_type_of_accommodation') }}
        @php
        if($user_data){
           $explode_accommodation=explode(',',$user_data->type_of_accommodation);
         }
        @endphp
         <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="resort" @if($user_data) @if(in_array('resort',$explode_accommodation)) checked="" @endif @endif>Resort
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Luxury hotel" @if($user_data) @if(in_array('Luxury hotel',$explode_accommodation)) checked="" @endif @endif>Luxury Hotel
            </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Coach surfing"@if($user_data) @if(in_array('Coach surfing',$explode_accommodation)) checked="" @endif @endif>Coach surfing
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Swapping" @if($user_data) @if(in_array('Swapping',$explode_accommodation)) checked="" @endif @endif>Swapping
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Boutique Hotel" @if($user_data) @if(in_array('Boutique Hotel',$explode_accommodation)) checked="" @endif @endif>Boutique Hotel
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Economy Hotel" @if($user_data) @if(in_array('Economy Hotel',$explode_accommodation)) checked="" @endif @endif>Economy Hotel
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Farmhouse" @if($user_data) @if(in_array('Farmhouse',$explode_accommodation)) checked="" @endif @endif>Farmhouse
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Bed & Breakfast" @if($user_data) @if(in_array('Bed & Breakfast',$explode_accommodation)) checked="" @endif @endif>Bed & Breakfast
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Hostel" @if($user_data) @if(in_array('Hostel',$explode_accommodation)) checked="" @endif @endif>Hostel
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Apartments" @if($user_data) @if(in_array('Apartments',$explode_accommodation)) checked="" @endif @endif>Apartments
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Luxury Villages" @if($user_data) @if(in_array('Luxury Villages',$explode_accommodation)) checked="" @endif @endif>Luxury Villages
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Economy villages" @if($user_data) @if(in_array('Economy villages',$explode_accommodation)) checked="" @endif @endif>Economy villages
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_accommodation[]" value="Tents and Campsites" @if($user_data) @if(in_array('Tents and Campsites',$explode_accommodation)) checked="" @endif @endif>Tents and Campsites
        </div>
          </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

  <div class="row">
     <div class="col">
        <div class="form-group senti-list">
             {{ html()->label(__('validation.attributes.frontend.vector_type'))->for('vector_type') }}
        @php
         if($user_data){
           $explode_vector_type=explode(',',$user_data->vector_type);
          }
        @endphp
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Airplane" @if($user_data) @if(in_array('Airplane',$explode_vector_type)) checked="" @endif @endif>Airplane
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Train" @if($user_data) @if(in_array('Train',$explode_vector_type)) checked="" @endif @endif>Train
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Camper" @if($user_data) @if(in_array('Camper',$explode_vector_type)) checked="" @endif @endif>Camper
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Bus" @if($user_data) @if(in_array('Bus',$explode_vector_type)) checked="" @endif @endif>Bus
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Car" @if($user_data) @if(in_array('Car',$explode_vector_type)) checked="" @endif @endif>Car
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Motorcycle" @if($user_data) @if(in_array('Motorcycle',$explode_vector_type)) checked="" @endif @endif>Motorcycle
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Bicycles" @if($user_data) @if(in_array('Bicycles',$explode_vector_type)) checked="" @endif @endif>Bicycles
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="Hitch-hiking" @if($user_data) @if(in_array('Hitch-hiking',$explode_vector_type)) checked="" @endif @endif>Hitch-hiking
        </div>
        <div class="input-sec">
            <input type="checkbox" name="vector_type[]" value="On foot" @if($user_data) @if(in_array('On foot',$explode_vector_type)) checked="" @endif @endif>On foot
        </div>

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

   <div class="row">
     <div class="col">
        <div class="form-group senti-list">
             {{ html()->label(__('validation.attributes.frontend.type_of_participants'))->for('type_of_participants') }}
        @php
        if(isset($user_data)){
           $explode_participants=explode(',',$user_data->type_of_participants);
         }
        @endphp
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="Solitary" @if($user_data) @if(in_array('Solitary',$explode_participants)) checked="" @endif @endif>Solitary
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="Mixed Group" @if($user_data) @if(in_array('Mixed Group',$explode_participants)) checked="" @endif @endif>Mixed Group
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="Single only" @if($user_data) @if(in_array('Single only',$explode_participants)) checked="" @endif @endif>Single only
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="Group" @if($user_data) @if(in_array('Group',$explode_participants)) checked="" @endif @endif>Group (over 10 participants)
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="children 0-6 years" @if($user_data) @if(in_array('children 0-6 years',$explode_participants)) checked="" @endif @endif>Family with children 0-6 years
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="Children 6-12 years" @if($user_data) @if(in_array('Children 6-12 years',$explode_participants)) checked="" @endif @endif>Family with Children 6-12 years
        </div>
        <div class="input-sec">
            <input type="checkbox" name="type_of_participants[]" value="children 12-16 years" @if($user_data) @if(in_array('children 12-16 years',$explode_participants)) checked="" @endif @endif>Family with children 12-16 years
        </div>

        </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_travel_budget'))->for('preferred_travel_budget') }}
                <div class="input-sec">
                 <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="from 50 to 200 €"@if($user_data) @if($user_data->preferred_travel_budget=='from 50 to 200 €') checked=""  @endif @endif>from 50 to 200 €
                 </div>
                <div class="input-sec">
                 <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="from 200 to 500 €"@if($user_data) @if($user_data->preferred_travel_budget=='from 200 to 500 €') checked=""  @endif @endif>from 200 to 500 €
                 </div>
                <div class="input-sec">
                 <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="from 500 to 1000 €" @if($user_data) @if($user_data->preferred_travel_budget=='from 500 to 1000 €') checked=""  @endif @endif>from 500 to 1000 €
                 </div>
                <div class="input-sec">
                <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="from 1000 to 3000 €" @if($user_data) @if($user_data->preferred_travel_budget=='from 1000 to 3000 €') checked=""  @endif @endif>from 1000 to 3000 €
                </div>
                <div class="input-sec">
                <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="from 3000 to 6000 €"@if($user_data) @if($user_data->preferred_travel_budget=='from 3000 to 6000 €') checked=""  @endif @endif>from 3000 to 6000 €
                </div>
                <div class="input-sec">
                <input type="radio" name="preferred_travel_budget" placeholder="validation.attributes.frontend.preferred_travel_budget" value="over 6000 €" @if($user_data) @if($user_data->preferred_travel_budget=='over 6000 €') checked=""  @endif @endif>over 6000 €
            </div>
           </div><!--form-group-->

      </div><!--col-->
 </div><!--row-->
    <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.preferred_type'))->for('preferred_type') }}
              <div class="input-sec">
                 <input type="radio" name="preferred_type" value="breakfast" placeholder="validation.attributes.frontend.preferred_type" @if($user_data) @if($user_data->preferred_type=='breakfast') checked=""  @endif @endif>Bed and breakfast
              </div>
              <div class="input-sec">
                 <input type="radio" name="preferred_type" value="Half board" placeholder="validation.attributes.frontend.preferred_type" @if($user_data) @if($user_data->preferred_type=='half board') checked=""  @endif @endif>Half board
              </div>
              <div class="input-sec">
                 <input type="radio" name="preferred_type" value="Full board" placeholder="validation.attributes.frontend.preferred_type" @if($user_data) @if($user_data->preferred_type=='full board') checked=""  @endif @endif>Full board
              </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
@endif
  @if(Auth::user()->role_type =='travel_agency')
  <input type="hidden" name="role_type" value="travel_agency">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.vat_number'))->for('vat_number') }}
               <input type="text" name="vat_number" value="@if($user_data){{isset($user_data->vat_number)?$user_data->vat_number:''}}@endif" placeholder="@lang('validation.attributes.frontend.vat_number')" class="form-control" >
         </div><!--form-group-->
      </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.agency_name'))->for('agency_name') }}
                 <input type="text" name="agency_name" value="@if($user_data){{isset($user_data->agency_name)?$user_data->agency_name:''}}@endif" placeholder="@lang('validation.attributes.frontend.agency_name')" class="form-control" >
         </div><!--form-group-->
       </div><!--col-->
  </div>
  <div class="row">
      <div class="col">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.agency_website'))->for('agency_website') }}
                 <input type="text" name="agency_website" value="@if($user_data){{isset($user_data->agency_website)?$user_data->agency_website:''}}@endif" placeholder="@lang('validation.attributes.frontend.agency_website')" class="form-control" >
         </div><!--form-group-->
      </div><!--col-->
  </div>

 <div class="row">
    <div class="col-md-12">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.agency_address'))->for('agency_address') }}
                <textarea class="form-control" name="agency_address">@if($user_data){{isset($user_data->agency_address)?$user_data->agency_address:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
  </div>
 <div class="row">
    <div class="col-md-12">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.license_detail'))->for('license_detail') }}
                <textarea class="form-control" name="license_detail">@if($user_data){{isset($user_data->license_detail)?$user_data->license_detail:''}}@endif</textarea>

         </div><!--form-group-->
      </div><!--col-->
  </div>
<div class="row">
    <div class="col">
         <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.identification_option'))->for('license_detail') }}
            <div class="input-sec">
              <input type="checkbox" name="identification_option" value="Tour operator" @if($user_data) @if($user_data->identification_option=='Tour operator') checked=""  @endif @endif>Tour operator
            </div>
            <div class="input-sec">
            <input type="checkbox" name="identification_option" value="Travel agency" @if($user_data) @if($user_data->identification_option=='Travel agency') checked=""  @endif @endif>Travel agency
          </div>
          <div class="input-sec">
            <input type="checkbox" name="identification_option" value="Travel agent" @if($user_data) @if($user_data->identification_option=='Travel agent') checked=""  @endif @endif>Travel agent
          </div>
          <div class="input-sec">
            <input type="checkbox" name="identification_option" value="Local agent" @if($user_data) @if($user_data->identification_option=='Local agent') checked=""  @endif @endif>Local agent
          </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
    <div class="col">
         <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.local_operator'))->for('local_operator') }}
            <div class="input-sec">
            <input type="checkbox" name="local_operator" value="excursions" @if($user_data) @if($user_data->local_operator=='excursions') checked=""  @endif @endif>Excursions
            </div>
            <div class="input-sec">
            <input type="checkbox" name="local_operator" value="Rentals" @if($user_data) @if($user_data->local_operator=='Rentals') checked=""  @endif @endif>Day Trips
            </div>
            <div class="input-sec">
            <input type="checkbox" name="local_operator" value="Tourist Guides" @if($user_data) @if($user_data->local_operator=='Tourist Guides') checked=""  @endif @endif>Travel Guide
            </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

  <div class="row">
    <div class="col">
         <div class="form-group senti-list">
              {{ html()->label(__('validation.attributes.frontend.tourist_facility'))->for('tourist_facility') }}
            <div class="input-sec">
            <input type="checkbox" name="tourist_facility" value="Overnight stay"  @if($user_data) @if($user_data->tourist_facility=='Overnight stay') checked=""  @endif @endif>Overnight stay
            </div>
            <div class="input-sec">
            <input type="checkbox" name="tourist_facility" value="Restaurants and Services" @if($user_data) @if($user_data->tourist_facility=='Restaurants and Services') checked=""  @endif @endif>Restaurants and Services
            </div>
            <div class="input-sec">
            <input type="checkbox" name="tourist_facility" value="Monuments and Institutions" @if($user_data) @if($user_data->tourist_facility=='Monuments and Institutions') checked=""  @endif @endif>Monuments and Institutions
            </div>
            <div class="input-sec">
            <input type="checkbox" name="tourist_facility" value="Attractions and Entertainment" @if($user_data) @if($user_data->tourist_facility=='Attractions and Entertainment') checked=""  @endif @endif>Attractions and Entertainment
            </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

   <div class="row">
    <div class="col">
         <div class="form-group">
              {{ html()->label(__('validation.attributes.frontend.doc_agency'))->for('doc_agency') }}
            <input type="file" name="doc_agency_data" value="">
            @if(!empty($user_data->doc_agency_data) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->doc_agency_data)) )
               <a href="{{url('uploads/frontend/pdf/'.$user_data->doc_agency_data)}}" target="_blank" class="click_btn">Click Here</a>
           @endif
            <input type="file" name="doc_agency_doc" value="">
            @if(!empty($user_data->doc_agency_doc) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->doc_agency_doc)) )
             <a href="{{url('uploads/frontend/pdf/'.$user_data->doc_agency_doc)}}" target="_blank" class="click_btn" >Click Here</a>
           @endif

         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.doc_upload'))->for('doc_upload') }}
                </br>
               <input type="file" name="doc_upload" placeholder="validation.attributes.frontend.doc_upload" value="">
               <input type="hidden" name="doc_upload_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data){{isset($user_data->doc_upload)?$user_data->doc_upload:''}}@endif">

          </div><!--form-group-->
      </div><!--col-->
       <div class="col-md-6">
        <div class="form-group">
            @if(!empty($user_data->doc_upload) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->doc_upload)) )
            <a href="{{url('uploads/frontend/doc/'.$user_data->doc_upload)}}" class="click_btn" target="_blank">Click Here</a>
            @endif
        </div>
      </div>
   </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.agency_logo'))->for('agency_logo') }}
                </br>
               <input type="file" name="agency_logo" placeholder="validation.attributes.frontend.agency_logo" value="">

          </div><!--form-group-->
      </div><!--col-->
       <div class="col-md-6">
            <div class="form-group">
    @if(!empty($user_data->agency_logo) && file_exists(public_path('img/frontend/user/agency_logo'.'/'.$user_data->agency_logo)) )
           <img src="{{url('img/frontend/user/agency_logo/'.$user_data->agency_logo)}}" class="img-responsive" width="100" height="100">
           @else
             <img src="{!! URL::to('img/frontend/demo.png') !!}">
            @endif

        </div>
      </div>

 </div><!--row-->

  @endif
    @if ($logged_in_user->canChangeEmail())
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                </div>

                <div class="form-group">
                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    @endif

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update'))->class('more_btn') }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}


@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script>
  $(document).ready(function(){

    $('#search_data').tokenfield({
        autocomplete :{
            source: [<?php echo '"' .implode( '", "', $countries ). '"' ?>],
            delay: 100
        }
    });

    $('#search').click(function(){
        $('#country_name').text($('#search_data').val());
    });

  });

  $('.blogger_img').on('click', function(e) {
    var dataId = $(this).data('id');

    var user_id = "<?php echo $user_data->user_id ?>";
    $.ajax({
        url: '{{ url('/img/blogger') }}' + '/' + dataId,
        type: 'POST',
       data:{
              "_token": "{{ csrf_token() }}",
              "id":dataId,
              "user_id" :user_id
                    },
        success: function(data) {
           $('.image_id'+dataId).remove();
        },

    });

    return false;
});
</script>

@endpush
