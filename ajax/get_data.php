<?php
    include('../config/db_connection.php');
    $DEPENDENT_PARAM = $_POST['DEPENDENT_PARAM'];
    $THIS_PARAM = $_POST['THIS_PARAM'];
    $THIS_VALUE = $_POST['THIS_VALUE'];
    $sql = "SELECT TABLE_NAME FROM data_tabes WHERE PK_NAME = '$THIS_PARAM'";
    $query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($query);
    $TABLE_NAME = $result['TABLE_NAME'];
    $sql = "SELECT $DEPENDENT_PARAM FROM $TABLE_NAME WHERE $THIS_PARAM = $THIS_VALUE";
    $query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($query);
    echo $result[$DEPENDENT_PARAM];
?>