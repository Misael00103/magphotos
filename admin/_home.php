<?php 
  include 'includes/config.php';
  include 'includes/usersModel.php';
  include 'includes/validate.php';
  include 'includes/allPanama.php';

  validate_user2();

  $bl = new alldestinos;
  $bloglist =array();
  
  if ((isset($_POST['datedesde']) and !empty($_POST['datedesde']) && isset($_POST['datehasta']) and !empty($_POST['datehasta'])) || (isset($_POST['article_title']) and !empty($_POST['article_title']))   ) 
	{
  $bloglist = $bl->get_blog_rangofecha($_POST['datedesde'], $_POST['datehasta'], '1,3', $_POST['article_title']);
  }else{
    $bloglist = $bl->get_blog_articles_limit(50, '1,3');
  }

  if (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $bl->add_article('_home.php');
    exit();
  }elseif( isset($_POST['editar']) && $_POST['editar'] == 'si'){
    $bl->edit_article();
    exit();
  }elseif( isset($_POST['editar']) && $_POST['editar'] == 'si_es'){
    $bl->edit_article_es();
    exit();
  }elseif (isset($_POST['eliminar']) && $_POST['eliminar'] == 'si') {
    $bl->eli_article('_home.php');
    exit();
  }

	 $subjects = $bl->get_all_subjects();
?>
<!DOCTYPE HTML>
<html lang="en" class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>DB Clients Administrator</title>
  <meta name="robots" content="NOINDEX, NOFOLLOW"/>
      <!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />  
    <!-- DATA TABLES -->
    <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Datepicker -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-select.css">

	  <script src="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js"></script>
        <link href="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
       
	     <script>
        // document.addEventListener('DOMContentLoaded', () => {
			
			             function images_cargar(id_img) {
			var id= id_img;
             // Input File
             const inputImage = document.querySelector('#image'+id);
             // Nodo donde estará el editor
             const editor = document.querySelector('#editor'+id);
             // El canvas donde se mostrará la previa
             const miCanvas = document.querySelector('#preview'+id);
             // Contexto del canvas
             const contexto = miCanvas.getContext('2d');
             // Ruta de la imagen seleccionada
             let urlImage = undefined;
             // Evento disparado cuando se adjunte una imagen
             inputImage.addEventListener('change', abrirEditor, false);

             /**
              * Método que abre el editor con la imagen seleccionada
              */
             function abrirEditor(e) {
                 // Obtiene la imagen
                 urlImage = URL.createObjectURL(e.target.files[0]);

                 // Borra editor en caso que existiera una imagen previa
                 editor.innerHTML = '';
                 let cropprImg = document.createElement('img');
                 cropprImg.setAttribute('id', 'croppr');
                 editor.appendChild(cropprImg);

                 // Limpia la previa en caso que existiera algún elemento previo
                 contexto.clearRect(0, 0, miCanvas.width, miCanvas.height);

                 // Envia la imagen al editor para su recorte
                 document.querySelector('#croppr').setAttribute('src', urlImage);

                 // Crea el editor
                 new Croppr('#croppr', {
                     aspectRatio: 0.6,
                     startSize: [80, 80],
                     onCropEnd: recortarImagen
                 })
             }

             /**
              * Método que recorta la imagen con las coordenadas proporcionadas con croppr.js
              */
             function recortarImagen(data) {
                 // Variables
                 const inicioX = data.x;
                 const inicioY = data.y;
                 const nuevoAncho = data.width;
                 const nuevaAltura = data.height;
                 const zoom = 1;
                 let imagenEn64 = '';
                 // La imprimo
                 miCanvas.width = nuevoAncho;
                 miCanvas.height = nuevaAltura;
                 // La declaro
                 let miNuevaImagenTemp = new Image();
                 // Cuando la imagen se carge se procederá al recorte
                 miNuevaImagenTemp.onload = function() {
                     // Se recorta
                     contexto.drawImage(miNuevaImagenTemp, inicioX, inicioY, nuevoAncho * zoom, nuevaAltura * zoom, -20, -20, nuevoAncho, nuevaAltura);
                     // Se transforma a base64
                     imagenEn64 = miCanvas.toDataURL("image/jpeg");
                     // Mostramos el código generado
                    $('#base64'+id).val(imagenEn64);
                     //document.querySelector('#base64HTML').textContent = '<img src="' + imagenEn64.slice(0, 40) + '...">';

                 }
                 // Proporciona la imagen cruda, sin editarla por ahora
                 miNuevaImagenTemp.src = urlImage;
             }

             /////////////////////// DEMO //////////////////////////////////
             /**
              * Método que seleccona todo el texto
              */
             function selectText(e) {
                 let node = e.target;
                 if (document.selection) { // IE
                     var range = document.body.createTextRange();
                     range.moveToElementText(node);
                     range.select();
                 } else if (window.getSelection) {
                     var range = document.createRange();
                     range.selectNode(node);
                     window.getSelection().removeAllRanges();
                     window.getSelection().addRange(range);
                 }
             }
             document.querySelector('#base64'+id).addEventListener('click', selectText, false);
            // document.querySelector('#base64HTML').addEventListener('click', selectText, false);
        // });
		}
        </script>
