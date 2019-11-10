<?php

     $servername = "localhost";
     $username = "root";
     $password = "";
     $db="restaurent";

    //conection base de donnee
    $con=new mysqli($servername,$username,$password,$db);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } 
	
?>