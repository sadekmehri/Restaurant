<?php
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT']."/test/ajax/cnx.php";

function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
}


$columns = array('id_reservation', 'date_vente','id_table', 'nom', 'price','order_status','action');

$query = "SELECT * FROM `final` join product using(id_product) WHERE ";

if(verif($_POST["is_date_search"]) == "yes")
{
 $query .= 'date_vente BETWEEN "'.verif($_POST["start_date"]).'" AND "'.verif($_POST["end_date"]).'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (id_reservation LIKE "%'.$_POST["search"]["value"].'%" 
  OR date_vente LIKE "%'.$_POST["search"]["value"].'%"
  OR id_table LIKE "%'.$_POST["search"]["value"].'%"  
  OR nom LIKE "%'.$_POST["search"]["value"].'%" 
  OR price LIKE "%'.$_POST["search"]["value"].'%"
  OR order_status LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= ' order by id_reservation , date_vente desc ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($con, $query));

$result = mysqli_query($con, $query . $query1);



$i=0;

$tab=array();
while($data = mysqli_fetch_assoc($result))
{
    $array = array(
        'id_reservation' => $data["id_reservation"],
        'nom' => $data["nom"],
        'table' => $data["id_table"],
        'date_vente' => $data["date_vente"],
        'order_status' => $data["order_status"],
        'qty_product' => $data["qty_product"],
	    'price' => $data["price"]
    );
	$tab[$i] = $array;
	$i++;
}     
    $n= count($tab)-1;
    $i=$prix=0;$ch="";
	$data=array();
				                  
	while($i<=$n)
	{   
		$sub_array=array();
		$sub_array[] = "<div data-target='id_reservation'>".$tab[$i]["id_reservation"]."</div>";
		$sub_array[] = "<div data-target='date'>".$tab[$i]["date_vente"]."</div>";				    	
		$sub_array[] = "<div data-target='table'>".$tab[$i]["table"]."</div>";
					 				  						    
		if( $tab[$i]["id_reservation"] == $tab[$i+1]["id_reservation"] )
		{
			$k = $i;			    		
			while( ($k<$n) && ( $tab[$k]["id_reservation"] == $tab[$k+1]["id_reservation"] ) )
			{		  
                $ch.=' '.$tab[$k]["qty_product"]." * [ ".$tab[$k]["nom"]." ] <br>";	
                $prix+=$tab[$k]["qty_product"] * $tab[$k]["price"];	                             								
				$k++;	
								
			}                                  							
				$ch.= ' '.$tab[$k]["qty_product"]." * [ ".$tab[$k]["nom"]." ]";
				$sub_array[] = "<div data-target='nom'>".$ch."</div>";
				$ch=" ";
                $prix+=$tab[$k]["qty_product"] * $tab[$k]["price"];	
                $sub_array[] = '$'.$prix;	
                $prix=0;								
				$i = $k;              						
		}
		else
		{				    	  
				$sub_array[] = " ".$tab[$i]["qty_product"]." * [ ".$tab[$i]["nom"].' ] ';
                $sub_array[] = "$".$tab[$i]["qty_product"] * $tab[$i]["price"];														   
	    }
	            $sub_array[] = "<div data-target='table'>".$tab[$i]["order_status"]."</div>";                  	
				$sub_array[] = '<button class="btn btn-info" id="'.$tab[$i]["id_reservation"].'"><span class="spinner-grow spinner-grow-sm"></span> Update </button>';

				$data[] = $sub_array;	
				$i++;						
    }
    

function get_all_data($connect)
{
 $query = "SELECT * FROM `final` join product using(id_product)";
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

$con->close();

?>
