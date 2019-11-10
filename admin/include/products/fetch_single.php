<?php

require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 

if(isset($_POST["user_id"]))
{
	 $output = array();
	 $query = "SELECT * FROM `product` join product_type using (category) WHERE id_product = '".$_POST["user_id"]."' LIMIT 1";
     $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result))
    {
    	while ($row = $result->fetch_assoc()) 
    	{
            $output["id"] = $row["id_product"];
    		$output["first_name"] = $row["nom"];
            $output["category"] = $row["category"];
            $output["description"] = $row["description"];
            $output["status"] = $row["status"];
    		$output["price"] = $row["price"];
    		if($row["photo"] != '')
    		{
    			$output['user_image'] = '<img src="../photo/'.$row["photo"].'" class="img-thumbnail" width="100" height="100" /><input type="hidden" id="hidden_user_image" name="hidden_user_image" value="'.$row["photo"].'" />';
		    }
	    }
    }
     echo json_encode($output);	
}

?>