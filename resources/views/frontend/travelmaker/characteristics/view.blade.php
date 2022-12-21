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
          <p><b>Terms of use:</b></p>
             <p>The user agrees to share images collected in first person (independently made with cameras, video cameras or smartphones) and of which he holds all rights.</p>
              <p>The user responds directly to the published images and declares to have the consent of the people portrayed in the images published by him.</p>
              <p>The user is responsible for the information published by him and declares to have collected it during direct experiences.</p>

              <p>The user owns the images published by him which will remain stored on the "Travel Maker" site</p>
              <p>- until the user cancels them (partial cancellation or modification of the "Travel Report")</p>
              <p>- until the user decides to delete his profile from Travel Maker (total cancellation and permanent cancellation of the account).</p>
              <p>In case of deletion of the profile (account) all the contents published by the user will be deleted and can no longer be recovered.</p>

              <p><b>Rules:</b></p>

              <p>The information shared in the "Travel Reports" must be real and verified.</p>

              <p><b>Images containing:</b></p>

              <p>- Text: no text is allowed in the images. The description of the images is limited to the caption to be filled in directly on "Travel Maker".</p>
              <p>- Logos and Watermarks are not allowed.</p>
              <p>- Obviously promotional images (in which signs or legible tables of commercial activities or accommodation facilities are easily recognizable).</p>
              <p>- Images depicting naked bodies or offending common morals.</p>
              <p>- Images that enhance potentially dangerous behaviors (Extreme Sports, dangerous or extreme Selfies).</p>
              <p>- Images that enhance the use of alcohol, drugs or tobacco.</p>
              <p>- Images showing firearms or edged weapons.</p>
              
              <p><b>Travel Report:</b></p>
              <p>- To register as a "Travel Maker", the user must provide additional information necessary to protect the community from fraud or deception.</p>
              <p>- The user registered as "Travel Maker" has the possibility to create "Travel Report" as the "Traveler profile" for the sole purpose of sharing the information collected during his travels.</p>
              <p>- The user registered as a "Travel Maker" also has the possibility to create "Travel Proposal" and "Travel Diaries".</p>
              <p>- Travel Porposal: It is a travel report similar to the others but which contains the invitation to participate in a trip organized by the "Travel Maker" who proposes himself as "Tour Leader".</p>
              <p><b>"Tour Leader" obligations</b></p>
              <p>- Organize the trip in every detail by referring to the information collected directly in previous travel experiences.</p>
              <p>- Coordinate the movements of the Group: round trip, transfer during the trip, all the activities included in the program proposed by him.</p>
              <p>- Pay for all the services included in the travel program proposed by him.</p>
              <p>- Pay 2,5% of the individual travel quotas (including yours) to Travel Maker. Participants send the dues to him and he sends a single payment to Travel Maker.
               Responsibility of the "Tour Leader"</p>
              <p>- The Tour Leader is not a professional guide or travel agent. He is a traveler like all the other participants. He therefore has no obligations towards the participants and is in all respects a participant in the holiday like everyone else. Once the above listed obligations have been fulfilled, it is in effect "on vacation" like all the other participants.</p>
              <p>- The "Tour Leader" shares the experiences and information collected in his previous trips. It is not responsible for disservices or setbacks that occurred during the trip / vacation but is committed to providing directions and suggestions to other participants.</p>
              <p>- The Tour Leader signs an agreement in which he declares not to carry out activities for profit. The trips he organizes are for the sole purpose of sharing expenses and entertainment by taking advantage of his previous experiences.</p>

              <p><b>Travel Diaries:</b></p>
              <p>- The user registered as "Travel Maker" has the possibility to publish "Travel Diaries".</p>
              <p>- "Travel Diaries" are downloadable documents containing all the information necessary to organize and repeat the travel experiences documented by him in total autonomy.</p>
              <p>- The "Travel Diaries" can be "free" (available to all users through the download option) or paid with a single and equal rate for all of € 3.00. (Amount paid by users directly to the "Travel Maker" in the manner chosen by him).</p>
              <p>- User registered as a "Travel Maker" has the possibility to choose, during the publication phases, whether to make the document available for free or for a fee.</p>
              <p>- The document is drawn up following a guided procedure. The fields are compulsory and the "Travel Maker" cannot publish it if not completely completed.
                 Users who register on the "Travel Maker" website in the role of "Travel Maker" accept and subscribe to these general rules and declare that they have read and signed the conditions of use described</p>

            
           
               <div class="">
              <!-- <input type="checkbox" class="term-ckeck"><p class="term-text"> ACCEPT THE TERMS OF USE</p> -->
              </div>
              <div class="btns-div">
              @if($user = Auth::user())
                  <!-- <input type="button" class="btn more_btn acceptbtn" value="ACCEPT"> -->
              @else
              <!-- <input type="button" class="btn more_btn acceptbtnwthout" value="ACCEPT"> -->
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