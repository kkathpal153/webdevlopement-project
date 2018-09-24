// Geo Location


function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		
	}
}

function showPosition(position) {
	var lat =  position.coords.latitude;
	var long = position.coords.longitude;

	var latlng = new google.maps.LatLng(lat, long);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status !== google.maps.GeocoderStatus.OK) {
            alert(status);
        }
        if (status == google.maps.GeocoderStatus.OK) {
            console.log(results[0].address_components[3].long_name);
             console.log(results[0].address_components[4].long_name);
             document.getElementById("geoLocation").innerHTML=document.getElementById("geoLocation").innerHTML+results[0].address_components[3].long_name+"/"+results[0].address_components[4].long_name;
            var address = (results[0].formatted_address);
        }
    });

}
$(document).ready(function(){
    getLocation();
    });