<?php
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 

$columns = array('id_product', 'photo','nom', 'type', 'description','price','status');
$query = "SELECT * FROM `product` join product_type using (category)";


$query .= " WHERE ";
if(isset($_POST["is_category"]))
{
 $query .= "type = '".verif($_POST["is_category"])."' AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (id_product LIKE "%'.$_POST["search"]["value"].'%" 
  OR photo LIKE "%'.$_POST["search"]["value"].'%"
  OR nom LIKE "%'.$_POST["search"]["value"].'%"  
  OR type LIKE "%'.$_POST["search"]["value"].'%" 
  OR description LIKE "%'.$_POST["search"]["value"].'%"
  OR price LIKE "%'.$_POST["search"]["value"].'%"
  OR status LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id_product ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($con, $query));

$result = mysqli_query($con, $query . $query1);


$data = array();


foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id_product'];
 $sub_array[] = '<img src="../photo/'.$row["photo"].'" class="img-thumbnail" width="125" height="125" />';
 $sub_array[] = $row['nom'];
 $sub_array[] = $row['type'];
 $sub_array[] = $row['description'];
 $sub_array[] = '$ '.$row['price'];
 $sub_array[] = $row['status'];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM product";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($con),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>


