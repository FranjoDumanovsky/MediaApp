<?php 
session_start();
if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "Please Log in to access user dashboard!";
    header('Location: login.php');
    exit(0);
}
?>