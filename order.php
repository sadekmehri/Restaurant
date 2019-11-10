<div class="container">
   <h1 class="text-center"> Top Orders <i class="fas fa-cart-arrow-down"></i></h1>
      <div class="row">
    
<?php 
  error_reporting(0);
  include "cnx.php";
  $sql="SELECT  *,count(id_product) FROM final join(product) using(id_product) group by(id_product) order by  count(id_product) desc limit 3";
  $test=$con->query($sql);
  $fetch=$test->num_rows;
  if($fetch>0){
    while($row=$test->fetch_assoc()):
?>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
      <ul class="product-list-basic">
        <li>

            <a href="##" class="product-photo">
                <img  class="card-img-top" src="./photo/<?php echo $row['photo'];?>"  width="215" height="200" alt="<?php echo $row['nom']; ?>" />
            </a>

            <h4 class="h4 text-center"><?php echo $row['nom']; ?></h4>
    
            <p class="product-description"><?php echo $row['description']; ?></p>
            <hr>
			<input type="hidden" name="hidden_name" id="name<?php echo $row['id_product']; ?>" value="<?php echo $row['nom']; ?>" />
            <input type="hidden" name="hidden_name" id="photo<?php echo $row['id_product']; ?>" value="<?php echo $row['photo']; ?>" />
			<input type="hidden" name="hidden_price" id="price<?php echo $row['id_product']; ?>" value="<?php echo $row['price']; ?>" />
            <input type="number" name="quantity" id="quantity<?php echo $row['id_product']; ?>" class="form-control" value="1" /><br>
            <button  name="add_to_cart"  id="<?php echo $row['id_product'];?>" class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>      
            <p class="product-price">$<?php echo $row['price']; ?></p>
        </li>
      </ul>
    </div>
<?php 
   endwhile;
  }else{
?>


<div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured,there is not transaction yet, Requested page not found!
                </div>
            </div>
         </div>
<?php 
  }
?>
        
      </div>
    </div>
 </div>