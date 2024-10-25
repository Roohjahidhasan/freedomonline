<?php include('header.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <div class="row">      
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="col-md-12">
                        <?=getInputField($isDisabled='',$isRequired='1',$type='password',$min='1',$max='',$fieldName='OLD_PASSWORD',$fieldClass='OLD_PASSWORD',$validation='',$is_unique=0)?>
                      </div>
                      <div class="col-md-12">
                        <?=getInputField($isDisabled='',$isRequired='1',$type='password',$min='1',$max='',$fieldName='NEW_PASSWORD',$fieldClass='NEW_PASSWORD',$validation='',$is_unique=0)?>
                      </div>
                      <div class="col-md-12">
                        <?=getInputField($isDisabled='',$isRequired='1',$type='password',$min='1',$max='',$fieldName='CONFIRM_NEW_PASSWORD',$fieldClass='CONFIRM_NEW_PASSWORD',$validation='',$is_unique=0)?>
                      </div>
                      <div class="col-md-12">
                        <input  type="button" class="btn btn-primary button" style="float: right" id="btnChangePass" value="Change Password"/>
                      </div>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 <?php include('footer.php');?>
 <script type="text/javascript">
   $(document).ready(function(){
      $("#btnChangePass").on("click",function(){
        $(".err_mgs").each(function(){
          $(this).text("");
        });
        var OLD_PASSWORD = $(".OLD_PASSWORD").val().trim();
        var NEW_PASSWORD = $(".NEW_PASSWORD").val().trim();
        var CONFIRM_NEW_PASSWORD = $(".CONFIRM_NEW_PASSWORD").val().trim();
        $.post("<?=$BASE_URL?>ajax/change_password.php",{REQ_TYPE: 'changhe_pass',OLD_PASSWORD : OLD_PASSWORD, NEW_PASSWORD : NEW_PASSWORD,CONFIRM_NEW_PASSWORD : CONFIRM_NEW_PASSWORD,tbl : 'users', pk_name : 'USER_NO',pk_value : <?=$_SESSION['data']['USER_NO']?>,FIELD_NAME: 'USER_PASSWORD'},function(data){
            if(data == "-1"){
              $("#err_OLD_PASSWORD").text("Invalid Old Password!");
              $(".OLD_PASSWORD").focus();
              return false;
            }
            if(data == "-2"){
              $("#err_NEW_PASSWORD").text("Password is too short! Please provide a minimum 6 digit password.");
              $(".NEW_PASSWORD").focus();
              return false;
            }
            if(data == "0"){
              $("#err_CONFIRM_NEW_PASSWORD").text("Password Not Match!");
              $(".CONFIRM_NEW_PASSWORD").focus();
              return false;
            }
            if(data == "1"){
              alert("Password Change Successfully!");
              window.location.replace("<?=$BASE_URL?>logout");              
              return false;
            }
        });
      });
   });
 </script>