<?php include('header.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Configuration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">configuration</li>
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
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='ORGANIZATION_NAME',$fieldClass='ORGANIZATION_NAME',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='THEAM_COLOR',$fieldClass='THEAM_COLOR',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='PHONE',$fieldClass='PHONE',$validation='',$is_unique=0)?>
                      </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='HOTLINE',$fieldClass='HOTLINE',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='FB_URL',$fieldClass='FB_URL',$validation='',$is_unique=0)?>
                      </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='GP_URL',$fieldClass='GP_URL',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='YOUTUBE_URL',$fieldClass='YOUTUBE_URL',$validation='',$is_unique=0)?>
                      </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='TWITTER_URL',$fieldClass='TWITTER_URL',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='0',$type='file',$min='1',$max='',$fieldName='MAIN_LOGO',$fieldClass='MAIN_LOGO',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='0',$type='file',$min='1',$max='',$fieldName='FAV_ICON',$fieldClass='FAV_ICON',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='1',$isRequired='1',$type='text',$min='1',$max='',$fieldName='BASE_URL',$fieldClass='BASE_URL',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='GET_TOUCH',$fieldClass='GET_TOUCH',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='textarea',$min='1',$max='',$fieldName='ADDRESS',$fieldClass='ADDRESS',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='1',$type='text',$min='1',$max='',$fieldName='EMAIL',$fieldClass='EMAIL',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                    <?=getInputField($isDisabled='',$isRequired='',$type='file',$min='1',$max='',$fieldName='ORDER_IMAGE',$fieldClass='ORDER_IMAGE',$validation='',$is_unique=0)?>
                    </div>
                    <div class="col-md-6">
                      <?=getInputField($isDisabled='',$isRequired='1',$type='textarea',$min='1',$max='',$fieldName='FOOTER_DETAILS',$fieldClass='FOOTER_DETAILS',$validation='',$is_unique=0)?>
                    </div>
                    
                  </div>
                  <input  tbl="configuration" type="button" class="btn btn-primary button" style="float: right" id="btnSave" is_single="1"  value="Save"/>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-footer">
                  <?=loadDataList($tblName = 'configuration',$fileds = 'BASE_URL,THEAM_COLOR,ORGANIZATION_NAME,MAIN_LOGO,FAV_ICON,FB_URL,GP_URL,TWITTER_URL,YOUTUBE_URL,PHONE,EMAIL,ADDRESS,GET_TOUCH,FOOTER_DETAILS,ORDER_IMAGE',$canEdit=1,$canDelete=0,$con,$institute_no='');?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php');?>
 