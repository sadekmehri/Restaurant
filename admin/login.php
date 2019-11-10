<?php
error_reporting(0);
session_start();require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php";
if(isset($_SESSION["user"])) {
 header('location:index.php');
}else{

$err="";
$test = true;

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
}

//recuperer @ ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$final = date("d-m-Y")." ".date("H:i");

if(isset($_POST["submit"]))
{
  if( empty($_POST["email"]) || empty($_POST["password"])  )
  {
    $test = false;
    $err.= '<script>toastr["error"]("Please provide us with valid informations!");</script> ';   
  }

  if( isset($_POST["email"]) && (!empty($_POST["email"])) )
  {
    if (filter_var(verif($_POST["email"]), FILTER_VALIDATE_EMAIL)) 
    {
      $email = verif($_POST["email"]); 
    }else{
      $err.= '<script>toastr["error"]("Invalid Email!");</script> ';
      $test = false;
    }
  }

  if( isset($_POST["password"]) && (!empty($_POST["password"])) )
  {
    $pass = verif($_POST["password"]);
    $pass =  sha1($pass);
  }  

   if($test)
   {
     $sql="select * from user_restaurent where password ='$pass' and email ='$email'";
     $test = $con->query($sql);
      if($test->num_rows == 1)
      {  
            $status=$email." was logged in ".$final." using this adress ip ".$ip."\n";   
            $dest = "./file/log_activity.txt";  
            $file = fopen($dest,"a+");
            fwrite($file,$status); 
            fclose($file);     
            $_SESSION["user"] = $email;
            $_SESSION ['timestamp'] = time();
            while($row = $test->fetch_assoc()) { $_SESSION["id_user"] = $row["id_user"];}
            header("location:index.php");                                            
      }
      else
      {
        $err.= '<script>toastr["error"]("Invalid credentials!");</script> ';
      }
   }
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin">
        <title>Admin</title>
        <link rel="icon" href="./photo/admin.png">
        <!-- css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/toastr.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
        <!-- js -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/toastr.js"></script>
        <script src="js/app.js"></script>
    </head>

    <body>

        <!-- body -->

        <body class="my-login-page">
            <section class="h-100">
                <div class="container h-100">
                    <div class="row justify-content-md-center h-100">
                        <div class="card-wrapper">
                            <div class="brand">
                                <img src="./photo/admin.png">
                            </div>
                            <div class="card fat">
                                <div class="card-body">
                                    <h4 class="card-title" align="center">Login</h4>
                                    <form method="POST">

                                        <div class="form-group">
                                            <label for="email">Email Account</label>
                                            <input id="email" type="email" class="form-control" name="email" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password </label>
                                            <input id="password" type="password" class="form-control" name="password" autocomplete="off" required data-eye>
                                        </div>

                                        <div class="form-group no-margin">
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </body>

    </html>
    <?php
  echo $err;
  }
  $con->close();
  ?>