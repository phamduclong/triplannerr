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
@if(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif
<div class="row">
    <ul class="nav nav-tabs">
        <!-- <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#first_step">First step</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#second_step">Second step</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#third_step">Third Step</a>
        </li> -->
    </ul>
    <!-- Tab panes -->

    <div class="tab-content">
        <div class="tab-pane container active" id="first_step">
            @include('frontend.travelblogger.account.tabs.first_step')
        </div>
        <div class="tab-pane container fade" id="second_step">
            @include('frontend.travelblogger.account.tabs.second_step')
        </div>
        <div class="tab-pane container fade" id="third_step">
            @include('frontend.travelblogger.account.tabs.third_step')
        </div>
    </div>
</div>


 