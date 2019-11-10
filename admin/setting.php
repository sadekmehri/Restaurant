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

                    <div>
                        <div class="card-body">
                            <div class="row">
                                <!-- 1 -->
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Reset Password</strong> <i class="fas fa-key"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample">
                                            <div class="card-body">
                                                <form method="POST" id="userForm">

                                                    <div class="form-group">
                                                        <label for="email">Email Account</label>
                                                        <input id="email" type="email" class="form-control" name="email" value="<?php echo $_SESSION["user"]?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="status">Security Question : </label>
                                                        <select class="form-control" id="status" name="status">
                                                            <?php  $sql="select question,id_question from user_restaurent join security_question using(id_question) 
where email ='".$_SESSION["user"]."'";

    $test = $con->query($sql);while($row = $test->fetch_assoc() ):
    ?>
                                                                <option value="<?php echo $row["id_question"];?>">
                                                                    <?php echo $row["question"];?>
                                                                </option>
                                                                <?php endwhile;?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="text">Answer : </label>
                                                        <input id="text" type="text" class="form-control" name="text" autocomplete="off" required>
                                                        <small id="answerHelp" class="form-text text-muted">
                                                    Security question Answer </small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password </label>
                                                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" required data-eye>
                                                        <small id="passwordHelp" class="form-text text-muted">
                                                    Length should be between 3 and 12 </small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password1">Repeat Password </label>
                                                        <input id="password1" type="password" class="form-control" name="password1" autocomplete="off" required data-eye>

                                                    </div>

                                                    <div class="form-group no-margin">
                                                        <input type="hidden" class="form-control" name="submit" value="update">

                                                        <input type="submit" class="btn btn-primary btn-block" name="submit" id="submit" value="Reset">
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->

                                <div class="col-xl-6 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample2" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Security Quetion</strong> <i class="fas fa-thermometer-half"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample2">
                                            <div class="card-body">

                                                <form method="POST" id="resetForm">
                                                    <div class="form-group">
                                                        <label for="email1">Email Account</label>
                                                        <input id="email1" type="email" class="form-control" name="user" value="<?php echo $_SESSION["user"]?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="status1">Security Question : </label>
                                                        <select class="form-control" id="status1" name="question">
                                                            <?php  $sql="select question,id_question from security_question";

    $test = $con->query($sql);while($row = $test->fetch_assoc() ):
    ?>
                                                                <option value="<?php echo $row["id_question"];?>">
                                                                    <?php echo $row["question"];?>
                                                                </option>
                                                                <?php endwhile;?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="text1">Answer : </label>
                                                        <input id="text1" type="text" class="form-control" name="answer" autocomplete="off" required>
                                                    </div>
                                                    Code :
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="code" id="code" autocomplete="off" required>
                                                        <div class="input-group-append">

                                                            <button type="button" class="btn btn-success" id="clicks" type="button"><i class="fas fa-redo-alt"></i></button>
                                                           
                                                        </div>

                                                    </div>
                                                     <small id="passwordHelp" class="form-text text-muted">
                                                    Code will be sent to your email </small>
                                                    
                                                    <br/>
                                                    <div class="form-group no-margin">
                                                        <input type="hidden" class="form-control" name="submit" value="reset">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Change Question
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div href="#collapseCardExample3" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <strong>Change Photo</strong> <i class="far fa-image"></i>
                                        </div>
                                        <div class="collapse show" id="collapseCardExample3">
                                            <div class="card-body">
                                                <form method="POST" id="photoForm">

                                                     <div class="form-group">
                                                        <input type="file" class="form-control" name="photo" id="photo" required>
                                                        <small id="emailHelp" class="form-text text-muted">
                                                        Max 5MB - gif , png , jpg , jpeg</small>

                                                    </div>

                                                  
                                                    
                                                    <div class="form-group no-margin">
                                                        <input type="hidden" class="form-control" name="submit" value="photo">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Update photo
                                                        </button>

                                                    </div>
                                                </form>



                                            </div>
                                        </div>
                                    </div>
                                </div>

                                


                            </div>

                        </div>
                    </div>
               

    <script type="text/javascript">
        
        $(document).on('submit', '#userForm', function(event) {
            event.preventDefault();

            $.ajax({
                url: "./include/settings/verif_setting.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#view_cart").html(data.message);
                    $('#userForm')[0].reset();
                }
            });
        });

        $("#clicks").click(function(){
            toastr["info"]("Code was successfully Sent Please check your mail box");
            $(this).prop('disabled', true);
            $(this).fadeOut();
            var submit = "send";

            $.ajax({
                url: "./include/settings/verif_setting.php",
                method: 'POST',
                data: {submit:submit}             
            });
        });

        $(document).on('submit', '#resetForm', function(event) {
            event.preventDefault();

            $.ajax({
                url: "./include/settings/verif_setting.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#view_cart").html(data.message);
                    $('#resetForm')[0].reset();
                }
            });
        });

        $(document).on('submit', '#photoForm', function(event) {
            event.preventDefault();
          
            var extension = $('#photo').val().split('.').pop().toLowerCase();

            if (extension != '') {
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) 
                {
                    toastr["error"]("Invalid Image File");
                    $('#photo').val('');
                    return false;
                }
            }
          
                $.ajax({
                    url: "./include/settings/verif_setting.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#view_cart").html(data.message);  
                        $('#photoForm')[0].reset();
                     
                         setTimeout(function() {
                            location.reload();
                        }, 1000);                              
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