</head>
<body class="skin-red fixed">
	<div class="wrapper">
	<?php include "includes/top-menu.php" ?>
    <div class="content-wrapper">
  
	<div class="clear" style="height:25px;"></div>
    <div class="row">
	<div class="col-xs-12 col-md-4">
		&nbsp;
	</div>
	<div class="col-xs-12 col-md-4">
	  <h3 style="text-align:center;">Articles</h3>
	</div>
	<div class="col-xs-12 col-md-4">
		<form action="" method="post" name="porfecha">
		<div class="col-xs-12 col-md-12">
        <h5>Search by Date Range:</h5>
        </div>
        <div class="col-xs-12 col-md-4">
        From:
        </div>
        <div class="col-xs-12 col-md-8" style="margin-bottom:10px;">
        <input class="form-control"  type="date" max="<?=date("Y-m-d");?>" name="datedesde" value="<?=date("Y-m-01");?>" >
        </div>
        <div class="col-xs-12 col-md-4">
        To:
        </div>
        <div class="col-xs-12 col-md-8" style="margin-bottom:10px;">
        <input class="form-control" type="date" max="<?=date("Y-m-d");?>" name="datehasta" value="<?=date("Y-m-d");?>" >
        </div> 
        <div class="col-xs-12 col-md-4">
        Article:
        </div>
        <div class="col-xs-12 col-md-8" style="margin-bottom:10px;">
        <input class="form-control article_list"  placeholder="Title" type="text" name="article_title"  >
        </div>
        <div class="col-xs-12 col-md-12 text-right">
        <input class="btn btn-primary" type="submit" value="Filter">
        <input class="hide" type="hide" value="FiltrarFecha">
        </div>
        </form>
	</div>
</div>
  
   
<!-- ------------------------------------ITEMS------------------------------------ -->
 <div class="row" style="padding:0 0 0 20px;">    
<div class="pull-left text-left">
  <a class="inline amininav" href="#addtour" title="Add Article">
  <img src="images/cross.svg" alt="Add" width="30"/></a>
  <a class="amininav" href="javascript: window.location.reload()">
  <img src="images/refresh.svg"  width="30" alt="refresh data" title="refresh data" width="30" /></a>
