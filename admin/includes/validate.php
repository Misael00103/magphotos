<?php ob_start();
$page=$_SERVER['PHP_SELF'];

function busk($texto, $palabra){
    if (preg_match('*\b' . preg_quote($palabra) . '\b*i', $texto, $matches, PREG_OFFSET_CAPTURE)){
        return $matches[0][1];
    }
    return -1;  // -1 cuando no se encuentra
}


			if ($_SESSION["level"] ?? 0== 1 || $_SESSION["level"]?? 0 == 9) //admin y Editor
                    { 
			$ruta=Conectar::ruta()."admin/_home.php";

					}elseif($_SESSION["level"] ?? 0== 6 || $_SESSION["level"] ?? 0== 7) // web y providers
                    {
			$ruta=Conectar::ruta()."admin/whattodo.php";

					}elseif($_SESSION["level"] ?? 0== 8) // aproved
                    {
			$ruta=Conectar::ruta()."admin/menu_paiup.php";					

					}elseif($_SESSION["level"] ?? 0== 10) // seller
                    {
			$ruta=Conectar::ruta()."admin/_classifieds.php";					

					}
					
	

function validate_user(){
	
	if (isset($_SESSION['usuario_id'])){
	    header("Location:".Conectar::ruta()."home/portafolio/");
	}
}

function validate_user2(){
	
	if (!isset($_SESSION['usuario_id'])){
	    header("Location:".Conectar::ruta());
	}
}

function validate_user3(){
	
	if (isset($_SESSION['id'])){
	    header("Location:".Conectar::ruta()."admin/whattodo.php");
	}
}

function validate_user4(){
	
	if (!isset($_SESSION['usuario_id'])){
	    header("Location:".Conectar::ruta()."admin/");
	}
}

function urls_amigables($url) {

		// Tranformamos todo a minusculas
		$url = rtrim(strtolower($url));
		//Rememplazamos caracteres especiales latinos
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		// Añaadimos los guiones
		$find = array(' ', '&', '\r\n', '\n', '+');
		$url = str_replace ($find, '-', $url);
		// Eliminamos y Reemplazamos demás caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);
			return $url;
					}

 ob_end_flush();
 ?>