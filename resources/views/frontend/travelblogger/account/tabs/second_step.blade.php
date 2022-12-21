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
             {{ html()->text('userdetail.phone_no')
                 ->class('form-control')
                 ->placeholder(__('validation.attributes.frontend.phone_no'))
                 ->autofocus()
              }}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 @php
  $birth_date = '';
 if($user_data->userdetail){
 $birth_date=date("m/d/Y", strtotime($user_data->userdetail->birth_place));
 }
 @endphp
  <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.birth_place'))->for('birth_place') }}
            <input type="date" name="birth_place" value="@if($user_data->userdetail){{isset($birth_date)?date('Y-m-d',strtotime($birth_date)):''}}@endif" placeholder="@lang('validation.attributes.frontend.birth_place')" class="form-control" date-format="mm/dd/yyyy"> 
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.sex'))->for('sex') }}
                <div class="input-sec">
                 <input type="radio" name="sex" value="Male" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='male') checked=""  @endif @endif>Male

                </div>
                 <div class="input-sec">
                 <input type="radio" name="sex" value="Female" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='female') checked=""  @endif @endif>Female

             </div>
             <div class="input-sec">
                 <input type="radio" name="sex" value="Custom" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='custom') checked=""  @endif @endif>I don't want to say
                 </div>
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

 <div class="row">
      <div class="col">
        <div class="form-group">
             {{ html()->label(__('validation.attributes.frontend.place_of_residence'))->for('place_of_residence') }}
              {{ html()->textarea('userdetail.place_of_residence')
               ->class('form-control')
               ->placeholder(__('validation.attributes.frontend.place_of_residence'))
               ->attribute('maxlength', 191)
               ->autofocus() }}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->
 <div class="row">
  <div class="col-md-8">
      <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.favorite_nations'))->for('favorite_nations') }}
          <div class="input-group">
         
              <input type="text" id="search_data" name="fav_nation[]" placeholder="" autocomplete="off" class="form-control input-lg" value="@if($user_data->userdetail){{ $user_data->userdetail->fav_nation }} @endif"/>
             <!--  <div class="input-group-btn">
                  <button type="button" class="btn btn-primary btn-lg" id="search">Get Value</button>
              </div> -->
          </div>
          <br />
          <span id="country_name"></span>
      </div>
  </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.favorite_nations_want'))->for('favorite_nations') }}
            <div class="input-group">
                <input type="text" id="search_data1" name="fav_nation_want[]" placeholder="" autocomplete="off" class="form-control input-lg" value="@if($user_data->userdetail){{ $user_data->userdetail->fav_nation_want }} @endif" />
            </div>
            <br />
            <span id="country_name1"></span>
        </div>
    </div>
