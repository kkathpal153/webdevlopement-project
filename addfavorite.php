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

$MID = $_SESSION['MID'];
$mtitle = $_SESSION['mtitle'];
$mgenres = $_SESSION['mgenres'];
$mvote = $_SESSION['mvote'];
$mvote_count = $_SESSION['mvote_count'];
$moverview = $_SESSION['moverview'];
$mrelease_date = $_SESSION['mrelease_date'];
$mposter = $_SESSION['mposter'];
$mvideoid = $_SESSION['mvideoid'];
$uemail = $_SESSION['email'];

include_once ("db_conn.php");

$sql = "INSERT INTO favorite_movies (MID, mtitle, mgenres, mvote, mvote_count, moverview, mrelease_date, mposter, mvideoid, uemail) VALUES(?,?,?,?,?,?,?,?,?,?)";

try{
    $stmt = $conn->prepare($sql);

    $stmt->execute(array($MID,$mtitle,$mgenres,$mvote,$mvote_count,$moverview,$mrelease_date,$mposter, $mvideoid, $uemail));

}catch(Exception $e){
    $output = 'Failure when adding movie to watch list! Error:'. $e->getMessage();
    include 'error_output.php';
    exit();
}

include_once ("includes/tmdb_api_key.php");

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/$MID/recommendations?page=1&language=en-US&api_key=$apikey",
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

$movie_image_url = 'https://image.tmdb.org/t/p/original';

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $json_response = json_decode($response, false);
    $recomm_arr = $json_response->results;
    for ($i = 0; $i < count($recomm_arr); $i++) {
        $movie_id = $recomm_arr[$i]->id;
        $movie_title = $recomm_arr[$i]->original_title;
        $movie_poster_url = $movie_image_url . $recomm_arr[$i]->poster_path;
        $movie_vote = $recomm_arr[$i]->vote_average;

        $sql = "CALL spAddRecommendationByUser(?, ?, ?, ?, ?, ?)";

        try{
            $stmt = $conn->prepare($sql);

            $stmt->execute(array($movie_id, $movie_title, $movie_poster_url, $movie_vote, $uemail, $MID));

        }catch(Exception $e){
            $output = 'Failure when adding recommendation! Error:'. $e->getMessage();
            include 'error_output.php';
            exit();
        }

    }

}
//disconnect with db
$conn = null;

header('Location: '.'moviedetail.php'."?mid=".$MID);