</div>
</div>

 <div class="row" style="padding:20px;"> 
        <table id="myTable"  class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
          	  <th>Picture</th>
          	  <th>id</th>
          	  <th>Category</th>
              <th>Tittle</th>
              <th>Manage pictures</th>
              <th>Home</th>
              <th>Article</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          $j=0;
            for ($i=0; $i < count($bloglist); $i++) { 
            $j=$i;
            if(1==$bloglist[$i]['article_category']){
                $tipo= "Pagos"; 
                }elseif(2==$bloglist[$i]['article_category']){
                $tipo= "gratis"; 
                }
			
          ?>
      <?php if($bloglist[$i]['article_position']==1) {echo "<tr style='background-color: #f1f1c1'>"; }else{ echo "<tr>";} ?>
      		    <td>  <img src="../home/portafolio/imagenes/<?php echo $bloglist[$i]['article_picture']; ?>" width="80" /></td>
                
                <td><?php echo $bloglist[$i]['id_blogs']; ?>


			  </td>
			  <td><?=$tipo;?></td>
             <td><?php echo $bloglist[$i]['article_title']; ?></td>
             <!-- <td><?php echo $bloglist[$i]['article_date']; ?></td>-->
              <td>
              <a class="btn btn-info" style="font-size:1rem !important;" href="_pic_property.php?id=<?=$bloglist[$i]['id_blogs'];?>">
              Manage<br>pictures</a>
              </td> 
              <td>
                <?php if($bloglist[$i]['article_position']==1){ echo '<input onchange="cambiar(parseInt('. $bloglist[$i]['id_blogs'].'),this)" type="checkbox" class="check_tabla" checked="true">'; }else{ echo '<input onchange="cambiar(parseInt('. $bloglist[$i]['id_blogs'].'),this)" type="checkbox" class="check_tabla">';} ?>
              </td> 
              
              <td>
                <?php if($bloglist[$i]['article_status']==1){ echo '<input onchange="cambiar_status(parseInt('. $bloglist[$i]['id_blogs'].'),this)" type="checkbox" class="check_tabla" checked="true">'; }else{ echo '<input onchange="cambiar_status(parseInt('. $bloglist[$i]['id_blogs'].'),this)" type="checkbox" class="check_tabla">';} ?>
              </td>
              
              <td><a class="inline" title="edit english" href="#edittour<?php echo $i; ?>">
			  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="366 276 60 60" xml:space="preserve">
	<path fill="#444444" d="M422.114,279.887c-5.165-5.177-13.564-5.177-18.729,0l-34.338,34.325c-0.269,0.269-0.435,0.614-0.486,0.984
l-2.544,18.845c-0.077,0.536,0.115,1.073,0.486,1.444c0.319,0.319,0.767,0.512,1.214,0.512c0.077,0,0.153,0,0.23-0.014l11.353-1.534c0.946-0.127,1.611-0.997,1.483-1.942c-0.128-0.946-0.997-1.611-1.943-1.483l-9.102,1.228l1.777-13.143l13.833,13.833c0.319,0.319,0.767,0.511,1.214,0.511c0.448,0,0.895-0.179,1.214-0.511l34.339-34.326c2.505-2.506,3.886-5.83,3.886-9.371
		C426,285.704,424.619,282.38,422.114,279.887z M404.05,284.105l5.766,5.766l-31.334,31.334l-5.766-5.766L404.05,284.105z
		 M386.574,329.285l-5.638-5.638l31.334-31.334l5.638,5.638L386.574,329.285z M420.312,295.483l-13.794-13.794
c1.751-1.445,3.938-2.237,6.238-2.237c2.621,0,5.075,1.023,6.929,2.864c1.854,1.841,2.864,4.308,2.864,6.929C422.549,291.559,421.756,293.732,420.312,295.483z"/>
</svg></a></td> 
      <td><a class="popupdelete" href="#delete_date<?php echo $i; ?>">
	  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="10 10 30 30" enable-background="new 10 10 30 30" xml:space="preserve">
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
            
            
            <div class="hide">
    <div class="edittour" id="edittour<?php echo $j; ?>" style="padding:20px;">
      <form class="row" action="" method="post"  enctype="multipart/form-data">   
        <h2 style="color:#333; margin-left: 20px;">Edit Article:</h2>          
        <div class="col-xs-12 col-md-9">
        	<label>Title:</label>
        	<input class="form-control" type="text" name="article_title" value="<?php echo $bloglist[$j]['article_title']; ?>" required>
        </div>
		
		<div class="col-xs-12 col-md-3">
			<label>Label:</label>

			<select class="form-control selectpicker" title="label" data-live-search="true" name="article_category" id="subjects">
              <?php  
              for ($m=0; $m < count($subjects); $m++) { 
    
                  ?>
                  <option <?php if($subjects[$m]["idsuj"]==$bloglist[$j]['subjects']){ echo "selected"; } ?> value="<?=$subjects[$m]["idsuj"]; ?>"><?php echo $subjects[$m]["namesub"]; ?></option>
                  <?php 
              }
              ?>
            </select>
			</div>
	
		
  
       <!-- <div class="col-xs-12 col-md-3" style="margin-bottom: 15px">
        	<label>Date: </label>-->
        	<input class="form-control" type="hidden" name="article_date" value="<?php echo $bloglist[$j]['article_date']; ?>"/>
     <!--   </div>
		
		
        
        <div class="col-xs-12 col-md-4">          
        <label>Price:</label>     -->     
        <input class="form-control" type="hidden"  step="0.01" value="<?php echo $bloglist[$j]['issueno']; ?>" name="issueno" placeholder="Price"  required min="0">        
        <!--/div-->
		

        
      <div class="col-xs-12 col-md-12">
          <label>SEO:</label>
          <textarea class="form-control" cols="3" rows="3" name="article_seo"  required style="resize: none; resize: vertical;" ><?php echo $bloglist[$j]['article_seo']; ?></textarea>
        </div>
        

        <div class="col-xs-12 col-md-12" style="margin-bottom:15px; padding-top:15px;">
          <label>Description:</label>
          <textarea title="Click on Source!" class="form-control" cols="3" rows="3" name="article_descriptione" id="article_descriptione<?=$j;?>" required ><?php echo $bloglist[$j]['article_description']; ?></textarea>
        </div>

        <div class="col-xs-12 col-md-6">
          show on homepage:<input type="checkbox" name="article_position" style="width:30px;" <?php if( $bloglist[$j]['article_position'] == 1) echo "checked";?>>
        </div>
        
        <div class="col-xs-12 col-md-6">
          Show article:<input type="checkbox" value="1" name="article_status" style="width:30px;" <?php if( $bloglist[$j]['article_status'] == 1) echo "checked";?>>
        </div>
        
         <div class="col-xs-12 col-md-6" style="padding-top:15px;">
       <label> GUID:</label>
          <input type="text"  placeholder="GUID" class="form-control" name="article_list" value="<?=$bloglist[$j]['article_list']; ?>">
          </div>
        
        <div class="col-xs-12 col-md-6" style="padding-top:15px;">
            <label>Category:</label>
            <select class="form-control selectpicker " title="Category" name="article_category" id="category" required>
            <option value="">-- Category --</option>
            <option <?php if(1==$bloglist[$j]['article_category']){ echo "selected"; } ?> value="1">Pagos</option>
            <option <?php if(2==$bloglist[$j]['article_category']){ echo "selected"; } ?> value="2">gratis</option>
            </select>
        </div>
        
        <div class="col-xs-12 col-md-12">
          <label>Image:  Use the aplication to cut the image into 9:16 proportion and right resolution.</label>
          <input accept="image/*" id="image<?=$j;?>"  class="form-control top_bottom" type="file" name="article_picturen" accept="image/*">
        </div>
			
        <div class="col-xs-12 col-md-6">
            <h4>Cut out</h4>
            <!-- Editor donde se recortará la imagen con la ayuda de croppr.js -->
            <div id="editor<?=$j;?>"></div>
        </div>
        <div class="col-xs-12 col-md-6">
            <h4>Preview the result</h4>
            <!-- Previa del recorte -->
            <canvas id="preview<?=$j;?>"></canvas>
        </div>
			
                 
        <div class="col-xs-12 col-md-12">
		  <input type="hidden" name="base64" id="base64<?=$j;?>" value="">
          <input type="hidden" name="base64HTML" id="base64HTML<?=$j;?>" value="">
          <input type="hidden" name="editar" value="si"/>
          <input type="hidden" name="max_size" value="390625" />
          <input type="hidden" name="article_picture1" value="<?php echo $bloglist[$j]['article_picture']; ?>">
          <input type="hidden" name="id_blogs" value="<?php echo $bloglist[$j]['id_blogs']; ?>"/>
          <input class="btn btn-primary" type="submit" name="enviar" value="Edit"/>
          <div class="sep" style="margin-top:30px;"><hr/></div>
        </div>
      </form>
    </div>
	
	<div class="edittour" id="edittour_es<?php echo $j; ?>" style="padding:20px;">
      <form class="row" action="" method="post"  enctype="multipart/form-data">   
        <h2 style="color:#333; margin-left: 20px;">Edit Article Spanish:</h2>          
        <div class="col-xs-12 col-md-12">
        	<label>Title:</label>
        	<input class="form-control" type="text" name="article_title" value="<?php echo $bloglist[$j]['article_title_es']; ?>" required>
        </div>
      

        <div class="col-xs-12 col-md-12" style="margin-bottom: 15px">
          <label>Short description:</label><br><br>
          <textarea title="Click on Source!" class="form-control" cols="3" rows="3" name="article_descriptione" id="article_descriptione_es<?=$j;?>" required ><?php echo $bloglist[$j]['article_description_es']; ?></textarea>
        </div>
        
        <div class="col-xs-12 col-md-12">
          <label>SEO (short description, most relevant):</label>
          <textarea class="form-control" cols="3" rows="3" name="article_seo"  required style="resize: none; resize: vertical;" ><?php echo $bloglist[$j]['article_seo_es']; ?></textarea>
        </div>

                 
        <div class="col-xs-12 col-md-6">

          <input type="hidden" name="editar" value="si_es"/>
          <input type="hidden" name="max_size" value="204801" />
          <input type="hidden" name="article_picture1" value="<?php echo $bloglist[$j]['article_picture']; ?>">
          <input type="hidden" name="id_blogs" value="<?php echo $bloglist[$j]['id_blogs']; ?>"/>
          <input class="btn btn-primary" type="submit" name="enviar" value="Edit"/>
          <div class="sep" style="margin-top:30px;"><hr/></div>
        </div>
      </form>
    </div>
	
  </div>
  
  
   <div class="hide">
      <div class="editart popup_delete" id="delete_date<?php echo $j; ?>" style="padding:10px;">
        <h2 style="color:#333;text-align: center">Do you really want to delete the record?</h2>
                <form class="row" action="" method="post">
                    <input type="hidden" name="eliminar" value="si"/>
                    <input type="hidden" name="id_blogs" value="<?php echo $bloglist[$j]['id_blogs']; ?>"/><br><br>
                    <input type="hidden" name="article_picture" value="<?php echo $bloglist[$j]['article_picture']; ?>">
                    <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-6">
                    
                    <input class="btn btn-primary col-md-6 " type="submit" name="enviar" value="Yes" style=" margin-left: 100px;" /><br><br>
 </div>                   
                   <div class="col-xs-12 col-md-6">
                    <input class="btn btn-primary col-md-6" type="button" name="enviar" value="No" onclick="location.href='_blog.php'" style=" margin-left: 100px;"/>
                  </div>
                  </div>
                </form>
      </div>
    </div>
    
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
    <div id="addtour" style="padding:20px;">
			<form class="row" onsubmit="return  checkSubmit();" action="" method="post"  enctype="multipart/form-data"> 
        <h2 style="color:#333; margin-left: 20px;">Add new Article:</h2>                    	                 
        <div class="col-xs-12 col-md-9">
        	<input class="form-control"   type="text" name="article_title" placeholder="Title" required  />
        </div>
		
		<div class="col-xs-12 col-md-3" style="margin-bottom: 15px">
			<select class="form-control selectpicker" title="label" data-live-search="true" name="subjects" id="subjects">
              <?php  
              for ($m=0; $m < count($subjects); $m++) { 
    
                  ?>
                  <option value="<?=$subjects[$m]["idsuj"]; ?>"><?php echo $subjects[$m]["namesub"]; ?></option>
                  <?php 
              }
              ?>
            </select>
			</div>
          
          
          <div class="col-xs-12 col-md-4" style="margin-bottom: 15px">
        	<input class="form-control" type="hidden" name="year"  placeholder="Year" required/>
        </div>
        
        <div class="col-xs-12 col-md-4" style="margin-bottom: 15px">
          <input class="form-control make_list" type="hidden" name="article_author" placeholder="Make" required/>
        </div>
        <!--<div class="col-xs-12 col-md-3" style="margin-bottom: 15px">-->
        	<input class="form-control" type="hidden" name="article_date" value="<?php echo date('Y-m-d H:i:s');?>" min="<?php echo date('Y-m-d H:i:s', strtotime('-1 day'));?>" placeholder="Published date" required/>
        <!--</div>-->
		
		
		
		<div class="col-xs-12 col-md-4" style="margin-bottom: 15px">
        	<input class="form-control model_list" type="hidden" name="model" placeholder="Model" required/>
        </div>
		
        
         <div class="col-xs-12 col-md-4" style="margin-bottom: 15px">
          <input class="form-control" type="hidden" step="0.01" name="issueno" placeholder="Price"  required min="0">
        </div>	
        
		<div class="col-xs-12 col-md-8" style="margin-bottom: 15px">
        	<input class="form-control" type="hidden" name="link" placeholder="Link ebay"/>
        </div>
        
        <div class="col-xs-12 col-md-12">
          <textarea class="form-control" cols="3" rows="3" name="article_seo" placeholder="SEO" required style="resize: none; resize: vertical;" ></textarea>
        </div> 
        
        <div class="col-xs-12 col-md-12" style="margin-bottom:15px; padding-top:15px;">
          <label>Description:</label>
          <textarea class="form-control" cols="3" rows="3" name="article_description" id="article_description" placeholder="Short description" required ></textarea>
        </div>
        
        <!-- div class="col-xs-12 col-md-12" style="margin-bottom: 15px">
          <label>Description:</label>
          <textarea title="Click on Source!" class="form-control" cols="3" rows="3" name="article_list" id="article_list" placeholder="Description"></textarea>
        </div -->
        
        <div class="col-xs-12 col-md-6">
          
          show on homepage:<input type="checkbox" name="article_position" style="width: 30px;">
        </div>
        
        <div class="col-xs-12 col-md-6">
          Show article:<input type="checkbox" value="1" name="article_status" style="width: 30px;">
        </div>
        
        <div class="col-xs-12 col-md-6">
          <input type="text"  placeholder="GUID" class="form-control" name="article_list" value="">
          </div>
        
		<div class="col-xs-12 col-md-6">
          <select class="form-control selectpicker " title="Category" name="category" id="category" required>
			<option value="" disabled>-- Category --</option>
			<option value="1">Pagos</option>
			<option value="2">gratis</option>

            </select>
        </div>
        
        <div class="col-xs-12 col-md-12" style="padding-top:15px;">
        <label>Image: Use the aplication to cut the image into 9:16 proportion and right resolution.</label><br>
          <input  accept="image/*" class="form-control top_bottom" type="file" name="article_picture"  id="image" required accept="image/*">
        </div>
		
        <div class="col-xs-12 col-md-6">
                <h4>Cut out</h4>
                <!-- Editor donde se recortará la imagen con la ayuda de croppr.js -->
                <div id="editor"></div>
            </div>
        
			
        <div class="col-xs-12 col-md-12">

        <input type="hidden" name="base64" id="base64" value="">
        <input type="hidden" name="base64HTML" name="base64HTML" value="">
        <input type="hidden" name="grabar" value="si">
        <input type="hidden" name="max_size" value="204801" />
        <input class="btn btn-primary" type="submit" name="enviar" id="btsubmit" value="Save" style="margin-left: 20px;">
      	</div>
      	</div>
        <div class="sep" style="margin-top 30px;"><hr/></div>
      </form>
    </div>
  </div>
        
        
                
         <!-- ------------------------------------- FORMS ------------------------------------ -->
    </div>

     
   

 <!--Delete-->

<?php include_once("includes/footer.php"); ?>

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
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/config.js"></script>

<script>
CKEDITOR.replace('article_description', {
			contentsCss: '../css/outputxhtml.css',

    language: 'en'
});
images_cargar('');
        
  <?php 
    
  for ($j=0; $j < count($bloglist) ; $j++) 
  {  

  ?> 

images_cargar('<?=$j;?>');  
CKEDITOR.replace('article_descriptione<?=$j;?>', {
		contentsCss: '../css/outputxhtml.css',

    language: 'en',
});

CKEDITOR.replace('article_descriptione_es<?=$j;?>', {
    language: 'eS',
	contentsCss: '../css/outputxhtml.css',
});

        
  <?php 
  }
  ?>  

$(document).ready( function() 
{ 
  CKEDITOR.config.startupFocus = true; 
  CKEDITOR.config.startupOutlineBlocks = true; 
  CKEDITOR.config.allowedContent = true;
  CKEDITOR.config.startupMode = 'source'; 
  $( '#article_description' ).val('Click on Source!'); 
});
</script>

<script src="js/modernizr-1.7.min.js"></script>
<script type="text/javascript" src="assets/js/typeahead.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>

<script>$(document).ready(function(){
    $(".group1").colorbox({rel:'group1', transition:"fade", height:"80%", slideshow:false});
    $(".group2").colorbox({rel:'group2', transition:"fade", height:"80%"}); 
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:420}); 
    $(".iframe").colorbox({iframe:true, width:"40%", height:"80%"}); 
    $(".inline").colorbox({inline:true, width:"80%", height:"80%",  trapFocus: true }); 
    $(".popupdelete").colorbox({inline:true, width:"50%", height:"50%",  trapFocus: true }); 
    });</script>
