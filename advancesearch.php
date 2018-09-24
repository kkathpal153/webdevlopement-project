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
            <h4 ><a href="search.php">Search</a></h4>
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
        <div class="row mx-auto">
            <div class="col-sm-6 col-md-4 col-xs-12 col-center-block login ">

            </div>
            <div class="col-sm-4 col-md-1 col-xs-12 col-center-block  " width="200px">
             <span style="color:white;">Year</span><br>
             <select id="year" name="primary_release_year" style="width: 100px; " ><option value="0">None</option><option selected="selected" value="2018">2018</option><option value="2017" >2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
            </div>

            <div class="col-sm-4 col-md-2 col-xs-12 col-center-block login" width="200px">
            <span style="color:white;">Popularity</span><br>
            <select id="sort" name="sort_by" style="width: 200px;"><option "selected="selected">Popularity Descending</option><option value="popularity.asc">Popularity Ascending</option><option value="vote_average.desc">Rating Descending</option><option value="vote_average.asc">Rating Ascending</option><option value="primary_release_date.desc">Release Date Descending</option><option value="primary_release_date.asc">Release Date Ascending</option><option value="title.asc">Title (A-Z)</option><option value="title.desc">Title (Z-A)</option></select>
            </div>
        <div class="col-sm-4 col-md-2 col-xs-12 col-center-block login" width="200px">
           <span style="color:white;">Genere</span><br>
           <select id="genres" style="width: 260px;" ><option value="28">Action</option><option value="12">Adventure</option><option value="16">Animation</option><option value="35">Comedy</option><option value="80">Crime</option><option value="99">Documentary</option><option value="18">Drama</option><option value="10751">Family</option><option value="14">Fantasy</option><option value="36">History</option><option value="27">Horror</option><option value="10402">Music</option><option value="9648">Mystery</option><option value="10749">Romance</option><option value="878">Science Fiction</option><option value="10770">TV Movie</option><option value="53">Thriller</option><option value="10752">War</option><option value="37">Western</option></select>
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

                    html+="<div class='col-md-6 col-sm-6 col-xs-12 col-lg-2  text-light'><div class='wMB mx-auto'><a href='#' class='browse-movie-link'><figure><img class='img-responsive' src='http://image.tmdb.org/t/p/w500/"+data[x].poster_path+"'alt=' Image not found' width='210' height='315'><figcaption class='hidden-xs hidden-sm'><div class='text-center py-3'><h3 >"+data[x].title+"</h3><h3>"+data[x].vote_average+"/10</h3></div></figcaption></figure></a></div></div>";
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
        xmlhttp.open("GET", "https://api.themoviedb.org/3/discover/movie?language=en-US&page=1&api_key=0ab4daba94f2b789ad24a714ceb0d6c8&primary_release_year="+document.getElementById("year").value+"&sort_by="+document.getElementById("sort").value+"&with_genres="+document.getElementById("genres").value+"&page="+page+"&with_keywords="+document.getElementById("query").value, true);
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

                   html+="<div class='col-md-6 col-sm-6 col-xs-12 col-lg-2  text-light'><div class='wMB mx-auto'><a href='#' class='browse-movie-link'><figure><img class='img-responsive' src='http://image.tmdb.org/t/p/w500/"+data[x].poster_path+"'alt=' Image not found' width='210' height='315'><figcaption class='hidden-xs hidden-sm'><div class='text-center py-3'><h3 >"+data[x].title+"</h3><h3>"+data[x].vote_average+"/10</div></figcaption></figure></a></div></div>";
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