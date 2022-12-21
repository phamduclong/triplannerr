<!doctype html>

<html lang="it">

<head>
  	<meta charset="utf-8">
    <meta property="og:site_name" content="Triplannerr.com">
    <meta name="language" content="it">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" class="favicon" href="/images/favicon.png">
    
    <!-- Meta tag per la SEO -->
    @section('meta_head')
    @show

    <link href="/css/global.css" rel="stylesheet">

    <!-- CSS di ogni singola pagina -->
    @section('css')
    @show
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

</head>

<body>

    @include('frontend_v2.partials.header')

    @section('content')
    @show

    @include('frontend_v2.partials.footer')

</body>


@section('scripts')
@show

</html>
