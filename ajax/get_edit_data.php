<?php
    include('../config/db_connection.php');
    $PK_NAME = $_POST['PK_NAME'];
    $TBL = $_POST['TBL'];
    $PK_VALUE = $_POST['PK_VALUE'];
    $sql = "SELECT * FROM $TBL WHERE $PK_NAME = $PK_VALUE";
    $query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($query);
    echo json_encode($result);
?>