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
        <li class="breadcrumb-item active">Updating Orders</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Updating Product</div>
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
                            <th>Update</th>
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
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                            <label for="categorys">Category :</label>
                            <select class="form-control" id="categorys" name="category" autocomplete="off" required>
                                <?php  
                $sql='select * from product_type';
                $test = $con->query($sql);while($row = $test->fetch_assoc() ):
              ?>
                                    <option value="<?php echo $row["category"];?>">
                                        <?php echo $row["type"];?>
                                    </option>
                                    <?php endwhile; $con->close();?>
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
                            <input type="text" name="price" id="price" class="form-control" pattern="[0-9]+(\.[0-9]{0,2})?%?" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                            <label for="descriptions">Description :</label>
                            <textarea class="form-control" rows="5" maxlength="200" minlength="10" name="description" id="descriptions" required>
                            </textarea>
                            <small id="emailHelp" class="form-text text-muted">10: Min - 200: Max</small>
                        </div>

                        <div class="form-group">
                            <label for="user_image">Example file input :</label>
                            <input type="file" class="form-control-file" name="user_image" id="user_image" />
                            <small id="emailHelp" class="form-text text-muted">Max 3MB</small>
                            <span id="user_uploaded_image"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-warning" value="Update" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                    url: "./include/products/fetch_updating.php",
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
                    "targets": [4],
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

        $(document).on('click', '.btn-success', function() {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "./include/products/fetch_single.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(data) {
                    $('#xxx').modal('toggle');
                    $('.modal-title').text("Edit Product");
                    $('#name').val(data.first_name);
                    $('#categorys').val(data.category);
                    $('#descriptions').val(data.description);
                    $('#price').val(data.price);
                    $('#status').val(data.status);
                    $('#user_id').val(data.id);
                    $('#operation').val("update");
                    $('#user_uploaded_image').html(data.user_image);
                }
            })
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var id = $('#user_id').val();
            var extension = $('#user_image').val().split('.').pop().toLowerCase();

            if (extension != '') {
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    toastr["error"]("Invalid Image File");
                    $('#user_image').val('');
                    return false;
                }
            }

            if (id != '') {
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
                        $('#data-table').DataTable().ajax.reload();
                    }
                });
            } else {
                toastr["error"]("Fields are required!");
            }

        });
    </script>

    <?php
}else{
header("Location:login.php");
}
$con->close(); 
?>