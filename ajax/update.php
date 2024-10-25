<?php
    include('../config/db_connection.php');
    $postdata = $_POST;//file_get_contents("php://input");
    $sql = "";
    foreach($postdata as $k=>$val){
        if($k == 'tbl'){
            $sql .= "UPDATE $val SET ";
        }else if($k == 'PK_NAME'){
            $PK_NAME = $val;
        }else if($k == 'PK_VALUE'){
            $PK_VALUE = $val;
        }else{
            $val = mysqli_real_escape_string($con,$val);
            $sql.="$k = '".$val."',";
        }
    }
    $sql = substr($sql, 0, -1)." WHERE $PK_NAME = $PK_VALUE";
    echo mysqli_query($con,$sql);
?>