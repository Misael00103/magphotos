<?php 
	include 'includes/config.php';
	include 'includes/validate.php';

  	validate_user2();
?>
<!DOCTYPE HTML>
<html lang="es" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="refresh" content="900">
<title>DB Clients Administrator</title>
<meta name="robots" content="NOINDEX, NOFOLLOW"/>
      <!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />  
    <!-- DATA TABLES -->
    <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" rel="stylesheet" type="text/css" />
</head>
<body>
<body class="skin-red fixed">
        <div class="wrapper">
                  <?php include "includes/top-menu.php" ?>
    <div class="content-wrapper">

    <div class="row" id="mainticbg"  style="padding:20px;">
      <h4 style="text-align:right;">Webadmin V1.0</h4> 
      <hr>
      
    </div>
    
	<div class="center">

		<h1 style="text-align:center;">Soporte</h1>

		<div class="tbclient">

		</div>

	</div>
	</div>


<?php include 'includes/footer.php'; ?>



</div>



<div class="hide">

	<div id="contract">

    	<div class="row" style="padding:20px;">

            <h1>Terminos y Condiciones</h1>

           
		</div>

    </div>

</div>

 <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- DATA TABES SCRIPT -->
    <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
	<script src="assets/js/jquery.colorbox.js"></script>
	<!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>


<script>$(document).ready(function(){$(".group1").colorbox({rel:'group1', transition:"fade", height:"80%", slideshow:false});$(".group2").colorbox({rel:'group2', transition:"fade", height:"80%"}); $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:420}); $(".iframe").colorbox({iframe:true, width:"40%", height:"80%"}); var mql = window.matchMedia("screen and (max-width:420px)") 

if (mql.matches){ $(".inline").colorbox({inline:true, width:"90%", height:"90%"}); } else{ $(".inline").colorbox({inline:true, width:"50%", height:"90%"}); } });</script>

</body>

</html>