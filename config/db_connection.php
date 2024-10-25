<?php
	$dbname = "freedom_test";
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$con = mysqli_connect($hostname, $username, $password, $dbname );
	mysqli_set_charset($con, "utf8");
	date_default_timezone_set('Asia/Dhaka');
    $current_time = date("Y-m-d H:i:s");

	function getQuery($tblName,$fields,$con,$orderBy){
        $sql = "SELECT $fields FROM $tblName $orderBy";
        $result = mysqli_query($con,$sql);
        return $result;
    }
    function getQuerySingle($tblName,$fields,$con,$orderBy){
        $sql = "SELECT $fields FROM $tblName $orderBy";
        $query = mysqli_query($con,$sql);
        $result = mysqli_fetch_array($query);
        return $result;
    }
    function getQueryWhere($tblName,$fields,$con,$where,$orderBy){
        $sql = "SELECT $fields FROM $tblName WHERE $where $orderBy";
        $result = mysqli_query($con,$sql);
        return $result;
    }
    function getQuerySingleWhere($tblName,$fields,$con,$where,$orderBy){
        $sql = "SELECT $fields FROM $tblName WHERE $where $orderBy";
        $query = mysqli_query($con,$sql);
        $result = mysqli_fetch_array($query);
        return $result;
    }
    function numberFormat($number){
        return number_format($number, 4, '.', '');
    }
    $THEAM_COLOR = "#3d6ad6";
    $configuration = getQuerySingle($tblName="configuration",$fields="BASE_URL,THEAM_COLOR,ORGANIZATION_NAME,MAIN_LOGO,HOTLINE,FAV_ICON,FB_URL,GP_URL,TWITTER_URL,YOUTUBE_URL,PHONE,EMAIL,GET_TOUCH,ADDRESS,FOOTER_DETAILS,ORDER_IMAGE",$con,$orderBy="");
    $BASE_URL = $configuration['BASE_URL'];
    $THEAM_COLOR = $configuration['THEAM_COLOR'];
    $ORGANIZATION_NAME = $configuration['ORGANIZATION_NAME'];
    $MAIN_LOGO = $configuration['MAIN_LOGO'];
    $HOTLINE = $configuration['HOTLINE'];
    $FAV_ICON = $configuration['FAV_ICON'];
    $FB_URL = $configuration['FB_URL'];
    $GP_URL = $configuration['GP_URL'];
    $TWITTER_URL = $configuration['TWITTER_URL'];
    $YOUTUBE_URL = $configuration['YOUTUBE_URL'];
    $PHONE = $configuration['PHONE'];
    $EMAIL = $configuration['EMAIL'];
    $GET_TOUCH = $configuration['GET_TOUCH'];
    $ADDRESS = $configuration['ADDRESS'];
    $FOOTER_DETAILS = $configuration['FOOTER_DETAILS'];
    $ORDER_IMAGE = $configuration['ORDER_IMAGE'];
?>