<?php
    session_start();
    include('../config/db_connection.php');
    $tbl = $_POST['tbl'];
    $pk_name = $_POST['pk_name'];
    $pk_value = $_POST['pk_value'];
    $FIELD_NAME = $_POST['FIELD_NAME'];
    $OLD_PASSWORD = $_POST['OLD_PASSWORD'];
    $NEW_PASSWORD = $_POST['NEW_PASSWORD'];
    $CONFIRM_NEW_PASSWORD = $_POST['CONFIRM_NEW_PASSWORD'];

    if(strlen($NEW_PASSWORD) <= 6){
        $result = "-2";
    }else if($NEW_PASSWORD != $CONFIRM_NEW_PASSWORD){
        $result = "0";
    }else{
        $sql = "UPDATE $tbl SET $FIELD_NAME = '$NEW_PASSWORD' WHERE $pk_name = $pk_value";
        mysqli_query($con,$sql);
        $result = "1";
    }
    echo $result;
?>