<?php
error_reporting(0);
define('MB', 1048576);

function verif($don)
{
    $don = strip_tags($don);
    $don = stripslashes($don);
    $don = trim($don);
    $don = htmlspecialchars($don);
    return $don;
}




if ($_FILES['csv_file']['size'] <= 5 * MB) 
{
    if (isset($_FILES['csv_file']['name']) && !empty($_FILES['csv_file']['name'])) 
    {
        
        if (strtolower(pathinfo(verif($_FILES['csv_file']['name']), PATHINFO_EXTENSION)) == 'csv') 
        {
            $new_name = mt_rand().'.'.strtolower(pathinfo(verif($_FILES['csv_file']['name']), PATHINFO_EXTENSION));
            $image = $new_name;
            $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/admin/file/' . $new_name;
            move_uploaded_file($_FILES['csv_file']['tmp_name'], $destination);
            $file_data = fopen($destination, 'r');
            fgetcsv($file_data);
            
            while ($row = fgetcsv($file_data)) 
            {
                $data[] = array(
                    'Reservation' => verif($row[0]),
                    'Date' => verif($row[1]),
                    'Table' => verif($row[2]),
                    'Order' => verif($row[3]),
                    'Price' => verif($row[4])
                );
            }
            
            fclose($file_data);
        }
        else 
        {
            echo '<script>toastr["error"]("Please Import A csv File!");</script> ';
        }        
    }       
}
else
{
    echo '<script>toastr["error"]("File size should be <= 5MB!");</script> ';
}




echo json_encode($data);