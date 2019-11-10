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
        <li class="breadcrumb-item active">OverView</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> OverView</div>
        <div class="card-body">
            <div class="table-responsive">
                <br />
                <div class="row">
                    <div class="input-daterange">
                        <div class="col-md-12">
                            <input type="text" name="start_date" id="start_date" class="form-control" autocomplete="off" />
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="end_date" id="end_date" class="form-control" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="button" name="search" id="search" value="Search" class="btn btn-success" />
                    </div>
                </div>
                <br />
                <table id="order_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Reservation</th>
                            <th>Date</th>
                            <th>Table</th>
                            <th>Order</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

        <div class="card-footer small text-muted">Updated
            <?php Print(date("d-m-Y").' '.date("H:i"));  ?>
        </div>
    </div>


    <script>
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });

        fetch_data('no');

        function fetch_data(is_date_search, start_date = '', end_date = '') {
            $('#order_data').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "./include/tables/fetch_overview.php",
                    type: "POST",
                    data: {
                        is_date_search: is_date_search,
                        start_date: start_date,
                        end_date: end_date
                    }
                },
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'csvHtml5',
                    title: 'Data_export'
                }, {
                    extend: 'pdfHtml5',
                    title: 'Data_export'
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }, {
                    "targets": [2],
                    "orderable": false
                }, {
                    "targets": [3],
                    "orderable": false
                }, {
                    "targets": [4],
                    "orderable": false
                }, {
                    "targets": [5],
                    "orderable": false
                }]
            });
        }

        $('#search').click(function() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if (start_date != '' && end_date != '') {
            $('#order_data').DataTable().destroy();
            fetch_data('yes', start_date, end_date);
        } else {
            toastr["error"]("Both data are required!");
        }
        });

        $(document).on('click', '.btn-dark', function() {
            var user_id = $(this).attr("id");
            $('#fetch').html('<img src="./photo/loader.gif" style="display:block;margin: 0 auto;">');
            $.ajax({
                url: "./include/tables/print_single.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    $("#fetch").fadeIn(500).html(data);
                         
                }
            })
        });



        

     
    </script>

    <?php
}else{
header("Location:login.php");
}
$con->close(); 
?>