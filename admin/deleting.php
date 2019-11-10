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
        <li class="breadcrumb-item active"> Deleting Product</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Deleting Product</div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th width="180px">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Category Search</option>
                                    <?php 
                    $query = "SELECT distinct(type) FROM `product` join product_type using (category)";
                    $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result)){
                    echo '<option value="'.$row["type"].'">'.$row["type"].'</option>';
                  }
                  ?>
                                </select>
                            </th>
                            <th width="280px">Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

        <div class="card-footer small text-muted">Updated
            <?php Print(date("d-m-Y").' '.date("H:i"));  ?>
        </div>

    </div>

    <div class="modal fade" id="xxx">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Comfirm deleting</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        Would You like to delte this Item !!
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id_product" id="id_product" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-warning" value="Delete" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="view_cart"></div>

    <script>
        load_data();

        function load_data(is_category) {
            $('#data-table').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "./include/products/fetch_deleting.php",
                    type: "POST",
                    data: {
                        is_category: is_category
                    }
                },
                "columnDefs": [{
                    "targets": [3],
                    "orderable": false
                }, {
                    "targets": [6],
                    "orderable": false
                }, {
                    "targets": [4],
                    "orderable": false
                }
                 ,{
                    "targets": [5],
                    "orderable": false
                }, {
                    "targets": [1],
                    "orderable": false
                }, {
                    "targets": [7],
                    "orderable": false
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
        }

        $(document).on('change', '#category', function() {
            var category = $(this).val();
            $('#data-table').DataTable().destroy();
            if (category != '') {
                load_data(category);
            } else {
                load_data();
            }
        });

        $(document).on('click', '.btn-danger', function() {
            var user_id = $(this).attr("id");
            $("#id_product").val(user_id);
            $("#operation").val("delete");
            $('#xxx').modal('toggle');
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var id = $('#id_product').val();
            if (id != '') {
                $.ajax({
                    url: "./include/products/insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#xxx').modal('hide');
                        var data = JSON.parse(data);
                        $("#view_cart").html(data.message);
                        $('#user_form')[0].reset();
                        $('#data-table').DataTable().ajax.reload();
                    }
                });
            }
        });
    </script>

    <?php
}else{
header("Location:login.php");
}
$con->close(); 
?>