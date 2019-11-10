<?php 
      error_reporting(0);
      session_start();
      require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
      if( isset($_SESSION["user"]) ){

        $idletime = 1800 ; 
        if ( time() - $_SESSION ['timestamp'] > $idletime ) {
            header("Location:logout.php");
        } else {
            $_SESSION ['timestamp'] = time();
        }
?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">History</li>
    </ol>
    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-chart-area"></i> Logging activity</div>
        <div class="card-body">
            <?php

              echo '<h3 class="h3">Latest History</h3>';
              $file = file("./file/log_activity.txt");
                for ($i = count($file); count($file)-15< $i; $i--) {
                  echo "<pre>";
                  echo $file[$i];
                  echo "</pre>";            
              }
              fclose($file); 
?>

        </div>
        <div class="card-footer small text-muted">Updated
          <?php Print(date("d-m-Y").' '.date("H:i"));  ?>
        </div>
    </div>

<?php
}else{
header("Location:login.php");
} 
$con->close();
?>