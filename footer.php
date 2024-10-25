<!-- Main Footer start -->
<!-- Features start -->
<!-- ==================================================================== -->
<!--                          partner backend                             -->
<!-- ==================================================================== -->
<section id="clients">
   <div class="container">
      <div class="row">
         <div class="col-md-12 wow bounceIn">
            <div class="text-center">
               <h2 class="title"><span> Our Partners and Members</span></h2>
            </div>
         </div>
      </div>
      <!-- Corporate client area -->   
      <div class="row " style="margin-top:30px">
         <?php 
            $partners = getQuery($tblName="all_partners",$fields="PARTNER_LOGO",$con,$orderBy="ORDER BY ORDER_SL ASC");
            
            ?>
         <?php foreach ($partners as $partner): ?>
         <div class="col-md-3 hoverimage" id="partnerImg">
            <img src="<?=$BASE_URL?>uploads/<?=$partner['PARTNER_LOGO']?>" id="pimg" style="height: 150px;width: 200px;" alt="">
         </div>
         <?php endforeach; ?>
      </div>
   </div>
   <!-- Main container end -->
</section>
<div style="margin-bottom: 50px;"></div>
<!-- ==================================================================== -->
<!--                         coverage backend                          -->
<!-- ==================================================================== -->
<div id="coverage_area"> </div>
<section id="clients">
   <div class="container">
      <div class="row">
         <div class="col-md-12 wow bounceIn">
            <div class="text-center">
               <h2 class="title"><span> Coverage Area</span></h2>
            </div>
         </div>
      </div>
      <?php 
         $maps = getQuery($tblName="cover_maps",$fields="MAP",$con,$orderBy="ORDER BY ORDER_SL ASC");
         ?>
      <div class="row">
         <?php foreach ($maps as $map): ?>
         <div class="col-md-4 myimage" style="margin-top:30px">
            <img  src="<?=$BASE_URL?>uploads/<?=$map['MAP']?>" style="width:361px;height:378px" alt="" id="areaimage">
         </div>
         <?php endforeach; ?>
      </div>
   </div>
</section>
<!-- ======================================================== -->
<section id="contact_us">
   <div class="container">
      <div class="row">
         <div class="col-md-12 wow bounceIn">
            <div class="text-center">
               <h2 class="title"><span>Contact Us</span></h2>
            </div>
         </div>
      </div>
      <!-- Contact form start -->
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <div class="contact-form">
            <!-- ======================================================================================== -->
            <form action="action.php" method="post" role="form">
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" id="contact_name" placeholder="" type="text" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" id="contact_email" placeholder="" type="email" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Subject</label>
                        <input class="form-control" name="subject" id="contact_subject" placeholder="" type="text" required>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control" name="message" id="contact_message" placeholder="" rows="8" required></textarea>
               </div>
               <div><br>
                  <button class="btn btn-primary" type="submit" value="Send">Send Message</button> 
               </div>
            </form>
            <!-- ======================================================================================== -->
         </div>
         <!-- Contact form end -->
      </div>
      <!-- Contact address details -->
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <div class="contact-info">
            <h3>Head Office</h3>
            <br>
            <p><i class="fa fa-home"></i> <?=$ADDRESS?> </p>
            <p><i class="fa fa-mobile"></i><?=$PHONE?></p>
            <p><i class="fa fa-phone"></i> <?=$HOTLINE?> </p>
            <p><i class="fa fa-envelope-o"></i><?=$EMAIL?></p>
         </div>
      </div>
   </div>
</section>
<section id="bill_pay">
   <div class="container">
      <!--/ about intro start -->
      <div class="row">
         <h2 class="title text-center"><span> Payment via bKash and Nagad</span></h2>
         <!-- ================= payment mobile ================ -->
         <?php 
            $mobile_payments = getQuery($tblName="mobaile_payments",$fields="PAYMENT_IMAGE",$con,$orderBy="");
            
            ?>
         <?php foreach ($mobile_payments as $mobile_payment): ?>
         <div class="text-center">                          
            <img src="<?=$BASE_URL?>uploads/<?=$mobile_payment['PAYMENT_IMAGE']?>" class="img-thumbnail" alt="mobile banking payment" width="850" height="550"> 
         </div>
         <?php  endforeach; ?>
         <!-- ---------------------------------------------------------- -->
         <!-- =========================== Bank Payment ========================== -->
      </div>
   </div>
