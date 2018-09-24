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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $cpassword = test_input($_POST["cpassword"]);


    try {

        $check = "SELECT UID FROM users WHERE email='$email';";
        $result = $conn->query($check)->fetch();
        $checkemail = $result['UID'];


        //email not exsit
        if ($checkemail == null) {
            //encrypt password
            $hash = hash_hmac('md5', $password, $salt);

            $insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$hash', '$email');";
            $s = $conn->prepare($insert);
            $s->execute();

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.themoviedb.org/3/authentication/token/new?api_key=$apikey",
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
                $json_result = json_decode($response);
                $request_token = $json_result->request_token;
            }

            $_SESSION['email'] = $email;
            $_SESSION['name'] = $username;
            $_SESSION['request'] = $request_token;
//            //api get request_token

      $url = "https://www.themoviedb.org/authenticate/" . $request_token . "?redirect_to=" . $direct_to;
            echo "<script> alert('Registered successfully!');parent.location.href='$url'; </script>";

        } else {

            echo "<script> alert('Sorry! This email has been used.');parent.location.href='register.html'; </script>";
        }


    } catch (PDOException $e) {
        echo $insert . "<br>" . $e->getMessage();
    } finally {
        $conn = null;
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
