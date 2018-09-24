<?php
session_start();
if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
        /* Prompt for password */
        exit;
    }
}
else
{
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/tablestyling.css">
    <link rel="stylesheet" href="CSS/index.css">
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
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">MovieBuff</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>

                <?php
                if (!isset($_SESSION['email'])) {
                    echo "  <li class=\"disabled\"><a>Recommendation</a>
                            </li><li class=\"disabled\"><a> Watch List</a ></li >";
                } else {
                    echo "<li><a href=\"#\">Recommendation</a></li>
                <li><a href=\"watchlist.php\">Watch List</a></li>";
                }
                ?>








                <li><a href="map.php">Cinema</a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
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


<?php
if (!isset($_SESSION['email'])) {
    echo "<div class=\"jumbotron\">
    <div id=\"notice\" class=\"container-fluid text-center\">
        <h1 id=\"header\">MovieBuff</h1>
        <p>Login for the full experience</p>
        <p>Movie recommendation based on your taste</p>
        <input type=\"button\" class=\"btn\" data-toggle=\"modal\" data-target=\"#myModal\" value=\"Login\" onclick=\"location.href='login.html'\">
        <input type=\"button\" class=\"btn\" data-toggle=\"modal\" data-target=\"#myModal\" value=\"Sign Up\" onclick=\"location.href='register.html'\">
    </div>
</div>";
} else {
    $name = $_SESSION['name'];
    echo "<div class=\"jumbotron\">
    <div id=\"notice\" class=\"container-fluid text-center\">
        <h1 id=\"header\">MovieBuff</h1>
        <p>Welcome!</p>
        <p>";
    echo $name;
    echo "</p><p>";
    echo $_SESSION['email'];
    echo "
        
    </div>
</div>";
}
?>

<script type="text/javascript" src="JS/trending.js"></script>
 <div class="container">
<div class="table-responsive">
<h1> Trending Movies</h1>
<br />
<table class="movietable" id="drawing_table">
<tr>
<th>MOVIE POSTER</th>
<th>MOVIE TITLE</th>
<th>MOVIE OVERVIEW</th>
<th>POPULARITY</th>

</tr>
</table>
</div>
</div>




<footer class="container-fluid text-center">
    <p>Footer Text</p>


</footer>

</body>
</html>
