<?php
session_start();
include('config/db_connection.php');
$mgs = "";
function removeSqlInjection($varaibleGiven,$con)
{
    $operator="'=','or', or ,' or '";
    $replacer='';
    $operatorArray=explode(",","$operator");
    $counts=count($operatorArray);
    for($i=0;$i<$counts;$i++)
    {

       $varaibleGiven=str_replace($operatorArray[$i],$replacer,$varaibleGiven); 
        
    }
    
    return mysqli_real_escape_string($con,$varaibleGiven);
}
if(isset($_POST['submit'])){  
	$mobile = removeSqlInjection(trim($_POST['mobile']),$con);
	$password = removeSqlInjection(trim($_POST['password']),$con);
	$sql = "SELECT * FROM users WHERE USER_MOBILE = '$mobile' AND USER_PASSWORD = '$password'";
	$query = mysqli_query($con,$sql);
	$result = mysqli_num_rows($query);
	if( $result > 0 ){
		$data = mysqli_fetch_array($query);
		$_SESSION['data'] = $data;
 		header('Location: admin/');
		exit;
	}else{
		$mgs="Your Email or Password is not valid!";
	}
}
?>