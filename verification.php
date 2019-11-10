<?php 
    error_reporting(0); 
    session_start();
    include "cnx.php";

    function test($don)
    {
        $don = strip_tags($don);
        $don = stripslashes($don);
        $don = trim($don);
        $don = htmlspecialchars($don);
        return $don;
    }

    function test_length($var)
    {
		  $x = true;
        $number = strlen(test($var));
        if( $number > 10 || $number < 3 )
        {
            $x = false;
        }
        return $x;
    }

    if(isset($_POST["submit"]))
    {	    
      $test = true;

      if( empty(test($_POST["list"])) || empty(test($_POST["nom"])) || empty(test($_POST["prenom"]))  ){
          $test = false;
          echo '<script>toastr["error"]("Please provide us with valid informations!");</script> ';   
      }
       
            if(!empty($_POST["list"]))
            {
                $list = test($_POST["list"]);           
            }
            
            if(isset($_POST["nom"]) && !empty($_POST["nom"]) )
            {
                $nom = test($_POST["nom"]);

               if(preg_match('/[^a-zA-Z]/',$nom))
               {
                    echo '<script>toastr["error"]("Only Letters are allowed !");</script> '; 
                    $test = false;									
               }
               else if(!test_length($nom))
               {
                    echo '<script>toastr["error"]("Name\'s length should be between 3-10 !");</script> '; 
                    $test = false;					
               }
     
            }

            if((isset($_POST["prenom"])&&(!empty($_POST["prenom"]))))
            {
                $prenom = test($_POST["prenom"]);

               if(preg_match('/[^a-zA-Z]/',$prenom))
               {
                    echo '<script>toastr["error"]("Only Letters are allowed !");</script> ';
                    $test = false;					
               }
               else if(!test_length($prenom))
               {
                    echo '<script>toastr["error"]("Last name\'s length should be between 3-10 !");</script> ';
                    $test = false;					
               }
               
            }
            

            if($test)
            {     
                include "insert.php"; 
                option2($_SESSION["restaurent"],$con,$nom,$prenom,$list);
                unset($_SESSION["restaurent"]);
                unset($_SESSION["view_cart"]); 
                echo '<script> toastr["success"]("Please check <i class=\"fa fa-bell\"></i> to get the password !"); </script> ';  
                echo "<script> setTimeout(refresh,1000);function refresh() {location.reload();}</script>";                                         
            }
    }

?>	


<link rel="stylesheet" href="toastr.css">
<script src="jquery.min.js.js"></script>
<script src="toastr.js"></script>

<section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>Payment</h2>
          <p>Please provide us with your right informations to complete the order .</p>
        </div>
        <form>
        <div class="products">
          <h3 class="title">Checkout</h3>
                       
        <?php 
        
         $total_price = 0;
         $count=1;
                 
        if(!empty($_SESSION["restaurent"]))
        {                    
	            foreach($_SESSION["restaurent"] as $keys => $values):	                    
        ?>
            <div class="item">
              <span class="price">$<?php echo $values["product_quantity"] * $values["product_price"]; ?></span>
              <p class="item-name">Product <?php echo $count; $count++;?></p>
              <p class="item-description"><?php echo $values["product_name"];?></p>
            </div>
      <?php

        $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);		
         endforeach;
      ?>	
                                
                     
                <div class="total">Total<span class="price">$<?php echo $total_price;?></span></div>
                     
                   </div>
                    
                   <div class="card-details">
                   <h3 class="title">Select your table</h3>
                     <div class="row">  
                     <div class="form-group col-sm-6">
                         <label for="name">Name</label>
                         <input id="nom"  name="nom" type="text" class="form-control" placeholder="Your name" aria-label="Name" aria-describedby="basic-addon1" autocomplete="off">
                         <small id="nameHelp" class="form-text text-muted">Only Letters (length between 3-10).</small>
                     </div>   
                     <div class="form-group col-sm-6">
                         <label for="prenom">Last name</label>
                         <input id="prenom" name="prenom" type="text" class="form-control" placeholder="Your Last name" aria-label="prenom" aria-describedby="basic-addon1" autocomplete="off">
                         <small id="prenomHelp" class="form-text text-muted">Only Letters (length between 3-10).</small>
                     </div> 
         
                     <div class="form-group col-sm-6">
                         <label for="table-select">Choose a table:</label>
                             <select name="list" id="list">
                             <option value="">--Please choose an option--</option>
                             <?php 
                                    include "cnx.php";
                                    $query='select * from reservation_table where status="1"';
                                    $test=$con->query($query);
                                    $row=$test->num_rows;
                                    
                                    if($row>0):
                                    while($fetch=$test->fetch_assoc()):                         
                              ?>
                               <option value="<?php echo $fetch["id_table"];?>"><?php echo $fetch["id_table"];?></option>
                               <?php 
                                     endwhile;
                                   endif;
                                   $con->close();
                               ?>
                             </select>
                             <small id="tableHelp" class="form-text text-muted">Select your current table please.</small>
         
                       </div>
                       <div class="form-group col-sm-6"></div>                   
                     
                       <div class="form-group col-sm-6">
                         <button type="reset" name="reset" class="btn btn-secondary btn-block">Cancel</button>
                       </div>

                       <div class="form-group col-sm-6">
                         <button type="button" id="submit" name="submit" class="btn btn-primary btn-block" >Proceed</button>
                       </div>
                                          
                     </div>
                   </div>
                 
               </div>
             </section>

        <?php } ?>  
             
  
              
