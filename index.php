<?php 
    error_reporting(0); 
    session_start();
    include 'cnx.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Our restaurent">
    <title>Restaurent</title>
	  <link rel="icon" href="photo/icon.png">
    <!-- css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/payment.css">    
    <link rel="stylesheet" href="css/basic.css"> 
    <link rel="stylesheet" href="css/toastr.css" > 
    <link rel="manifest" href="manifest.json">   	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" >
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/toastr.js"></script>

    <style>
      body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
      .error-template {padding: 40px 15px;text-align: center;}
      .error-actions {margin-top:15px;margin-bottom:15px;}

      #load {position: absolute; background:  url('./css/loader.gif') no-repeat center center; top: 0; left: 0; width: 100%; height: 100%;}
    </style>



</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="index.php">Restaurent</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <!-- sidebar-header  -->
      <div class="sidebar-search" >
        <div>
          <div class="input-group" >
            <input type="text" class="form-control search-menu" placeholder="Search..." id="typing" autocomplete="off">
            <div class="input-group-append">
               <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
		
          <li class="header-menu">
            <span>General</span>
          </li>
		  
          <li class="sidebar-dropdown" id="111a">
            <a href="#">
              <i class='fas fa-pizza-slice'></i>
              <span >Pizza</span>
              <?php 
                $query='select * from product join product_type using (category) where type="pizza" and status ="1"';
                $test=$con->query($query);
              ?>
              <span class="badge badge-pill badge-danger"> <?php echo $test->num_rows; ?></span>
            </a>        
          </li>
		  
          <li class="sidebar-dropdown" id="222a">
            <a href="#">
              <i class="fas fa-hamburger"></i>
              <span>Sandwich</span>
              <?php 
                $query='select * from product join product_type using (category) where type="san" and status ="1"';
                $test=$con->query($query);
              ?>
              <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>
            
          </li>
		  
          <li class="sidebar-dropdown" id="333a">
            <a href="#">
              <i class='fas fa-coffee'></i>
              <span>Coffee</span>
              <?php 
                $query='select * from product join product_type using (category) where type="coffee" and status ="1"';
                $test=$con->query($query);
              ?>
			        <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>           
          </li>
		  
		    <li class="sidebar-dropdown" id="444a">
            <a href="#">
              <i class="fas fa-cocktail"></i>
              <span>Jus</span>
              <?php 
                $query='select * from product join product_type using (category) where type="jus" and status ="1"';
                $test=$con->query($query);
              ?>
              <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>        
            </a>         
          </li>
		  	  
		    <li class="sidebar-dropdown" id="555a">
            <a href="#">
              <i class="fas fa-mug-hot"></i>	
              <span>Tea</span>
              <?php 
                $query='select * from product join product_type using (category) where type="tea" and status ="1"';
                $test=$con->query($query);
              ?>
			        <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>         
          </li>
		  
		    <li class="sidebar-dropdown" id="666a">
            <a href="#">
              <i class="fas fa-ice-cream"></i>
              <span>Ice cream</span>
              <?php 
                $query='select * from product join product_type using (category) where type="ice cream" and status ="1"';
                $test=$con->query($query);
              ?>
			        <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>         
          </li>
		  
		  	  
		    <li class="sidebar-dropdown" id="777a">
            <a href="#">
              <i class="fas fa-stroopwafel"></i>	
              <span>Waffle</span>
              <?php 
                $query='select * from product join product_type using (category) where type="waffle" and status ="1"';
                $test=$con->query($query);
              ?>
			        <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>         
          </li>
		  
          <li class="sidebar-dropdown" id="888a">
            <a href="#">
              <i class="fas fa-candy-cane"></i>
              <span>Crepe</span>
              <?php 
                $query='select * from product join product_type using (category) where type="crepe" and status ="1"';
                $test=$con->query($query);
              ?>
			        <span class="badge badge-pill badge-danger"><?php echo $test->num_rows;?></span>
            </a>         
          </li>

          <li class="header-menu">
            <span>Extra</span>
          </li>

          <li class="sidebar-dropdown" id="recent">
            <a href="#">
              <i class="fas fa-concierge-bell" ></i>
              <span>Recent Orders</span>
            </a>   
          </li>

          <li class="sidebar-dropdown" id="order">
            <a href="#">
            <i class="fa fa-shopping-cart"></i>
              <span>Top Orders</span>
            </a>   
          </li>
       
		      <?php $con->close(); ?>
        </ul>   
      </div>    
    </div> 

    <div class="sidebar-footer">

      <a href="#">
        <i class="fa fa-bell" id="check2"></i>
        <span class="badge badge-pill badge-warning notification">
          <?php $count=0; if(!empty($_SESSION["test"])){$count=sizeof($_SESSION["test"]);}echo $count; ?></span>
      </a>

      <a href="#">
        <i class="fas fa-money-check-alt" id="check1"></i>
        <span class="badge-sonar"></span>
      </a>

    </div>
    
  </nav>

  <main class="page-content"> 
    <div class="container-fluid"> 
  <!-- shopping -->
    <header>
			<div id="header">
				<div class="container">
					<div class="row">       				
						<div class="col-md-12 clearfix">
              <div class="header-logo">							
								<a href="index.php" class="logo">
									<img src="photo/icon.png" alt="logo" width="40" height="40">
								</a>						
              </div>        
							<div class="header-ctn">
								<div class="dropdown">								
									<a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-shopping-cart"></i>                                 
                  <span>Your Cart</span>
										<div class="qty"></div>
									</a>									
									<div class="cart-dropdown"></div>
								</div>
              </div>
              <div>
                <form method="POST"> 
                  <div class="input-group">
                   <input type="text" class="form-control" name="code" id="code" placeholder="Search Your order" autocomplete="off">
                     <div class="input-group-append">
                       <button class="btn btn-secondary" type="button" id="btn">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>                
                    </div>
                 </form> 				
               </div>                 
             </div>
						</div>
					</div>
				</div>
			</div>
		</header>
    <!-- end shopping  -->
       
      <hr>
	 	<!-- Body  -->
      <div id="view_cart"></div>
      <div class="row" id="fetch"></div>
      
 
</main>

<!-- end body  -->
</body>
</html>

<script src="js/menu.js"></script>
<script src="js/menu_navbar.js"></script>
<script src="js/traitement.js"></script>
<script src="js/traitement-1.js"></script>










