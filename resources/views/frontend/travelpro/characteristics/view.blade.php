<style>
   .profile-inner {
    background: #fff;
    margin-top: 0px !important;
    display: inline-block;
    width: 100%;
    position: relative;
    box-shadow: 0px 0 10px #ddd;
}
.condition-info {
    padding: 80px;
}
input.term-ckeck {
    float: left;
}
.term-text{
  margin-left: 32px;
    font-size: 12px;
}
  </style>
<div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
    <div class="row">
       <div class="form-group condition-info">
          <p> To register as "Travel PRO" the user must provide additional information necessary to protect the community. "Travel Maker" recognizes the registration as "Travel PRO"</p>
          <p>- only to professionals who demonstrate that they carry out professional activity according to the regulations in force in the countries of residence.</p>
          <p>- only to professionals who send the documentation requested in the registration phase</p>
          <p>Any refusal to register will be motivated.</p>
          <p>The number of members as "Travel PRO" is limited compared to "Traveler" and "Travel Maker". Registration requests that cannot be accepted to maintain 
            the right proportion will be put on hold in chronological order and accepted as soon as the correct proportion is restored.</p>

          <p><b>Terms of use:</b></p>
             <p>The user agrees to share images collected in first person (independently made with cameras, video cameras or smartphones) and of which he holds all rights.</p>
              <p>The user responds directly to the published images and declares to have the consent of the people portrayed in the images published by him.</p>
              <p>The user is responsible for the information published by him and declares to have collected it during direct experiences.</p>

              <p>The user owns the images published by him which will remain stored on the "Travel Maker" site</p>
              <p>- until the user cancels them (partial cancellation or modification of the "Travel Report")</p>
              <p>- until the user decides to delete his profile from Travel Maker (total cancellation and permanent cancellation of the account).</p>
              <p>In case of deletion of the profile (account) all the contents published by the user will be deleted and can no longer be recovered.</p>
              
              <p>Registration as "Travel PRO" is conditional on the payment of a monthly fee of € 60.00. Annual or quarterly season tickets are provided.</p>

              <p><b>Rules:</b></p>

              <p>The information shared in the "Travel Reports" must be real and verified.</p>

              <p><b>Images containing:</b></p>
              <p>- Images depicting naked bodies or offending common morals.</p>
              <p>- Images that enhance potentially dangerous behaviors (Extreme Sports, dangerous or extreme Selfies).</p>
              <p>- Images that enhance the use of alcohol, drugs or tobacco.</p>
              <p>- Images showing firearms or edged weapons.</p>
              
              <p>The user registered as "Travel PRO" publishes offers directly aimed at users and has the right to enter all the contact details necessary to initiate direct contacts with other users.</p>
              <p><b>Collaborations:</b></p>
              <p>- The user registered as "Travel PRO" has the right to receive and send "Collaboration Requests" to users registered as "Travel Blogger".</p>
              <p>- The "Travel PRO" can send an unlimited number of requests to the "Travel Blogger" while it can receive a maximum of three monthly requests from each of the "Travel Blogger".</p>
              <p>- To register as a "Travel Blogger" the user must also send all the required documents, download and sign and resend the private agreement with "Travel Maker.info"</p>
              <p>- Users who register on the "Travel Maker" website in the role of "Travel Blogger" accept and subscribe to these general rules and declare that they have read and signed the conditions of use described on the Policy page.</p>
              
              <div class="">
              <!-- <input type="checkbox" class="term-ckeck"><p class="term-text"> ACCEPT THE TERMS OF USE</p> -->
              </div>
              <div class="btns-div">
              @if($user = Auth::user())
                  <!-- <input type="submit" class="btn more_btn acceptbtn" value="ACCEPT"> -->
              @else
              <!-- <input type="submit" class="btn more_btn acceptbtnwthout" value="ACCEPT"> -->
              @endif
              </div>
      </div>   
     </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script> 
$(document).ready(function() { 
    $(".acceptbtn").click(function() { 
        if($(".term-ckeck").is(':checked')){
            sessionStorage.setItem("tc",1);
            window.location.href = "{{url('account')}}";
        } else{ 
            sessionStorage.setItem("tc",0);
            alert("Check box is Unchecked"); 
        } 
    }); 
    $(".acceptbtnwthout").click(function() { 
        if($(".term-ckeck").is(':checked')){
            var queryParams = new URLSearchParams(window.location.search);
            queryParams.set("approval_status", "1");
            sessionStorage.setItem("tc",1);
            window.location.href = "{{url('register/')}}"+"?"+queryParams+'&tc_approved=1';
        } else { 
            sessionStorage.setItem("tc",0);
            alert("Check box is Unchecked"); 
        }
    }); 
});  
          
</script>
