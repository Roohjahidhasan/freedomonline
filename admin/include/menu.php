  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link page-url">
      <span class="brand-text font-weight-light"><img src="<?=$BASE_URL?>uploads/<?=$MAIN_LOGO?>" style="height: 25px;"></span>
      <a class="closebtn">×</a>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=$BASE_URL?>img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="font-size: 12px;"><strong><?=$user_caption?></strong><br/><span class="text-success"><?=$branch?></span></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link page-url active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <?php
              $sql = "SELECT MENU_ICON, MENU_NAME,ADMIN_SUB_MENUS FROM admin_user_menu_maps LEFT JOIN admin_menus ON admin_menus.ADMIN_MENU_NO = admin_user_menu_maps.ADMIN_MENU_NO WHERE USER_TYPE_NO = $USER_TYPE_NO ORDER BY MENU_ORDER ASC";
              $menus = mysqli_query($con,$sql);
              foreach($menus as $menu):
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="<?=$menu['MENU_ICON']?>"></i>
              <p>
                <?=$menu['MENU_NAME']?>
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <?php
                  $ADMIN_SUB_MENUS = $menu['ADMIN_SUB_MENUS'];
                  $where = " ADMIN_SUB_MENU_NO IN ($ADMIN_SUB_MENUS)";
                  $admin_sub_menus = getQueryWhere($tblName='admin_sub_menus',$fields='SUM_MENU_NAME,PAGE_LINK',$con,$where,$orderBy=' ORDER BY ORDER_SL ASC');
                  foreach($admin_sub_menus as $sub):
              ?>
              <li class="nav-item">
                <a href="<?=$sub['PAGE_LINK']?>" class="nav-link page-url">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?=$sub['SUM_MENU_NAME']?></p>
                </a>
              </li>
              <?php endforeach;?>   
            </ul>
          </li>
        <?php endforeach;?>     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>