<script>//tables
$(document).ready(function(){ $('#myTable').DataTable({ "order": [[ 0, "desc" ]], "columnDefs": [ { "width":50, "targets": 0 } ], "iDisplayLength":25, responsive: true, ordering: false }); });
// Jquerie replace img
jQuery('img.svg').each(function(){ var $img = jQuery(this); var imgID = $img.attr('id'); var imgClass = $img.attr('class'); var imgURL = $img.attr('src'); jQuery.get(imgURL, function(data) { var $svg = jQuery(data).find('svg'); if(typeof imgID !== 'undefined') { $svg = $svg.attr('id', imgID); } if(typeof imgClass !== 'undefined') { $svg = $svg.attr('class', imgClass+' replaced-svg'); } $svg = $svg.removeAttr('xmlns:a'); $img.replaceWith($svg); jQuery('path').each(function() { jQuery(this).click(function() {alert(jQuery(this).attr('id'));}); }); }); });
//placeholder modernizer
$(document).ready(function(){if(!Modernizr.input.placeholder){$('[placeholder]').focus(function(){var input = $(this); if(input.val() == input.attr('placeholder')){input.val('');input.removeClass('placeholder'); }}).blur(function(){var input = $(this); if (input.val() == '' || input.val() == input.attr('placeholder')){input.addClass('placeholder');input.val(input.attr('placeholder'));}}).blur();$('[placeholder]').parents('form').submit(function(){$(this).find('[placeholder]').each(function(){var input = $(this);if (input.val() == input.attr('placeholder')){input.val('');}})});}});
  </script>

	

  <script type="text/javascript">
    
    function cambiar( id, bt ){

        //amarillo: background-color: #f1f1c1
        var cambio = ( $(bt).prop('checked') == true ) ? 1 : 0;

        //console.log( id+" -> "+$(".check_tabla:checked").length );
              
            //console.log( id+" -> "+$(".check_tabla:checked").length );
            $.ajax({
                async: false,
                dataType: 'html',
                data:  {
                  change_article_position: true,
                  id_blogs: id,
                  position: cambio
                },
                url:   'controller/c_article.php',
                type:  'post',
                beforeSend: function () {},
                success:  function (response) {
                    
                    if( parseInt(response) == 1 ){

                      //console.log( $(bt).parents('tr') );
                      if( cambio == 0 ){
                        $(bt).removeAttr('checked');
                        $(bt).parents('tr').css('background-color', '#ffffff');
                      }
                      else {
                        $(bt).attr('checked','checked');
                        $(bt).parents('tr').css('background-color', '#f1f1c1');
                      }/**/
                    }
                    else{
                      if( cambio == 0 ){
                        $(bt).attr('checked','checked');
                        $(bt).parents('tr').css('background-color', '#f1f1c1');
                      }
                      else {
                        $(bt).removeAttr('checked');
                        $(bt).parents('tr').css('background-color', '#ffffff');
                      }
                    }
                },
                error: function( msj, xhr, status ) {
                    console.log( msj+" - "+xhr );
                }
          });
    }
    
    function cambiar_status( id, bt ){

        //amarillo: background-color: #f1f1c1
        var cambio = ( $(bt).prop('checked') == true ) ? 1 : 3;

        //console.log( id+" -> "+$(".check_tabla:checked").length );
            //console.log( id+" -> "+$(".check_tabla:checked").length );
            $.ajax({
                async: false,
                dataType: 'html',
                data:  {
                  change_status: true,
                  id_blogs: id,
                  status: cambio
                },
                url:   'controller/c_article.php',
                type:  'post',
                beforeSend: function () {},
                success:  function (response) {
                    
                    if( parseInt(response) == 1 ){

                      //console.log( $(bt).parents('tr') );
                      if( cambio == 0 ){
                        $(bt).removeAttr('checked');
                      }
                      else {
                        $(bt).attr('checked','checked');
                      }/**/
                    }
                    else{
                      alert("Error al cambiar");
                        if( cambio == 0 ){
                        $(bt).removeAttr('checked');
                      }
                      else {
                        $(bt).attr('checked','checked');
                      }/**/
                    }
                },
                error: function( msj, xhr, status ) {
                    console.log( msj+" - "+xhr );
                }
          });
    }
    
    
    

    function checkSubmit() {
        document.getElementById("btsubmit").value = "Enviando...";
        document.getElementById("btsubmit").disabled = true;
        return true;
    }


$('.model_list').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "includes/ajax.php",
					data: 'operacion=MODEL&busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
        
        
        $('.make_list').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "includes/ajax.php",
					data: 'operacion=MAKE&busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });

$('.selectpicker').selectpicker({
  size: "10px"
});


	$('.article_list').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "includes/ajax.php",
					data: 'operacion=ARTICLES2&busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
        
        $( document ).ready(function() {
	   $('.form-control').attr("autocomplete", "off");
	});	
  
  </script>
</body>
</html>