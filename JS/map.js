/*function initMap() {
  var locationi =  {lat : 44.648764, lng : -63.575239};
  var map = new google.maps.Map(document.getElementById("map"),{
    zoom:15,
    center:locationi
  });
  var requests = {
    location : locationi,
    radius: 8047,
    types: ['auditorium']
  };

  var service = new google.maps.places.PlacesService(map);

  service.nearbySearch(requests,callback);
  
  
   }

 function callback(results,status) {
  
    for(var i=0;i<results.length; i++){
      createMarker(result[i]);
    
  }

 }


function createMarker(place) {
  var placeloc = place.geometry.location;
  var marker = new google.maps.Marker({
    map:map,
    position: place.geometry.location
  });
   google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
}

I taken help from google API documentation*//*taken from https://www.w3schools.com/Bootstrap/  */
      var map;
      var infowindow;
      var pyrmont = {lat : 44.648764, lng : -63.575239};

         
        var x = document.getElementById("demo");
        function getloc() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
                  }
          function showPosition(position) {
            
              pyrmont = {lat: parseFloat(position.coords.latitude) , lng : parseFloat(position.coords.longitude)}
              
          }

$( document ).ready(function() {
    console.log( "ready!" );

                    function initMap() {
                      getloc();
                      map = new google.maps.Map(document.getElementById('map'), {
                        center: pyrmont,
                        zoom: 13
                      });

                      infowindow = new google.maps.InfoWindow();
                      var service = new google.maps.places.PlacesService(map);
                      service.nearbySearch({
                        location: pyrmont,
                        radius: 20000,
                        type: ['university']
                      }, callback);
                      //document.getElementById("textb").innerHTML = "Paragraph changed!";

                    }

                    function callback(results, status) {
                      if (status === google.maps.places.PlacesServiceStatus.OK) {

                        
                        for (var i = 0; i < results.length; i++) {
                          createMarker(results[i]);
                        }
                      }
                    }

                    function createMarker(place) {
                      var placeLoc = place.geometry.location;
                      var marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location
                      });
                        google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name);
                        infowindow.open(map, this);
                      });
                    }

initMap();
});

     function audi (){ //function for movie theatre button
 
      
       
        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 13
        });
        var radiusi = document.getElementById("radius").value;
   
        radiusi=parseInt(radiusi);
        

        if(!radiusi){
          radiusi=2;
        }

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: radiusi*1000,
          type: ['movie_theater']
        }, callback);
       
       
     
      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {

          
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
          google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
     }


    function rental(){  //function for the rental button

      
      

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 13
        });
var radiusi = document.getElementById("radius").value;
       
        radiusi=parseInt(radiusi);
        
        if(!radiusi){
          radiusi=2;
        }

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: radiusi*1000,
          type: ['movie_rental']
        }, callback);
       
       
     
      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {

          
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
          google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
     }