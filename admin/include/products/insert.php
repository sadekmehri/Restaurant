<?php
//error_reporting(0);
require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
$err="";
define('MB', 1048576);

$type = array();
$sql = mysqli_query($con, "SELECT category FROM product_type");
while($row = mysqli_fetch_array($sql)) {
   $type[] = $row['category'];
}

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 

function test_image()
{
	if( isset($_FILES["user_image"]) )
	{
		if( $_FILES['user_image']['size'] <= 3*MB )
		{
			$allowed =  array('gif','png','jpg','jpeg');
		    $filename = verif($_FILES['user_image']['name']);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if(!in_array($ext,$allowed) )
            	return false; 
            else
        	    return true;
		}
		else
		{
			return false;
		}
				
	}
}


if(isset($_POST["operation"]))
{	
	//update
	if($_POST["operation"] == "update")
	{	
        $test = true;
		include "verification_insert.php";


		$id = verif($_POST["user_id"]);
		if( empty($id) || !isset($id) )
		{
			$test = false;
			$err.='<script>toastr["error"]("Invalid Product!");</script>';
		}
		
	    $image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			if( test_image($_FILES["user_image"])) 
		    {
				$new_name = mt_rand().'.'.strtolower(pathinfo(verif($_FILES['user_image']['name']), PATHINFO_EXTENSION));
			    $image = $new_name;
			    $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/photo/' . $new_name;
		        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);

		        $sql = "SELECT photo
                FROM product          
                WHERE id_product = '".$id."'"; 
                $test = $con->query($sql);
                while($row = $test->fetch_assoc())
                {
                     $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/photo/' . $row["photo"];
                     if(!unlink($destination))
                     {
                        $err.='<script>toastr["success"]("Something Happened!");</script>';  
                     }
                       
                }

		    }
		    else
		    {
		    	$err.='<script>toastr["error"]("extention gif png jpg jpeg!");</script>';
		    	$test = false;
		    }

		}
		else
		{
			$image = verif($_POST["hidden_user_image"]);
		}

	
        if($test)
        {
        	$test = false;
        	$price = number_format($price,2);
        	$sql = "UPDATE product 
			    SET category = '".$category."' , 
			    description = '".$description."' ,
			    price = '".$price."' ,
			    nom = '".$name."' ,
			    photo = '".$image."' ,
			    status = '".$status."' 
			    WHERE id_product = '".$id."'"; 
			    $err.='<script>toastr["success"]("Updated successfully!");</script>';


	        $con->query($sql); 
        }
	}


    //deleting
	if($_POST["operation"] == "delete")
	{	

		$sql = "SELECT photo
                FROM product            
                WHERE id_product = '".verif($_POST["id_product"])."' ";	 
                $test = $con->query($sql);
                while($row = $test->fetch_assoc())
                {
                     $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/photo/' . $row["photo"];
                     if(unlink($destination))
                     {
                     	 $sql = "DELETE FROM product 
			                    WHERE id_product = '".verif($_POST["id_product"])."' ";	 
	                            $con->query($sql); 		
	                            $err.='<script>toastr["success"]("Item was successfully deleted !");</script>';                  
                     }
                     else
                     {
                     	 $err.='<script>toastr["error"]("Something Happened!");</script>';
                     }
                       
                }
	   
	}

	//add
	if($_POST["operation"] == "add")
	{	
	    $test = true;	
        include "verification_insert.php";

		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			if( test_image($_FILES["user_image"])) 
		    {
				$new_name = mt_rand().'.'.pathinfo(verif($_FILES['user_image']['name']), PATHINFO_EXTENSION);
			    $image = $new_name;
			    $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/photo/' . $new_name;
		        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		    }
		    else
		    {
		    	$err.='<script>toastr["error"]("extention gif png jpg jpeg!");</script>';
		    	$test = false;
		    }
		}

		if($test)
		{
			$test = false;
            $sql = "INSERT INTO product (nom,photo,price,category,description,status)
                    VALUES ('$name','$image','$price','$category','$description','$status')";
                    $test = $con->query($sql);
                     $err.='<script>toastr["success"]("Item was successfully inserted !");</script>';
		}		
	}
}

$con->close();


$output = array(
	"message"	=>	$err
);

echo json_encode($output);


?>