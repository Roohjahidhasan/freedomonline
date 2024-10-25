<?php
	session_start();
    include('../config/db_connection.php');
    $where = " IS_SEND = 0";
    $sms = getQueryWhere($tblName='sms',$fields='SMS_NO,SMS,SEND_TO,SEND_TO',$con,$where,$orderBy="");
    foreach($sms as $data):
		$apiGet = "http://esms.mimsms.com/smsapi?api_key=C20047205da2f0c42320d4.42963592&type=text&contacts=#msisdn#&senderid=8809601000500&msg=#message#";
		$message = $data['SMS'];
		$mobile= $data['SEND_TO'];
		$SMS_NO = $data['SMS_NO'];
		$sql = "UPDATE sms SET IS_SEND = 1,SEND_TIME= '$current_time' WHERE SMS_NO = $SMS_NO";
		mysqli_query($con,$sql);
		$api = str_replace("#message#",  urlencode($message),$apiGet);
		$msisdn = "88".str_replace("880", "0", $mobile);
		$api = str_replace("#msisdn#",$msisdn,$api);
		$response = file_get_contents($api);
	endforeach;
	$isAlive = 1;
	if(empty($_SESSION['data'])){
		$isAlive = 0;
	}
	echo $isAlive;
?>