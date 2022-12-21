<style> 
    .term_condition{
        float: left;
        margin: 5px;
    }
    label.condition_text {
    cursor: pointer;
    text-decoration: underline;
}
.account-form .nav-tabs {
    border-bottom: 1px solid #fff;
    width: 100%;
    margin-bottom: 20px;
}
</style>
<div class="row"> 
    <!-- Tab panes -->
    <div class="tab-content" style="width: 100%;">
        <div class="container stepper" id="first_step">
            @include('frontend.traveler.account.tabs.first_step')
        </div>
        <div class="container stepper d-none" id="second_step">
            @include('frontend.traveler.account.tabs.second_step')
        </div>
        <div class="container stepper d-none" id="third_step">
            @include('frontend.traveler.account.tabs.third_step')
        </div>
    </div>
</div>

<script type="text/javascript">

    function changeStep(stepId) {
        $(".stepper").addClass("d-none");
        $(stepId).removeClass("d-none");
    }

</script>




    
  