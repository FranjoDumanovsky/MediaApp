<?php 

session_start();
include('dbcon.php');

if(isset($_GET['token'])){

    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($con, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0) {

        $row = mysqli_fetch_array($verify_query_run);

        if($row['verify_status'] == "0") {
            
        }

    }
}



?>