<?php
  include '../includes/config.php';
  include '../includes/usersModel.php';
  include '../includes/validate.php';
  include '../includes/allPanama.php';

$bl = new alldestinos;

if( isset($_POST['change_linebg_status']) ){

	$id = $_POST['id_linebg'];

	$resp = $bl->edit_status_linebg( $id );

	echo $resp;
}
else{}