<?php

	include 'includes/config.php';
	session_destroy();
	header("Location: ".Conectar::ruta());
	exit();

?>