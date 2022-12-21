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

                    <p>-Text: no text is allowed in the images. The description of the images is limited to the caption to be filled in directly on "Travel Maker".</p>
                    <p>-Logos and Watermarks are not allowed.</p>
                    <p>- Obviously promotional images (in which signs or legible tables of commercial activities or accommodation facilities are easily recognizable).</p>
                    <p>-Images depicting naked bodies or offending common morals.</p>
                    <p>-Images that enhance potentially dangerous behaviors (Extreme Sports, dangerous or extreme Selfies).</p>
                    <p>-Images that enhance the use of alcohol, drugs or tobacco.</p>
                    <p>-Images showing firearms or edged weapons.</p>
                   
                    <div class="">
                    <!-- <input type="checkbox" class="term-ckeck" required><p class="term-text"> ACCEPT THE TERMS OF USE</p> -->
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
    
</script>
<script> 
    $(document).ready(function() { 
        $(".acceptbtn").click(function() { 
            if($(".term-ckeck").is(':checked')){
                sessionStorage.setItem("tc",1);
                window.location.href = "{{url('account')}}";
            } 
            else{ 
                sessionStorage.setItem("tc",0);
                alert("Check box is Unchecked"); 
            } 
        }); 
        
        $(".acceptbtnwthout").click(function() { 
            if($(".term-ckeck").is(':checked')){
                //const queryString = window.location.search;
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