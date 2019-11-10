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
        <li class="breadcrumb-item active">Revenue</li>
    </ol>

    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-chart-area"></i> Revenue Chart </div>

        <div class="row">

            <div class="col-md-4">
               </br>
                <div class="input-daterange">
                        <div class="col-md-12">
                            <input type="text" name="start_date" id="start_date" class="form-control" autocomplete="off" />
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="end_date" id="end_date" class="form-control" autocomplete="off" />
                        </div>
                    </div>
            </div>

            <div class="col-md-4">
                <div class="col-md-12">
                    <small id="test" class="form-text text-muted">Select category</small>
                    <select class="form-control" name="list" id="status" required>
                        <option value="">--Please choose an option--</option>
                        <?php 

                       $query='select * from product_type ';
                       $test=$con->query($query);
                       $row=$test->num_rows;
                       if($row>0):
                          while($fetch=$test->fetch_assoc()):                         
                    ?>
                            <option value="<?php echo $fetch["category"];?>">
                                <?php echo $fetch["type"];?>
                            </option>
                            <?php 
                          endwhile;
                        endif;
                    ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <br/>
                <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="fetchs"></table>
            </div>

        </div>
        <div class="card-footer small text-muted">Updated
            <?php Print(date("d-m-Y").' '.date("H:i"));  ?>
        </div>

    </div>

    <script>
        $(document).ready(function() {

            load_data();

            function load_data(start_date = '', end_date = '', category = '') {
                $.ajax({
                    url: "./include/charts/revenue_fetch.php",
                    method: "POST",
                    data: {
                        category: category,
                        start_date: start_date,
                        end_date: end_date
                    },
                    beforeSend: function() {
                        $('#fetchs').html("<img src='./photo/loader.gif' />");
                    },
                    success: function(data) {
                        $("#fetchs").fadeIn(500).html(data);
                    }
                });
            }

            $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
            });

            $('.btn-info').click(function() {
                var status = $("#status").val();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date != '' && end_date != '' && status != '') {
                    load_data(start_date, end_date, status);
                } else if (start_date != '' && end_date != '' && status == '') {
                    load_data(start_date, end_date);
                } else if (start_date == '' && end_date == '' && status != '') {
                    load_data("", "", status);
                } else if (start_date == '' && end_date == '' && status == '') {
                    toastr["error"]("Provide valid informations!");
                }
            });

        });
    </script>

    <?php
}else{
header("Location:login.php");
}
$con->close(); 
?>