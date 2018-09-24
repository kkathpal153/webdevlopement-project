<?php
session_start();

if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
        exit;
    }
}
else
{
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
}

//Get current user's email
if (isset($_SESSION['email'])){
    $uemail = $_SESSION['email'];
}else{
    $uemail = null;
}

include_once ("db_conn.php");
include_once ("includes/tmdb_api_key.php");

//TODO: waiting for movie id sent from movie list
if (empty($_COOKIE["movieid"])){

}else{
    $movieid = $_COOKIE["movieid"];
}


$movie_image_url = 'https://image.tmdb.org/t/p/original';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$movieid."?append_to_response=videos&language=en-US&api_key=$apikey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $json_response = json_decode($response, false);
    $movie_title = $json_response->original_title;
    $movie_genres_array = $json_response->genres;
    $movie_vote = $json_response->vote_average;
    $movie_vote_count = $json_response->vote_count;
    $movie_overview = $json_response->overview;
    $movie_release_date = $json_response->release_date;
    $movie_poster_path = $json_response->poster_path;

    if ($json_response->videos->results!=null){
        $movie_video_youtubeid = ($json_response->videos->results)[0]->key;
        $_SESSION['mvideoid'] = $movie_video_youtubeid;
    }

    $movie_poster_url = $movie_image_url . $movie_poster_path;

    $movie_genres = "";
    for ($i = 0; $i < count($movie_genres_array); $i++) {
        if ($i != count($movie_genres_array) - 1) {
            $movie_genres = $movie_genres . $movie_genres_array[$i]->name . ' / ';
        } else {
            $movie_genres = $movie_genres . $movie_genres_array[$i]->name;
        }
    }

    $_SESSION['MID'] = $movieid;
    $_SESSION['mtitle'] = $movie_title;
    $_SESSION['mgenres'] = $movie_genres;
    $_SESSION['mvote'] = $movie_vote;
    $_SESSION['mvote_count'] = $movie_vote_count;
    $_SESSION['moverview'] = $movie_overview;
    $_SESSION['mrelease_date'] = $movie_release_date;
    $_SESSION['mposter'] = $movie_poster_url;


}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/281338/reviews?api_key=0ab4daba94f2b789ad24a714ceb0d6c8&language=en-US&page=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));

$response1 = curl_exec($curl);
$err1 = curl_error($curl);

curl_close($curl);

if ($err1) {
    echo "cURL Error #:" . $err1;
} else {
    $json_response1 = json_decode($response1, false);
    for($i=0; ($json_response1->total_results)-1 >= $i; $i++) {
        $movie_author[$i] = ($json_response1->results)[$i]->author;
        $movie_content[$i] = ($json_response1->results)[$i]->content;
    }

}



if(isset($_POST["submit"])) {
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $rating = $_POST['rating'];
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/281338/rating?guest_session_id=06a003153e215394096153cc3a043807&api_key=0ab4daba94f2b789ad24a714ceb0d6c8",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"value\":$rating}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json;charset=utf-8"
        ),
    ));

    $response2 = curl_exec($curl);
    $err2 = curl_error($curl);

    curl_close($curl);

    if ($err2) {
        echo "cURL Error #:" . $err2;
    } else {
        $json_response2 = json_decode($response2, false);
        $rating_status = $json_response2->status_message;

    }
    ?>
    <script>
        alert ('<?php echo $rating_status;?>Right now your rating is <?php echo $rating;?>');
    </script>
    <?php
}


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/281338/external_ids?api_key=0ab4daba94f2b789ad24a714ceb0d6c8",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));

$response3 = curl_exec($curl);
$err3 = curl_error($curl);

curl_close($curl);

