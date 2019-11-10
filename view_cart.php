<?php error_reporting(0); session_start(); ?>
<section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>One more Step</h2>
          <p>Please Check out your order .</p>
        </div>
   
    <div class="products">
		 <div class="container mb-4">
           <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>				
					  <tr>
                          <th scope="col"><input type="checkbox" id="checkAll"> </th>
                          <th> </th>
                          <th scope="col">Product</th>
                          <th scope="col">Available</th>
                          <th scope="col" class="text-center">Quantity</th>
                          <th scope="col" class="text-right">Price</th>
                          <th> </th>
                      </tr>
                    </thead>
					
					<tbody>
		
    <?php

        $total_price = 0;
        if(!empty($_SESSION["restaurent"])):         
            foreach($_SESSION["restaurent"] as $keys => $values):
                        		
	?>		     
			              <tr>
                        <td><input class="checkbox" type="checkbox" id="<?php echo $values['product_id'] ?>" name="id[]"></td>
                        <td><img src="./photo/<?php echo $values['product_photo']; ?>" width="125" height="75"></td>
                        <td><?php echo $values["product_name"];?></td>
                        <td>In stock</td>
                        <td >
                        <input type="hidden" name="hidden_name" id="name<?php echo $values['product_id']; ?>" value="<?php echo $values['product_name']; ?>" />
                        <input type="hidden" name="hidden_name" id="photo<?php echo $values['product_id']; ?>" value="<?php echo $values['product_photo']; ?>" />
                        <input type="hidden" name="hidden_price" id="price<?php echo $values['product_id']; ?>" value="<?php echo $values['product_price']; ?>" />
                        <input type="number" name="quantity" id="quantity<?php echo $values['product_id']; ?>" class="form-control" value="<?php echo $values["product_quantity"];?>" /><br>
                        </td>
                        <td class="text-right"><?php echo $values["product_quantity"] * $values["product_price"]; ?> €</td>
                        <td class="text-right"><button class="btn btn-sm btn-warning" id="<?php echo $values["product_id"];?>"><i class="fas fa-sync-alt"></i></button></td>
                        <td class="text-right"><button class="btn btn-sm btn-danger" id="<?php echo $values["product_id"];?>"><i class="fa fa-trash"></i></button></td>
                    </tr>  
    <?php   
                $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);	
            endforeach;	
    ?>                                 					
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td class="text-right"><?php echo $total_price;?> €</td>
                        <td></td>
                    </tr>
                      
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">

              <div class="form-group col-sm-6">
                  <button type="button" class="btn btn-danger btn-block" id="delete">Delete</button>
                </div> 
              <div class="form-group col-sm-6">          
                <button type="submit" id="check_out"class="btn btn-primary btn-block">Proceed</button>
              </div>
            </div>
        </div>
    </div>
</div>

    <?php   
         endif;          		
    ?>          

        </div>
	</div>
</section>

