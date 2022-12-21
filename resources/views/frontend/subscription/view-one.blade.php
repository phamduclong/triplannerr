@extends('frontend.layouts.travelmaker')
@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

@include('frontend.includes.travelmaker.home_slider')
<style>
.service-box{
margin: 15px auto 80px;
padding: 0 78px;
/*height: 440px;*/
height: auto;

text-align: center;
}
.pattern_img h2 {
font-size: 25px;
color: #005ca9;
margin: 15px auto;
}
.pattern_img h4 {
font-size: 25px;
color: #005ca9;
margin: 15px auto;
}
</style>

<div class="login-section login_option">
  <div class="row" style="margin-top: -30px">
    <div class="col-md-5"></div>
    <div class="col-md-5"><h3 style="margin-left: -100px">Subscribe your Memberschip Plan</h3></div>
  </div>
  <div class="container">
    <div class="tab-content">
      <div id="tab_1" class="tab-pane fade show active"  role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-3 col-sm-6 pd5">
                    <div class="boarding_effect">
                        <div class="pattern_img">
                            <h2>Monthly</h2>
                            <hr/>
                            <h4>€ 60.00</h4>
                        </div>
                        <div class="service-box">Monthly €60.00</div>
                        <div class="pkg-btn-div">
                            {{-- <button class="btn user_login gr-btn">Select</button> --}}
                            <div id="paypal-button-container-P-0UD350424U152170KML5F6PA"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 pd5">
                    <div class="boarding_effect">
                        <div class="pattern_img">
                            <h2>Quarterly</h2>
                            <hr/>
                            <h4>€ 160.00</h4>
                        </div>
                        <div class="service-box">Quarterly €160.00</div>
                        <div class="pkg-btn-div">
                            {{-- <button class="btn user_login gr-btn">Select</button> --}}
                            <div id="paypal-button-container-P-5SD9196139556603EML5F77A"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 pd5">
                    <div class="boarding_effect">
                        <div class="pattern_img">
                            <h2>Half-yearly</h2>
                            <hr/>
                            <h4>€ 320.00</h4>
                        </div>
                        <div class="service-box">Half-yearly €320.00</div>
                        <div class="pkg-btn-div">
                            {{-- <button class="btn user_login gr-btn">Select</button> --}}
                            <div id="paypal-button-container-P-8D9311541D262824FML5GB5Q"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 pd5">
                    <div class="boarding_effect">
                        <div class="pattern_img">
                            <h2>Annual</h2>
                            <hr/>
                            <h4>€ 640.00</h4>
                        </div>
                        <div class="service-box">Annual €640.00</div>
                        <div class="pkg-btn-div">
                            {{-- <button class="btn user_login gr-btn">Select</button> --}}
                            <div id="paypal-button-container-P-6D039230H86176946ML5GCQI"></div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
  </div>
</div>
@endsection


<script src="https://www.paypal.com/sdk/js?client-id=ARemuoAxIFtIPr4flD6nde6rmsU3DfPXnvPqa1i7wjiFPDCf4aN8LmXs4_bmTlOu4LOyKQ1ZmROghqrJ&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-0UD350424U152170KML5F6PA'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-0UD350424U152170KML5F6PA'); // Renders the PayPal button
</script>

{{-- <script src="https://www.paypal.com/sdk/js?client-id=ARemuoAxIFtIPr4flD6nde6rmsU3DfPXnvPqa1i7wjiFPDCf4aN8LmXs4_bmTlOu4LOyKQ1ZmROghqrJ&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> --}}
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-5SD9196139556603EML5F77A'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-5SD9196139556603EML5F77A'); // Renders the PayPal button
</script>


{{-- <script src="https://www.paypal.com/sdk/js?client-id=ARemuoAxIFtIPr4flD6nde6rmsU3DfPXnvPqa1i7wjiFPDCf4aN8LmXs4_bmTlOu4LOyKQ1ZmROghqrJ&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> --}}
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-8D9311541D262824FML5GB5Q'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-8D9311541D262824FML5GB5Q'); // Renders the PayPal button
</script>


{{-- <script src="https://www.paypal.com/sdk/js?client-id=ARemuoAxIFtIPr4flD6nde6rmsU3DfPXnvPqa1i7wjiFPDCf4aN8LmXs4_bmTlOu4LOyKQ1ZmROghqrJ&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> --}}
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-6D039230H86176946ML5GCQI'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-6D039230H86176946ML5GCQI'); // Renders the PayPal button
</script>
