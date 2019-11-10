<?php
error_reporting(0);
//recuperer @ ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$date = date("d-m-Y"); $heure = date("H:i");
$final =$date." ".$heure;

/***************************/
session_start();
$email = $_SESSION["user"];
$status=$email." was logged out ".$final." using this adress ip ".$ip."\n";   
$dest = "./file/log_activity.txt";  
$file = fopen($dest,"a+");
fwrite($file,$status);
fclose($file);      
$_SESSION["user"] = $email;
header("location:index.php");
session_destroy(); 
unset($_SESSION["user"]); 
header("location:login.php");
exit();
?>