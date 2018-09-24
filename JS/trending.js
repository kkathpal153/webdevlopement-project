 function magic(){

 var settings = {
                  "async": true,
                  "crossDomain": true,
                  "url": "https://api.themoviedb.org/3/movie/popular?page=1&language=en-US&api_key=0ab4daba94f2b789ad24a714ceb0d6c8",
                  "method": "GET",
                  "headers": {},
                  "data": "{}"
                }
 
var response ;
$.ajax(settings).done(function (response) {
  console.log(response);
          $.each(response, function(index, element) {
          for (var i = 0; i < response.results.length; i++) {
           console.log(response.results[i].title);
           
          }
        });
    });

}

$(document).ready(function(){
$.getJSON("https://api.themoviedb.org/3/movie/popular?page=1&language=en-US&api_key=0ab4daba94f2b789ad24a714ceb0d6c8",
function(data){
console.log(data);
var drawing_data ='';
$.each(data['results'], function(key, value){
drawing_data += '<tr><font-size: 26px>';
drawing_data += '<td><button onclick="moviei_set_cookie(' + value.id + ')"><a href="moviedetail.php"><img src="https://image.tmdb.org/t/p/original' + value.poster_path + '" style="float:left;width:200px;height:200px; " ></a></button></td>';
drawing_data += '<td>' +value.original_title+'</td>';
drawing_data += '<td>' +value.overview+'</td>';
drawing_data += '<td><span class="movie-vote">' +value.vote_average+'</span></td>';
drawing_data += '</font-size><tr>';
});
$('#drawing_table').append(drawing_data);
});
});

function moviei_set_cookie(data){
  //console.log(data);
  cname="movieid";
  cvalue=data;
      document.cookie = cname + "=" + cvalue + "; path=/";
    moviei_check_cookie();
}


function getcookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function moviei_check_cookie() {

    var user=getcookie("movieid");
    if (user != "") {
        console.log("the movie id is "+user);
    } 
}

/*$(document).ready(function () {
    $.ajax({ 
    type: 'GET', 
    url: 'https://api.themoviedb.org/3/movie/popular?page=1&language=en-US&api_key=0ab4daba94f2b789ad24a714ceb0d6c8', 
    data: { get_param: 'value' }, 
    dataType: 'json',
    success: function (data) { 
        $.each(data, function(index, element) {
            $('sassy').append($('<div>', {
                text: element.results
            }));
        });
    }
   });
});






    $.each(response, function(index, element) {
            $('sassy').append($('<div>', {
                text: element.results.title
            }));
        });*/