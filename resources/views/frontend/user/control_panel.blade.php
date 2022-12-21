@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
 
    @if(Auth::user()->role_type =='traveler')
        @include('frontend.traveler.control_panel.view')
    @endif
    @if(Auth::user()->role_type =='travel_maker')
        @include('frontend.travelmaker.control_panel.view')
    @endif
    @if(Auth::user()->role_type =='travel_blogger')
        @include('frontend.travelblogger.control_panel.view')
    @endif
    @if(Auth::user()->role_type =='travel_agency')
        @include('frontend.travelpro.control_panel.view')
    @endif

    <script>
    function load_data(obj)
    {
        var id = $(obj).attr('id');
        var text = $( "#"+id+" option:selected" ).text();
        var value = $(obj).val();
        $('#'+id+'_a').html(text);
    }
</script>
@endsection
