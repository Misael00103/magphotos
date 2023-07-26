<?php 
//eso es todo
ini_set("display_errors", 0);
@session_start();

class Conectar
{   private $conex;
    private $conex2;
    public function con()
    {
        //aqui datos de la bd usuario clave y nombre de la bd
        $con=mysqli_connect("localhost","u422112289_magpho","Magphotos01.","u422112289_admindb"); 
        $this->conex=$con;
	mysqli_set_charset( $con, 'utf8');
        return $con;
		
    }
    public function con2()
    {

        return false;
        
    }
    public static function ruta()
    {
        // aqui la ruta o doiminio 
        // aqui luego de activar el ssl
        // cambiar el http por https
        return "https://magphotos.online/";

    }
    public function comillas_inteligentes($valor)
	{

		// Colocar comillas si no es entero
		if (!is_numeric($valor)) {
			$valor = "'" . mysqli_real_escape_string($this->conex,$valor) . "'";
		}
		return $valor;
	}

    public static function voltear_fecha($fecha)
    {
        $dia = $fecha[8]."".$fecha[9];
        $mes = $fecha[5]."".$fecha[6];
        $anio = $fecha[0]."".$fecha[1]."".$fecha[2]."".$fecha[3];
        $fecha_nueva = $dia."-".$mes."-".$anio;
                    
        return $fecha_nueva;
    }

    public static function voltear_fecha2($fecha)
    {
        $dia = $fecha[3]."".$fecha[4];
        $mes = $fecha[0]."".$fecha[1];
        $anio = $fecha[6]."".$fecha[7]."".$fecha[8]."".$fecha[9];
        $fecha_nueva = $anio."-".$mes."-".$dia;
                    
        return $fecha_nueva;
    }

    public static function send_mail($destino, $mensaje, $asunto)
    {
        //Titulo
        $titulo = $asunto;
        //cabecera
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        //dirección del remitente 
        $headers .= "From: Triangle Auto Recyclers <info@tarnc.com>\r\n";
        $headers .= "Reply-To: info@tarnc.com" . "\r\n";
        //Enviamos el mensaje a tu_dirección_email 
        $bool = mail($destino,$titulo,$mensaje,$headers);
        
        if($bool){
            //echo "<div style='height:8px; width:15px; position:relative; float:left; font-size:0.6em; background-color:#cafff3; border-bottom:1px #999 dashed; float:left;'>ok</div>";
        }else{
            //echo "<div style='height:8px; width:100%; font-size:0.8em; background-color:#ff6363; border-bottom:1px #999 dashed; color:#FFF; float:left;'>not sent = $destino</div>";
        
        return 0;
        }
    }

/*
|By Glairet Gonzalez, Kolormedia
|Parametros: 1) name del input file 2) tamaño maximo permitido 3) id de la ultima imagen registrada, para incrementarlo 
|               y asignarselo a la imagen subida, y así evitar que al subir un imagen con nombre existente se sobreescriba
|Desc: Permite subir imagenes de cualquier tipo al servidor
*/
public static function upload_image($slide_pic,$maxsize,$id,$directorio)
{

    $uploadedfileload="true";

    if (!($_FILES[$slide_pic]['type'] =="image/jpeg" or $_FILES[$slide_pic]['type'] =="image/gif" or $_FILES[$slide_pic]['type'] =="image/png" or $_FILES[$slide_pic]['type'] =="image/jpg")){$uploadedfileload="false";}

    $file_name = $id;
    $file_name = $file_name.'.'.substr($_FILES[$slide_pic]['type'],6,strlen($_FILES[$slide_pic]['type']));

    //Cuando se suben archivos desde paginas del directorio raíz
    if(substr($directorio,0,1) == "*")
    {   $plus="";   
$directorio = substr($directorio,1,strlen($directorio)); }
    else
    {   $plus=""; } 

    $add=trim($plus.$directorio."/".$file_name);
    
    if($uploadedfileload=="true")
    {
        
            if($_POST["base64"]!=''){
		$file_name='img_'.$id.'.png';
		$add=trim($plus.$directorio."/".$file_name);
		//echo "pasoooo".$_POST["base64"];
		$base64=$_POST["base64"];	
				
		$img = str_replace('data:image/png;base64,', '', $base64);
		$img = str_replace('data:image/jpg;base64,', '', $base64);
		$img = str_replace('data:image/jpeg;base64,', '', $base64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
        // definimos la ruta donde se guardara en el server
        $path= $name;
		
        // guardamos la imagen en el server
        if(!file_put_contents($add, $data)){
            // retorno si falla
			return 0;
        }
        else{
            // retorno si todo fue bien
            return $file_name;

        }
		
    
		}else{
		//	$maxsizedf=9000000;
			//ECHO $_FILES[$slide_pic]['size'] ; DIE();
        //if($_FILES[$slide_pic]['size'] < $maxsizedf)
        if(true)
        {   
            if(move_uploaded_file($_FILES[$slide_pic]['tmp_name'], $add))
            { 
                return $file_name;
            }
            else
            {
				//die();
                return 0; //ERROR AL SUBIR ARCHIVO
            }
        }
        else
        {
            return 1; // EL ARCHIVO EXCEDE EL TAMAÑO ESTABLECIDO
        }
		}
    }
    else
    {
        return 2; // EL TIPO DE ARCHIVO NO COINCIDE CON EL DE UNA IMAGEN
    }
}

public function maxid($tabla,$id)
{
    $query="select max(".$id.") as id from ".$tabla;
    $result = mysqli_query($this->conex,$query);
    $row=mysqli_fetch_array($result);

    return $row["id"];
}

public function date_30()
{
    $date = date('Y-m-d');
    $newdate = strtotime ( '+30 day' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m-d' , $newdate );

    return $newdate;
}

public function date_x($date, $days)
{
    $date = $date;
    $newdate = strtotime ( '+'.$days.' day' , strtotime ( $date ) ) ;
    $newdate = date ( 'Y-m-d' , $newdate );

    return $newdate;
}

}
?>