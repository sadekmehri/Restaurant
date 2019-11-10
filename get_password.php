<?php 
    error_reporting(0); 
    session_start();
	include "cnx.php";  
?>
    <section class="payment-form dark">
      <div class="container">
	  	<div class="block-heading">
        <?php 
        if(empty($_SESSION["test"]))
        {                               	                    
        ?>
		
		<div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, you haven't order yet, Requested page not found!
                </div>
            </div>
         </div>
			 
        <?php }else{ ?>  
      <h2>Order Consulting</h2> 
       <div class="products">
		 <div class="container mb-4">
           <div class="row">
            <div class="col-12">        	
            <?php
                $sql = "select * from final where id_reservation ='".$_SESSION["test"][0]."'limit 1";
                $result = $con->query($sql);
                if ($result->num_rows > 0):         
                    while($row = $result->fetch_assoc()):                     		
            ?>		     
            
                <?php echo 'Your password is : <strong>'.$row["id_reservation"]." </strong> Please verify your order"; ?>

            <?php    	
               	    endwhile;
		          endif;
		        $con->close();  
            ?>                                 					
                           
            </div>
          </div>
         </div>
        </div>
    <?php                 
        }              		
    ?> 
     
      </div>
    </div>     	        	     
  </section>

