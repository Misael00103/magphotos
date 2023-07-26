<?php 
  include 'includes/config.php';
  include 'includes/usersModel.php';
  include 'includes/validate.php';
  include 'includes/allPanama.php';

  validate_user4();
  
  $peo = new usuarios;
  $peoplelist = $peo->get_crowid();

  $bl = new alldestinos;
  $country = $bl->get_all_country(); 
  
  if( isset($_POST['editar']) && $_POST['editar'] == 'si'){
    $peo->edit_person("people");
    exit();
  }

  if (isset($_POST['recuperar']) && $_POST['recuperar'] == 'si') 
  {
      $peo->new_pass("people");
      exit();
  }

?>
<!DOCTYPE HTML>
<html lang="es" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta http-equiv="refresh" content="900">
  <title>Control Panel</title>
  <meta name="robots" content="NOINDEX, NOFOLLOW"/>
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
  <script src="js/modernizr-1.7.min.js"></script>
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
  
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
  <style> .personinfo h5{padding:10px 0 10px 0 !important;}
  

#loader {
  top: 0px;
  left: 0px;
  width: 150px;
  height: auto;
  background-color: #2185C5;
  position: relative;
}

  
  </style>
</head>
<body class="skin-red fixed">
  <div id="wrapper">
    <header>
      <?php if($_SESSION["level"] == 6) include_once 'includes/menup.php'; ?>
      <?php if($_SESSION["level"] == 7) include_once 'includes/menupp.php'; ?>
    </header>
    <div class="clear" style="height:35px;">
    </div>
    <hr>
    <h3 style="text-align:center;">My Profile</h3>
    <div class="clear" style="height:25px;"></div>
  <!-- ------------------------------------- ITEMS ------------------------------------ -->
    <div class="row" style="padding:20px;">
    <?php  
          for ($m=0; $m < count($peoplelist); $m++) { 
        ?>
      <div class="col-xs-12 col-md-6" style="text-align:right;">
        <img src="images/people/<?php echo $peoplelist[$m]['person_img']; ?>" />
      </div>
      <div class="col-xs-12 col-md-6">
        <h2>ID#: <?php echo $peoplelist[$m]['id_person']; ?></h2>
          <h2>Name: <?php echo $peoplelist[$m]['person_name']; ?></h2>
          <h4>Email: <?php echo $peoplelist[$m]['person_email']; ?></h4>
          <h4>Company: <?php echo $peoplelist[$m]['person_company']; ?></h4>
          <div class="col-xs-12 col-md-6">
            Edit: <a class="inline" href="#edit_date<?php echo $m; ?>"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="366 276 60 60" xml:space="preserve">
            <path fill="#444444" d="M422.114,279.887c-5.165-5.177-13.564-5.177-18.729,0l-34.338,34.325c-0.269,0.269-0.435,0.614-0.486,0.984
            l-2.544,18.845c-0.077,0.536,0.115,1.073,0.486,1.444c0.319,0.319,0.767,0.512,1.214,0.512c0.077,0,0.153,0,0.23-0.014l11.353-1.534c0.946-0.127,1.611-0.997,1.483-1.942c-0.128-0.946-0.997-1.611-1.943-1.483l-9.102,1.228l1.777-13.143l13.833,13.833c0.319,0.319,0.767,0.511,1.214,0.511c0.448,0,0.895-0.179,1.214-0.511l34.339-34.326c2.505-2.506,3.886-5.83,3.886-9.371
            C426,285.704,424.619,282.38,422.114,279.887z M404.05,284.105l5.766,5.766l-31.334,31.334l-5.766-5.766L404.05,284.105z
            M386.574,329.285l-5.638-5.638l31.334-31.334l5.638,5.638L386.574,329.285z M420.312,295.483l-13.794-13.794
            c1.751-1.445,3.938-2.237,6.238-2.237c2.621,0,5.075,1.023,6.929,2.864c1.854,1.841,2.864,4.308,2.864,6.929C422.549,291.559,421.756,293.732,420.312,295.483z"/>
            </svg></a>
          </div>
          <div class="col-xs-12 col-md-6">
            Change Password: <a class="inline" href="#edit_password_form<?php echo $m; ?>">Change</a>
          </div>
      </div>
      
        <?php
          }
        ?>

      <div class="sep" style="margin-top:100px;"></div>
    </div>       
