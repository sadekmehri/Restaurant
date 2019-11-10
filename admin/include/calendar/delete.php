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
	
 $id = verif($_POST["id"]);
 $id_user = verif($_SESSION["id_user"]);
 $query = 'DELETE from events  WHERE id = "'.$id.'" and id_user = "'.$id_user.'" '; 
 $statement = $con->query($query);
 
}

?>