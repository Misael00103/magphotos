<?php 
  include 'includes/config.php';
  include 'includes/usersModel.php';
  include 'includes/validate.php';
  include('includes/allPanama.php');
  validate_user2();
  
  $peo = new usuarios;
  $peoplelist = $peo->get_crowd();
  $groups = $peo->get_groups();

  $bl = new alldestinos;
  $country = $bl->get_all_country(); 
  
  if (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $peo->add_person();
    exit();
  }elseif( isset($_POST['editar']) && $_POST['editar'] == 'si'){
    $peo->edit_person("_people");
    exit();
  }elseif (isset($_POST['eliminar']) && $_POST['eliminar'] == 'si') {
    $peo->eli_person();
    exit();
  }

?>
<!DOCTYPE HTML>
<html lang="es" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="refresh" content="900">
<title>DB Clients Administrator</title>
<meta name="robots" content="NOINDEX, NOFOLLOW"/>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121577471-1"></script><script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-121577471-1');</script><script src="js/jQuery_v1.8.2.js"></script>
<script src="js/modernizr-1.7.min.js"></script>
<script src="js/jq_f.js"></script>
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



<style> .personinfo h5{padding:10px 0 10px 0 !important;}</style>
</head>
<body class="skin-red fixed">
        <div class="wrapper">
                  <?php include "includes/top-menu.php" ?>

    <div class="content-wrapper">

   

    <div class="row" id="mainticbg">
        <h5 style="text-align:right;"><a href="_gestion.php">← Back to management</a></h5> 
        <hr>
        <h3 style="text-align:center;">People</h3>
    </div>

  

<!-- ------------------------------------- ITEMS ------------------------------------ -->
 <div class="row" style="padding:20px;">       
 <div class="clear-right right btn_refresh">
      <a class="inline amininav" href="#adddate">
      <img src="images/cross.svg" alt="agregar" title="agregar" width="30"/></a>
           <a class="amininav" href="javascript: window.location.reload()"> 
      <img src="images/refresh.svg"  width="30" alt="refresh data" title="refresh data"/></a>
    </div>
        <table id="myTable"  class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
              <th>ID#</th>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Company</th>
              <th>Person type</th>
              <th>Details</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php  
            for ($m=0; $m < count($peoplelist); $m++) { 
				if($peoplelist[$m]['id_group']==6){
          ?>
      <tr>
              <td><?php echo $peoplelist[$m]['id_person']; ?></td>
              <td><img src="images/people/<?php echo $peoplelist[$m]['person_img']; ?>" width="80" /></td> 
              <td><?php echo $peoplelist[$m]['person_name']; ?></td>
              <td><?php echo $peoplelist[$m]['person_email']; ?></td>
              <td><?php echo $peoplelist[$m]['person_company']; ?></td>
              <td><?php echo $peoplelist[$m]['name_group']; ?></td>
              <td><a class="inline" href="#ver_person<?php echo $m; ?>">see details...</a></td>
              <td><a class="inline" href="#edit_date<?php echo $m; ?>"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="366 276 60 60" xml:space="preserve">
	<path fill="#444444" d="M422.114,279.887c-5.165-5.177-13.564-5.177-18.729,0l-34.338,34.325c-0.269,0.269-0.435,0.614-0.486,0.984
l-2.544,18.845c-0.077,0.536,0.115,1.073,0.486,1.444c0.319,0.319,0.767,0.512,1.214,0.512c0.077,0,0.153,0,0.23-0.014l11.353-1.534c0.946-0.127,1.611-0.997,1.483-1.942c-0.128-0.946-0.997-1.611-1.943-1.483l-9.102,1.228l1.777-13.143l13.833,13.833c0.319,0.319,0.767,0.511,1.214,0.511c0.448,0,0.895-0.179,1.214-0.511l34.339-34.326c2.505-2.506,3.886-5.83,3.886-9.371
		C426,285.704,424.619,282.38,422.114,279.887z M404.05,284.105l5.766,5.766l-31.334,31.334l-5.766-5.766L404.05,284.105z
		 M386.574,329.285l-5.638-5.638l31.334-31.334l5.638,5.638L386.574,329.285z M420.312,295.483l-13.794-13.794
c1.751-1.445,3.938-2.237,6.238-2.237c2.621,0,5.075,1.023,6.929,2.864c1.854,1.841,2.864,4.308,2.864,6.929C422.549,291.559,421.756,293.732,420.312,295.483z"/>
</svg></a></td>   
          <td><a class="inline" href="#delete_date<?php echo $m; ?>"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="10 10 30 30" enable-background="new 10 10 30 30" xml:space="preserve">
                      <g>
                          <path fill="#999" d="M37.335,14.205h-5.856V13.51c0-1.968-1.601-3.569-3.567-3.569h-5.86c-1.968,0-3.568,1.601-3.568,3.569  v0.695h-5.855c-0.624,0-1.132,0.508-1.132,1.133c0,0.624,0.508,1.131,1.132,1.131h1.177v19.014c0,2.596,2.112,4.708,4.708,4.708       H31.45c2.596,0,4.708-2.112,4.708-4.708V16.469h1.178c0.624,0,1.132-0.507,1.132-1.131C38.467,14.712,37.959,14.205,37.335,14.205z             M22.051,12.205h5.86c0.72,0,1.305,0.585,1.305,1.304v0.695h-8.469v-0.695C20.747,12.79,21.332,12.205,22.051,12.205z M31.45,37.925H18.512c-1.348,0-2.444-1.096-2.444-2.442V16.469h17.832l-0.007,19.014C33.894,36.829,32.797,37.925,31.45,37.925z"></path>
                          <path fill="#999" d="M24.981,18.797c-0.624,0-1.132,0.509-1.132,1.133v14.528c0,0.629,0.508,1.14,1.132,1.14
                              c0.625,0,1.132-0.509,1.132-1.134V19.93C26.113,19.306,25.605,18.797,24.981,18.797z"></path>
                          <path fill="#999" d="M19.614,19.699c-0.624,0-1.132,0.508-1.132,1.132v12.725c0,0.625,0.508,1.133,1.132,1.133
                              s1.132-0.508,1.132-1.133V20.831C20.747,20.207,20.238,19.699,19.614,19.699z"></path>
                          <path fill="#999" d="M30.348,19.699c-0.625,0-1.132,0.508-1.132,1.132v12.725c0,0.625,0.507,1.133,1.132,1.133
                              c0.626,0,1.133-0.508,1.133-1.133V20.831C31.479,20.207,30.974,19.699,30.348,19.699z"></path>
                      </g>
                   </svg></a> 
        </td>
            </tr>
          <?php
					}
            }
          ?>
        </tbody>
    </table>
        <div class="sep" style="margin-top:100px;"><hr/></div>
 </div>       
