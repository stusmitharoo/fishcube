<html>
  <head>
    <title>District Map</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  </head>
  <body class="background">
  	@include('includes.navbar')
  	<h4 class="words" id="info-box">click your'e fishing spot to find location</h4>
  	<div class="box-map">
    	<div id="map">
    	</div>
  	</div>
    @include('includes.footer')
   <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
  var map, layer;
      function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 51.2, lng: -0.8},
    zoom: 11
  });

  layer = new google.maps.FusionTablesLayer({
    suppressInfoWindows: true,
    query: {
      select: 'geometry',
      from: '1pIQGWBkK_iV6DpMq2uumj7q-ajpWBB-SHSJFhDIR',
      where: 'is_district > 0'
    },
    styles: [{
      polygonOptions: {
        fillColor: '#158d86',
        fillOpacity: 0.3
      }
    }]
  }); 

  layer.setMap(map);

  layer.addListener('click', function(event) {

      document.getElementById('info-box').textContent =
              event.row.name.value;
    });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Your Location.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
        infoWindow.open(map);
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU9jk80GXFrz7n_TezwohN7rq-VhkijQY&callback=initMap">
    </script>
  </body>
</html>
   