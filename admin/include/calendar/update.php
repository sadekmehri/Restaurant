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

if(isset($_POST["id"]))
{
	

 $id_user = verif($_SESSION["id_user"]);
 $id = verif($_POST["id"]);
 $start = verif($_POST["start"]);
 $end = verif($_POST["end"]);


 $query = 'UPDATE events  SET   start_event = "'.$start.'" ,
           end_event = "'.$end.'"
           WHERE id = "'.$id.'" and id_user = "'.$id_user.'" '; 
 $test = $con->query($query);
}

?>