<?php 

error_reporting(0);
session_start();
require $_SERVER['DOCUMENT_ROOT']."/Test/ajax/cnx.php"; 
include "generate.php";
define('MB', 1048576);


function verif($don)
{
  $don = strip_tags($don);
  $don = stripslashes($don);
  $don = trim($don);
  $don = htmlspecialchars($don);
  return $don;
} 

function test_image()
{
    if( isset($_FILES["photo"]) )
    {
        if( $_FILES['photo']['size'] <= 5*MB )
        {
            $allowed =  array('gif','png','jpg','jpeg');
            $filename = verif($_FILES['photo']['name']);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if(!in_array($ext,$allowed) )
                return false; 
            else
                return true;
        }
        else
        {
            return false;
        }
                
    }
}


$err="";


    //update 
	if(isset($_POST["submit"]))
	{	
		if(verif($_POST["submit"]) == "update")
		{
			$test = true;
			      
			$pass1 = verif($_POST["password1"]);$pass = verif($_POST["password"]);
            if(isset($pass) && !empty($pass)  && isset($pass1) && !empty($pass1) )
            {
            	if( strlen($pass) < 3 || strlen($pass) > 12 || strlen($pass1) < 3 || strlen($pass1) > 12 )
            	{
            		$test = false;
            		$err.='<script>toastr["error"]("password length should be between 3 and 12!");</script>';
            	}
            	else
            	{
            		if($pass != $pass1)
            		{
            			$test = false;
            			$err.='<script>toastr["error"]("Passwords don\'t match!");</script>';
            		}

            	}

            }



            $text = verif($_POST["text"]);
            if(empty($text) || !isset($test))
            {
            	$test = false;
            }


            $status = verif($_POST["status"]);
            if(empty($status) || !isset($status))
            {
            	$test = false;
            }
            else
            {
            	$sql="select id_question,answer_question
            	from user_restaurent join security_question using(id_question) 
                where email ='".verif($_SESSION["user"])."'and id_question ='".$status."'";
                $num = $con->query($sql); 
                if($num->num_rows == 1)
                { 
                	while($row = $num->fetch_assoc()) 
                	{
                		if($text!= $row["answer_question"])
                		{
                			$test = false;
                			$err.='<script>toastr["error"]("Invalid answer for the security_question!");</script>';
                		}
                	}
    
                }
                else
                {
                	$test = false;
                	$err.='<script>toastr["error"]("Error!");</script>';
                }

            }

            if($test)
            {
                $test = false;
            	$pass = sha1($pass);
            	$sql="UPDATE user_restaurent 
			    SET password = '".$pass."' , 
			    answer_question= '".$text."'
			    WHERE id_question = '".$status."'and email = '".verif($_SESSION["user"])."'"; 
			    $con->query($sql);
			    $err.='<script>toastr["success"]("Updated Successfully!");</script>'; 
            }
            
		}
        
        //sending code
        if(verif($_POST["submit"]) == "send")
        {
            $ch="";
            $ch=randomPassword(10,1,"lower_case,numbers")[0];
            $sql="UPDATE user_restaurent 
                  SET reset_code = '".$ch."' where email = '".verif($_SESSION["user"])."'"; 
                  $con->query($sql);
            $date = date('l jS \of F Y h:i:s A');
            $to = verif($_SESSION["user"]);
            $subject = "Please confirm your email ";
            $header = "From:Jhonny Sins\r\n"; 
            $message = "<b>Your Code </b><strong>$ch</strong>";
            $header = "From:Jhonny Sins\r\n"; 
            mail ($to,$subject,$message,$header);
        }

        //update photo
        if(verif($_POST["submit"]) == "photo")
        {
             
         
        $image = '';
        if($_FILES["photo"]["name"] != '')
        {
            if( test_image($_FILES["photo"])) 
            {
                $new_name = mt_rand().'.'.strtolower(pathinfo(verif($_FILES['photo']['name']), PATHINFO_EXTENSION));
                $image = $new_name;
                $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/admin/photo/' . $new_name;
                move_uploaded_file($_FILES['photo']['tmp_name'], $destination);

                $sql = "SELECT photo
                FROM user_restaurent            
                WHERE email = '".$_SESSION['user']."'"; 
                $test = $con->query($sql);
                while($row = $test->fetch_assoc())
                {
                     $destination = $_SERVER['DOCUMENT_ROOT'].'/Test/ajax/admin/photo/' . $row["photo"];
                     if(!unlink($destination))
                     {
                        $err.='<script>toastr["error"]("Something Happened!");</script>';  
                     }
                       
                }

                $sql = "UPDATE user_restaurent
                SET photo = '".$new_name."'             
                WHERE email = '".$_SESSION['user']."'";    
                $test = $con->query($sql);
                $err.='<script>toastr["success"]("Photo Updated!");</script>';  

            }
            else
            {
                $err.='<script>toastr["error"]("extention gif png jpg jpeg!");</script>';
            }

        }
        

        //submit
        }

        if(verif($_POST["submit"]) == "reset")
        {
            $test = true;

            $code = verif($_POST["code"]);
            if(empty($code) || !isset($code))
            {
                $test = false;
            }
            else
            {
                $sql="select reset_code
                from user_restaurent  
                where email ='".verif($_SESSION["user"])."'";
                $num = $con->query($sql); 
                if($num->num_rows == 1)
                { 
                    while($row = $num->fetch_assoc()) 
                    {
                        if($code!= $row["reset_code"])
                        {
                            $test = false;
                            $err.='<script>toastr["error"]("Invalid Code!");</script>';
                        }
                    }
    
                }
                else
                {
                    $test = false;
                    $err.='<script>toastr["error"]("Error!");</script>';
                }

            }

            $question= verif($_POST["question"]);
            if(empty($question) || !isset($question))
            {
                $test = false;
            }
            else
            {
                $sql="select *
                from security_question 
                where id_question ='".$question."'";
                $num = $con->query($sql); 
                if($num->num_rows != 1)
                {                
                    $test = false;
                    $err.='<script>toastr["error"]("Invalid question!");</script>';
                }

            }

            $answer = verif($_POST["answer"]);
            if(empty($answer) || !isset($answer))
            {
                $test = false;
            }

            if($test)
            {
                 $sql="UPDATE user_restaurent 
                  SET answer_question = '".$answer."' , id_question ='".$question."' 
                  where email = '".verif($_SESSION["user"])."' and reset_code = '".$code."'"; 
                  $con->query($sql);
                  $err.='<script>toastr["success"]("Question  Updated!");</script>';
            }

        }
            
	}



$output = array(
	"message"	=>	$err
);

echo json_encode($output);


?>