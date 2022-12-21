@extends('backend.layouts.app')
@section('title', app_name() . ' | ' . __('labels.backend.access.travelcateg.show-travel'))

@section('breadcrumb-links')
    @include('backend.travelcateg.includes.breadcrumb-links')
@endsection
@section('content')
<div class="card">
    <div class="card-body">

    </div><!--card-body-->
</div><!--card-->
@endsection
