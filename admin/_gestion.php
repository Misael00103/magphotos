<?php 
  include 'includes/config.php';
  include 'includes/usersModel.php';
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
<body class="skin-red fixed">
      <div class="wrapper">
                  <?php include "includes/top-menu.php" ?>

    <div class="content-wrapper">


  <div class="clear" style="height:35px;"></div>
  
  <hr>
  <h3 style="text-align:center;">Management</h3>

  <div class="clear" style="height:25px;"></div>

  <div class="row">
  	<div class="center">
        <a class="col-xs-12 col-md-3"  href="_people.php" title="clients / readers">
            	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" xml:space="preserve">
				<path fill="#000" d="M11.4,57.7c0.2-3.9-0.4-7.8,0.4-11.6c1.5-6.9,5.8-11.5,12.4-13.9c0.5-0.2,1-0.4,1.3-0.8c0.9-1,0.6-2.5-0.6-3.1
c-7.3-4-9.1-15-3.6-21.7c4.9-6.1,13-5.8,17.5,0.6c3.8,5.4,3.6,13.2-0.7,18.3c-0.9,1-2,1.9-3.2,2.7c-0.8,0.6-1.3,1.2-1.2,2.2
c0.1,1,0.8,1.5,1.6,1.8c7.3,2.5,11.6,7.5,13,15.1c0.2,1.1,0.2,2.3,0.2,3.5c0,2.3,0,4.7,0,7.1C36.2,57.7,23.8,57.7,11.4,57.7z"/>
				<path fill="#000" d="M52.8,54.2c0-1.4,0-2.8,0-4.2c1,0,2,0,3,0c0-0.2,0.1-0.4,0.1-0.5c-0.1-2.4,0.1-4.9-0.3-7.2
