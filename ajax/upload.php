<?php
    $target_dir = "../uploads/";
    $file_name = basename($_FILES["file"]["size"].$_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
?>