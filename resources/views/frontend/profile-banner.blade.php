<div class="account-section mx-50">
    <div class="container-fluid1">
        <div id="map1" style="position: relative; margin: 0 auto; width: 90%; height: 500px;"></div>
        <div class="mt-5 d-flex justify-content-center">
            {{-- <div class="p-3" style="background-color: #149ece; color: #fff;">(Favourite Visited Countries)</div>
            <div class="p-3" style="background-color: #bd0000; color: #fff;">(Countries Wishlist)</div> --}}
            <div class="p-3" style="background-color: #149ece; color: #fff;">(Country Of Departure)</div>
            <div class="p-3" style="background-color: #bd0000; color: #fff;">(Destination Countries)</div>
        </div>
    </div>
</div>

@php
    if (0 && isset($userdata)) {
        $fav_nations = explode(",", $userdata->fav_nation);
        $fav_countries = '';
        foreach ($fav_nations as $key => $value) {
            $fav_country = DB::table('countries')->where('name', trim($value))->first();
            if ($fav_country && $fav_country->cod) $fav_countries .= $fav_country->cod.": {fillKey: 'visited'},";
        }

        $fav_nations_want = explode(",", $userdata->fav_nation_want);
        $wish_countries = '';
        foreach ($fav_nations_want as $key => $value) {
            $wish_country = DB::table('countries')->where('name', trim($value))->first();
            if ($wish_country && $wish_country->cod) $wish_countries .= $wish_country->cod.": {fillKey: 'wish'},";
        }

        echo '<script>';
        echo 'COUNTRIES = {'.$fav_countries.$wish_countries.'}';
        echo '</script>';
    }
@endphp
<script>

// COUNTRIES =
// {
//     IT: {fillKey: 'visited'},
//     USA: {fillKey: 'visited'},
//     THA: {fillKey: 'visited'},

//     FRA: {fillKey: 'wish'},
// }

// CITIES =
// [
//    {name: 'Venice', latitude: 45.4408, longitude: 12.3155, radius: 3, fillKey: 'city', date: '1963-10'},
//    // Not really a city, but we define just one type of "POI" (fillKey here) in index.html, you can define more.
//    {name: 'Khao Phing Kan', latitude: 8.2745, longitude: 98.5012, radius: 3, fillKey: 'city', date: '1974-12'},
//    {name: 'San Francisco', latitude: 37.7749, longitude: -122.4194, radius: 3, fillKey: 'city', date: '1985-05'},
// ]
(function() {
   // your page initialization code here
   // the DOM will be available here


    var map = new Datamap({
        // scope: 'world',
        element: document.getElementById('map1'),
        // projection: 'mercator',
        responsive: true,
        // height: 900,
        fills: {
            defaultFill: '#f2f2f2',
            wish: '#bd0000',
            visited: '#149ece',
            city: '#FC8050'
        },
        geographyConfig: {
            highlightOnHover: true,
            highlightFillColor: '#A0C0A0',
            highlightBorderColor: '#F0F0F0',
            popupOnHover: true,
            popupTemplate: function(geography, data) {
                return '<div class="hoverinfo"><b>' + geography.properties.name + '</b></div>';
            },
        },
        bubblesConfig: {
            borderWidth: 1,
            borderColor: '#FFFFFF',
            highlightOnHover: true,
            popupOnHover: true,
            popupTemplate: function(geo, data) {
                return "<div class='hoverinfo'>" + data.name + ":<br>" + data.date + "</div>";
            }
        },

        data: COUNTRIES
    });
})();
//map.bubbles(CITIES);

window.addEventListener('resize', function() {
    map.resize();
});

</script>
