<?php
  include '../includes/config.php';
  include '../includes/usersModel.php';
  include '../includes/validate.php';
  include '../includes/allPanama.php';

$bl = new alldestinos;

if( isset($_POST['change_article_position']) ){

	$id = $_POST['id_blogs'];
	$position = $_POST['position'];

	$resp = $bl->change_article_position( $id, $position );

	echo $resp;
}elseif( isset($_POST['change_status']) ){
	
	$id = $_POST['id_blogs'];
	$status = $_POST['status'];

	$resp = $bl->change_article_status( $id, $status );

	echo $resp;
}elseif( isset($_POST['agregar']) ){
	
	$id = $_POST['id_blogs'] ?? 0;
	$resp = $bl->inser_foto( $id );

	echo $resp;
}