<!-- ------------------------------------- ITEMS ------------------------------------ -->

      
        
        <!-- ------------------------------------- FORMS ------------------------------------ -->
                 
        <div class="hide">
            <div id="adddate" style="padding:20px;">
                <form class="row" action="" method="post" enctype="multipart/form-data">
               	<h2 style="color:#333;">Add new person:</h2>
                <input class="form-control" type="text" name="person_name" placeholder="Name"  required>
                <input class="form-control" type="text" name="person_email" placeholder="Email"  required>
                <input class="form-control" type="text" name="person_phone" placeholder="Phone #"  required>
                <input class="form-control" type="text" name="person_company" placeholder="Company"  >
                <input class="form-control" type="text" name="person_position" placeholder="Position"  >
                <input class="form-control" type="text" name="person_social" placeholder="Social Network"  >
              <select class="form-control" name="person_type" required id="person_type">
                <option value="">Select type user...</option>
                  <?php for ($j=0; $j < count($groups); $j++) { 
                  ?>
                    <option value=" <?php echo $groups[$j]['id_group'] ?> "><?php echo $groups[$j]['name_group'] ?></option>
                  <?php 
                  } ?>
              </select>
                <textarea class="form-control" cols="3" rows="3" name="person_history" placeholder="Person history" style="resize: none; resize: vertical;"></textarea>
                <select class="form-control" name="country" required> 
                  <option value="">Select Country...</option> 
                  <?php  
                  for ($j=0; $j < count($country); $j++) 
                  {  
                  ?> 
                    <option value="<?php echo $country[$j]['id_pais'] ?>"><?php echo $country[$j]['pais'] ?></option> 
                  <?php  
                  }  
                  ?> 
                </select>
                <input class="form-control top_bottom" type="file" name="person_img" accept="image/*">
                <input type="hidden" name="person_img1" value="default.png">
                <input type="hidden" name="max_size" value="204801" />
                <input type="hidden" name="grabar" value="si">
                <input class="btn btn-primary" type="submit" name="enviar" value="Save">
                <div class="sep" style="margin-top:30px;"></div>
				</form>
            </div>
        </div>
        
        
