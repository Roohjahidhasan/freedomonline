<?php 
	session_start();
	include('../../config/db_connection.php');
	include('../../functions/admFunctions.php');
	$USER_TYPE_NO = $_SESSION['data']['USER_TYPE_NO'];
	$EMPLOYEE_NO = $_SESSION['data']['EMPLOYEE_NO'];
	$USER_NO = $_SESSION['data']['USER_NO'];
?>