</div>
  <input type="hidden" name="role_type" value="travel_blogger">
 <div class="row">
   <div class="col-md-6">
        <div class="form-group">
        <label>Upload an identity document<h7 style="color: red;">*</h7></label>
        @if(!empty($user_data->userdetail->identity_document))
        {{ html()->file('userdetail.identity_document')
            ->class('form-control')
           ->autofocus()
        }}
     <input type="hidden" name="identity_document_hide" value="@if($user_data->userdetail){{isset($user_data->userdetail->identity_document)?$user_data->userdetail->identity_document:''}}@endif">
       @if(!empty($user_data->userdetail->identity_document) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->userdetail->identity_document)) )
          {{--<a href="{{url('uploads/frontend/doc/'.$user_data->userdetail->identity_document)}}" class="click_btn" target="_blank">Upload</a>--}}
       @endif
     @else
      {{ html()->file('userdetail.identity_document')
            ->class('form-control')
            ->autofocus()
      }}
     @endif
   </div><!--form-group-->
  </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.telephone_number'))->for('telephone_number') }}
               
               {{ html()->text('userdetail.telephone_number')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.telephone_number'))
                     ->autofocus()
                }}
         </div><!--form-group-->
      </div><!--col-->
 </div><!--row-->

  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
              <label>Vat Number<h7 style="color: red;">*</h7></label>
              {{ html()->text('userdetail_vat_number')
                   ->class('form-control')
                   ->placeholder(__('validation.attributes.frontend.vat_number'))
                   ->value(($user_data->userdetail ? $user_data->userdetail->vat_number : ''))
                   ->autofocus()
              }}
         </div><!--form-group-->
      </div><!--col-->
    <div class="col-md-6">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.personal_website'))->for('personal_website') }}
                 {{ html()->text('userdetail.personal_website')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.personal_website'))
                     ->autofocus()
                }}
              
         </div><!--form-group-->
      </div><!--col-->
  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.other'))->for('other') }}
            {{ html()->textarea('other')
               ->class('form-control')
               ->placeholder(__('validation.attributes.frontend.other'))
               ->attribute('maxlength', 250)
               ->value(($user_data->userdetail ? $user_data->userdetail->other : ''))
               ->autofocus() }}
           </div><!--form-group-->
      </div><!--col-->
  </div>
          @php
        if($user_data->userdetail){
           $explode_service=explode(',',$user_data->userdetail->blogger_service);
         }
         @endphp
 <div class="row">
      <div class="col">
          <div class="form-group">
           {{ html()->label(__('validation.attributes.frontend.service_term'))->for('service_term') }}
           <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Seo article" @if($user_data->userdetail)  @if(in_array('Seo article',$explode_service)) checked="" @endif @endif>{{ html()->label(__('validation.attributes.frontend.seo_article'))->for('vat_number') }}
           </div>
            {{--<div class="serv-input-sec">
                  <input type="checkbox" name="blogger_service[]" value="Introduction" @if($user_data->userdetail)  @if(in_array('Introduction',$explode_service)) checked="" @endif @endif>{{ html()->label(__('validation.attributes.frontend.introduction'))->for('vat_number') }}
                  </div>--}}
           <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Promotion Social" @if($user_data->userdetail)  @if(in_array('Promotion Social',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.promotion_social'))->for('promotion_social') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Take Over" @if($user_data->userdetail)  @if(in_array('Take Over',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.take_over'))->for('take_over') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Ad_hoc Format" @if($user_data->userdetail)  @if(in_array('Ad_hoc Format',$explode_service)) checked="" @endif @endif> 
            {{ html()->label(__('validation.attributes.frontend.ad_hoc_format'))->for('ad_hoc_format') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="Promotional Video" @if($user_data->userdetail)  @if(in_array('Promotional Video',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.promotional_video'))->for('promotional_video') }}
            </div>
            <div class="serv-input-sec">
            <input type="checkbox" name="blogger_service[]" value="blogger images" @if($user_data->userdetail)  @if(in_array('blogger images',$explode_service)) checked="" @endif @endif>
            {{ html()->label(__('validation.attributes.frontend.blogger_images'))->for('blogger_images') }}
            </div>
           </div>
        </div>
   </div>

  <div class="row">
    <div class="col">
        <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.social_link'))->for('social_link') }}
                </br>
                <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Facebook</label>
                          {{ html()->text('userdetail.fb_link')
                                 ->class('form-control')
                                 ->autofocus() }}
                       </div><!--form-group-->
                  </div><!--col-->
              
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Twitter</label>
                           {{ html()->text('userdetail.twitter_link')
                                 ->class('form-control')
                                 ->autofocus() }}
                        </div><!--form-group-->
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="last_name">Instagram</label>
                          {{ html()->text('userdetail.insta_link')
                                 ->class('form-control')
                                 ->autofocus() }}
                      </div><!--form-group-->
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label for="last_name">Pinterest</label>
                           {{ html()->text('userdetail.pinterest_link')
                                 ->class('form-control')
                                 ->autofocus() }}
                       </div><!--form-group-->
                  </div><!--col-->
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Tiktok</label>
                           {{ html()->text('userdetail.tiktok_link')
                                 ->class('form-control')
                                 ->autofocus() }}
                         </div><!--form-group-->
                  </div><!--col-->
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Youtube</label>
                          {{ html()->text('userdetail.youtube_link')
                                 ->class('form-control')
                                 ->autofocus() }}
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
          @if(!empty($user_data->userdetail->signed_doc) && file_exists(public_path('uploads/frontend/pdf/signdoc'.'/'.$user_data->userdetail->signed_doc)) )
               <a href="{{url('uploads/frontend/pdf/signdoc/'.$user_data->userdetail->signed_doc)}}" class="click_btn" target="_blank">Click here</a>
           @endif
         </div>
       </div>
     </div>
  </div>
  <ul class="nav nav-tabs">
        
       <li class="nav-item ml-auto">
            <a class="nav-link" data-toggle="tab" href="#third_step" id="button1"><i class="fa fa-arrow-right"></i> Go To Third Page</a>
        </li>
    </ul>


   