<?php 
	for ($l=0; $l < count($peoplelist) ; $l++) {  
?>  
<div class="hide">
  <div class="editart" id="edit_date<?php echo $l; ?>" style="padding:20px;">
		<form class="row" action="" method="post" enctype="multipart/form-data">
      <h2 style="color:#333;">Edit a person #<?php echo $peoplelist[$l]['id_person']; ?>:</h2>
			<label>Name:</label>
			<input class="form-control" type="text" name="person_name" value="<?php echo $peoplelist[$l]['person_name']; ?>"  required>
			<label>Email:</label>
			<input class="form-control" type="text" name="person_email" value="<?php echo $peoplelist[$l]['person_email']; ?>"  required>
			<label>Phone #:</label>
			<input class="form-control" type="text" name="person_phone" value="<?php echo $peoplelist[$l]['person_phone']; ?>"  required>
			<label>Company:</label>
			<input class="form-control" type="text" name="person_company" value="<?php echo $peoplelist[$l]['person_company']; ?>" >
			<label>Job Position:</label>
			<input class="form-control" type="text" name="person_position" value="<?php echo $peoplelist[$l]['person_position']; ?>" >
      <label>Social network:</label>
      <input class="form-control" type="text" name="person_social" value="<?php echo $peoplelist[$l]['person_social']; ?>" >
			<label>Person type:</label>
        <select class="form-control" name="person_type" required id="person_type">
          <option value="">Select type user...</option>
            <?php for ($j=0; $j < count($groups); $j++) { 
            ?>
              <option value=" <?php echo $groups[$j]['id_group'] ?> " <?php if($groups[$j]['id_group']==$peoplelist[$l]['person_type'])echo 'selected';?> ><?php echo $groups[$j]['name_group'] ?></option>
            <?php 
            } ?>
        </select>         
			<label>History:</label>
			<textarea class="form-control" cols="3" rows="3" name="person_history"><?php echo $peoplelist[$l]['person_history']; ?></textarea>
      <label>Country:</label>
      <select class="form-control" name="country" required> 
        <option value="">Select Country...</option> 
        <?php  
        for ($i=0; $i < count($country); $i++) 
        {  
        ?>  
          <option value="<?php echo $country[$i]['id_pais'] ?>" <?php if($country[$i]['id_pais'] == $peoplelist[$l]['country']) echo "Selected";?> ><?php echo $country[$i]['pais'] ?></option> 
        <?php  
        }  
        ?> 
      </select> 
      <label>Image:</label>
      <input class="form-control top_bottom" type="file" name="person_imgn" accept="image/*">
      <input type="hidden" name="max_size" value="204801" />
      <input type="hidden" name="person_img1" value="<?php echo $peoplelist[$l]['person_img']; ?>">

			<input type="hidden" name="editar" value="si"/>
			<input type="hidden" name="id_person" value="<?php echo $peoplelist[$l]['id_person']; ?>"/>
			<input class="btn btn-primary" type="submit" name="enviar" value="Editar"/>
			<div class="sep" style="margin-top:30px;"></div>
		</form>
  </div>
</div>
<?php 
}
?>
    
    <?php 
		  for ($n=0; $n < count($peoplelist) ; $n++) {  
		?>  
        <div class="hide">
            <div id="ver_person<?php echo $n; ?>">
            	<div class="row" style="padding:20px;">
                    <div class="g-6 col personinfo">
                    	<em>Name:</em>
                        <h3><?php echo $peoplelist[$n]['id_person']; ?> / <?php echo $peoplelist[$n]['person_name']; ?></h3>
                        <em>Email:</em>
                        <h3><?php echo $peoplelist[$n]['person_email']; ?></h3>
                        <em>Phone#:</em>
                        <h3><?php echo $peoplelist[$n]['person_phone']; ?></h3>
                        <em>Company:</em>
                        <h3><?php echo $peoplelist[$n]['person_company']; ?></h3>
                        <hr/>
                        <em>Social network:</em>
                        <h5><?php echo $peoplelist[$n]['person_social']; ?></h5>
                        <em>Position:</em>
                        <h5><?php echo $peoplelist[$n]['person_position']; ?></h5>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    	<div class="col-xs-12 col-md-6">
                    	<em>Type:</em>
                        <h5><?php echo $peoplelist[$n]['person_type']; ?></h5>
                        </div>
                        <div class="col-xs-12 col-md-6">
                        <em>Status:</em>
                        <h5><?php echo $peoplelist[$n]['person_check']; ?></h5>
                        </div>
                        <hr>
                        <div class="col-xs-12 col-md-12" style="padding:0;">
                    	<em>Person History:</em>
                        <p style="margin-top:20px;"><?php echo $peoplelist[$n]['person_history']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
		}
		?>
                
         <!-- ------------------------------------- FORMS ------------------------------------ -->
         
    </div>
        <?php 
      for ($j=0; $j < count($peoplelist) ; $j++) {  
    ?>  
    <div class="hide">
      <div class="editart popup_delete" id="delete_date<?php echo $j; ?>" style="padding:10px;">
        <h2 style="color:#333;text-align: center">Do you really want to delete the record?</h2>
                <form class="row" action="" method="post">
                    <input type="hidden" name="eliminar" value="si"/>
                    <input type="hidden" name="id_person" value="<?php echo $peoplelist[$j]['id_person']; ?>"/><br><br>
          <input class="btn btn-primary" type="submit" name="enviar" value="Yes" style=" margin-left: 100px;" /><br><br>
                    <input class="btn btn-primary" type="button" name="enviar" value="No" onclick="location.href='_people.php'" style=" margin-left: 100px;"/>
                </form>
      </div>
    </div>
    <?php 
    }
    ?>

 <!--Delete-->

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
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/config.js"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<?php include_once("includes/footer.php"); ?>

</div>
</body>
</html>