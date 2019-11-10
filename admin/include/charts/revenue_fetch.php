<?php  
 
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
  
$hi=0;
function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 

$query = " SELECT date_vente,sum(qty_product * price) as revenue FROM `final` join product using(id_product)  where order_status ='Done' ";

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

 $query .= " GROUP BY date_vente"; 

 $result = mysqli_query($con, $query);  
 ?>  
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Revenue'],
        <?php 
          if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_array($result))  
                 {  
                    echo "['".$row["date_vente"]."', ".$row["revenue"]."],";  
                 }
            }
            else
            {
              echo "['".$hi."', ".$hi."],";
              $err='<script>toastr["error"]("Pas d\'information a afficher !");</script>';
            } 
                 $con->close(); 
            ?> 
        ]);

        var options = {
          title: 'Company Revenue',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
  
<div id="chart_div" style="width: 100%; height: 500px;"></div>

<?php echo $err; ?>
