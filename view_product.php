<?php error_reporting(0); session_start(); include "cnx.php";

    if(!empty($_SESSION["view_cart"])):         
        $sql="select * from product where id_product='".$_SESSION["view_cart"][0]."'";
        $test=$con->query($sql);
        $fetch=$test->num_rows;
        if($fetch>0):
          while($row=$test->fetch_assoc()):

?>


     <ul class="product-list-vertical">
        <li>

            <a href="#" class="product-photo">
                <img class="card-img-top" src="./photo/<?php echo $row['photo'];?>"  width="215" height="200" alt="<?php echo $row['photo'];?>" />
            </a>

            <div class="product-details">
  
                <h2><a href="#"><?php echo $row['nom']; ?> <p class="product-price">$<?php echo $row['price']; ?></p></a></h2>
				
                <div class="product-rating">             
                    <span>
					    <a href="#">
						     <?php	$sqls="select count(*) from final where id_product='".$_SESSION["view_cart"][0]."'";
		                            $tests=$con->query($sqls);
		                            $rows=$tests->fetch_assoc();
						            echo $rows['count(*)'];?> orders <i class="fas fa-cart-arrow-down"></i>
						</a>
				    </span>											
                </div>

				<p class="product-description"><?php echo $row['description']; ?></p>
				<input type="hidden" name="hidden_name" id="name<?php echo $row['id_product']; ?>" value="<?php echo $row['nom']; ?>" />
                <input type="hidden" name="hidden_name" id="photo<?php echo $row['id_product']; ?>" value="<?php echo $row['photo']; ?>" />
				<input type="hidden" name="hidden_price" id="price<?php echo $row['id_product']; ?>" value="<?php echo $row['price']; ?>" />
                <input type="number" name="quantity" id="quantity<?php echo $row['id_product']; ?>" class="form-control" value="1" /><br>
                <div class="text-center">
                <button  name="add_to_cart"  id="<?php echo $row['id_product'];?>" class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>       		
                </div>
            </div>

        </li>
    </ul>

<?php 
   endwhile;
  endif;
endif;
$con->close();

?>


 