<!-- ------------------------------------- ITEMS ------------------------------------ -->

        
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
          <input class="form-control" type="text" name="person_company" value="<?php echo $peoplelist[$l]['person_company']; ?>"  required>
          <label>Job Position:</label>
          <input class="form-control" type="text" name="person_position" value="<?php echo $peoplelist[$l]['person_position']; ?>"  required>
          <label>Social network:</label>
          <input class="form-control" type="text" name="person_social" value="<?php echo $peoplelist[$l]['person_social']; ?>"  required>
    
          <input class="form-control" type="hidden"  name="person_type" value="<?php echo $peoplelist[$l]['person_type']; ?>" >
          <label>Status:</label>
          <select class="form-control" name="person_check" disabled required>
            <option value="">Select status...</option>
            <option value="1" <?php if($peoplelist[$l]['person_check']==1)echo 'selected'; ?>>Active</option>
            <option value="0" <?php if($peoplelist[$l]['person_check']==0)echo 'selected'; ?>>Inactive</option>
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
          <input class="form-control top_bottom" type="file" name="person_imgn" id="person_img_file" accept="image/*">
          <input type="hidden" name="max_size" value="12582912" />
          <input type="hidden" name="person_img1" value="<?php echo $peoplelist[$l]['person_img']; ?>">
          <input type="hidden" id="x1" name="x1" />
          <input type="hidden" id="y1" name="y1" />
          <input type="hidden" id="x2" name="x2" />
          <input type="hidden" id="y2" name="y2" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
          <input type="hidden" name="editar" value="si"/>
          <input type="hidden" name="id_person" value="<?php echo $peoplelist[$l]['id_person']; ?>"/>           
          <input class="btn btn-primary" type="submit" name="enviar" value="Editar"/>
          <div class="sep" style="margin-top:30px;"></div>
        </form>
        <div id ="loader" style="background: white;
                                width: 960px;
                                height: 960px;display: flex;flex-direction: column;justify-content: flex-start;align-items: left;">
            <img alt="" id="person_img_img">
            <div style="display:flex;flex-direction:row;">
              <button id="cropCancel" class="btn btn-primary" style="align-self:flex-end;width:200px;margin:10px;">Cancel</button>
              <button id="cropOK" class="btn btn-primary" style="align-self:flex-end;width:200px;margin:10px;">OK!</button>
            </div>
          </div>
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

<!-- cambiar passw -->
<?php 
  for ($j=0; $j < count($peoplelist); $j++){ 
?>
    <div class="hide">
      <div  name="edit_password_form" id="edit_password_form<?php echo $j; ?>" style="padding:10px;">
        <form id="reserva" class="formu" action="" method="post" enctype="multipart/form-data">
          <h1 class="titulo">Change Password</h1>
          <br>
          <!-- Input password actual -->
          <label>Old Password:</label>
          <input type="password" class="form-control" id="pass0"  name="password_actual" placeholder="Old password" required /> <br> 
          <label>New Password:</label>          
          <input type="password" class="form-control" id="pass1"  name="password_new1" placeholder="New password" required /> <br>
          <label>New Password:</label>
          <input type="password" class="form-control" id="pass2"  name="password_new2" placeholder="Repeat password" required /> <br>
          <input type="hidden" name="recuperar" value="si">
          <input type="hidden" name="id" value="<?php echo $peoplelist[$j]['id_user']; ?>">
          <input class="btn btn-primary" type="submit" name="enviar" value="Cambiar">
        </form>
      </div>
    </div>
<?php  
  }
?>
  </div>  
<?php include_once("includes/footerclients.php"); ?>

<script src="js/jquery.Jcrop.min.js"></script>
<script>
var jcropInit = false
var jcrop_api;
var loader = $('#loader');
loader.hide();

function updateInfo(e) {
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
    $('#w').val(e.w);
    $('#h').val(e.h);
};
// clear info by cropping (onRelease event handler)
function clearInfo() {
  $('#w').val('');
  $('#h').val('');
};
$('#person_img_file').change(function(){
// get selected file
  var oFile = $('#person_img_file')[0].files[0];
  
  // check for image type (jpg and png are allowed)
  var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        alert("Please select a valid image file (jpg and png are allowed)");
        return;
    }

    // check for file size
    if (oFile.size > (12 * Math.pow(1024,2))) {
        alert('You have selected too big file, please select a one smaller image file');
        return;
    }
    // preview element
    var oImage = document.getElementById('person_img_img');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        loader.show();
        oImage.onload = function () { // onload event handler

            // Create variables (in this scope) to hold the Jcrop API and image size
            var boundx, boundy;
            if (jcrop_api){
              jcrop_api.destroy();
            }
            // initialize Jcrop
            $('#person_img_img').Jcrop({
                minSize: [32, 32], // min crop size
                aspectRatio : 1, // keep aspect ratio 1:1
                bgFade: true, // use fade effect
                bgOpacity: .3, // fade opacity
                onChange: updateInfo,
                onSelect: updateInfo,
                onRelease: clearInfo,
                setSelect: [200,200,50,50],
                boxWidth: 960,
                boxHeight: 960
            }, function(){
                jcropInit = true;
                // Store the Jcrop API in the jcrop_api variable
                jcrop_api = this;
            });
        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
});
$(document).on('click','#cropCancel',function(e){
  jcrop_api.destroy();
  loader.hide();
});
$(document).on('click','#cropOK',function(e){
  loader.hide();
});
$(document).ready(function(){$(".group1").colorbox({rel:'group1', transition:"fade", height:"80%", slideshow:false});$(".group2").colorbox({rel:'group2', transition:"fade", height:"80%"}); $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:420}); $(".iframe").colorbox({iframe:true, width:"40%", height:"80%"}); var mql = window.matchMedia("screen and (max-width:420px)") 
if (mql.matches){ $(".inline").colorbox({inline:true, width:"90%", height:"90%"}); } else{ $(".inline").colorbox({inline:true, width:"50%", height:"90%"}); } });</script>
</body>
</html>