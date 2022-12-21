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
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

            {{ html()->text('last_name')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.last_name'))
                ->attribute('maxlength', 191)
                ->required() }}
        </div>
    </div>
</div>
 
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.user_name'))->for('user_name') }}

            {{ html()->text('user_name')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.user_name'))
                ->attribute('maxlength', 191)
            }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.phone_no'))->for('phone_no') }}
            
            {{ html()->text('userdetail.phone_no')
                 ->class('form-control')
                 ->placeholder(__('validation.attributes.frontend.phone_no'))
                 ->autofocus()
            }}  
        </div>
    </div>
</div>

@php
    $birth_date = '';
    if($user_data && !empty($user_data->userdetail)){
        $birth_date=date("m/d/Y", strtotime($user_data->userdetail->birth_place));
    }
@endphp

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.birth_place'))->for('birth_place') }}

            <input type="date" name="birth_place" value="@if($user_data){{isset($birth_date)?date('Y-m-d',strtotime($birth_date)):''}}@endif" placeholder="@lang('validation.attributes.frontend.birth_place')" class="form-control" date-format="mm/dd/yyyy"> 
        </div>
    </div>
</div>


@php
    $sex = '';
    if($user_data && !empty($user_data->userdetail)){
        $sex=date("m/d/Y", strtotime($user_data->userdetail->sex));
    }
@endphp
<div class="row">
    <div class="col">
        <div class="form-group senti-list">
            {{ html()->label(__('validation.attributes.frontend.sex'))->for('sex') }}

             <div class="input-sec">
                  
                 <input type="radio" name="sex" value="male" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='male') checked=""  @endif @endif>Male

                </div>
                 <div class="input-sec">
                 <input type="radio" name="sex" value="female" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail) @if($user_data->userdetail->sex=='female') checked=""  @endif @endif>Female

             </div>
             <div class="input-sec">
                 <input type="radio" name="sex" value="custom" placeholder="validation.attributes.frontend.sex" @if($user_data->userdetail)
                 @if($user_data->userdetail->sex=='custom') checked=""  @endif @endif>I don't want to say
                 </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.place_of_residence'))->for('place_of_residence') }}
            
            {{ html()->textarea('userdetail.place_of_residence')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.place_of_residence'))
                ->attribute('maxlength', 191)
                ->autofocus() 
            }}
        </div>
    </div>
</div>

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
          <span id="country_name1"></span>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.favorite_nations_want'))->for('favorite_nations') }}
            <div class="input-group">
                <input type="text" id="search_data1" name="fav_nation_want[]" placeholder="" autocomplete="off" class="form-control input-lg" value="{{ isset($user_data->userdetail) ? $user_data->userdetail->fav_nation_want: '' }}" />
            </div>
            <br />
            <span id="country_name1"></span>
        </div>
    </div>
</div>

   
<input type="hidden" name="role_type" value="travel_maker">
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.classification_of_travel_report'))->for('classification_of_travel_report') }}
                  
            {{ html()->textarea('userdetail.classification_travel_report')
                     ->class('form-control')
                     ->placeholder(__('validation.attributes.frontend.classification_of_travel_report'))
                     ->attribute('maxlength', 191)
                     ->autofocus() }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.photo_valid_identity_doc'))->for('photo_valid_identity_doc') }}
        </div>
    </div>
</div>
     
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ html()->file('userdetail.front_identity_doc')
                    ->class('form-control')
                    ->autofocus()
            }}
            {{--@if(!empty($user_data->front_identity_doc) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->front_identity_doc)) )
                <a href="{{url('uploads/frontend/doc/'.$user_data->userdetail->front_identity_doc)}}" target="_blank" class="click_btn">Click here</a>
            @endif--}}
            <input type="hidden" name="front_identity_doc_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data){{isset($user_data->userdetail->front_identity_doc)?$user_data->userdetail->front_identity_doc:''}}@endif">
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
           
            {{ html()->file('userdetail.back_identity_doc')
                        ->class('form-control')
                        ->autofocus()
            }}
                    
            {{--@if(!empty($user_data->userdetail->back_identity_doc) && file_exists(public_path('uploads/frontend/doc'.'/'.$user_data->userdetail->back_identity_doc)) )
                <a href="{{url('uploads/frontend/doc/'.$user_data->userdetail->back_identity_doc)}}" target="_blank" class="click_btn">Click here</a>  
            @endif--}} 
            <input type="hidden" name="back_identity_doc_hide" placeholder="validation.attributes.frontend.doc_upload" value="@if($user_data){{isset($user_data->userdetail->back_identity_doc)?$user_data->userdetail->back_identity_doc:''}}@endif">
        </div>
    </div>
</div>

 <div class="row">
    <div class="col">
         <div class="form-group input-sec">
            <a href= "javascript:void(0)">Signing of Commitment to organize travel only to share expenses with other travelers</a>
            {{-- <input type="checkbox" name="sign_organize" value="Commitment to organize travel" @if($user_data->userdetail) @if($user_data->userdetail->sign_organize=='Commitment to organize travel') checked=""  @endif @endif>  Signing of Commitment to organize travel only to share expenses with other travelers
            --}}
         </div>
      </div>
 </div>

 <div class="row">
    <div class="col">
        <div class="form-group input-sec">
            <a href= "javascript:void(0)">Signing of Commitment to be the groups tour leader during the trip</a>
            {{-- 
            <input type="checkbox" name="sign_tour_leader" value="Commitment to be the groups" @if($user_data->userdetail) @if($user_data->userdetail->sign_tour_leader=='Commitment to be the groups') checked=""  @endif  @endif>  Signing of Commitment to be the groups tour leader during the trip
            --}}
        </div>
    </div>
</div>
  

<div class="row">
    <div class="col">
        <div class="form-group input-sec">
            <a href= "javascript:void(0)">Signing of the agreement to recognize the site 2.5% of the travel fees paid by users who buy his tour</a>
            {{--<input type="checkbox" name="sign_agreement_recognize" value="agreement to recognize the site" @if($user_data->userdetail) @if($user_data->userdetail->sign_agreement_recognize=='agreement to recognize the site') checked=""  @endif @endif>  Signing of the agreement to recognize the site 2.5% of the travel fees paid by users who buy his tour--}}
         </div>
    </div>
</div>
   

<div class="row">
    <div class="col">
        <div class="form-group input-sec">
            {{ html()->label('To complete the registration procedure, download the document, sign and send the signed copy.')->for('pdf_declaration_form') }}
            <br>
            <div class="col-md-6" style="float:left">
                <button class="doc_download_btn"> <a href="{{ url('img/doc/TRAVELMAKER _Doc.pdf')}}" download target="_blank">Document download</a></button>
            </div>
            <div class="col-md-6" style="float:left">
                <input type="file" name="signed_doc" value="">
                @if(!empty($user_data->signed_doc) && file_exists(public_path('uploads/frontend/pdf'.'/'.$user_data->userdetail->signed_doc)) )
                    <a href="{{url('uploads/frontend/pdf/'.$user_data->signed_doc)}}" target="_blank" class="click_btn">Click here</a>
                @endif
            </div>
        </div>
    </div>
</div>
    <ul class="nav nav-tabs" style="margin-left: 47pc;">
        
       <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#third_step"><i class="fa fa-arrow-right"></i> Go To Third Page</a>
        </li>
    </ul>

    