c-0.9-5.1-4.1-8.5-9-10.2c-1.1-0.4-1.7-1.1-1.7-2.2c0-0.8,0.5-1.4,1.2-1.8c5.7-3.5,6.2-12.5,0.9-16.6c-0.3-0.3-0.7-0.6-1.1-0.7
c-0.7-0.2-1-0.8-1.2-1.4c-0.4-1.2-1-2.4-1.5-3.6c1.2,0,2.4,0.3,3.5,0.8c4.4,1.9,6.9,5.3,7.8,9.9c0.9,4.7-0.1,8.9-3.2,12.7
c-0.1,0.1-0.1,0.2-0.2,0.3c2,1.2,3.7,2.6,5.2,4.4c2.5,3.1,3.8,6.7,3.8,10.6c0,2.5,0,4.9,0,7.4c0,1.5-0.8,2.3-2.3,2.3
					C56.1,54.2,54.5,54.2,52.8,54.2z"/>
				<path fill="#000" d="M4.2,50c1,0,2,0,3,0c0,1.4,0,2.7,0,4.2c-0.9,0-1.7,0-2.6,0c-0.9,0-1.7,0-2.6,0c-1.1,0-2-0.9-2-1.9C0,49.2-0.1,46,0.2,43c0.5-5.6,3.4-9.9,8.1-13c0.2-0.1,0.3-0.2,0.5-0.3c0,0,0,0,0-0.1c-4.4-5.7-5.1-11.8-1.4-18.1c2-3.4,5.8-5.6,9.2-5.6c-0.6,1.4-1.2,2.9-1.8,4.4c-0.1,0.1-0.2,0.3-0.4,0.4c-3.5,1.6-5.6,5.7-5.2,9.9c0.3,3.3,1.8,6,4.7,7.7c0.8,0.5,1.1,1.2,1,2.1c-0.1,0.9-0.7,1.4-1.5,1.7c-3.7,1.2-6.5,3.6-8.1,7.2c-0.8,1.7-1.1,3.4-1.2,5.2C4.2,46.3,4.2,48.1,4.2,50z"/>
				</svg>
				<br/>
            <abbr>Clients</abbr>
        </a>
        
        
        
        <a class="col-xs-12 col-md-3" href="_users.php" title="system users">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" xml:space="preserve">
                <g>
                    <g>
                        <path fill="#1D1D1B" d="M48.015,60h-36.03c-0.629,0-1.238-0.271-1.668-0.745c-0.431-0.474-0.654-1.116-0.613-1.765
                            c0.257-4.021,1.857-16.901,11.686-21.896c-2.087-2.251-3.252-5.211-3.252-8.383C18.138,20.478,23.46,15,30.001,15
                            s11.863,5.479,11.863,12.212c0,3.125-1.194,6.135-3.268,8.388c9.839,5.008,11.443,17.875,11.701,21.889
                            c0.04,0.65-0.184,1.293-0.613,1.767C49.254,59.729,48.646,60,48.015,60z M12.235,57.406h35.532
                            c-0.301-4.133-2.032-16.571-11.919-20.191c-0.438-0.161-0.756-0.557-0.824-1.032c-0.066-0.475,0.125-0.948,0.5-1.233
                            c2.393-1.815,3.82-4.709,3.82-7.737c0-5.304-4.191-9.619-9.344-9.619c-5.153,0-9.344,4.315-9.344,9.619
                            c0,3.071,1.39,5.891,3.813,7.733c0.375,0.285,0.565,0.76,0.497,1.234s-0.387,0.872-0.826,1.031
                            C14.265,40.806,12.534,53.257,12.235,57.406z"/>
                        <path fill="#1D1D1B" d="M58.063,52.791h-7.067c-0.588,0-1.1-0.422-1.229-1.012c-1.09-4.996-3.619-11.748-9.484-15.545
                            c-0.293-0.189-0.496-0.494-0.563-0.843s0.006-0.711,0.205-1.002c1.453-2.126,2.222-4.608,2.222-7.178
                            c0-0.9-0.096-1.804-0.283-2.683c-0.125-0.582,0.152-1.178,0.672-1.441c1.15-0.583,2.375-0.88,3.64-0.88
                            c4.554,0,8.259,3.813,8.259,8.5c0,1.983-0.688,3.897-1.9,5.407c6.263,3.574,7.297,11.906,7.465,14.553
                            c0.035,0.548-0.153,1.093-0.518,1.492C59.108,52.564,58.594,52.791,58.063,52.791z M51.991,50.197h5.439
                            c-0.286-3.028-1.594-10.293-7.54-12.471c-0.438-0.16-0.756-0.557-0.823-1.031C49,36.22,49.19,35.746,49.565,35.462
                            c1.469-1.115,2.346-2.892,2.346-4.754c0-3.257-2.573-5.906-5.738-5.906c-0.564,0-1.121,0.086-1.658,0.257
                            c0.1,0.713,0.15,1.434,0.15,2.153c0,2.668-0.684,5.256-1.988,7.559C48.151,38.842,50.754,45.162,51.991,50.197z"/>
                        <path fill="#1D1D1B" d="M9.001,52.789H1.938c-0.532,0-1.046-0.228-1.411-0.625c-0.369-0.401-0.559-0.948-0.523-1.502
                            c0.169-2.646,1.204-10.982,7.455-14.547c-1.217-1.504-1.889-3.394-1.889-5.406c0-4.688,3.705-8.5,8.257-8.5
                            c1.265,0,2.488,0.296,3.639,0.879c0.52,0.264,0.797,0.857,0.673,1.439c-0.188,0.891-0.285,1.793-0.285,2.685
                            c0,2.601,0.761,5.083,2.201,7.175c0.2,0.291,0.274,0.652,0.207,1.002s-0.271,0.655-0.563,0.846
                            c-5.854,3.789-8.38,10.543-9.468,15.541C10.1,52.369,9.59,52.789,9.001,52.789z M2.568,50.197h5.437
                            c1.235-5.037,3.833-11.358,9.296-15.424c-1.29-2.281-1.967-4.869-1.967-7.561c0-0.715,0.051-1.436,0.151-2.153
                            c-0.539-0.171-1.094-0.257-1.658-0.257c-3.166,0-5.739,2.648-5.739,5.906c0,1.888,0.854,3.619,2.343,4.75
                            c0.375,0.285,0.567,0.76,0.498,1.234c-0.069,0.476-0.387,0.873-0.826,1.031C4.164,39.886,2.854,47.162,2.568,50.197z"/>
                    </g>
                </g>
                <path fill="#1D1D1B" d="M17.461,16.589h-5.046V9.793h-1.499l-2.075,0.959l0.3,1.368l1.487-0.708h0.024v5.177H5.69
                    c-0.96,0-1.738,0.778-1.738,1.739s0.778,1.739,1.738,1.739h11.771c0.96,0,1.738-0.778,1.738-1.739S18.421,16.589,17.461,16.589z"/>
                <path fill="#1D1D1B" d="M37.624,8.515h-4.276V7.584h-2.95V7.561l0.719-0.6c1.14-1.007,2.075-2.051,2.075-3.37
                    c0-1.403-0.96-2.435-2.734-2.435c-1.043,0-1.967,0.36-2.542,0.804l0.516,1.295c0.408-0.3,0.996-0.636,1.667-0.636
                    c0.9,0,1.271,0.503,1.271,1.139c-0.012,0.912-0.84,1.787-2.554,3.322L27.819,7.98v0.535h-5.443c-1.244,0-2.252,1.008-2.252,2.252
                    s1.008,2.252,2.252,2.252h15.248c1.243,0,2.252-1.008,2.252-2.252S38.867,8.515,37.624,8.515z"/>
                <path fill="#1D1D1B" d="M54.772,16.589h-3.592c0.265-0.357,0.415-0.776,0.415-1.243c0-1.032-0.756-1.739-1.691-1.907v-0.024
                    c0.959-0.324,1.428-0.983,1.428-1.811c0-1.067-0.924-1.943-2.579-1.943c-1.02,0-1.942,0.288-2.411,0.588l0.373,1.319
                    c0.311-0.192,0.982-0.468,1.619-0.468c0.779,0,1.15,0.348,1.15,0.815c0,0.66-0.768,0.899-1.379,0.899h-0.72v1.307h0.743
                    c0.805,0,1.572,0.348,1.572,1.127c0,0.576-0.48,1.032-1.428,1.032c-0.744,0-1.487-0.3-1.811-0.48l-0.213,0.787h-3.248
                    c-0.96,0-1.738,0.778-1.738,1.739s0.778,1.739,1.738,1.739h11.771c0.96,0,1.738-0.778,1.738-1.739S55.732,16.589,54.772,16.589z"/>
            </svg><br/>
            <abbr>Sys. Users</abbr>
        </a>
                
       
           
    </div>
  </div>
  </div>

<?php include_once("includes/footer.php"); ?>
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
</div>
</body>
</html>