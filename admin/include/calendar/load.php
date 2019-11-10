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

 $id_user = verif($_SESSION["id_user"]);
 $data = array();
 $query = 'SELECT * FROM events  WHERE id_user = "'.$id_user.'" ORDER BY id '; 
 $statement = $con->query($query);


 while($row = $statement->fetch_assoc()) {
       $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data); 

?>