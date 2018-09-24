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

//obtain form value
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $hash=hash_hmac('md5', $password, $salt);
}
try {
    $check = "SELECT password,username FROM users WHERE email='$email';";
    $result = $conn->query($check)->fetch();
    $checkpassword = $result['password'];
    $name = $result['username'];

    if ($checkpassword==$hash) {
        $_SESSION['email']=$email;
        $_SESSION['name']=$name;
        echo "<script> alert('Login successfully!');parent.location.href='index.php'; </script>";
    }else{
        echo "<script> alert('Sorry! Wrong email or password.');parent.location.href='login.html'; </script>";
    }
}
catch(PDOException $e)
{
    echo $check . "<br>" . $e->getMessage();
}finally{
    $conn=null;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}