if ($err3) {
    echo "cURL Error #:" . $err3;
} else {
    $json_response3 = json_decode($response3, false);
    $facebook_id = $json_response3->facebook_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    
    <script type="text/javascript" src="JS/trending.js">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="CSS/moviedetail.css">

    <title>MovieBuff - Movie Detail: <?php echo $movie_title; ?></title>

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MovieBuff</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION['email']) && $_SESSION['email']!=null) {
                    echo "<li><a href=\"#\" >Recommendation</a></li>";
                    echo "<li><a href=\"watchlist.php\">Watch List</a></li>";
                }else{
                    echo "<li class=\"disabled\"><a href=\"#\" >Recommendation</a></li>";
                    echo "<li class=\"disabled\"><a href=\"#\">Watch List</a></li>";
                }
                ?>
                <li><a href="map.php">Cinema</a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-0 col-md-2 col-xs-12 bg-white text-right">
            <br>
        </div>

        <div class="col-sm-6 col-md-3 col-xs-12 bg-white">
            <br>
            <br>
            <img class="img-responsive img-thumbnail movie-image" src="<?php echo $movie_poster_url; ?>" alt="Poster image"/>
            <br>
            <?php
            if ($uemail == null){
                echo "<a class=\"btn btn-default btn-block\" href=\"login.html\">Login to add this movie into your watch list</a>";
            }else{
                //CHECK IF THE MOVIE HAS BEEN ADDED INTO WATCH LIST
                try{
                    $stmt=$conn->prepare("SELECT * FROM favorite_movies WHERE MID = ? AND uemail = ?");
                    if($stmt->execute(array($movieid, $uemail))){
                        $num = $stmt->rowCount();
                        if ($num > 0){
                            echo "<a class=\"btn btn-warning btn-block\" href=\"remove_from_favorite.php\"><i class=\"fas fa-heart\"></i> Remove this from your watch list</a>";
                        }else{
                            echo "<a class=\"btn btn-success btn-block\" href=\"addfavorite.php\"><i class=\"far fa-heart\"></i> Add to watch list</a>";
                        }
                    }
                }catch(Exception $e){
                    $output = 'Failure when checking if the movie has been marked as favorite! Error:'. $e->getMessage();
                    include 'error_output.php';
                    exit();
                }
                $conn = null;
            }
            ?>

            <br>


            <form  method="POST">
                rating: <input type="text" name="rating" />
                <input type="submit" name="submit" value="submit" />
            </form>

            <br>

            <?php

            if($facebook_id != null) {

                echo '<div class="fb-page" data-href="https://www.facebook.com/ApesMovies" data-tabs="timeline"
                 data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                 data-show-facepile="true"><blockquote cite="https://www.facebook.com/ApesMovies" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/ApesMovies">Planet of the Apes</a></blockquote>
            </div>';
            }
            ?>



        </div>

        <div class="col-sm-6 col-md-5 col-xs-12 bg-white">
            <br>

            <h2 class="movie-title"><?php echo $movie_title; ?></h2>

            <p>Released on
                <?php echo $movie_release_date; ?>
            </p>

            <p class="movie-genres"><b><?php echo $movie_genres; ?></b></p>

            <p><span class="movie-vote">
                    <?php echo $movie_vote; ?>
                </span>
                <span>  based on <?php echo $movie_vote_count; ?> reviews
                </span>
            </p>

            <p class="movie-overview"><b>Overview</b></p>
            <p><?php echo $movie_overview; ?></p>

            <?php
            if ($json_response->videos->results!=null){
                echo "<p class=\"movie-overview\"><b>Trailer</b></p>";
                echo "<p>";
                echo "<div id=\"player\" class=\"video\"></div>";
            }
            ?>


            <br>

            <hr/>

            <h2> Review</h2>
            <div>
                <div class="white_column">

                    <section class="panel review">
                        <div class="review_container">

                            <div class="content">
                                <div class="inner_content">
                                    <div class="card">
                                        <div class="grouped">
                                            <div class="avatar">

                                            </div>

                                            <div class="info">


                                                <div class="rating_wrapper">
                                                    <h4><?php echo $movie_author[0]; ?></h4>
                                                </div>

                                                <h5>Written by <?php echo  $movie_author[0]; ?> on June 22, 2018</h5>
                                            </div>
                                        </div>
                                        <div class="teaser">

                                            <p><?php echo  $movie_content[0]; ?></p>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            <div>
                <div class="white_column">
                    <section class="panel review">
                        <div class="review_container">
                            <div class="content">
                                <div class="inner_content">
                                    <div class="card">
                                        <div class="grouped">
                                            <div class="avatar">
                                            </div>
                                            <div class="info">
                                                <div class="rating_wrapper">
                                                    <h4><?php echo $movie_author[1]; ?></h4>
                                                </div>
                                                <h5>Written by <?php echo  $movie_author[1]; ?> on September 26, 2017</h5>
                                            </div>
                                        </div>
                                        <div class="teaser">
                                            <p><?php echo  $movie_content[1]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            <div>
                <div class="white_column">
                    <section class="panel review">
                        <div class="review_container">
                            <div class="content">
                                <div class="inner_content">
                                    <div class="card">
                                        <div class="grouped">
                                            <div class="avatar">
                                            </div>
                                            <div class="info">
                                                <div class="rating_wrapper">
                                                    <h4><?php echo $movie_author[2]; ?></h4>
                                                </div>
                                                <h5>Written by <?php echo  $movie_author[2]; ?> on July 13, 2017</h5>
                                            </div>
                                        </div>
                                        <div class="teaser">
                                            <p><?php echo  $movie_content[2]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

        </div>



    </div>

    <div class="col-sm-0 col-md-2 col-xs-12 bg-white text-right">
        <br>
    </div>

</div>
<br>


<footer class="container-fluid text-center">
    <p>© 2018 Dalhousie Pandas. All rights reserved.</p>
</footer>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>

    // var video_width = document.getElementById('player').offsetWidth;
    // var video_height = video_width * 0.5625;
    // document.getElementById('player').style.height = video_height + 'px';



    var tag = document.createElement('script');

    var video_id = "<?php echo $movie_video_youtubeid; ?>";

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '360',
            width: '640',
            videoId: video_id,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        event.target.pauseVideo();
    }

    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            setTimeout(stopVideo, 6000);
            done = true;
        }
    }
    function stopVideo() {
        player.stopVideo();
    }
</script>

</body>
</html>