<?php

require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 

if(isset($_POST["user_id"]))
{

?>
    <div class="container" >
        <div class="card" >
            <div class="card-header">
                 <img src="../photo/icon.png" height="40" width="40" class="img-thumbnail">

        <?php
          $sql = "SELECT * FROM `final` join product using(id_product) join product_type using(category) where id_reservation = '".$_POST["user_id"]."' LIMIT 1";
          $query = $con->query($sql);
          while($row = mysqli_fetch_assoc($query)): 
        ?>

                    <?php Print(date("d/m/Y").' '.date("H:i"));  ?>
                        <span class="float-right"> <strong>Status : </strong><?php echo $row["order_status"];?> </span>

            </div>
            <div class="card-body" >
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>Restaurent</strong>
                        </div>

                        <div>Email: xxxxxxxxxxxx</div>
                        <div>Phone: +xxxxxxxxxxx</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong><?php echo $row["client_nom"].' '.$row["client_prenom"];?></strong>
                        </div>

                    </div>

                </div>


        <?php
         endwhile;
        ?>

                    <table class="table table-sm table-striped table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>

                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>

<?php

    $sql = "SELECT * FROM `final` join product using(id_product) join product_type using(category) where id_reservation = '".$_POST["user_id"]."' ";
    $query = $con->query($sql);
    $i=0; $total = 0;
    while($row = mysqli_fetch_assoc($query)):
    $i++;
?>

                                <tr>
                                    <td class="center">
                                        <?php echo $i;?>
                                    </td>
                                    <td class="left strong">
                                        <?php echo $row["nom"];?>
                                    </td>
                                    <td class="left">
                                        <?php echo $row["type"];?>
                                    </td>

                                    <td class="right">$
                                        <?php echo $row["price"];?>
                                    </td>
                                    <td class="center">
                                        <?php echo $row["qty_product"];?>
                                    </td>
                                    <td class="right">$
                                        <?php $sum = $row["price"] * $row["qty_product"]; echo $sum; $total+=$sum;  ?>
                                    </td>
                                </tr>
    <?php
         endwhile;
    ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-sm table-hover table-responsive-sm ">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">$<?php echo $total;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="right">$0</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (10%)</strong>
                                    </td>
                                    <td class="right">$0</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>$<?php echo $total;?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
              <button id="click_print">Print me</button>
        </div>
       


    <br/>
     
</div>


    

    <?php
}

 ?>