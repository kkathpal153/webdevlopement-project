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
//db connection
include_once ("db_conn.php");
include_once ("includes/tmdb_api_key.php");
include_once ("includes/direct.php");
include_once ("includes/hash_salt.php");

$email = $_SESSION["email"];//"siwalkhushboo@gmail.com";//
//obtain form value

try {
    $query = "SELECT mtitle, mgenres,mvote,mposter,MID FROM favorite_movies where uemail='".$email."'";
    //echo $query;
   // $result = $conn->query($check)->fetch();
    $data = "{\"results\":[";
    foreach ($conn->query($query) as $row) {

        $data = $data."{ \"genere\":\"".$row['mgenres'] . "\",";
        $data = $data."\"vote\":\"".$row['mvote'] . "\",";
         $data = $data."\"mid\":\"".$row['MID'] . "\",";
        $data = $data."\"poster\":\"".$row['mposter'] . "\",";
        $data = $data."\"title\":\"".$row['mtitle'] . "\"},";
       
    }
    $data = $data."{}]}";
    echo $data;

}
catch(PDOException $e)
{
    echo "<br>" . $e->getMessage();
}finally{
    $conn=null;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}