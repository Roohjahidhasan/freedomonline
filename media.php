<?php include('config/db_connection.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Media</title>
	<link rel="stylesheet" href="<?=$BASE_URL?>assets/css/bootstrap.min.css">
</head>
<body style="background-image: url(assets/images/depositphotos_73031397-stock-photo-icon-internet-provider.jpg); background-position: center center; background-size: cover;">

<?php 

   $media_menus = getQuery($tblName="media_menus",$fields="URL,MENU_NAME,IMAGE",$con,$orderBy="ORDER BY ORDER_SL ASC");

?>
<div class="container" style="margin-bottom:70px;">
	<div class="row" style="margin-top:80px">

		<!--<div class="col-md-3 mb-3 col-sm-6" style="margin-right:100px">-->
		<!--	<a href="<?=$BASE_URL?>tv_server" style="text-decoration: none;" >-->

	 <!--           <img src="assets/images/tv.jpg" style="height: 200px;width: 300px;" alt="">-->
	 <!--           <h3 style="color:white">vhjjjgj</h3>            -->
 	<!--		</a>-->
 	<!--		<div style="margin-bottom: 30px;"></div>-->
  <!--    </div>-->
  <?php foreach ($media_menus as $media_menu):?>
		<div class="col-md-3 mb-3 col-sm-6 " style="margin-right:100px">
			<a href="<?=$media_menu['URL']?>"  style="text-decoration: none;" >

	            <img src="<?=$BASE_URL?>uploads/<?=$media_menu['IMAGE']?>" style="height: 200px;width: 300px;" alt="">
	            <h3 style="color:white;"><?=$media_menu['MENU_NAME']?></h3>            
 			</a>
 			<div style="margin-bottom: 30px;"></div>
      </div>
 <?php endforeach; ?> 


	</div>
</div>


</body>
</html>