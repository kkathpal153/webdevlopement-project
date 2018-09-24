<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prefrance Page</title>



  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="JS/validator.js" ></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href= "CSS/style.css" type = "text/css"  />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="height:1000px">



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Movie Suggestor</a>
    </div>
    <ul class="nav navbar-nav">
          <li><a href="#">Home Page</a></li>
          <li><a href="#">Suggestions Page</a></li>
          <li><a href="prefrance.php" class="active">Prefrance Page</a></li>
          <li><a href="map.php">Map Page</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


<div class="container" >
  <h3>Some latest movies</h3>
  <div class="row">
    <div class="col-sm-8">
        
                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="images/thenun.jpg" data-slide-to="0" class="active"></li>
                <li data-target="images/ocean8.jpg" data-slide-to="1"></li>
                <li data-target="images/interstellar.jpg" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                  <img src="images/thenun.jpg" alt="THE NUN" style="width:100%; height: 100%;">
                </div>

                <div class="item">
                  <img src="images/ocean8.jpg" alt="OCEAN8" style="width:100%; height:100%;">
                </div>
              
                <div class="item">
                  <img src="images/interstellar.jpg" alt="INTERSTELLAR" style="width:100%; height:100%;">
                </div>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>    
    </div>

    <form onsubmit="return validateForm()" method="post" name="user_prefrance">

      <div class="form-group">
      <div class="col-sm-4"> 
                       <h1><b><u>User Prefrance and Choice Form</b></u></h1>
                       <p>Enter latitude</p>
                       <input type="text" placeholder="Enter Latitude" name="lat"><br>
                       <p>Enter longitude</p>
                       <input type="text" placeholder="Enter Latitude" name="long"><br>
                       <p>Please select what you are looking for</p>
                         <div class="radio">
                          <label><input type="radio" name="placetype" value="movierentals">MOVIE_RENTALS</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="placetype" value="moviehalls">MOVIE_HALLS</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="placetype" value="audis" >AUDITORIUMS</label>
                        </div> 
                        <p>Please Enter the Radius in Meters</p>
                        <input type="text" placeholder="Enter the Radius" name="radius">
                        <br>      
                        <button type="submit" value="Submit">SUBMIT</button><br>
                        <b><a href="map.php">Click to Access Customized Map</a></b>
        </div>
        </div>
        
      </form>
                       
   


<footer>This is developed by Dalhousie Students.. All credits to W3 school</footer>
</body>
</html>
