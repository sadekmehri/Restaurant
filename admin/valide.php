<?php 
      error_reporting(0);
      session_start();
      require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
      if( isset($_SESSION["user"]) ){

        $idletime = 300 ; 
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
        <li class="breadcrumb-item active">Validation Orders</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Validation Orders</div>
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
                        <input type="button" name="search" id="search" value="Search" class="btn btn-success"  />
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
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

        <div class="card-footer small text-muted">Updated
            <?php Print(date("d-m-Y").' '.date("H:i"));  ?>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Id : </label>
                        <input type="text" id="id_order" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Order : </label>
                        <input type="text" id="nom" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Table : </label>
                        <input type="text" id="table" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Price: </label>
                        <input type="text" id="price" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Status : </label>
                        <select class="form-control" id="status">
                            <?php  $array = array(
                      "0" => "Pending",
                      "1" => "Canceled",
                      "2" => "Done"         
                    ); 
                    foreach ($array as $value) :
                  ?>
                                <option value="<?php echo $value;?>">
                                    <?php echo $value;?>
                                </option>
                                <?php 
                         endforeach;                                             
                    ?>

                        </select>

                        <small id="emailHelp" class="form-text text-muted">Pending - Canceled - Done</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <button name="action" id="action" class="btn btn-success">Validate</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.btn-info', function() {
                $('#myModal').modal('toggle');
                $('.modal-title').text("Validating Product");
                var user_id = $(this).attr("id");
                var currow = $(this).closest('tr');
                var nom = currow.find('td:eq(3)').text();
                var table = currow.find('td:eq(2)').text();
                var price = currow.find('td:eq(4)').text();
                var status = currow.find('td:eq(5)').text();
                $('#nom').val(nom);
                $('#table').val(table);
                $('#price').val(price);
                $('#status').val(status);
                $('#user_id').val(user_id);
                $('#id_order').val(user_id);
            });

            $('#action').click(function() {
                var id = $('#user_id').val();
                var status = $('#status').val();
                var action = "submit";
                $.ajax({
                    url: './include/tables/modification.php',
                    method: 'post',
                    data: {
                        action: action,
                        id: id,
                        status: status
                    },
                    success: function(data) {
                        $("#notif").fadeIn(500).html(data);
                        $('#myModal').modal('toggle');
                        $('#order_data').DataTable().ajax.reload();
                    }
                });
            });

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
                        url: "./include/tables/fetch_valide.php",
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
                        "targets": [6],
                        "orderable": false
                    }, {
                        "targets": [4],
                        "orderable": false
                    }, {
                        "targets": [5],
                        "orderable": false
                    }],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]

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

        });
    </script>

<?php
}else{
header("Location:login.php");
} 
$con->close();
?>