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
        <li class="breadcrumb-item active">Adding Product</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Adding Product</div>
        <div class="card-body">
            <button class="btn btn-default" id="add"><i class="fas fa-plus"></i> Adding Product</button>
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
                    $query = "SELECT distinct(type) FROM `product` join product_type using (category)";
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

    <div class="modal fade" id="xxx">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Adding Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="categorys">Category :</label>
                            <select class="form-control" id="categorys" name="category" required>
                                <?php 
                    $query = "SELECT * FROM product_type";
                    $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result)){
                        echo '<option value="'.$row["category"].'">'.$row["type"].'</option>';
                    }$con->close();  
              ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status : </label>
                            <select class="form-control" id="status" name="status" required>
                                <?php  $array = array("0" => "0","1" => "1"); 
                    foreach ($array as $value) :
                  ?>
                                    <option value="<?php echo $value;?>">
                                        <?php echo $value;?>
                                    </option>
                                    <?php  endforeach;$con->close();  ?>
                            </select>
                            <small id="emailHelp" class="form-text text-muted">0: Cancel - 1: Valid</small>
                        </div>

                        <div class="form-group">
                            <label for="price">Price: </label>
                            <input type="text" name="price" id="price" class="form-control" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                            <label for="descriptions">Description :</label>
                            <textarea class="form-control" rows="5" maxlength="200" minlength="10" name="description" id="descriptions" autocomplete="off" required>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_image">Example file input :</label>
                            <input type="file" class="form-control-file" name="user_image" id="user_image" required />
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-warning" value="Update" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="view_cart"></div>
    </body>

    </html>

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
                    "targets": [5],
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

        $("#add").click(function() {
            $('#operation').val('add');
            $('#xxx').modal('toggle');
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var extension = $('#user_image').val().split('.').pop().toLowerCase();

            if (extension != '') 
            {
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) 
                {
                    toastr["error"]("Invalid Image File");
                    $('#user_image').val('');
                    return false;
                }
            }

            if (extension != '') 
            {
                $.ajax({
                    url: "./include/products/insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#view_cart").html(data.message);
                        $('#user_form')[0].reset();
                        $('#xxx').modal('hide');
                        $.ajax({
                            url: 'adding.php',
                            method: 'post',
                            success: function(data) {
                                $("#fetch").fadeIn(500).html(data);

                            }
                        });

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