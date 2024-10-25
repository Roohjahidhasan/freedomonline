<?php
    function inputField($isDisabled,$isRequired,$type,$min,$max,$fieldName){
        $disabled = "";
        if($isDisabled == 1){
            $disabled = "disabled";
        }
        $required = "is_required = '0'";
        $errorText = "";
        if($isRequired == 1){
            $required = "is_required = '1'";
            $errorText = "<span class='red-color err_mgs' id='err_".$fieldName."'></span>";
        }
        $minShow = "";
        if($min != ''){
            if($type == 'text')
                $minShow = "minlength=$min";
            else
                $minShow = "min=$min";
        }
        $maxShow = "";
        if($max != ''){
            if($type == 'text')
                $maxShow = "maxlength=$max";
            else
                $maxShow = "max=$max";
        }
        if($type == 'textarea')
            return "<textarea class='data form-control ".$fieldName."' name='".$fieldName."' $minShow $maxShow $disabled $required></textarea>".$errorText;
        else
            return "<input type='".$type."' class='data form-control ".$fieldName."' name='".$fieldName."' id='".$fieldName."' $minShow $maxShow $disabled $required/>".$errorText;
    }
    function getDataTable($fieldName,$con){
        $sql = "SELECT TABLE_NAME,FIELD_NAME,ATTR_FIELD FROM data_tabes WHERE PK_NAME = '$fieldName'";
        $query = mysqli_query($con,$sql);
        return $result = mysqli_fetch_array($query);
    }
    function dropdownList($isRequired,$fieldName,$con,$institute_no,$has_dependency,$is_dependent,$TABLE_NAME,$FIELD_NAME,$ATTR_FIELD,$where){ 
        $select_attr = "";
        if($ATTR_FIELD != ""){
            $ATTR_FIELD_ARRAY = explode(',', $ATTR_FIELD);
            $select_attr = ",$ATTR_FIELD";
        }
        $required = "is_required = '0'";
        $errorText = "";
        if($isRequired == 1){
            $required = "is_required = '1'";
            $errorText = "<span class='red-color err_mgs' id='err_".$fieldName."'></span>";
        }
        if($has_dependency <> 1):
            $sql = "SELECT $fieldName,CONCAT($FIELD_NAME) AS fields $select_attr FROM $TABLE_NAME WHERE 1 = 1 $where";
            $query = mysqli_query($con,$sql);
        endif;
        $html = "<select class='data form-control ".$fieldName."' name='$fieldName' has_dependency = '".$has_dependency."' is_dependent = '".$is_dependent."' $required><option value=''>--Select--</option>";
        if($has_dependency <> 1):
            while($row = mysqli_fetch_array($query)):
            $attr = "";
            if($ATTR_FIELD != ""):
                foreach($ATTR_FIELD_ARRAY as $ATTR):
                    $attr .= " $ATTR = ".$row[$ATTR];
                endforeach;
            endif;
            $html.= "<option value='".$row[$fieldName]."' $attr>".$row['fields']."</option>";
            endwhile;
        endif;
        $html.= "</select>".$errorText;
        return $html;
    }
    function dropdownListSelected($isRequired,$fieldName,$con,$institute_no,$has_dependency,$is_dependent,$TABLE_NAME,$FIELD_NAME,$ATTR_FIELD,$where){
        $select_attr = "";
        if($ATTR_FIELD != ""){
            $ATTR_FIELD_ARRAY = explode(',', $ATTR_FIELD);
            $select_attr = ",$ATTR_FIELD";
        }
        $required = "is_required = '0'";
        $errorText = "";
        if($isRequired == 1){
            $required = "is_required = '1'";
            $errorText = "<span class='red-color err_mgs' id='err_".$fieldName."'></span>";
        }
        if($has_dependency <> 1):
            $sql = "SELECT $fieldName,CONCAT($FIELD_NAME) AS fields $select_attr FROM $TABLE_NAME WHERE 1 = 1 $where";
            $query = mysqli_query($con,$sql);
        endif;
        $html = "<select class='data form-control ".$fieldName."' name='$fieldName' has_dependency = '".$has_dependency."' is_dependent = '".$is_dependent."' $required>";
        if($has_dependency <> 1):
            while($row = mysqli_fetch_array($query)):
            $attr = "";
            if($ATTR_FIELD != ""):
                foreach($ATTR_FIELD_ARRAY as $ATTR):
                    $attr .= " $ATTR = ".$row[$ATTR];
                endforeach;
            endif;
            $html.= "<option value='".$row[$fieldName]."' $attr>".$row['fields']."</option>";
            endwhile;
        endif;
        $html.= "</select>".$errorText;
        return $html;
    }
    function getInputField($isDisabled,$isRequired,$type,$min,$max,$fieldName,$fieldClass,$validation="",$is_unique=0){
        $title = str_replace('_', ' ', $fieldName);
        $f1 = "<div class='form-group'><label for='".$fieldName."'>";
        $f2 = "</label>";
        $f3 = "</div>";
        $f4 = $title;
        echo $f1; 
        $lbl = "";
        if($isRequired == 1){
            $lbl = "<span class='red-color'>*</span>";
        }
        echo $title = $f4.$lbl;
        echo $f2;
        echo $field = inputField($isDisabled,$isRequired,$type,$min,$max,$fieldName);
        echo $f3;
    }
    function getDropDown($isRequired,$fieldName,$fieldClass,$con,$institute_no,$has_dependency,$is_dependent,$where,$sessionWhere){
        $result = getDataTable($fieldName,$con);
        $TABLE_NAME = $result['TABLE_NAME'];
        $FIELD_NAME = $result['FIELD_NAME'];
        $ATTR_FIELD = trim($result['ATTR_FIELD']);
        $title = str_replace('_', ' ', $FIELD_NAME);
        $f1 = "<div class='form-group'><label for='".$fieldName."'>";
        $f2 = "</label>";
        $f3 = "</div>";
        $f4 = $title;
        echo $f1; 
        $lbl = "";
        if($isRequired == 1){
            $lbl = "<span class='red-color'>*</span>";
        }
        echo $title = $f4.$lbl;
        echo $f2;
        echo $field = dropdownList($isRequired,$fieldName,$con,$institute_no,$has_dependency,$is_dependent,$TABLE_NAME,$FIELD_NAME,$ATTR_FIELD,$where);
        echo $f3;
    }
    function getDropDownSelected($isRequired,$fieldName,$fieldClass,$con,$institute_no,$has_dependency,$is_dependent,$where,$sessionWhere){
        $result = getDataTable($fieldName,$con);
        $TABLE_NAME = $result['TABLE_NAME'];
        $FIELD_NAME = $result['FIELD_NAME'];
        $ATTR_FIELD = trim($result['ATTR_FIELD']);
        $title = str_replace('_', ' ', $FIELD_NAME);
        $f1 = "<div class='form-group'><label for='".$fieldName."'>";
        $f2 = "</label>";
        $f3 = "</div>";
        $f4 = $title;
        echo $f1; 
        $lbl = "";
        if($isRequired == 1){
            $lbl = "<span class='red-color'>*</span>";
        }
        echo $title = $f4.$lbl;
        echo $f2;
        echo $field = dropdownListSelected($isRequired,$fieldName,$con,$institute_no,$has_dependency,$is_dependent,$TABLE_NAME,$FIELD_NAME,$ATTR_FIELD,$where);
        echo $f3;
    }
    function loadDataList($tblName,$fileds,$canEdit,$canDelete,$con,$where){
        if($fileds != '*'){
            $sql = "SELECT PK_NAME FROM data_tabes WHERE TABLE_NAME = '$tblName'";
            $query = mysqli_query($con,$sql);
            $result = mysqli_fetch_array($query);
            $PK_NAME = $result['PK_NAME'];
            $fileds = explode(",",$fileds);
            $join = "";
            $show_data = "";
            foreach($fileds as $field){
                if(substr($field,-3) == "_NO"){
                    $result = getDataTable($field,$con);
                    $TABLE_NAME = $result['TABLE_NAME'];
                    if($tblName != $TABLE_NAME){
                        $FIELD_NAME = $result['FIELD_NAME'];
                        $join .= " LEFT JOIN $TABLE_NAME ON $TABLE_NAME.$field = $tblName.$field";   
                        $show_data.= $FIELD_NAME.","; 
                    }else{
                        $show_data.= $field.",";
                    }    
                }else{
                    $show_data.= $tblName.".".$field.",";
                }
            }
            $show_data = substr($show_data, 0, -1);
            $sql = "SELECT $tblName.$PK_NAME,$show_data FROM $tblName $join $where";
            $html = "";
            $query = mysqli_query($con,$sql);
            $show_data = explode(",",$show_data);
            $html .= "<div style='overflow:auto'><table id='search' class='table table-striped table-bordered table-hover'>";
            $html .= "<thead><tr>";
            $html .= "<th class='hide'>ACTION</th>";
            foreach($show_data as $data){
                $data = str_replace($tblName.'.', '', $data);
                $html .= "<th>".str_replace('_', ' ', $data)."</th>";
            }
            $html .= "</tr></thead>";
            $html .= "<tbody>";
            while($row = mysqli_fetch_array($query)):   
                $link = '';
                if(isset($_GET['sub'])){
                    $m_name = $_GET['mn'];
                    if(isset($_GET['sub1'])){
                        $m_name1 = $_GET['mn1'];
                        $link .= "<span class='btn btn-xs btn-primary page-url' href='".$_GET['sub1'].".php?p=".$PK_NAME."&v=".$row[$PK_NAME]."'>$m_name1</span>";
                    }
                    $link .= "<span class='btn btn-xs btn-primary page-url' href='".$_GET['sub'].".php?p=".$PK_NAME."&v=".$row[$PK_NAME]."'>$m_name</span>";
                }             
                $edit = "";
                if($canEdit == 1)
                    $edit = "<i class='edit fas fa-edit btn btn-xs btn-success' PK_VALUE='".$row[$PK_NAME]."' PK_NAME='".$PK_NAME."' TBL='".$tblName."' aria-hidden='true'></i>";
                $delete = "";
                if($canDelete == 1)
                    $delete = "<i class='remove fas fa-trash-alt btn btn-xs btn-danger'  PK_VALUE='".$row[$PK_NAME]."' PK_NAME='".$PK_NAME."' TBL='".$tblName."' aria-hidden='true'></i>";
                $html .= "<tr>";
                $html.="<td class='hide'>$link $edit $delete</td>";
                foreach($show_data as $data){
                    $data = str_replace($tblName.'.', '', $data);
                    $html .= "<td>".$row[$data]."</td>";
                }
                $html .= "</tr>";
            endwhile;
            $html .= "</tbody>";
            $html .= "</table></div>";
            return $html;
        }else{
            $sql = "SELECT * FROM $tblName";
            return $sql;
        }
    }    
    function getFieldData($fieldName,$value,$con){        
        $result = getDataTable($fieldName,$con);
        $TABLE_NAME = $result['TABLE_NAME'];
        $FIELD_NAME = $result['FIELD_NAME'];
        $sql = "SELECT $FIELD_NAME FROM $TABLE_NAME WHERE $fieldName = $value";
        $query = mysqli_query($con,$sql);
        $result = mysqli_fetch_array($query);
        return $result[$FIELD_NAME];
    }
    function SMSInsert($mgs,$MOBILE,$con,$current_time){
        $NO_OF_CHARACTER = strlen($mgs);
        $NO_OF_SMS = ceil($NO_OF_CHARACTER/159);
        $sql = "INSERT INTO sms SET SMS = '$mgs', NO_OF_CHARACTER = $NO_OF_CHARACTER, NO_OF_SMS = $NO_OF_SMS, SEND_TO = '$MOBILE', LOAD_TIME= '$current_time'";
        mysqli_query($con,$sql);
    }
    function commission($con,$current_time,$BED_VALUE,$CLUB_COMMISSION_PERCENTAGE,$AGENT_COMMISSION_PERCENTAGE,$REGISTER_NO,$TRANSACTION_TYPE_NO){
        $CLUB_COMMISSION = $BED_VALUE*$CLUB_COMMISSION_PERCENTAGE/100;
        $AGENT_COMMISSION = $CLUB_COMMISSION*$AGENT_COMMISSION_PERCENTAGE/100;
        //club statement
        $sql = "SELECT CLUB_NO FROM registers WHERE  REGISTER_NO = $REGISTER_NO";
        $query = mysqli_query($con,$sql);
        $register = mysqli_fetch_array($query);
        $CLUB_NO = $register['CLUB_NO'];
        $sql = "INSERT INTO `club_statements` SET `CLUB_NO` = $CLUB_NO, `TRANSACTION_DATE` = '$current_time', `TRANSACTION_ON` = '$current_time', `TRANSACTION_TYPE_NO` = $TRANSACTION_TYPE_NO, `AMOUNT` = '$CLUB_COMMISSION'";
        mysqli_query($con,$sql);
        $sql = "UPDATE `clubs` SET `CURRENT_BALANCE` = CURRENT_BALANCE+$CLUB_COMMISSION WHERE `CLUB_NO` = $CLUB_NO";
        mysqli_query($con,$sql);
        //agent statement
        $sql = "SELECT AGENT_NO FROM clubs WHERE  CLUB_NO = $CLUB_NO";
        $query = mysqli_query($con,$sql);
        $club = mysqli_fetch_array($query);
        $AGENT_NO = $club['AGENT_NO'];
        $sql = "INSERT INTO `agent_statements` SET `AGENT_NO` = $AGENT_NO, `TRANSACTION_DATE` = '$current_time', `TRANSACTION_ON` = '$current_time', `TRANSACTION_TYPE_NO` = $TRANSACTION_TYPE_NO, `AMOUNT` = '$AGENT_COMMISSION'";
        mysqli_query($con,$sql);
        $sql = "UPDATE `agents` SET `CURRENT_BALANCE` = CURRENT_BALANCE+$AGENT_COMMISSION WHERE `AGENT_NO` = $AGENT_NO";
        mysqli_query($con,$sql);
    }
    function userStatement($con,$current_time,$REGISTER_NO,$TRANSACTION_TYPE_NO,$AMOUNT,$STATEMENT_DETAILS){
        $sql = "INSERT INTO `statements` SET `REGISTER_NO` = '$REGISTER_NO',TRANSACTION_DATE = '$current_time', `TRANSACTION_ON` = '$current_time', `TRANSACTION_TYPE_NO` = $TRANSACTION_TYPE_NO, `AMOUNT` = '$AMOUNT', STATEMENT_DETAILS = '$STATEMENT_DETAILS'";
        mysqli_query($con,$sql);
    }
?>