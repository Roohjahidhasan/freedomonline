<?php include('header.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Media Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Media Menu</li>
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

                    <div class="col-md-6">
                        <?=getInputField($isDisabled='1',$isRequired='0',$type='text',$min='1',$max='',$fieldName='URL',$fieldClass='URL',$validation='',$is_unique=0)?>
                     </div>
                     <div class="col-md-6">
                         <?=getInputField($isDisabled='',$isRequired='0',$type='text',$min='1',$max='',$fieldName='MENU_NAME',$fieldClass='MENU_NAME',$validation='',$is_unique=0)?>
                     </div>
                     <div class="col-md-6">
                         <?=getInputField($isDisabled='',$isRequired='0',$type='file',$min='1',$max='',$fieldName='IMAGE',$fieldClass='IMAGE',$validation='',$is_unique=0)?>
                     </div>

                     <div class="col-md-6">
                        <?=getInputField($isDisabled='',$isRequired='0',$type='number',$min='1',$max='',$fieldName='ORDER_SL',$fieldClass='ORDER_SL',$validation='',$is_unique=0)?>
                     </div>
      
                  </div>
                  <input  tbl="media_menus" type="button" class="btn btn-primary button" style="float: right" id="btnSave" is_single=""  value="Save"/>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-footer">
                  <?=loadDataList($tblName = 'media_menus',$fileds = 'URL,MENU_NAME,IMAGE,ORDER_SL',$canEdit=1,$canDelete=0,$con,$where="");?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('footer.php');?>