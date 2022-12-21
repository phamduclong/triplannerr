<!DOCTYPE html>
@langrtl
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', app_name())">
        <meta name="author" content="@yield('meta_author', 'WDP Technologies Pvt. Ltd.')">
        @yield('meta')

        @stack('before-styles')
        {{ style(mix('css/frontend.css')) }}
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        {{ style('css/frontend/dataTables.bootstrap4.min.css')}}
        {{ style('css/frontend/responsive.bootstrap4.min.css')}}
        {{ style('css/frontend/font-awesome.min.css') }}
        {{ style('css/frontend/bootstrap.min.css') }}
        {{ style('css/frontend/owl.carousel.css') }}
        {{ style('css/frontend/owl.theme.css') }}
        {{ style('css/frontend/style.css') }}
        {{ style('css/frontend/responsive.css') }}
        {!! script('js/frontend/jquery.min.js') !!}
        {!! script('js/frontend/jquery.dataTables.min.js')!!}

        {!! script('js/frontend/d3/d3.v3.min.js')!!}
        {!! script('js/frontend/d3/topojson.v1.min.js')!!}
        {!! script('js/frontend/datamaps/datamaps.world.min.js')!!}

        @stack('after-styles')
    </head>
    <body>
      @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('frontend.includes.travelmaker.header')
        @include('includes.partials.messages')
        @yield('content')

        @include('frontend.includes.travelmaker.main_footer')

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script('js/frontend/popper.min.js') !!}
        {!! script('js/frontend/bootstrap.min.js') !!}
        {!! script('js/frontend/jquery.dataTables.min.js')!!}
        {!! script('js/frontend/dataTables.bootstrap4.min.js')!!}
        {!! script('js/frontend/dataTables.responsive.min.js')!!}
        {!! script('js/frontend/responsive.bootstrap4.min.js')!!}


        <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    {{--
    <script>
    $(document).ready(function() {
      $('.owl-demo').owlCarousel({
          items : 1,
          itemsDesktop : [1199,1],
          itemsDesktopSmall : [979,1],
          itemsTablet : [768,1],
          itemsTabletSmall: [767,1],
          navigation : true,
          pagination : false,
          navigationText : false,
          autoPlay : true,
          center: true,
      });
    });
    </script>

         <script>
            $(document).ready(function() {
              $('#owl-demo1').owlCarousel({
                  items : 5,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3],
                  itemsTablet : [768,3],
                  itemsTabletSmall: [767,2],
                  itemsTabletSmall: [600,1],
                  navigation : true,
                  pagination : false,
                  navigationText : false,
                autoPlay : true,
              });

            });
        </script>
        <script>
            $(document).ready(function() {
              $('#owl-demo2').owlCarousel({
                  items : 5,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3],
                  itemsTablet : [768,3],
                  itemsTabletSmall: [767,2],
                  itemsTabletSmall: [600,1],
                  navigation : true,
                  pagination : false,
                  navigationText : false,
                  autoPlay : true,
              });

            });
        </script>

        <script>
            $(document).ready(function() {
              $('#owl-demo3').owlCarousel({
                  items : 5,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3],
                  itemsTablet : [768,3],
                  itemsTabletSmall: [767,2],
                  itemsTabletSmall: [600,1],
                  navigation : true,
                  pagination : false,
                  navigationText : false,
                  autoPlay : true,
              });

            });
        </script>
        --}}
        <script>
        $(document).ready(function() {
            // $('#example').DataTable();
            // $('#example1').DataTable()
            // $('#example2').DataTable()
            // $('#example3').DataTable()
        } );
        </script>
        @stack('after-scripts')
    </body>