</section>
<div class="gap-40"></div>
<!-- ========================================================================================= -->
<!--                                       Footer Backend                                      -->
<!-- ========================================================================================= -->
<!-- Start Footer Section -->
<footer style="margin-top: 50px;background:#156a70 !important">
   <!-- background: #222 -->
   <div class="container">
      <div class="row footer-widgets">
         <!-- ========================  one ================================= -->
         <div class="col-md-3 col-xs-12">
            <div class="footer-widget twitter-widget">
               <h4><?=$ORGANIZATION_NAME?><span class="head-line"></span></h4>
               <p><?=$FOOTER_DETAILS?></p>
               <ul>
                  <li><span>Phone Number:</span> <?=$PHONE?></li>
                  <li><span>Email:</span> <?=$EMAIL?></li>
                  <li><span>Website:</span> www.freedomonlinebd.com</li>
               </ul>
            </div>
         </div>
         <!-- ============================ quick link ======================= -->
         <?php 
            $quicks = getQuery($tblName="quick_links",$fields="URL,LINK_NAME",$con,$orderBy="");
            ?>
         <div class="col-md-3 col-xs-12">
            <div class="footer-widget twitter-widget">
               <h4 style="margin-left:35px">quick Link<span class="head-line"></span></h4>
               <ul>
                  <?php foreach ($quicks as $quick): ?>
                  <li><a href="<?=$quick['URL']?>" style="color: #C1CCCC;"><?=$quick['LINK_NAME']?></a></li>
                  <?php endforeach; ?>
               </ul>
            </div>
         </div>
         <!-- =========================  our support  =========================== -->
         <?php 
            $supports = getQuery($tblName="our_supports",$fields="URL,LINK_NAME",$con,$orderBy="");
            ?>
         <div class="col-md-3 col-xs-12">
            <div class="footer-widget twitter-widget">
               <h4 style="margin-left:35px">Our Support<span class="head-line"></span></h4>
               <ul>
                  <?php foreach ($supports as $support): ?>
                  <li><a href="<?=$support['URL']?>" style="color: #C1CCCC;"><?=$support['LINK_NAME']?></a></li>
                  <?php endforeach; ?>
               </ul>
            </div>
         </div>
         <!-- ============================ four ======================= -->
         <!-- Start Subscribe & Social Links Widget -->
         <div class="col-md-3 col-xs-12">
            <div class="footer-widget mail-subscribe-widget">
               <h4>Get in touch<span class="head-line"></span></h4>
               <p><?=$GET_TOUCH?></p>
               <form class="subscribe">
                  <input type="text" placeholder="mail@example.com">
                  <input type="submit" class="btn-system" value="Send">
               </form>
            </div>
            <div class="footer-widget social-widget">
               <h4>Follow Us<span class="head-line"></span></h4>
               <ul class="social-icons">
                  <li>
                     <a class="facebook itl-tooltip" data-placement="bottom" title=""  href="<?=$FB_URL?>" target="new"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                     <a class="twitter itl-tooltip" data-placement="bottom" title="" href="<?=$TWITTER_URL?>" target="new"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                     <a class="google itl-tooltip" data-placement="bottom" title=""  href="<?=$GP_URL?>" target="new"><i class="fa fa-google-plus"></i></a>
                  </li>
                  <li>
                     <a class="skype itl-tooltip" data-placement="bottom" title="" href="<?=$YOUTUBE_URL?>" target="new"><i class="fa fa-youtube"></i></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <!-- .row -->
      <!-- ================= payment mehtod ================ -->
      <?php 
         $payments = getQuery($tblName="payment_methods",$fields="PAYMENT_AGENT",$con,$orderBy="");
         
         ?>
      <div class="row">
         <div class="col-md-12">
            <div class="col-md-12">
               <span>Payment <b style="margin-right: 10px;"> | </b></span>
               <?php foreach ($payments as $payment): ?>
               <img src="<?=$BASE_URL?>uploads/<?=$payment['PAYMENT_AGENT']?>" alt="payment image" style="width: 60px;height: 50px;margin-right: 10px;">
               <?php endforeach; ?> 
            </div>
         </div>
      </div>
      <!-- Start Copyright -->
      <div class="copyright-section">
         <div class="row">
            <div class="col-md-8" >
               <p>&copy; 2022 Freedom Online - All Rights Reserved & Designed by <a href="http://bdsoft.biz/bdsoft/" >BDSOFT IT SOLUTIONS</a></p>
            </div>
            <!-- .col-md-6 -->
            <div class="col-md-4">
            </div>
            <!-- .col-md-6 -->
         </div>
         <!-- .row -->
      </div>
      <!-- End Copyright -->
   </div>
</footer>
<!-- End Footer Section -->
</div>
<!-- End Full Body Container -->
<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<!-- Javascript Files
   ================================================== -->
<!-- initialize jQuery Library -->
<!-- <script
   src="https://code.jquery.com/jquery-3.6.0.min.js"
   integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
   crossorigin="anonymous"></script> -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.migrate.js"></script>
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.js"></script>
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<!-- Bootstrap jQuery -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/bootstrap.min.js"></script>
<!-- Owl Carousel -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/owl.carousel.js"></script>
<!-- PrettyPhoto -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.prettyPhoto.js"></script>
<!-- Bxslider -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.bxslider.min.js"></script>
<!-- Isotope -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.isotope.min.js"></script>
<!-- Wow Animation -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/wow.min.js"></script>
<!-- SmoothScroll -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/smoothscroll.js"></script>
<!-- Animated Pie -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/jquery.easy-pie-chart.js"></script>
<!-- Template custom -->
<script type="text/javascript" src="<?=$BASE_URL?>assets/js/custom.js"></script>
<!-- <script type="text/javascript" src="assets/js/script.js"></script> -->
<script>
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   
   ga('create', 'UA-70084181-1', 'auto');
   ga('send', 'pageview');
   
</script>
<!-- ================ client ========== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
   $('.clients-carousel').owlCarousel({
       loop: true,
       nav: false,
       autoplay: true,
       autoplayTimeout: 5000,
       animateOut: 'fadeOut',
       animateIn: 'fadeIn',
       smartSpeed: 450,
       margin: 30,
       responsive: {
           0: {
               items: 1
           },
           768: {
               items: 2
           },
           991: {
               items: 2
           },
           1200: {
               items: 2
           },
           1920: {
               items: 2
           }
       }
   });
</script>
</div>
</body>
</html>