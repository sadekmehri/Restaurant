
<?php
   
    error_reporting(0);
    include "cnx.php";
	
	function tr($don){
	 $don=strip_tags($don);
	 $don=stripslashes($don);
	 $don=trim($don);
	 return($don);
  }

	
	if(isset($_POST["x"])){
		
         $data=tr($_POST["x"]);
         $query = " SELECT * FROM product join product_type using(category)
             WHERE nom LIKE '%".$data."%'
             OR type LIKE '%".$data."%' 
             ";
			 
     $test=$con->query($query);
     $fetch=$test->num_rows;
     if($fetch>0){
         while($row=$test->fetch_assoc()){	 
		 
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
               <input type="text" name="quantity" id="quantity<?php echo $row['id_product']; ?>" class="form-control" value="1" /><br>
               <button class="btn btn-info" style="display:inline-block;"id="<?php echo $row['id_product'];?>">View | <i class="fa fa-eye"></i></button>
               <button style="display:inline-block;" name="add_to_cart"  id="<?php echo $row['id_product'];?>" class="btn btn-success">Buy | <i class="fas fa-shopping-cart"></i></button>
               </div>            
            </div>
        </div>          
    </div>
	
<?php     
		}
	}	
	  
	}else{
    
?>	
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/1.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Pizza</h4>
            <div class="card-body text-center">
               <button id="11a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/2.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="22a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/3.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="33a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/4.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Jus</h4>
            <div class="card-body text-center">
               <button id="44a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		 
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/5.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="55a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/6.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="66a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/7.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="77a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		
		    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">          
          <div class=" cardrounded-0 p-0 shadow p-3">
            <div class="shop"><div class="shop-img"><img src="photo/index/8.png" class="card-img-top"></div></div>
            <h4 class=" h4 text-center">Crepe</h4>
            <div class="card-body text-center">
               <button id="88a" class="btn btn-primary btn-sm">Preview <i class='fas fa-angle-right'></i></button>
            </div>
          </div>          
        </div>
		 
      
<?php
	}
	$con->close();
?>
		
	
      
	


  
