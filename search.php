<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
    <link rel="stylesheet" type="text/css" href="CSS/nice-select.css">
    <script type="text/javascript" src="JS/jquery.nice-select.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }

    footer {
        background-color: #000000;
        padding: 25px;
    }
</style>
</head>
<body >


    <nav class="navbar navbar-inverse navbar-expand-lg navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">MovieBuff</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li  class="nav-item"><a href="index.php">Home</a></li>

                    <?php
                    if (!isset($_SESSION['email'])) {
                        echo "  <li class=\"disabled nav-item\"><a>Recommendation</a>
                        </li><li class=\"disabled\"><a> Watch List</a ></li >";
                    } else {
                        echo "<li class=\"nav-item\"><a href=\"#\">Recommendation</a></li>
                        <li><a href=\"watchlist.php\">Watch List</a></li>";
                    }
                    ?>
                    <li class="nav-item"><a href="map.php">Cinema</a></li>
                    <li class="nav-item active"><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                </ul>

                <?php
                if (!isset($_SESSION['email'])) {
                    echo "<ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"login.html\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>
                    </ul>";
                } else {
                    echo " <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>
                    </ul>";
                }
                ?>


            </div>
        </div>
    </nav>
    <div class=" StickyContent">
        <div class="mt-4 ml-3">
            <h4 ><a href="advancesearch.php">Advance Search</a></h4>
        </div>
        <div class="row ">
            <div class="col-sm-6 col-md-3 col-xs-12 col-center-block login mx-auto">
                <form class="text-center" role="search">
                    <div class="form-group">
                        <input type="text" id="query" class="form-control" placeholder="Search">
                    </div>
                    <button type="button" class="btn btn-default" onclick="getResult('n');">Search</button>

                </form>
            </div>
        </div>
        <div class="row">       
            <div class="col-sm-6 col-md-1 col-xs-6 login"  style="margin-left:50px;">
                <button type="button" class="btn btn-default" onclick="getResult('p');">&lt;&lt;Previous</button>
            </div>
            <div class="col-sm-6 col-md-2=1 col-xs-6  login ">
                <button type="button" class="btn btn-default" onclick="getResult('x');">&nbsp;&nbsp;&nbsp;&nbsp;Next >>&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>
        </div>
        <div class="row mx-lg-3 py-2 my-5"  id="movieList"  >
        </div>

    </div>

    <footer class="container-fluid text-center">
    <p>© 2018 Dalhousie Pandas. All rights reserved.</p>
</footer>
<script type="text/javascript">
    var page=1;
    function getResult(a){

        if(a=="n"){
            page=1;
            console.log("L>w>>>"+query);
        }else if(a=="p" && a!=0){
            page--;
            console.log("L>>a>>"+query);
        }else{
            page++;
            console.log("L>>>s>"+query);
        }
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            var query =  document.getElementById("query").value;
            var html ="<div class='row mx-lg-3 py-2 my-5'>";
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                myObj = JSON.parse(this.responseText);
                var data =myObj.results;
                for (x in myObj.results ) {
                    if(x>=18){
                        break;
                    }
                    if(x!=0 && x%6==0){
                        html+="<div class='row mx-lg-3 py-2 my-5'>";
                    }

                    html+="<div class='col-md-6 col-sm-6 col-xs-12 col-lg-2  text-light'><div class='wMB mx-auto'><a href='#' class='browse-movie-link'><figure><img class='img-responsive' src='http://image.tmdb.org/t/p/w500/"+data[x].poster_path+"'alt=' Image not found' width='210' height='315'><figcaption class='hidden-xs hidden-sm'><div class='text-center py-3'><h3 >"+data[x].title+"</h3><h3>"+data[x].vote_average+"/10</div></figcaption></figure></a></div></div>";
                    if(x!=0 &&  x%6==5){
                        html +="</div>";
                    }
                }
                console.log(myObj.total_results+"<<<<<<");
                if(myObj.total_results==0){
                    html="<h4>Oops! We didn't find any movie. Please try with some other keywords.</h4>";
                }

                document.getElementById("movieList").innerHTML = html;
            }
        };
        xmlhttp.open("GET", "https://api.themoviedb.org/3/search/movie?language=en-US&page=1&api_key=0ab4daba94f2b789ad24a714ceb0d6c8&query="+ document.getElementById("query").value, true);
        xmlhttp.send();

    }


    function trending(){
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            console.log("L>>>>"+query);
            var html ="<div class='row mx-lg-3 py-2 my-5'>";
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                myObj = JSON.parse(this.responseText);
                var data =myObj.results;
                for (x in myObj.results) {
                    if(x>=18){
                        break;
                    }

                    if(x!=0 && x%6==0){
                        html+="<div class='row mx-lg-3 py-2 my-5'>";
                    }

                    html+="<div class='col-md-6 col-sm-6 col-xs-12 col-lg-2  text-light'><div class='wMB mx-auto'><a href='#' class='browse-movie-link'><figure><img class='img-responsive' src='http://image.tmdb.org/t/p/w500/"+data[x].poster_path+"'alt='' width='210' height='315'><figcaption class='hidden-xs hidden-sm'><div class='text-center py-3'><h3 >"+data[x].title+"</h3><h3>"+data[x].vote_average+"/10</h3></div></figcaption></figure></a></div></div>";
                    if(x!=0 &&  x%6==5){
                        html +="</div>";
                    }
                }

                document.getElementById("movieList").innerHTML = html;
            }
        };
        xmlhttp.open("GET", "https://api.themoviedb.org/3/movie/popular?language=en-US&page=1&api_key=0ab4daba94f2b789ad24a714ceb0d6c8", true);
        xmlhttp.send();


    }

    $( ".browse-movie-link" ).hover(function() {
        $(this).find("figcaption").css("background", "#383838");
        $(this).find("figcaption").css("opacity", "0.7");
    }, function() {
        $(this).find("figcaption").css("opacity", "0");
    }
        /*$("figcaption").css("background", "#383838");
        $("figcaption").css("opacity", "0.7");
         $( this ).fadeOut( function(){
            $("figcaption").css("background", "");
        } );*/
        );


    $(document).ready(function() {
      $('select').niceSelect();
  });
    $(document).ready(function() {
        trending();
    });

</script>
</body>
</html>