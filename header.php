<?php include('config/db_connection.php');?>

<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
   <meta http-equiv="Pragma" content="no-cache"/>
   <meta http-equiv="Expires" content="0"/>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <!-- Custom Modifications
         ================================================== -->
      <!-- Title -->
      <title>Freedom Online</title>
      <!---------------------- SEO ------------------->
      <meta name="google-site-verification" content=""/>
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta property="og:local" content="Bangladesh_BD"/>
      <meta property="og:type" content="Website"/>
      <meta property="og:title" content=""/>
      <meta property="og:description" content="">
      <meta property="og:url" content=""/>
      <meta property="og:site_name" content=""/>
     
      <!-- Don't Cache Website on Browser -->
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
      <meta http-equiv="Pragma" content="no-cache"/>
      <meta http-equiv="Expires" content="0"/>
      <!-- Mobile Specific Metas
         ================================================== -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- Favicons
         ================================================== -->
      <link rel="icon" href="<?=$BASE_URL?>uploads/<?=$FAV_ICON?>" type="image/x-icon"/>
      <!-- CSS
         ================================================== -->
      <!-- Bootstrap -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/bootstrap.min.css">
      <!-- Template styles-->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/style.css">
       <!-- Slicknav -->
      <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/slicknav.css" media="screen">

      <!-- FontAwesome -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/font-awesome.min.css">
      <!-- Animation -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/animate.css">
      <!-- Prettyphoto -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/prettyPhoto.css">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/owl.carousel.css">
      <!-- Bxslider -->
      <link rel="stylesheet" href="<?=$BASE_URL?>assets/css/jquery.bxslider.css">

<!-- ======================== client ============================= -->


 <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">



<!-- ======================== client end ============================= -->

      <!-- Color CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/red.css" title="red" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/jade.css" title="jade" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/green.css" title="green" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/blue.css" title="blue" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/beige.css" title="beige" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/cyan.css" title="cyan" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/orange.css" title="orange" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/peach.css" title="peach" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/pink.css" title="pink" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/purple.css" title="purple" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/colors/sky-blue.css" title="sky-blue" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>css/colors/yellow.css" title="yellow" media="screen" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
      <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
      <style>


.topnav {
  overflow: hidden;
  background-color: #f5f5f5;
}

.topnav a{
  float: left;
  display: block;
  color: #333;
  text-align: center;
  padding: 5px 16px;
  text-decoration: none;
  font-size: 15px;
  padding-left: 25px;

}

.topnav a:hover {
  background-color: #CE1D8F;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

</style>
   </head>
   <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
   <meta http-equiv="Pragma" content="no-cache"/>
   <meta http-equiv="Expires" content="0"/>


<body>
   <div class="body-inner"  id="container">
   <!-- Header start -->
   
   <!-- Start Header Section -->
   <div class="hidden-header"></div>
   <header id="header" class="clearfix navbar-fixed-top main-nav" role="banner">

    <!-- Start Top Bar -->
      <div class="top-bar top-info">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <!-- Start Contact Info -->
              <ul class="contact-details">
                <li><a href="#"><i class="fa fa-map-marker"></i> <?=$ADDRESS?></a>
                </li>
                <li><a href="mailto:<?=$EMAIL?>"><i class="fa fa-envelope-o"></i> <?=$EMAIL?></a>
                </li>
                <li><a href="tel:<?=$HOTLINE?>"><i class="fa fa-phone"></i> <?=$HOTLINE?></a>
                </li>

              </ul>
              <!-- End Contact Info -->
            </div>
            <!-- .col-md-6 -->
                <div class="col-md-3">
              <!-- Start Social Links -->
              <ul class="social-list">
               <li>
               <a class="facebook itl-tooltip" data-placement="bottom" title="" href="<?=$FB_URL?>" target="new"><i class="fa fa-facebook"></i></a>
               </li>
               <li>
               <a class="twitter itl-tooltip" data-placement="bottom" title="" href="<?=$TWITTER_URL?>" target="new"><i class="fa fa-twitter"></i></a>
               </li>
               <li>
               <a class="google itl-tooltip" data-placement="bottom" title="" href="<?=$GP_URL?>" target="new"><i class="fa fa-google-plus"></i></a>
               </li>
               <li>
               <a class="skype itl-tooltip" data-placement="bottom" title="" href="<?=$YOUTUBE_URL?>" target="new"><i class="fa fa-youtube"></i></a>
               </li>

               </ul>              
            </div>
            <!-- .col-md-6 -->
            
          </div>
          <!-- .row -->
        </div>
        <!-- .container -->
      </div>
      <!-- .top-bar -->
      <!-- End Top Bar -->


     <!-- Start  Logo & Naviagtion  -->
    <div class="topnav" id="myTopnav">
                   <a  href="<?=$BASE_URL?>">
             <img alt="freedom Online" src="<?=$BASE_URL?>uploads/<?=$MAIN_LOGO?>" class="logo-img">
           </a>
 <a href="<?=$BASE_URL?>home" style="margin-top: 25px; text-decoration:none;">Home</a>
  <a href="#about_us_page" style="margin-top: 25px;">About Us</a>
 <a href="#features" style="margin-top: 25px;">Service</a>
  <a class="" href="#our_package" style="margin-top: 25px;">Package</a>
  <a href="media.php" style="margin-top: 25px;">Media</a>
  <a class="" href="#coverage_area" style="margin-top: 25px;">Coverage</a>
  <?php 

   $self = getQuerySingle($tblName="selfcares",$fields="URL",$con,$orderBy="");

?>
  <a href="<?=$self['URL']?>" target="_blank" class="dropdown-toggle" style="margin-top: 25px;">Selfcare</a>

<a href="#contact_us" class="" style="margin-top: 25px;">Contact </i></a>

<a class="" href="#bill_pay" style="margin-top: 25px;">Bill Pay</a>
<a class="" href="chart.php" target="_blank" style="margin-top: 25px;">BTRC Tariff Chart</a>
<a class="" style="margin-top: 25px;" href="offer.php" target="_blank">Offer</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
     <!-- End Header Logo & Naviagtion -->
   </header>
   <!-- End Header Section -->
   <!--/ Header end -->

   <!-- Home service start -->
