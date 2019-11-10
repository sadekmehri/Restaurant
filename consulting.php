<section class="payment-form dark">
  <div class="container">

	 <div class="block-heading">
      <h2>Order Consulting</h2> 
       <div class="products">
		    <div class="container mb-4">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>				
					            <tr>
                          <th scope="col"> </th>
                          <th scope="col">Product</th>
                          <th scope="col">Available</th>
                          <th scope="col" class="text-center">Quantity</th>
                          <th scope="col" class="text-right">Price</th>
                          <th> </th>
                      </tr>
                    </thead>
					
					<tbody>
		
    <?php
    error_reporting(0);
    include "cnx.php";
	

    function tr($don){
      $don=strip_tags($don);
      $don=stripslashes($don);
      $don=trim($don);
      return($don);
      }

        if(isset($_POST["action"]))
        {
          if($_POST["action"] == "submit")
          { 

            $don=tr($_POST["code"]);
            $sum=$total=0;
            $sql = "select * from final join reservation_table using(id_table) join product using(id_product) where id_reservation ='".$don."'";
            $result = $con->query($sql);
            if ($result->num_rows > 0){        
                while($row = $result->fetch_assoc()){
                            		
	  ?>		     
			        <tr>
                <td><img src="./photo/<?php echo $row["photo"]; ?>" width="125" height="75"></td>
                <td><?php echo $row["nom"];?></td>
                <td>In stock</td>
                <td><input class="form-control" type="number" value="<?php echo $row["qty_product"];?>" disabled readonly/></td>
                <td class="text-right"><?php  $total = $row["qty_product"] * $row["price"]; $sum+=$total; echo $total;  ?> €</td>
                <td class="text-right">
                <?php echo $row["order_status"].' '; 
                  switch ($row["order_status"]) {
                  case "Pending":
                    echo '<i class="fas fa-spinner"></i>';break;

                  case "Done":
                    echo '<i class="fas fa-check"></i>';break;
                  
                  case "Canceled":
                    echo '<i class="far fa-window-close"></i>';break;
                  }						  
                ?>													
										
						    </td>
              </tr>  
    <?php    	
              }
                echo'<script>toastr["success"]("Your order was successfully reloaded !");</script>';
              }else{
                echo'<script>toastr["error"]("Write a valid code !");</script>';
              }
            }
          }
		$con->close();  
    ?>                                 					
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td class="text-right"><?php echo $sum;?> €</td>
                    </tr>            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                
       </div>
    </section>




   
