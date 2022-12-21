@extends('frontend.layouts.travelmaker')

@section('content')
<style>
.control-banner img {
    width: 100%;
    height: 560px;
}
</style>
<div class="inner-banner control-banner">
<!-- <img src="{{url('img/frontend/banner2.jpg')}}">   -->
<img src="{{url('img/frontend/banner-img.png')}}">
</div>

            
</div> 
<div class="account-section mx-50">
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col col-sm-10">
            <div class="card">
               

                <div class="card-body">
                    <div class="account-form">

                        <h4 style="color: #005ca9;margin-bottom: 20px;text-align: center;">Public Card</h4>
                        {{ html()->form('POST', route('frontend.user.public_card.save'))->attribute('enctype','multipart/form-data')->open() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.departure_from_date'))->for('departure_from_date') }}
                                    {{ html()->date('departure_from_date')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.departure_to_date'))->for('departure_to_date') }}
                                    {{ html()->date('departure_to_date')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.price'))->for('trip_start') }}
                                    {{ html()->number('price')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.payment_percentage'))->for('payment_percentage') }}
                                    {{ html()->number('payment_percentage')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.min_participants'))->for('min_participants') }}
                                    {{ html()->number('min_participants')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.max_participants'))->for('max_participants') }}
                                    {{ html()->number('max_participants')
                                        ->class('form-control')
                                         }}
                                 </div>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group senti-list">
                                   {{ html()->label(__('validation.attributes.frontend.travel_report.payment_option'))->for('payment_option') }}
                                       
                                        <div class="input-sec bank">
                                            <input type="radio" name="payment_option" value="bank" >Bank
                                        </div>
                                       
                                        <div class="input-sec online">
                                            <input type="radio" name="payment_option" value="online">Online
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="bank_details" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.name_on_card'))->for('name_on_card') }}
                                    {{ html()->text('name_on_card')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.card_number'))->for('card_number') }}
                                    {{ html()->number('card_number')
                                        ->class('form-control')
                                         }}
                                 </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.expiry_month'))->for('expiry_month') }}
                                   
                                   <select id="month" name="expiry_month" style="height: 44px;" class="form-control">
                                        <option >Select</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                 </div>
                             </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.expiry_year'))->for('expiry_year') }}
                                 <select id="year" name="expiry_year" style="height: 44px;" class="form-control">
                                    <option >Select</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                                 </div>
                             </div>
                        </div>
                      <div class="row"  id="paypal" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.travel_report.paypal_id'))->for('paypal_id') }}
                                    {{ html()->text('paypal_id')
                                        ->class('form-control')
                                        ->required() }}
                                 </div>
                             </div>
                         </div>
                          <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix login-fbtn">
                                    {{ form_submit(__('labels.frontend.public_card.button'))->class('more_btn')}}
                                </div>
                            </div>
                        </div>
                   
                   {{ html()->form()->close() }}
                    </div>
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
  </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() { 
     $( ".bank" ).click(function() {
       $('#bank_details').show();
       $('#paypal').hide();
       $('#paypal_id').removeAttr('required'); 
     });
      $( ".online" ).click(function() {
       $('#paypal').show();
       $('#bank_details').hide();
       $('#name_on_card').removeAttr('required'); 
     });
 });
</script>
@endsection
