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
        <li class="breadcrumb-item active">Import Data</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Import Data</div>
        <div class="card-body">

            <form id="upload_csv" method="post" enctype="multipart/form-data">

                <div class="col-md-4">
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" required/>
                </div>
                <div class="col-md-5">
                    <small id="emailHelp" class="form-text text-muted">*.csv ,file size should be <=5MB </small>
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-success" />
                </div>
                <div style="clear:both"></div>
            </form>

            <br/>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>Reservation</th>
                            <th>Date</th>
                            <th>Table</th>
                            <th>Order</th>
                            <th>Price</th>
                            
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
        $(document).ready(function() {

            $('#upload_csv').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "./include/tables/import_fetch.php",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(jsonData) {
                        $('#csv_file').val('');
                        $('#data-table').DataTable({
                            data: jsonData,
                            columns: [{
                                data: "Reservation"
                            }, {
                                data: "Date"
                            }, {
                                data: "Table"
                            }, {
                                data: "Order"
                            }, {
                                data: "Price"
                            }],                   
                            "columnDefs": [{
                                "targets": [0],
                                "orderable": false
                            }, {
                                "targets": [1],
                                "orderable": false
                            }, {
                                "targets": [2],
                                "orderable": false
                            }, {
                                "targets": [3],
                                "orderable": false
                            }],                          
                            "lengthMenu": [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ]
                        });
                    }
                });
            });
        });
    </script>

    <?php
}else{
header("Location:login.php");
} 
$con->close();
?>