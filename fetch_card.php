<?php
error_reporting(0);
session_start();

$output="";
$var=0;
$total_price = 0;
$total_item = 0;
$var=count($_SESSION["restaurent"]);



if(!empty($_SESSION["restaurent"]))
{
	foreach($_SESSION["restaurent"] as $keys => $values)
	{
		$output .= '
		<div class="cart-list">						
		  <div class="product-widget">
				<div class="product-img">
				    <img  class="image-responsive" src="photo/'.$values["product_photo"].'" alt="">
				</div>

				<div class="product-body">
	          <h3 class="product-name"><a href="#">'.$values["product_name"].'</a></h3>
						<h4 class="product-price">
						   <span >'.$values["product_quantity"].'x </span>'.number_format($values["product_quantity"] * $values["product_price"], 2).'									 
							 </h4>					
				</div>				
		    </div>
		</div>
		
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}

	$output .= '
	  <div class="cart-summary">
		<small>'.$var.' Item(s) selected</small>
			<h5 class="total_price">$ '.number_format($total_price, 2).'</h5>
	 </div>

		<div class="cart-btns">
		  <a href="#" id="view">View Cart</a>
			<a href="#" id="check">Checkout <i class="fa fa-arrow-circle-right"></i></a>
		</div>	
	';
}
else
{
	$output .= '
	<div class="cart-list">						
		  <div class="product-widget"> 
		     <div class="product-body"> 
    		    Your Cart is Empty!
    		 </div>
    	   </div>
	</div>
    ';
}

$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'$' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>

           