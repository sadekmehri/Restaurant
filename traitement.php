<?php
error_reporting(0); 
session_start();

function test($don)
{
    $don = strip_tags($don);
    $don = stripslashes($don);
    $don = trim($don);
    $don = htmlspecialchars($don);
    return $don;
}


if(isset($_POST["action"]))
{
	//add
	if($_POST["action"] == "add")
	{ 
		if(isset($_SESSION["restaurent"]))
		{
			$is_available = 0;
			foreach($_SESSION["restaurent"] as $keys => $values)
			{
				if($_SESSION["restaurent"][$keys]['product_id'] == test($_POST["product_id"]))
				{
					$is_available++;
					$_SESSION["restaurent"][$keys]['product_quantity'] = $_SESSION["restaurent"][$keys]['product_quantity'] + (int)test($_POST["product_quantity"]);
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'               =>     test($_POST["product_id"]),  
					'product_name'             =>     test($_POST["product_name"]), 
					'product_photo'            =>     test($_POST["product_photo"]), 
					'product_price'            =>     test($_POST["product_price"]),  
					'product_quantity'         =>     (int)test($_POST["product_quantity"])
				);
				$_SESSION["restaurent"][] = $item_array;
			}
		}
		else
		{
			$item_array = array(
				'product_id'               =>     test($_POST["product_id"]),  
				'product_name'             =>     test($_POST["product_name"]),
				'product_photo'            =>     test($_POST["product_photo"]),  
				'product_price'            =>     test($_POST["product_price"]),  
				'product_quantity'         =>     test($_POST["product_quantity"])
			);
			$_SESSION["restaurent"][] = $item_array;
		}


	}


	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["restaurent"] as $keys => $values)
		{
			if($values["product_id"] == test($_POST["product_id"]))
			{
				unset($_SESSION["restaurent"][$keys]);
			}
		}
	}

	//view
	if($_POST["action"] == "view")
	{	
		$val=array();
	    array_push($val,test($_POST["product_id"]));	
		$_SESSION['view_cart'] = $val;	
	}

    //update
	if($_POST["action"] == "update")
	{ 
		if(isset($_SESSION["restaurent"]))
		{
			foreach($_SESSION["restaurent"] as $keys => $values)
			{
				if($_SESSION["restaurent"][$keys]['product_id'] == (int)test($_POST["product_id"]))
				{
					$_SESSION["restaurent"][$keys]['product_quantity'] = (int)test($_POST["product_quantity"]);
				}
			}
		}
	}



}


    if(isset($_POST['data']))
	{
		$dataArr = $_POST['data']; 

		foreach($_SESSION["restaurent"] as $keys => $values)
		{
			foreach($dataArr as $id)
			{
		        if($values["product_id"] == $id)
			    {		
				    unset($_SESSION["restaurent"][$keys]);
			    }
	        }
		}
					
	 }
	 
?>
