<?php 
  include 'includes/config.php';
  include 'includes/usersModel.php';
  include 'includes/validate.php';

  validate_user2();
  
  $u = new usuarios;

  $users = $u->get_users();
  $groups = $u->get_groups();
  
  if (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $u->add_user();
    exit();
  }elseif( isset($_POST['editar']) && $_POST['editar'] == 'si'){
    $u->edit_person("_users");
    exit();
  }
  elseif( isset($_POST['recuperar']) && $_POST['recuperar'] == 'si'){
    $u->new_pass("_users");
    exit();
  }
  elseif (isset($_POST['eliminar']) && $_POST['eliminar'] == 'si') {
    $u->delete_user();
    exit();
  }
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
    <!-- Datepicker -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/colorbox.css" rel="stylesheet" type="text/css" />

<style></style>
<script>function myPrint() { window.print();}</script>
</head>
<body class="skin-red fixed">
        <div class="wrapper">
                  <?php include "includes/top-menu.php" ?>

    <div class="content-wrapper">

    <header>
            <?php include_once 'includes/menu.php'; ?>
    </header>

    <div class="row" id="mainticbg">
      <h5 style="text-align:right;"><a href="_gestion.php">← Back to management</a></h5> 
      <hr>
      <h3 style="text-align:center;">Users</h3>
    </div>

  <div class="row" style="padding:20px;">
    <div class="clear-right right btn_refresh">
      <a class="inline amininav" href="#addusers">
      <img src="images/cross.svg" alt="agregar" title="agregar" width="30"/></a>
           <a class="amininav" href="javascript: window.location.reload()"> 
      <img src="images/refresh.svg"  width="30" alt="refresh data" title="refresh data"/></a>
    </div>
    
        <table id="myTable"  class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>Image</th>
              <th>Email</th>
              <th>Name</th> 
              <th>Phone</th>
              <th>Group</th>
              <th>Edit</th>
              <th>Password</th>
              <th>Delete</th>
            </tr>
            </thead>
			<tbody>
        <?php
          for ($i=0; $i < count($users) ; $i++) { 
            //muestro solo los status activos
            if ($users[$i]['id_status']==1 && $users[$i]['id_group']<>6) {
        ?>
          <tr>
              <td><img src="images/people/<?php echo $users[$i]['person_img']; ?>" width="80" /></td> 
              <td><?php echo $users[$i]['person_email'];?></td>
              <td><?php echo $users[$i]['person_name'];?></td>
              <td><?php echo $users[$i]['person_phone'];?></td>
              <td><?php echo $users[$i]['name_group'];  ?></td>
              <td><a class="inline" href="#edit_user_form<?php echo $i; ?>">Edit</a></td>
              <td><a class="inline" href="#edit_password_form<?php echo $i; ?>">Change</a></td>
              <td><a class="inline" href="#delete_date<?php echo $i; ?>">Delete</a></td>  
          </tr>
        <?php  
          }
          }
        ?>
			</tbody>
		</table>

</div>
</div>
<?php include_once("includes/footer.php"); ?>
    </div>
<!--Agregar Usuario-->    
<div class="hide">
    <div id="addusers">
        <form id="newuser" class="formu" action="" method="post" enctype="multipart/form-data">
        	<h3>Add user</h3>


          <input class="form-control" type="text" name="person_name" id="person_namead" placeholder="Name and Surname"  required>
          <input class="form-control" type="text" name="person_email" id="person_emailas" placeholder="Email"  required>
          <input class="form-control" type="text" name="person_phone" id="person_phone" placeholder="Phone # (Whatsapp)"  required>
          <input class="form-control" type="text" name="person_social" id="person_social" placeholder="Social Network"  required>
          <input class="form-control" name="pass1" id="pass1ad" type="password" placeholder="Password" required />
          <input class="form-control" name="pass2" id="pass2ad" type="password" placeholder="Repeat password" required />
          <select class="form-control" name="person_type" required id="person_type">
            <option value="">Select type user...</option>
              <?php for ($j=0; $j < count($groups); $j++) { 
              ?>
                <option value=" <?php echo $groups[$j]['id_group'] ?> "><?php echo $groups[$j]['name_group'] ?></option>
              <?php 
              } ?>
          </select>
          <select class="form-control" name="person_check" required id="person_check">
            <option value="">Select status...</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
          <p style="color:red; text-align: left">(*) No require</p>
          <input class="form-control top_bottom" type="file" name="person_img" accept="image/*">
          <input type="hidden" name="person_img1" value="default.png">
          <input type="hidden" name="max_size" value="204801" />
          <input class="form-control" type="text" name="person_company" placeholder="Company">
          <input class="form-control" type="text" name="person_position" placeholder="Position">
          <textarea class="form-control" cols="3" rows="3" name="person_history" placeholder="Person history" style="resize: none; resize: vertical;"></textarea>

            <br><br>
            <input type="hidden" name="grabar" value="si">
            <input class="btn btn-primary" type="submit" name="enviar" value="Guardar" id="registerok">
            <div class="clear" style="height:20px;"></div>
        </form>
    </div>
</div>


