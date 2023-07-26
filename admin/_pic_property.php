<?php 
include 'includes/config.php';
  include 'includes/usersModel.php';
  include 'includes/validate.php';
  include 'includes/allPanama.php';

  validate_user2();
  
  $ppy = new alldestinos;
    
  if (isset($_GET['id']) and !empty($_GET['id'])  ) 
	{
  $id_blogs=$_GET['id'];
  $pisturespp = $ppy->get_all_pics_property($_GET['id']);
    }


  if (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $ppy->add_pics_property();
    exit();
  }elseif( isset($_POST['editar']) && $_POST['editar'] == 'si'){
    $ppy->edit_pics_property();
    exit();
  }elseif (isset($_POST['eliminar']) && $_POST['eliminar'] == 'si') {
    $ppy->eli_pics_property();
  }

?>
<!DOCTYPE HTML>
<html lang="es" class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="refresh" content="900">
  <title>DB Clients Administrator</title>
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
  
  
  
  <style>
  
  .loader {
  position: absolute;
  text-align: center;
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  display:none;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  </style>
</head>
<body class="skin-red fixed">
        <div class="wrapper">
                  <?php include "includes/top-menu.php" ?>

    <div class="content-wrapper">

   
 
   <div class="clear" style="height:25px;"></div>

  <h3 style="text-align:center;">Pictures</h3>
  

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
                <th>name</th>
                <th>Artycle</th>
                <th>picture file</th>
                <th>status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php  
              for ($i=0; $i < count($pisturespp); $i++) { 
            ?>
        <tr>
                <td><?php echo $pisturespp[$i]['id_gallery']; ?></td>
                <td><?php echo $pisturespp[$i]['service_name']; ?></td>
                <td><?php echo $pisturespp[$i]['article_title']; ?></td>
                <td><img style="max-width:80px;" src="../images/art_imgs/<?php echo $pisturespp[$i]['photo']; ?>"/></td> 
                <td><?php if( $pisturespp[$i]['gallery_estatus'] == 1) echo "Visible"; else echo "Hidden"; ?></td>
                <td><a class="inline" href="#edit_date<?php echo $i; ?>"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="366 276 60 60" xml:space="preserve">
    <path fill="#444444" d="M422.114,279.887c-5.165-5.177-13.564-5.177-18.729,0l-34.338,34.325c-0.269,0.269-0.435,0.614-0.486,0.984
  l-2.544,18.845c-0.077,0.536,0.115,1.073,0.486,1.444c0.319,0.319,0.767,0.512,1.214,0.512c0.077,0,0.153,0,0.23-0.014l11.353-1.534c0.946-0.127,1.611-0.997,1.483-1.942c-0.128-0.946-0.997-1.611-1.943-1.483l-9.102,1.228l1.777-13.143l13.833,13.833c0.319,0.319,0.767,0.511,1.214,0.511c0.448,0,0.895-0.179,1.214-0.511l34.339-34.326c2.505-2.506,3.886-5.83,3.886-9.371
      C426,285.704,424.619,282.38,422.114,279.887z M404.05,284.105l5.766,5.766l-31.334,31.334l-5.766-5.766L404.05,284.105z
       M386.574,329.285l-5.638-5.638l31.334-31.334l5.638,5.638L386.574,329.285z M420.312,295.483l-13.794-13.794
  c1.751-1.445,3.938-2.237,6.238-2.237c2.621,0,5.075,1.023,6.929,2.864c1.854,1.841,2.864,4.308,2.864,6.929C422.549,291.559,421.756,293.732,420.312,295.483z"/>
  </svg></a></td>
        <td><a class="inline" href="#delete_date<?php echo $i; ?>"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="10 10 30 30" enable-background="new 10 10 30 30" xml:space="preserve">
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
            ?>
          </tbody>
      </table>
          <div class="sep" style="margin-top:100px;"><hr/></div>
   </div>       
  <!-- ------------------------------------- ITEMS ------------------------------------ -->


    <!-- ------------------------------------- FORMS ------------------------------------ -->
                 
        <div class="hide">
            <div id="adddate" style="padding:20px;">
                <form class="row" onsubmit="return  checkSubmit('');" action="" method="post" enctype="multipart/form-data">
                	<h2 style="color:#333;">Add a new picture:</h2>
                    <input class="form-control" type="text" name="service_name" placeholder="Picture Title" required>
                    <input class="form-control article_list" type="hidden" value="<?=$id_blogs;?>" name="id_photo_gallery" placeholder="Article id #" required>
					show on homepage:<input type="checkbox" name="gallery_estatus" style="width:30px;">
                    <br>
                    <label>Image:</label>
                    <input class="form-control top_bottom" type="file" id="slide_pic" name="photo" required accept="image/*">
                    <br>
                    <div id="img_slide"></div>
                    <br><br>
                    <input type="hidden" name="grabar" value="si">
                    <input type="hidden" name="max_size" value="204801" />


                    <input class="btn btn-primary" type="submit"  name="enviar" id="btsubmit" value="Save">
                    <div class="sep" style="margin-top:30px;"><hr/></div>
                    <div id="loader_page"  class="loader"></div> 

                </form>
            </div>
        </div>
              
        
      <?php 
        
      for ($j=0; $j < count($pisturespp) ; $j++) 
      {  
      ?>  
        <div class="hide">
          <div class="editart" id="edit_date<?php echo $j; ?>" style="padding:20px;">
            <form class="row"  onsubmit="return  checkSubmit('<?=$j; ?>');" action="" method="post" enctype="multipart/form-data">
              <h2 style="color:#333;">Edit picture:</h2>
              <label>Picture Title</label>
              <input class="form-control" type="text" name="service_name" value="<?php echo $pisturespp[$j]['service_name']; ?>" required>
              <!--<label>Article:</label>-->
              <input class="form-control article_list" type="hidden" name="id_photo_gallery" value="<?=$pisturespp[$j]['id_photo_gallery']; ?>" >
              <br>
              show on homepage:<input type="checkbox" name="gallery_estatus" style="width:30px;" <?php if( $pisturespp[$j]['gallery_estatus'] == 1) echo "checked";?>>
              <br>
              <label>Image: </label>
              <input type="hidden" name="slide_pic1" value="<?php echo $pisturespp[$j]['photo']; ?>">
              <input class="form-control top_bottom" type="file" id="slide_pictu<?php echo $j; ?>" name="slide_picn" accept="image/*">
              <br>
                <div id="img_slide_pictu<?php echo $j; ?>"></div>
              <br><br>
              <input type="hidden" name="editar" value="si"/>
              <input type="hidden" name="max_size" value="204801" />
              <input type="hidden" name="id_gallery" value="<?php echo $pisturespp[$j]['id_gallery']; ?>"/>
              <input class="btn btn-primary" type="submit" name="enviar" id="btsubmit<?=$j; ?>" value="Modify"/>
              <div class="sep" style="margin-top:30px;"><hr/></div>
              <div id="loader_page<?=$j; ?>"  class="loader"></div> 

            </form>
          </div>
        </div>
        <script type="text/javascript">
          function openI() { //Esta función validaría una imágen
        
              var input = this;
              var file = input.files[0];
              var fileName = input.value;
              var maxSize = 204800; //200KB en bytes
              var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones válidas
              document.getElementById("img_slide_pictu<?php echo $j; ?>").innerHTML = "";

              var error = {
                  state: false,
                  msg: ''
              };

              if (this.files && file) {

                  for (var i = fileName.length-1; i >= 0; i--) {

                      if (fileName[i] == '.') {

                          var ext = fileName.substring(fileName[i],fileName.length);

                          if (!extensions.test(ext)) {
                              error.state = true;
                              error.msg+= 'The file extension is not valid.<br>';
                          }
                          break;
                      }
                  }

                  if (file.size > maxSize) {
                      error.state = true;
                      error.msg += 'The image can not occupy more than 200 KB.';
                  }

                  if (error.state) {
                      input.value = '';
                      //document.getElementById("result").innerHTML = error.msg;
                      alert( error.msg );
                      return;
                  } else {
                    //document.getElementById("result").innerHTML = "El archivo es válido";
                  }
                 
                  var reader = new FileReader();

                  reader.onload = (function(theFile) {
                    return function(e) {
                      // Insertamos la imagen
                      document.getElementById("img_slide_pictu<?php echo $j; ?>").innerHTML = ['<img class="thumb" width="800px" height="501px" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    };
                  })(file);

                  reader.readAsDataURL(file);
                }
          }
          //document.getElementById("slide_pictu<?php echo $j; ?>").addEventListener("change",openI,false);
        </script>
      <?php 
      }
      ?>
      
                 
   <!-- ------------------------------------- FORMS ------------------------------------ -->
 
    

    <?php 
    for ($j=0; $j < count($pisturespp) ; $j++) {  
    ?>  
    <div class="hide" style="height: 150px!important;">
      <div class="editart popup_delete" id="delete_date<?php echo $j; ?>" >
        <h2 style="color:#333; text-align: center">Do you really want to delete the record?</h2>
        <form class="row" action="" method="post">
          <input type="hidden" name="id_gallery" value="<?php echo $pisturespp[$j]['id_gallery']; ?>"/><br><br>
          <input type="hidden" name="photo" value="<?php echo $pisturespp[$j]['photo']; ?>">
          <input class="btn btn-primary" type="submit" name="enviar" value="Yes" style=" margin-left: 100px;"/><br><br>
          <input class="btn btn-primary" type="button" name="enviar" value="No" onclick="location.href='_pic_property.php'" style=" margin-left: 100px;"  />
          <input class="form-control article_list" type="hidden" name="id_photo_gallery" value="<?=$pisturespp[$j]['id_photo_gallery']; ?>" >
          <input type="hidden" name="eliminar" value="si"/>

     </form>
      </div>
    </div>
    <?php 
    }
    ?>
 <!--dddddddddddddddddddddddddddddd-->
<div class="clear" style="height:100px;"></div>
</div><?php include_once("includes/footer.php"); ?>
</div>
<script>
$(document).ready(function(){ $('#myTable').DataTable({ "order": [[ 0, "desc" ]], "columnDefs": [ { "width":50, "targets": 0 } ], "iDisplayLength":25, responsive: true }); });
$(document).ready(function(){$(".group1").colorbox({rel:'group1', transition:"fade", height:"80%", slideshow:false});$(".group2").colorbox({rel:'group2', transition:"fade", height:"80%"}); $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:420}); $(".iframe").colorbox({iframe:true, width:"40%", height:"80%"}); $(".inline").colorbox({inline:true, height:"90%"}); });
</script>
<script type="text/javascript" src="assets/js/typeahead.js"></script>

<script type="text/javascript">
  
  function openImage() { //Esta función validaría una imágen
        
      var input = this;
      var file = input.files[0];
      var fileName = input.value;
      var maxSize = 204800; //200KB en bytes
      var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones válidas
      document.getElementById("img_slide").innerHTML = "";

      var error = {
          state: false,
          msg: ''
      };

      if (this.files && file) {

          for (var i = fileName.length-1; i >= 0; i--) {

              if (fileName[i] == '.') {

                  var ext = fileName.substring(fileName[i],fileName.length);

                  if (!extensions.test(ext)) {
                      error.state = true;
                      error.msg+= 'The file extension is not valid.<br>';
                  }

                  break;
              }

          }

          if (file.size > maxSize) {
              error.state = true;
              error.msg += 'The image can not occupy more than 200 KB.';
          }

          if (error.state) {
              input.value = '';
              //document.getElementById("result").innerHTML = error.msg;
              alert( error.msg );
              return;
          } else {
            //document.getElementById("result").innerHTML = "El archivo es válido";
          }
         
          var reader = new FileReader();

          reader.onload = (function(theFile) {
            return function(e) {
              // Insertamos la imagen
              document.getElementById("img_slide").innerHTML = ['<img class="thumb" width="1000px" height="562px" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
            };
          })(file);

          reader.readAsDataURL(file);
        }
  }  


 function checkSubmit(ud) {
        document.getElementById("loader_page"+ud).style.display = "block";
        document.getElementById("btsubmit"+ud).value = "Loading Please wait...";
        document.getElementById("btsubmit"+ud).disabled = true;
        return true;
    }
    
  //document.getElementById("slide_pic").addEventListener("change",openImage,false);

  function cambiar( id, bt ){

        //amarillo: background-color: #f1f1c1
        var cambio = ( $(bt).prop('checked') == true ) ? 1 : 0;

        //console.log( id+" -> "+$(".check_tabla:checked").length );
        
        if( cambio == 0 ){
            alert('There must be at least one active');
            $(bt).attr('checked','checked');
        }
        else{            
            $.ajax({
                async: false,
                dataType: 'html',
                data:  {
                  change_linebg_status: true,
                  id_linebg: id
                },
                url:   'controller/c_linebg.php',
                type:  'post',
                beforeSend: function () {},
                success:  function (response) {
                    
                    console.log( response );
                    if( parseInt(response) == 1 ){

                        $(".check_line:checked").removeAttr('checked');
                        $(bt).attr('checked','checked');
                    }
                    else{
                        $(bt).removeAttr('checked');
                    }
                },
                error: function( msj, xhr, status ) {
                    console.log( msj+" - "+xhr );
                }
          });
        }
    }
    
    
    	$('.article_list').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "includes/ajax.php",
					data: 'operacion=ARTICLES&busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }/*, afterSelect: function(item) {
				var listaitem = item.split(' | ');
				$(this).val(listaitem[0]);


			}*/
        });
		
        
</script>
</body>
</html>