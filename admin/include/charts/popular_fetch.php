<?php
 error_reporting(0);
 require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
$hi=0;$string="";
function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 


 $query = "select nom,count(*) as number from final join product using(id_product)  where order_status ='Done' ";

 
if(isset($_POST["start_date"]) && !empty($_POST["start_date"]) && isset($_POST["end_date"]) && !empty($_POST["end_date"]) )
{
  if(empty($_POST["category"]))
  {
    $query .= ' AND date_vente BETWEEN "'.verif($_POST["start_date"]).'" AND "'.verif($_POST["end_date"]).'"';
  }
  else
  {
     $query .= ' AND date_vente BETWEEN "'.verif($_POST["start_date"]).'" AND "'.verif($_POST["end_date"]).'" AND  category= "'.verif($_POST["category"]).'"';
  }

 }
 else
 {
  
  if(isset($_POST["category"]) && !empty($_POST["category"]))
  {
  $query .= ' AND category = "'.verif($_POST["category"]).'"';
  }

}

 $query .= " GROUP BY nom"; 

 $result = mysqli_query($con, $query);  
 ?>  
    
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['nom', 'Number'],  
            <?php 
              if(mysqli_num_rows($result)>0){ 
                 while($row = mysqli_fetch_array($result))  
                 {  
                    echo "['".$row["nom"]."', ".$row["number"]."],";  
                 }
              }
              else
              {
                echo "['".$string."', ".$hi."],";
                $err='<script>toastr["error"]("Pas d\'information a afficher !");</script>';
              } 
                $con->close();             
            ?>  
        ]);

        var options = {
          title: 'Fruits Data',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }


     
    </script>

     
    <div id="donutchart" style="width: 900px; height: 500px;"></div> 
    <?php echo $err; ?>
