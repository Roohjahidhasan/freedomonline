<?php  session_start();
if(empty($_SESSION['data'])){
    header('Location: ../home');
    exit;
}
include('../config/db_connection.php');
include('../functions/admFunctions.php');
$USER_TYPE_NO = $_SESSION['data']['USER_TYPE_NO'];
$branch = "";
$user_caption = "";
if($USER_TYPE_NO == 1){
  $user_caption = "Admin User";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::Admin Panel::</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$BASE_URL?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$BASE_URL?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?=$BASE_URL?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="<?=$BASE_URL?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=$BASE_URL?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> 
  <link rel="stylesheet" href="<?=$BASE_URL?>dist/css/custom.css"> 
  <style type="text/css">
    .nav-treeview>.nav-item>.nav-link.active, [class*=sidebar-light-] .nav-treeview>.nav-item>.nav-link.active:hover {background-color: <?=$THEAM_COLOR?> !important;}
    .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-light-] .nav-sidebar>.nav-item:hover>.nav-link {background-color: <?=$THEAM_COLOR?> !important;}
    .nav-pills .nav-link:not(.active):hover {
        color: #B7360E !important;
        background: #b18a7f2b !important;
    }
    .content-header .container-fluid {background: <?=$THEAM_COLOR?>;}
    nav.main-header.navbar.navbar-expand.navbar-white.navbar-light {background: <?=$THEAM_COLOR?>;}
    a.brand-link.page-url {background: <?=$THEAM_COLOR?>;}
    .nav-sidebar>.nav-item>.nav-link:active, [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-link:focus {background: <?=$THEAM_COLOR?> !important;}
    .theam-bg{background: <?=$THEAM_COLOR?>;}
    .theam-text{color: <?=$THEAM_COLOR?>;}
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {  background-color: <?=$THEAM_COLOR?>;} 
    fieldset.scheduler-border {
        border: 1px groove #aaa !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #ccc;
              box-shadow:  0px 0px 0px 0px #ccc;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }   
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div> -->
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <!--<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>-->
      </li>

      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">          
          <?php
              $profile = $BASE_URL."img/user.png";
          ?>          
          <img src="<?=$profile?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header theam-bg">
            <img src="<?=$profile?>" class="img-circle elevation-2" alt="User Image">
            <p><?=$user_caption?></p>
            <p><?=$branch?></p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-primary btn-flat"><i class="fas fa-cog fa-fw"></i>Profile</a>
            <a href="<?=$BASE_URL?>logout" class="btn btn-danger btn-flat float-right"><i class="fas fa-power-off"></i> Sign out</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>