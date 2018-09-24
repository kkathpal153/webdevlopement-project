<?php
/**
 * Created by PhpStorm.
 * User: youranzhang
 * Date: 2018-07-21
 * Time: 3:17 PM
 */
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

include_once ("includes/direct.php");
unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['session_id']);

$_SESSION=array();
session_destroy();


header("Location: "."$myapp");
?>

