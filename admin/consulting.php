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
        <li class="breadcrumb-item active">Consulting</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Consulting Product</div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th width="200px">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Category Search</option>
                                    <?php 
                    $query = "select distinct(type) from product join product_type using (category)";
                    $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result)){
                    echo '<option value="'.$row["type"].'">'.$row["type"].'</option>';
                  }
                  ?>
                                </select>
                            </th>
                            <th width="300px">Description</th>
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
        load_data();

        function load_data(is_category) {
            $('#data-table').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "./include/products/fetch_consulting.php",
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
                }, {
                    "targets": [1],
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
    </script>

    <?php
}else{
header("Location:login.php");
}
$con->close(); 
?>