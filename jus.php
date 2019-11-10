<?php 
     error_reporting(0);
     include 'cnx.php';
     
     $query="select * from product join product_type using (category) where type='jus' and status ='1'  ";
     $test=$con->query($query);
     $fetch=$test->num_rows;
     if($fetch>0):
         while($row=$test->fetch_assoc()):	 
?>	

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
        <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="./photo/<?php echo $row['photo']; ?>" class="card-img-top"></div></div>
            <h4 class="h4 text-center"><?php echo $row['nom'];?></h4>
            <h4 class="h4 text-center"><span class="text-danger"><?php echo $row['price'];?> D</span></h4>
            <hr>
            <div class="card-body text-center">
               <input type="hidden" name="hidden_name" id="name<?php echo $row['id_product']; ?>" value="<?php echo $row['nom']; ?>" />
               <input type="hidden" name="hidden_name" id="photo<?php echo $row['id_product']; ?>" value="<?php echo $row['photo']; ?>" />
               <input type="hidden" name="hidden_price" id="price<?php echo $row['id_product']; ?>" value="<?php echo $row['price']; ?>" />
               <input type="number" name="quantity" id="quantity<?php echo $row['id_product']; ?>" class="form-control"  value="1" /><br>
               <button class="btn btn-info" style="display:inline-block;"id="<?php echo $row['id_product'];?>">View | <i class="fa fa-eye"></i></button>
               <button style="display:inline-block;" name="add_to_cart"  id="<?php echo $row['id_product'];?>" class="btn btn-success">Buy | <i class="fas fa-shopping-cart"></i></button>
               </div>            
            </div>
        </div>          
    </div>
		
<?php     
     endwhile;
      endif;	
      $con->close();
?>										

