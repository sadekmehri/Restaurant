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
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin">
        <link rel="icon" href="./photo/admin.png">
        <title>Admin - Dashboard</title>
        <!-- css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/toastr.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <link rel='stylesheet' href='css/dataTables.bootstrap4.min.css'>
        <link rel='stylesheet' href='css/buttons.bootstrap4.min.css'>
        <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
        <script src="js/jquery.min.js"></script>
    
        

        <!-- style -->

    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

            <a class="navbar-brand mr-1" href="index.php">Dashboard</a>

            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Search -->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-danger"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-menu-right" aria-labelledby="userDropdown">

                        <h5 class="dropdown-header">Dropdown header</h5>
                        <div class="dropdown-divider"></div>
                        <div>

                            <a class="dropdown-item" href="#s">Settings</a>
                            <a class="dropdown-item" href="#s">Activity Log</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                     $query = "SELECT photo FROM `user_restaurent`"; 
                     $test = $con->query($query);
                     while($row = $test->fetch_assoc()):
                     ?>
                            <img class="rounded-circle" src="./photo/<?php echo $row["photo"]?>" height="25" width="25" alt="<?php echo $row["photo"]?>">
                            <?php 
                     endwhile;
                     ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" id="setting">Settings</a>
                        <a class="dropdown-item" href="#" id="history1">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </li>

            </ul>

        </nav>

        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span>Tables</span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="#" id="view"> <i class="fas fa-binoculars"></i> OverView</a>
                        <a class="dropdown-item" href="#" id="valid"><i class="fab fa-black-tie"></i> Validation Orders</a>
                        <a class="dropdown-item" href="#" id="import"><i class="fas fa-file-upload"></i> Import Data</a>
                    </div>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-chart-pie"></i>
                        <span>Charts</span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="#" id="revenue"> <i class="fas fa-dollar-sign"></i> Revenue</a>
                        <a class="dropdown-item" href="#" id="pop"><i class="fas fa-shopping-cart"></i> Popular orders</a>
                    </div>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-dolly"></i>
                        <span>Products</span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="#" id="consulting"><i class="fas fa-eye"></i> Consulting</a>
                        <a class="dropdown-item" href="#" id="adding"><i class="fas fa-plus"></i> Adding</a>
                        <a class="dropdown-item" href="#" id="updating"> <i class="fas fa-wrench"></i> Updating</a>
                        <a class="dropdown-item" href="#" id="deleting"><i class="fas fa-eraser"></i> Deleting</a>
                    </div>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" id="history">
                        <i class="fas fa-chart-line"></i>
                        <span>Activity</span></a>
                </li>

            </ul>

            <div id="content-wrapper">

                <div class="container-fluid" id="fetch">
                    <!-- 1 -->
                    <div>
                        <div class="card-body">

                            <!-- Icon Cards-->
                            <div class="row">

                                <div class="col-xl-12 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample0" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Tableau de bord</strong> <i class="fas fa-thumbtack"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample0">
                                            <div class="card-body">
                                                <div class="row">

                                                    <!-- 1 -->
                                                    <div class="col-xl-3 col-sm-12 ">
                                                        <div class="card text-white bg-danger ">
                                                            <div class="card-body">
                                                                <div class="card-body-icon">
                                                                    <i class="fas fa-fw fa-list"></i>
                                                                </div>
                                                                <div class="mr-5">0 New Tasks!</div>
                                                            </div>
                                                            <a class="card-footer text-white clearfix small z-1" href="#">
                                                                <span class="float-left">View Details</span>
                                                                <span class="float-right"><i class="fas fa-angle-right"></i> </span>
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                    <!-- 2 -->
                                                    <div class="col-xl-3 col-sm-12 ">
                                                        <div class="card text-white bg-warning ">
                                                            <div class="card-body">
                                                                <div class="card-body-icon">
                                                                    <i class="fas fa-fw fa-list"></i>
                                                                </div>
                                                                <div class="mr-5">0 New Tasks!</div>
                                                            </div>
                                                            <a class="card-footer text-white clearfix small z-1" href="#">
                                                                <span class="float-left">View Details</span>
                                                                <span class="float-right"><i class="fas fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                    <!-- 3 -->
                                                    <div class="col-xl-3 col-sm-12">
                                                        <div class="card text-white bg-success">
                                                            <div class="card-body">
                                                                <div class="card-body-icon"><i class="fas fa-fw fa-shopping-cart"></i></div>
                                                                <div class="mr-5">

                                                                    <?php
                          $sql='SELECT * FROM final where order_status ="Pending" group by id_reservation';
                          $test = $con->query($sql); echo $test->num_rows; $con->close(); 
                        ?> New Orders!

                                                                </div>
                                                            </div>
                                        <a class="card-footer text-white clearfix small z-1" href="#" id="valid1" >
                                                        <span class="float-left" >View Details</span>
                                                                <span class="float-right"><i class="fas fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                    <!-- 4 -->
                                                    <div class="col-xl-3 col-sm-12">
                                                        <div class="card text-white bg-primary ">
                                                            <div class="card-body">
                                                                <div class="card-body-icon">
                                                                    <i class="fas fa-fw fa-list"></i>
                                                                </div>
                                                                <div class="mr-5">0 New Tasks!</div>
                                                            </div>
                                                            <a class="card-footer text-white clearfix small z-1" href="#">
                                                                <span class="float-left">View Details</span>
                                                                <span class="float-right"><i class="fas fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <!-- 1 -->
                                <div class="col-xl-4 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample3" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Meteo</strong> <i class="fas fa-thermometer-half"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample3">
                                            <div class="card-body">
                                                <div align="center">
                                                    <img src="photo/weather.jpg" width="35" height="35">
                                                    <h2 id="city"></h2>
                                                    <img src="#" alt="icon" id="icon">
                                                    <div class="degrees">
                                                        <h1 id="temp"></h1>
                                                    </div>
                                                    <h3 id="desc"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="col-xl-8 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample4" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Calander</strong> <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample4">
                                            <div class="card-body">
                                                <div align="center">
                                                    <div id="calendar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!--js-->

        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/weather.js"></script>
        <script src="js/calendar.js"></script>
        <script src="js/toastr.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/fullcalendar.min.js"></script>
        

        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js'></script>
        <div id="notif"></div>
        <div id="view_cart"></div>
        <script src="js/traitement.js"></script>

    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(f2);
        $(document).ready(f1);     

    
   
 
    </script>


    <?php
}else{
header("Location:login.php");
} 
$con->close();
?>