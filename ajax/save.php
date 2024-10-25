<?php
    include('../config/db_connection.php');
    $postdata = $_POST;//file_get_contents("php://input");
    $sql = "";
    foreach($postdata as $k=>$val){
        if($k == 'tbl'){
            $sql .= "INSERT INTO $val SET ";
        }else{
            $val = mysqli_real_escape_string($con,$val);
            $sql.="$k = '".$val."',";
        }
    }
    $sql = substr($sql, 0, -1);
    echo mysqli_query($con,$sql);
?>