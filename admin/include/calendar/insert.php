<?php
error_reporting(0); 
session_start(); 
require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php";

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 

if(isset($_POST["title"]))
{
	
	$title = verif($_POST["title"]);
	$start = verif($_POST["start"]);
	$end = verif($_POST["end"]);
	$id_user = verif($_SESSION["id_user"]);
	
 $query = "
 INSERT INTO events 
 (id_user,title, start_event, end_event) 
 VALUES ('$id_user','$title', '$start', '$end')
 ";
    $statement = $con->query($query);

}


?>