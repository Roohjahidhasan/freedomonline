<?php
    include('../config/db_connection.php');
    $DEPENDENT_PARAM = $_POST['DEPENDENT_PARAM'];
    $THIS_PARAM = $_POST['THIS_PARAM'];
    $THIS_VALUE = $_POST['THIS_VALUE'];
    $sql = "SELECT TABLE_NAME,FIELD_NAME,ATTR_FIELD FROM data_tabes WHERE PK_NAME = '$DEPENDENT_PARAM'";
    $query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($query);
    $ATTR_FIELD = $result['ATTR_FIELD'];
    $select_attr = "";
    if($ATTR_FIELD != ""):
        $ATTR_FIELD_ARRAY = explode(',', $ATTR_FIELD);
        $select_attr = ",$ATTR_FIELD";
    endif;
    $TABLE_NAME = $result['TABLE_NAME'];
    $FIELD_NAME = $result['FIELD_NAME'];
    $sql = "SELECT $DEPENDENT_PARAM,$FIELD_NAME $select_attr FROM $TABLE_NAME WHERE $THIS_PARAM = $THIS_VALUE";
    $query = mysqli_query($con,$sql);
    $html = "<option value=''>--Select--</option>";
    while($row = mysqli_fetch_array($query)):
        $attr = "";
        if($ATTR_FIELD != ""):
            foreach($ATTR_FIELD_ARRAY as $ATTR):
                $attr .= " $ATTR = '".$row[$ATTR]."'";
            endforeach;
        endif;
        $html .= "<option value='".$row[$DEPENDENT_PARAM]."' $attr>".$row[$FIELD_NAME]."</option>";
    endwhile;
    echo $html;
?>