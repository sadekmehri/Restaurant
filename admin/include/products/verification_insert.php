<?php      
        $category = verif($_POST["category"]);
		if(!in_array($category,$type))
		{
			$test = false;
			$err.='<script>toastr["error"]("Invalid Category!");</script>';
		}

        $status = verif($_POST["status"]);
        if( $status != '0' && $status != '1')
        {
        	$test = false;
        	$err.='<script>toastr["error"]("Invalid Status!");</script>';
        }
		
		$price = verif($_POST["price"]);
		if( empty($price) || !isset($price) || $price < 0 || is_float($price) )
		{
			$test = false;
			$err.='<script>toastr["error"]("Invalid Price!");</script>';
		}

		$name = verif($_POST["name"]);
		if( empty($name) || !isset($name) )
		{
			$test = false;
			$err.='<script>toastr["error"]("Invalid Name!");</script>';
		}

		$description = verif($_POST["description"]);
		if( strlen($description) > 200 || strlen($description) < 10 )
		{
			$test = false;
			$err.='<script>toastr["error"]("Length Should be between 10 and 200 !");</script>';
		}
		
?>