<?php 
  for ($l=0; $l < count($users) ; $l++) {  
?>  
<div class="hide">
  <div class="editart" name="edit_user_form" id="edit_user_form<?php echo $l; ?>" style="padding:20px;">
    <form class="row" action="" method="post" enctype="multipart/form-data">
      <h2 style="color:#333;">Edit a person #<?php echo $users[$l]['id_person']; ?>:</h2>
      <label>Name:</label>
      <input class="form-control" type="text" name="person_name" value="<?php echo $users[$l]['person_name']; ?>"  required>
      <label>Email:</label>
      <input class="form-control" type="text" name="person_email" value="<?php echo $users[$l]['person_email']; ?>"  required>
      <label>Phone #:</label>
      <input class="form-control" type="text" name="person_phone" value="<?php echo $users[$l]['person_phone']; ?>"  required>
      <label>Company:</label>
      <input class="form-control" type="text" name="person_company" value="<?php echo $users[$l]['person_company']; ?>"  required>
      <label>Position:</label>
      <input class="form-control" type="text" name="person_position" value="<?php echo $users[$l]['person_position']; ?>"  required>
      <label>Social network:</label>
      <input class="form-control" type="text" name="person_social" value="<?php echo $users[$l]['person_social']; ?>"  required>
    
      <input class="form-control" type="hidden"  name="person_type" value="<?php echo $users[$l]['person_type']; ?>" >
      <label>Status:</label>
      <select class="form-control" name="person_check" disabled required>
        <option value="">Select status...</option>
        <option value="1" <?php if($users[$l]['person_check']==1)echo 'selected'; ?>>Active</option>
        <option value="0" <?php if($users[$l]['person_check']==0)echo 'selected'; ?>>Inactive</option>
      </select>      

      <label>History:</label>
      <textarea class="form-control" cols="3" rows="3" name="person_history"><?php echo $users[$l]['person_history']; ?></textarea>
      
      <label>Image:</label>
      <input class="form-control top_bottom" type="file" name="person_imgn" accept="image/*">
      <input type="hidden" name="max_size" value="204801" />
      <input type="hidden" name="person_img1" value="<?php echo $users[$l]['person_img']; ?>">

      <input type="hidden" name="editar" value="si"/>
      <input type="hidden" name="id_person" value="<?php echo $users[$l]['id_person']; ?>"/>
      <input class="btn btn-primary" type="submit" name="enviar" value="Editar"/>
      <div class="sep" style="margin-top:30px;"></div>
    </form>
  </div>
</div>
<?php 
}
?>

<!-- cambiar passw -->
<?php 
  for ($j=0; $j < count($users); $j++){ 
?>
    <div class="hide">
      <div  name="edit_password_form" id="edit_password_form<?php echo $j; ?>" style="padding:10px;">
          <form id="reserva" class="formu" action="" method="post" enctype="multipart/form-data">
                    <h1 class="titulo">Change Password</h1>
          <br>
          <!-- Input password actual 
            <label>Old Password:</label>-->
            <input type="hidden" class="form-control" id="pass0"  name="password_actual" placeholder="Old password" required /> <br> 
            <label>New Password:</label>          
            <input type="password" class="form-control" id="pass1"  name="password_new1" placeholder="New password" required /> <br>
            <label>New Password:</label>
            <input type="password" class="form-control" id="pass2"  name="password_new2" placeholder="Repeat password" required /> <br>
            <input type="hidden" name="recuperar" value="si">
            <input type="hidden" name="id" value="<?php echo $users[$j]['id_user']; ?>">
            <input class="btn btn-primary" type="submit" name="enviar" value="Cambiar">
        </form>
        </div>
    </div>
<?php  
  }
?>

        <?php 
      for ($j=0; $j < count($users) ; $j++) {  
    ?>  
    <div class="hide">
      <div class="editart popup_delete" id="delete_date<?php echo $j; ?>" style="padding:10px;">
        <h2 style="color:#333;text-align: center">Do you really want to delete the record?</h2>
                <form class="row" action="" method="post">
                    <input type="hidden" name="eliminar" value="si"/>
                    <input type="hidden" name="id_person" value="<?php echo $users[$j]['id_user']; ?>"/><br><br>
          <input class="btn btn-primary" type="submit" name="enviar" value="Yes" style=" margin-left: 100px;" /><br><br>
                    <input class="btn btn-primary" type="button" name="enviar" value="No" onclick="location.href='_people.php'" style=" margin-left: 100px;"/>
                </form>
      </div>
    </div>
    <?php 
    }
    ?>

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

	<script>$(document).ready(function(){$(".group1").colorbox({rel:'group1', transition:"fade", height:"80%", slideshow:false});$(".group2").colorbox({rel:'group2', transition:"fade", height:"80%"}); $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:420}); $(".iframe").colorbox({iframe:true, width:"40%", height:"80%"}); var mql = window.matchMedia("screen and (max-width:420px)") 
if (mql.matches){ $(".inline").colorbox({inline:true, width:"90%", height:"90%"}); } else{ $(".inline").colorbox({inline:true, width:"50%", height:"90%"}); } });</script>

<script>$(document).ready(function(){ $('#myTable').DataTable({ "order": [[ 0, "desc" ]], "iDisplayLength":50, responsive: true, scrollCollapse: true, "bLengthChange": false, "bAutoWidth": false , "sScrollX": "100%", "scrollX": true  }); });</script>

<script>

  $(document).on('click','#registerok',function(e) {

    if($("#person_namead").val()!="" && $("#person_emailad").val()!="" && $("#pass1ad").val()!="" && $("#pass2ad").val()!="")
    {
        if( $("#pass1ad").val() == $("#pass2ad").val() )
        { 
          $("#newuser").submit();
        }
        else
        {
          alert("Passwords do not match");
          $('#pass1ad').val('');
          $('#pass2ad').val('');
        }
    }
    else
    {
        alert("Empty fields");
		return false;
    }

  });
  
</script>
</body>
</html>