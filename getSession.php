<?php
/**
 * Created by PhpStorm.
 * User: youranzhang
 * Date: 2018-07-19
 * Time: 10:45 PM
 */
session_start();

include_once ("db_conn.php");
include_once ("includes/tmdb_api_key.php");
include_once ("includes/direct.php");

$request_token = $_SESSION['request'];
$email = $_SESSION['email'];


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/authentication/session/new?request_token=".$request_token."&api_key=".$apikey,
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
//    echo $response;
    $json_result = json_decode($response);
    $sessiod_id= $json_result->session_id;
    $_SESSION["session_id"] = $sessiod_id;
}

try {
//    //store token into database
    $insertToken = "UPDATE users SET session_id='$sessiod_id' WHERE email='$email';";
    $stmt = $conn->prepare($insertToken);
    $stmt->execute();
    header("Location: " . "$myapp");
}catch (PDOException $e){
    echo $insertToken . "<br>" . $e->getMessage();
}finally{
    $conn=null;
}
