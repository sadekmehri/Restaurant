<?php 
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT']."/test/ajax/cnx.php"; 

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
}


if(isset($_POST['action']))
{
	if($_POST["action"]=="submit")
	{
		$status = verif($_POST["status"]);
		if($status =="Pending" || $status == "Done" || $status == "Canceled")
		{
			$id = verif($_POST['id']);
            $sql ="UPDATE final SET order_status='$status' WHERE id_reservation='$id'";
	        if($con->query($sql))
	        {
	         	echo '<script>toastr["success"]("data updated successfully!");</script> ';
		    }
		}
		else
		{
			echo '<script>toastr["error"]("Something happened!");</script> ';
	    }
	}
}

$con->close(); 

?>