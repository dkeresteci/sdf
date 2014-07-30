      function init_gmaps(lat, lon, zoom, scale, colour) {
      	var myLatlng = new google.maps.LatLng(lat, lon);
        var mapOptions = {
          center: myLatlng,
          zoom: zoom
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

		 var marker = new google.maps.Marker({
		    position: myLatlng,
		    icon: {
		      path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
		      strokeColor: colour,
		      scale: scale
		    },
		    draggable: false,
		    map: map
		  });
      }