<!DOCTYPE html>
<html>
    <head>
        <title>
            Nearby locations
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href= "CSS/style.css" type = "text/css"/>
        <link rel="stylesheet" href= "CSS/styling.css" type = "text/css"/>
         <script src="JS/map.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFIPlWtRsnbQ8EaAZXmZOMGH85VsZAUYk&libraries=places"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body id="map_body">

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">MovieBuff</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li class="disabled"><a href="#" >Recommendation</a></li>
                    <li class="disabled"><a href="watchlist.php">Watch List</a></li>
                    <li><a href="map.php">Cinema</a></li>
                    <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="padding-top:50px;">
          <br>
          <br>
            <script src="JS/map.js"></script>
        <button onclick="getloc()">Click here to Get Location</button>
        <p id="demo"></p>
         
         <h1 >IT Will help you in showing nearby locations for Entertainment </h1>
         <button id= "movie_rental" onclick="rental()" name="theatre" class="btn" >MOVIE_RENTAL</button>
         <button id="audi" onclick="audi()" name="audi" class="btn">MOVIE_HALLS</button>
           <b><<--- PLEASE CLICK THESE BUTTONS TO ACCESS API(refresh page if does'nt work)</b>
           <br>
    <label for="mapradius">Radius(kilometers):</label>
    <input type="number" id="radius" name="mapradius"
           placeholder="1KM increments" step="1" />

        <div id ="map">
        </div>
    
    </div>
    </body>
     <script src="JS/map.js"></script>
</html>