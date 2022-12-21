@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
  #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }

</style>
<div class="inner-banner control-banner">
<!-- <img src="{{url('img/frontend/banner2.jpg')}}">   -->
    <img src="{{url('img/frontend/banner-img.png')}}">
</div>
   <!-- Begin Mailchimp Signup Form -->

<div class="account-section mx-50">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div id="mc_embed_signup">
                        <form action="https://gmail.us10.list-manage.com/subscribe/post?u=047345851fa9e7256d1545fd0&amp;id=7286d9907d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                          <div id="mc_embed_signup_scroll">
                             <h2>Subscribe</h2>
                            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                               <div class="mc-field-group">
                                   <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>   </label>
                                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                               </div>
                               <div id="mce-responses" class="clear">
                                  <div class="response" id="mce-error-response" style="display:none"></div>
                                  <div class="response" id="mce-success-response" style="display:none"></div>
                               </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                  <input type="text" name="b_047345851fa9e7256d1545fd0_7286d9907d" tabindex="-1" value="">
                                </div>
                                <div class="clear">
                                  <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style="background-color: #1757ac;">
                                </div>
                           </div>
                        </form>
                    </div>
                </div>
             </div>
          </div>
      </div>
  </div>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->

 
@endsection