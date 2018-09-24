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

if (isset($_SESSION['email'])){
    $uemail = $_SESSION['email'];
}

include_once ("db_conn.php");

$sql = "DELETE FROM favorite_movies WHERE MID = ? AND uemail = ?";

try{
    $stmt = $conn->prepare($sql);

    $stmt->execute(array($MID, $uemail));

}catch(Exception $e){
    $output = 'Failure when removing movie from watch list! Error:'. $e->getMessage();
    include 'error_output.php';
    exit();
}

$sql = "DELETE FROM recommendations WHERE basedMID = ? AND uemail = ?";

try{
    $stmt = $conn->prepare($sql);

    $stmt->execute(array($MID, $uemail));

}catch(Exception $e){
    $output = 'Failure when removing movies from recommendations! Error:'. $e->getMessage();
    include 'error_output.php';
    exit();
}

$conn = null;


header('Location: '.'moviedetail.php'."?mid=".$MID);
