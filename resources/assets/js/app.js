$(function () {
    $('.datetimepicker').datetimepicker({
    	sideBySide: true,
    	useCurrent: false,
    	format: 'YYYY-MM-DD HH:mm'
    });

    // Render map
    $.ajax({
    	dataType:'JSON',
    	url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&key=AIzaSyDqJYrTN2ffw9hO9pvZjKo4dwD6ugOe_yQ',
    	success: function(response) {
    		var location = response.results[0].geometry.location,
    			mapProp= {
			    	center: new google.maps.LatLng(location.lat, location.lng),
		    		zoom:15,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
				},
				map;
			map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    	}
    });
});
