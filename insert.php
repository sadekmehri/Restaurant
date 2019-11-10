<?php 

function option2($array,$connect,$nom,$prenom,$list)  
{  
      if(is_array($array))  
      {  
        include "generate.php";
		$ch='';$_SESSION["test"] = array();
		$ch=randomPassword(10,1,"lower_case,numbers")[0];
           
           $values = array();  
           foreach($array as $row => $value)  
           {  	
		        	   
				$id_reservation = mysqli_real_escape_string($connect,$ch);
				$table_id = mysqli_real_escape_string($connect,$list);
        $id_item = mysqli_real_escape_string($connect, $value["product_id"]);             			
				$qty = mysqli_real_escape_string($connect,$value["product_quantity"]); 
				$date = mysqli_real_escape_string($connect,date("Y/m/d"));
        $nom = mysqli_real_escape_string($connect,$nom);
				$prenom = mysqli_real_escape_string($connect,$prenom);		        
        $values[] = "( '$id_reservation' , '$table_id' ,'$id_item', '$qty' , '$date' , '$nom', '$prenom' ,'Pending')";  
           } 
		   
		   $sql = "INSERT INTO final(id_reservation,id_table,id_product,qty_product,date_vente,client_nom,client_prenom,order_status) VALUES ";  
           $sql .= implode(', ', $values); 
           $_SESSION["test"][]=$ch;
           $connect->query($sql);                 	
           $connect->close();	           
      }      
 }  
 

?>