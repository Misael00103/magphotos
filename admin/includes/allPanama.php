<?php

class alldestinos extends Conectar
{
    private $firsteve;
    private $slider;
    private $linebg;
    private $calendar;
    private $thcalendar;
    private $blogs;
    private $item;
    private $magzs;
    private $magazine;
    private $peoples;
    private $classyf;
    private $country;
	private $services;
    private $conex;
    private $conex2;

    public function __construct()
    {
        $this->firsteve=array();
        $this->slider=array();
        $this->linebg=array();
        $this->calendar=array();
        $this->thcalendar=array();
        $this->blogs=array();
        $this->item=array();
        $this->magzs=array();
        $this->magazine=array();
        $this->peoples=array();
        $this->classyf=array();
        $this->country=array();
		$this->services=array();
        $this->conex=parent::con();
        $this->conex2=parent::con2();
    }

    public function __destruct()
    {
        $this->firsteve=array();
        $this->slider=array();
        $this->linebg=array();
        $this->calendar=array();
        $this->thcalendar=array();
        $this->blogs=array();
        $this->item=array();
        $this->magzs=array();
        $this->magazine=array();
        $this->peoples=array();
        $this->classyf=array();
		$this->services=array();
    }


function color_rand() {
	return sprintf('%06X', mt_rand(0, 0xFFFFFF));
	}

    ##############################################   SLIDER
	
	  //OK//Obtener todos los slides con status=1 (visibles) - status=2 (NOvisibles) - status=0 (eliminados)
    public function get_all_slider()
    {
        unset($this->slider);
        $sql="select * from slides where slide_status = 1 or slide_status = 2";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->slider[]=$reg;
        }
            return $this->slider;
        mysqli_free_result($reg);
    }
		
		public function get_all_subjects()
    {
        unset($this->subjects);
        $sql="SELECT `idsuj`, `namesub`, `id_status`, namesub_es FROM `subjects` WHERE `id_status`=1";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->subjects[]=$reg;
        }
            return $this->subjects;
        mysqli_free_result($reg);
    }

	  //OK//Obtener todos los slides con status=1 (visibles)
    public function get_slider()
    {
        unset($this->slider);
        $sql="select * from slides where slide_status = 1";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->slider[]=$reg;
        }
            if (!isset($this->slider))
            {
                return null;
            }
            else
            {
                return $this->slider;
            }
        mysqli_free_result($reg);
    }    
	public function get_banks()
    {
        unset($this->slider);
        $sql="SELECT `id_banks`, `descrip_banks`, `phone`, `direccion`, `id_status` FROM `banks` WHERE `id_status`=1";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->slider[]=$reg;
        }
            if (!isset($this->slider))
            {
                return null;
            }
            else
            {
                return $this->slider;
            }
        mysqli_free_result($reg);
    }
	
	public function get_user_id_group($id_user)
    {
        unset($this->users);
        $sql="SELECT `id_group` FROM `users` WHERE `id_user`=$id_user and id_status=1";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->users[]=$reg;
        }
            if (!isset($this->users))
            {
                return 0;
            }
            else
            {
                return $this->users[0]["id_group"];
            }
        mysqli_free_result($reg);
    }

     //OK//Agregar Slides
    public function add_slides()
    {
        $id = parent::maxid('slides','id_slide');
        $filename=parent::upload_image('slide_pic',$_POST["max_size"],($id+1),'../images/banner');

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {
                    if(isset($_POST["slide_status"]) and $_POST["slide_status"]=='on')
                    {$_POST["slide_status"]=1;}else{ $_POST["slide_status"]=2;}
                    $query=sprintf("insert into slides values (null, %s, %s, %s, %s, %s, %s, %s);",
                    parent::comillas_inteligentes( $_POST["slide_title"]),
                    parent::comillas_inteligentes( $filename),
                    parent::comillas_inteligentes( $_POST["slide_btvalue"]),
                    parent::comillas_inteligentes( $_POST["slide_link"]),
                    parent::comillas_inteligentes( $_POST["slide_status"]) ,
                    parent::comillas_inteligentes( $_POST["slide_btvalue_es"]) ,
                    parent::comillas_inteligentes( $_POST["slide_title_es"]) 
					);
					//echo $query;
                    mysqli_query($this->conex,$query);
                    echo "<script type='text/javascript'>
                        alert('The Slide was Created successfully');
                        window.location='_slider.php';
                    </script>";
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_slider.php';                         
                    </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_slider.php';                    
                </script>";
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_slider.php';
                </script>";
        }
    }

    //OK//Editar slides
    public function edit_slides()
    {    
      if(isset($_POST["slide_status"]) and $_POST["slide_status"]=='on')
      {$_POST["slide_status"]=1;}else{ $_POST["slide_status"]=2;}

      if($_FILES['slide_picn']['tmp_name'] =="")
        {
            $query=sprintf("update slides set 
            slide_tittle = %s,
            slide_btvalue = %s,
            slide_link = %s,
            slide_status = %s,
            slide_btvalue_es = %s,
            slide_title_es = %s
            where id_slide = %s;",
                parent::comillas_inteligentes( $_POST["slide_tittle"]),
                parent::comillas_inteligentes( $_POST["slide_btvalue"]),
                parent::comillas_inteligentes( $_POST["slide_link"]),
                parent::comillas_inteligentes( $_POST["slide_status"]), 
                parent::comillas_inteligentes( $_POST["slide_btvalue_es"]), 
                parent::comillas_inteligentes( $_POST["slide_title_es"]), 
                parent::comillas_inteligentes( $_POST["id_slide"]) );
            mysqli_query($this->conex,$query);
           echo "<script type='text/javascript'>
                alert('The Slide was Modified successfully');
                window.location='_slider.php';
            </script>";

        }
        else
        {
            $filename=parent::upload_image('slide_picn',$_POST["max_size"],($_POST["id_slide"]),'../images/banner');

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["slide_pic1"]){unlink('../images/banner/'.$_POST["slide_pic1"]);}
                        $query=sprintf("update slides set 
                        slide_tittle = %s,
                        slide_pic = %s,
                        slide_btvalue = %s,
                        slide_link = %s,
                        slide_status = %s
                        where id_slide = %s;",
                            parent::comillas_inteligentes( $_POST["slide_tittle"]),
                            parent::comillas_inteligentes($filename),
                            parent::comillas_inteligentes( $_POST["slide_btvalue"]),
                            parent::comillas_inteligentes( $_POST["slide_link"]),
                            parent::comillas_inteligentes( $_POST["slide_status"]),
                            parent::comillas_inteligentes( $_POST["id_slide"]) );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Slide was Modified successfully');
                            window.location='_slider.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_slider.php';                         
                        </script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_slider.php';                    
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_slider.php';
                    </script>";
            }
        }
      
    }




    //OK//Eliminar slides
    public function eli_slides()
    {     
        $query=sprintf("update slides set 
        slide_status = %s
        where id_slide = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_slide"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["slide_pic"])){unlink('../images/banner/'.$_POST["slide_pic"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_slider.php';
        </script>";
    }

public function get_subjects_name($name)
    {
        unset($this->services);
        $sql="SELECT `idsuj`, `namesub`, `namesub_es`, `id_status` FROM `subjects` 
        WHERE `id_status`=1 and (`namesub`='".$name."' or `namesub_es`='".$name."');";
        $res=mysqli_query($this->conex,$sql);
        //echo $sql;
        if($res){
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->services[]=$reg;
        }
            if (!isset($this->services))
            {
                return 0;
            }
            else
            {
                return $this->services;
            }
        mysqli_free_result($reg);
        }else{
            return false;
        }
    }
	

     //OK//Agregar un articulo ebay
    public function uf_addarticle_ebay($url='_home.php')
    {    
    if (isset($_POST['fila']) and intval($_POST['fila'])>0) {
        $cont=0;
        //print_r($_POST['fila']);
        
             
                    if($_POST['eliminar']){
                    $sql="DELETE FROM `blogs` WHERE `ItemID`>0 and `ItemID` is not null;";
                    mysqli_query($this->conex,$sql);
                    }
                    
            
        
        for ($i=1; $i <= intval($_POST['fila']); $i++) { 
        $id = parent::maxid('blogs','id_blogs');
        $id_status=1;
        $article_position=0;
        $ItemID=$_POST['ItemID'.$i];
        $article_title=$_POST['Title'.$i];
        $article_description=$_POST['Description'.$i];
        $article_seo=$_POST['PrimaryCategoryName'.$i];
        $GalleryURL=$_POST['GalleryURL'.$i];
        $PictureURL=$_POST['PictureURL'.$i];     
		$category=$_POST['category'.$i];
		$article_list=$_POST['SKU'.$i];
        $issueno=$_POST['CurrentPrice'.$i];
        $label=$_POST['label'.$i];
        $tidar=$_POST['tidar'.$i];
        $article_author='';
        $year='';
        $model='';
        $link=$_POST['ViewItemURLForNaturalSearch'.$i];
        $carpeta1="../home/portafolio/imagenes/";
        $carpeta2="../home/portafolio/imagenes/";
        $sugest=$this->get_subjects_name($label);
                if(count($sugest)>0 ){
                  $subjects=intval($sugest[0]["idsuj"]);  
                }else{
                    
                     $query=sprintf("INSERT INTO `subjects`(`idsuj`, `namesub`, `namesub_es`, `id_status`) 
                     VALUES (null, %s, %s, %s);", 
					parent::comillas_inteligentes( $label ),
                    parent::comillas_inteligentes( $label),  
                    parent::comillas_inteligentes(1) 
                    );
					//echo $query;
                    $q = mysqli_query($this->conex,$query);
                    $subjects = intval(mysqli_insert_id($this->conex));
                }
                
                if($tidar==1){
                    
                $imgGallery=explode("/",$GalleryURL);
                $filename=$imgGallery[count($imgGallery)-1];
                $destino1 =$carpeta1.$filename;
                $resp=  file_put_contents($destino1, file_get_contents($GalleryURL));
                
                
                    $query2=sprintf("insert into blogs(id_blogs, article_title, article_date, article_description, article_seo, 
					article_picture, article_author, article_category, article_position, article_status, article_seo_es,
					article_title_es, article_description_es, article_list, issueno, subjects, year, model, link, ItemID)
					values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', '', '', %s, %s, %s, %s, %s, %s, %s);", 
                    parent::comillas_inteligentes( $article_title),
                    parent::comillas_inteligentes( date( "Y-m-d h:i:s")), //strtotime() ) ), 
                    parent::comillas_inteligentes( $article_description),
                    parent::comillas_inteligentes( $article_seo),
                    parent::comillas_inteligentes( $filename ),
                    parent::comillas_inteligentes( $article_author),
					parent::comillas_inteligentes($category), // category
                    parent::comillas_inteligentes( $article_position ),
                    parent::comillas_inteligentes( $id_status ) ,// status
					parent::comillas_inteligentes( $article_list ),
                    parent::comillas_inteligentes( $issueno), // issueno
                    parent::comillas_inteligentes($subjects),
                    parent::comillas_inteligentes($year),
                    parent::comillas_inteligentes($model),
                    parent::comillas_inteligentes($link),
                    parent::comillas_inteligentes($ItemID)
                    );
                  //  echo "<code>".$query."</code>";
                    $resp = mysqli_query($this->conex,$query2);
                    $id_blogs = intval(mysqli_insert_id($this->conex));
                    if(!$resp) {
                        echo("Error description: " . mysqli_error($this->conex));
                    }else{
                        
                             for ($q=0; $q < count($PictureURL); $q++) {
                                 
                      $img=$PictureURL[$q];
                      //echo "-->".$img."<br>";
	
                    if(strrpos($img,'jpg')){
                    $filename2="img".$q."-".RAND(0,99).".jpg";    
                    }elseif(strrpos($img,'jpge')){
                    $filename2="img".$q."-".RAND(0,99).".jpge";    
                    }elseif(strrpos($img,'png')){
                    $filename2="img".$q."-".RAND(0,99).".png";    
                    }elseif(strrpos($img,'gif')){
                    $filename2="img".$q."-".RAND(0,99).".gif";    
                    }elseif(strrpos($img,'psd')){
                    $filename2="img".$q."-".RAND(0,99).".psd";    
                    }elseif(strrpos($img,'tiff')){
                    $filename2="img".$q."-".RAND(0,99).".tiff";    
                    }elseif(strrpos($img,'bmp')){
                    $filename2="img".$q."-".RAND(0,99).".bmp";    
                    }elseif(strrpos($img,'svg')){
                    $filename2="img".$q."-".RAND(0,99).".svg";    
                    }else{
                    $filename2="img".$q."-".RAND(0,99).".jpg";    
                    }

                      
                      $destino2 =$carpeta2.$filename2;
                      $name="img".intval($q+1);
                    $respfil=  file_put_contents($destino2, file_get_contents($img));
                  if($respfil){
                      $query=sprintf("insert into gallery(id_gallery, service_name, id_photo_gallery, description_s, photo, gallery_estatus) values (null, %s, %s, '', %s, %s);",
                    parent::comillas_inteligentes($name),
					parent::comillas_inteligentes( $id_blogs),
                    parent::comillas_inteligentes($filename2),
                    parent::comillas_inteligentes(1) 
					);
                    mysqli_query($this->conex,$query);
                  }
                    
                  }
                 // die();
	                 $cont++;
                    }
                }
            }
            
           // die($cont);
            if($cont>0){
                echo "<script type='text/javascript'>
	                        alert('The Article was succesfully saved');
	                        window.location='".$url."';
	                    </script>"; 
            }else{
                 echo "<script type='text/javascript'>
	                        alert('The Article was not saved');
	                        window.location='".$url."';
	                    </script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record'); 
                    window.location='".$url."';
                </script>";
        }
                

    }
    
 

    ##############################################   PROPERTIES PICTURES
	
	 public function get_all_pics_property($id_blogs=0)
    {
        unset($this->services);
        $sql="select * from gallery g, blogs as b
        where b.id_blogs=g.id_photo_gallery and b.id_blogs=".$id_blogs."
        and (gallery_estatus = 1 or gallery_estatus = 2) ";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->services[]=$reg;
        }
            return $this->services;
        mysqli_free_result($reg);
    }
	
  //OK//Agregar properties pictures
    public function add_pics_property()
    {
        $id = parent::maxid('gallery','id_gallery');
        $filename=parent::upload_image('photo',$_POST["max_size"],($id+1),'../home/portafolio/imagenes');
        $id_photo_gallery=intval($_POST["id_photo_gallery"]);

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {
                    if(isset($_POST["gallery_estatus"]) and $_POST["gallery_estatus"]=='on')
                    {$_POST["gallery_estatus"]=1;}else{ $_POST["gallery_estatus"]=2;}
                
                    $query=sprintf("insert into gallery(id_gallery, service_name, id_photo_gallery, description_s, photo, gallery_estatus) values (null, %s, %s, '', %s, %s);",
                    parent::comillas_inteligentes( $_POST["service_name"]),
					parent::comillas_inteligentes( $id_photo_gallery),
                    parent::comillas_inteligentes( $filename),
                    parent::comillas_inteligentes( $_POST["gallery_estatus"]) 
					);
                    mysqli_query($this->conex,$query);
                    echo "<script type='text/javascript'>
                        alert('The picture was Created successfully');
                        window.location='_pic_property.php?id=$id_photo_gallery';
                    </script>";
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_pic_property.php?id=$id_photo_gallery';                         
                    </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight');    
                    window.location='_pic_property.php?id=$id_photo_gallery';                    
                </script>";
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_pic_property.php';
                </script>";
        }
    }

    //OK//Editar properties pictures
    public function edit_pics_property()
    {    
      if(isset($_POST["gallery_estatus"]) and $_POST["gallery_estatus"]=='on')
      {$_POST["gallery_estatus"]=1;}else{ $_POST["gallery_estatus"]=2;}


     $id_photo_gallery=intval($_POST["id_photo_gallery"]);
                    
      if($_FILES['slide_picn']['tmp_name'] =="")
        {
            $query=sprintf("update gallery set 
            service_name = %s,
			id_photo_gallery = %s,
            gallery_estatus = %s
            where id_gallery = %s;",
                parent::comillas_inteligentes( $_POST["service_name"]),
				parent::comillas_inteligentes( $id_photo_gallery),
                parent::comillas_inteligentes( $_POST["gallery_estatus"]),  
                parent::comillas_inteligentes( $_POST["id_gallery"]) );
            mysqli_query($this->conex,$query);
           echo "<script type='text/javascript'>
                alert('The Slide was Modified successfully');
                window.location='_pic_property.php?id=$id_photo_gallery';
            </script>";

        }
        else
        {
            $filename=parent::upload_image('slide_picn',$_POST["max_size"],($_POST["id_gallery"]),'../home/portafolio/imagenes');

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["slide_pic1"]){unlink('../home/Pprtafolio/imagenes/'.$_POST["slide_pic1"]);}
                        $query=sprintf("update gallery set 
                        service_name = %s,
						id_photo_gallery = %s,
                        photo = %s,
                        gallery_estatus = %s
                        where id_gallery = %s;",
                            parent::comillas_inteligentes( $_POST["service_name"]),
							parent::comillas_inteligentes( $id_photo_gallery),
                            parent::comillas_inteligentes($filename),
                            parent::comillas_inteligentes( $_POST["gallery_estatus"]),
                            parent::comillas_inteligentes( $_POST["id_gallery"]) );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The picture was Modified successfully');
                            window.location='_pic_property.php?id=$id_photo_gallery';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_pic_property.php?id=$id_photo_gallery';                         
                        </script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight');    
                        window.location='_pic_property.php?id=$id_photo_gallery';                    
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_pic_property.php?id=$id_photo_gallery';
                    </script>";
            }
        }
      
    }




    //OK//Eliminar properties pictures
    public function eli_pics_property()
    {     
    
    $id_photo_gallery=intval($_POST["id_photo_gallery"]);
        $query=sprintf("update gallery set 
        gallery_estatus = %s
        where id_gallery = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_gallery"]) );
       // echo    $query; die();
        mysqli_query($this->conex,$query);
        //if(isset($_POST["slide_pic"])){unlink('../images/banner/'.$_POST["slide_pic"]);}
        echo "<script type='text/javascript'>
            alert('The picture was successfully Deleted');
            window.location='_pic_property.php?id=$id_photo_gallery';
        </script>";
    }
	
	

	##############################################   CALENDARIO

	//OK//Obtener la fecha del calendario que se mostrara en el slider del index
    //Muestra la ultima registrada y una establecida por el usurio, en caso de que no haya ninguna establecida se muestran las ultimas 2 registradas 
    //status=1 (ACTIVAS)- status=5 (SI HOMEPAGE) - status=5 (establecido por el usuario) - status=0 (eliminados)
    public function get_firstevent()
    {
        unset($this->firsteve);
		$dias = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
		$campo=$dias[date("w")];
	   
	   $sql="select (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN 'NO EXISTE' ELSE 'EXISTE' END) AS CAMP, id_calendar, title, c_url, date_start, date_end, hora_f, c_img, calendar_status, hora_i, NOW() as fecha_actual from calendar where calendar_status= 1  
AND id_calendar = (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN id_calendar ELSE (SELECT id_calendar FROM `hor_event` 
WHERE `id_status`=1 and $campo='1' and `id_calendar`=calendar.id_calendar LIMIT 1) END) order by id_calendar desc limit 2;";
//echo $sql;die();
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->firsteve[]=$reg;
        }
            if (!isset($this->firsteve))
            {
                return null;
            }
            else
            {
                return $this->firsteve;
            }
        mysqli_free_result($res);
    }
	
	
	public function get_firstevent_new()
    {
        unset($this->firsteve);
		$dias = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
		$campo=$dias[date("w")];
		$fechaact=date('Y-m-d');
	   
	   $sql="select (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN 'NO EXISTE' ELSE 'EXISTE' END) AS CAMP, id_calendar, title, c_url, date_start, date_end, hora_f, c_img, calendar_status, hora_i, NOW() as fecha_actual from calendar where calendar_status= 1  
AND id_calendar = (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN id_calendar ELSE (SELECT id_calendar FROM `hor_event` 
WHERE `id_status`=1 and $campo='1' and `id_calendar`=calendar.id_calendar LIMIT 1) END) 
and date_start<='".$fechaact."'
and date_end>='".$fechaact."' order by date_start asc, date_end asc, id_calendar desc limit 2;";
//echo $sql;die();


        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->firsteve[]=$reg;
        }
            if (!isset($this->firsteve))
            {
                return null;
            }
            else
            {
                return $this->firsteve;
            }
        mysqli_free_result($res);
    }


	//OK//Obtener todas las fechas del calendario con status=1 (ACTIVAS) - status=5 (establecido por el usuario) - status=0 (eliminados)
    public function get_calendar()
    {
        unset($this->calendar);

        $sql="select * from calendar where calendar_status= 1 or calendar_status= 5";
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }
	
	public function get_calendar_limit($limit=50)
    {
        unset($this->calendar);

        $sql="select * from calendar where calendar_status= 1 or calendar_status= 5
		order by id_calendar desc limit ".$limit;
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }
	
	public function get_calendar_rangofecha($desde, $hasta)
    {
        unset($this->calendar);

        $sql="select * from calendar where 
				 date_start>='".$desde."' and date_start<='".$hasta."'
			and
		(calendar_status= 1 or calendar_status= 5)
		order by id_calendar desc";
		//echo  $sql;
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }
	

    public function get_my_calendar()
    {
        unset($this->calendar);

        $sql="select * from calendar where id_user_plan = '".$_SESSION['usuario_id']."'";
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }

    public function get_calendar_disapproved()
    {
        //unset($this->calendar);

        $sql="select * from calendar where calendar_status = 2";
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }    
	
	public function get_plans_disapproved()
    {
        //unset($this->calendar);

        $sql="SELECT (SELECT p.`person_name` FROM `people` AS p, users as u WHERE p.`id_person`=u.`id_person` and u.`id_user`=pa.id_user) as user,descrip_banks, `idpayment`, `referencia`, `monto`, `banco`, `fecha`, `iddocument`, `tipo`, `id_user`, pa.`id_status`, tipdocument, id_plan
		FROM `payment` as pa , banks as b WHERE pa.`id_status`=1
		and b.id_banks=pa.banco";
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->calendar[]=$reg;
            }
            
            return $this->calendar;    
        }
        else
        {
            return null;  
        }

        mysqli_free_result($reg);

    }

	//ok//Obtener todas las fechas del calendario deL MES ACTUAL 
    public function get_calendar_tmonth()
    {
        unset($this->thcalendar);
		$fecha = date('Y-m-d');
		$nuevafecha = strtotime ( '+30 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		$dias = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");
		$campo=$dias[date("w")];
	   
	   
		$sql = "select * from calendar where date_start <='".$nuevafecha."'
		and date_end>='".$fecha."'
 AND id_calendar = (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN id_calendar ELSE (SELECT id_calendar FROM `hor_event` 
WHERE `id_status`=1 and $campo='1' and `id_calendar`=calendar.id_calendar LIMIT 1) END) ; ";
		//ECHO $sql;//die();
        $res=mysqli_query($this->conex,$sql);
        if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->thcalendar[]=$reg;
            }
            return $this->thcalendar;
        }
        else
        {
            return null;  
        }
        mysqli_free_result($res);
    }

	//ok//Obtener una fecha del calendario por id
	public function get_calendar_by_id($id)
	{        
		unset($this->calendar);
		//parent::con();
		$sql=sprintf("select *, (CASE (SELECT count(`idhors`) FROM `hor_event` WHERE `id_status`=1 and `id_calendar`=calendar.id_calendar) 
WHEN 0 THEN 'NO' ELSE 'SI' END) AS existe from calendar where id_calendar = %s;",parent::comillas_inteligentes($id));
		$res=mysqli_query($this->conex,$sql);

		while ($reg=mysqli_fetch_assoc($res))
		{
			$this->calendar[]=$reg;
		}
			return $this->calendar;
		mysqli_free_result($res);
	}

    //Agregar fechas al Calendario
    public function add_dates()
    {
        $id = parent::maxid('calendar','id_calendar');
        $filename=parent::upload_image('c_img',$_POST["max_size"],($id+1),'images/events');

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {
                    if(isset($_POST["status"]) and $_POST["status"]=='on')
                    {$_POST["status"]=5;}else{ $_POST["status"]=1;}
                    if(isset($_POST["repeat"]) and $_POST["repeat"]=='on')
                    {$_POST["repeat"]=1;}else{ $_POST["repeat"]=0;}
                    $query=sprintf("insert into calendar (id_calendar, repetir, title, c_url, date_start, date_end, c_desc, c_img, calendar_status, hora_i, hora_f, color, title_es, c_desc_es, id_user_plan)
					values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', '', '');",
                    parent::comillas_inteligentes( $_POST["repeat"]),
                    parent::comillas_inteligentes( $_POST["title"]),
                    parent::comillas_inteligentes( $_POST["c_url"]),
                    parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                    parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                    parent::comillas_inteligentes( trim($_POST["c_desc"])),
                    parent::comillas_inteligentes( $filename),
                    parent::comillas_inteligentes( $_POST["status"]),
                    parent::comillas_inteligentes( $_POST["horai"].":00" ),
                    parent::comillas_inteligentes( $_POST["horaf"].":00" ),  
                    parent::comillas_inteligentes( $_POST["color"] )
                    );

                    mysqli_query($this->conex,$query);
					$this->send_mail_level(8, 2);
                    echo "<script type='text/javascript'>
                        alert('The Calendar was succesfully saved');
                        window.location='_home.php';
                    </script>";
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_home.php';                       
                    </script>";  
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_home.php';                 
                </script>";
            }   

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_home.php';
                </script>";
        }
    }

    public function add_dates_2()
    {
        $id = parent::maxid('calendar','id_calendar');
        $filename=parent::upload_image('c_img',$_POST["max_size"],($id+1),'../images/events');

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {
                    if(isset($_POST["repeat"]) and $_POST["repeat"]=='on')
                    {$_POST["repeat"]=1;}else{ $_POST["repeat"]=0;}
                    $query=sprintf("insert into calendar values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', '',%s);",
                    parent::comillas_inteligentes( $_POST["repeat"]),
                    parent::comillas_inteligentes( $_POST["title"]),
                    parent::comillas_inteligentes( $_POST["c_url"]),
                    parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                    parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                    parent::comillas_inteligentes( trim($_POST["c_desc"])),
                    parent::comillas_inteligentes( $filename),
                    parent::comillas_inteligentes( 2 ),
                    parent::comillas_inteligentes( $_POST["horai"].":00" ),
                    parent::comillas_inteligentes( $_POST["horaf"].":00" ),  
                    parent::comillas_inteligentes( $_POST["color"] ),
                    parent::comillas_inteligentes( $_SESSION["usuario_id"] )
                    );

                    mysqli_query($this->conex,$query);
					
					$this->send_mail_level(8, 2);

                    echo "<script type='text/javascript'>
                        alert('The Event was succesfully saved');
                        window.location='_events.php';
                    </script>";
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_events.php';                       
                    </script>";  
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_events.php';                 
                </script>";
            }   

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_events.php';
                </script>";
        }
    }

    //Editar fechas del Calendario

    public function edit_dates()
    {    
        if(isset($_POST["status"]) and $_POST["status"]=='on')
        {$_POST["status"]=5;}else{ $_POST["status"]=1;}
        if(isset($_POST["repeat"]) and $_POST["repeat"]=='on')
        {$_POST["repeat"]=1;}else{ $_POST["repeat"]=0;}

        if($_FILES['c_imgn']['tmp_name'] =="")
        {
            $query=sprintf("update calendar set 
            repetir = %s,
            title = %s,
            c_url = %s,
            date_start = %s,
            date_end = %s,
            c_desc = %s,
            calendar_status = %s,
            hora_i = %s,
            hora_f = %s,
            color = %s
            where id_calendar = %s;",
                parent::comillas_inteligentes( $_POST["repeat"]),
                parent::comillas_inteligentes( $_POST["title"]),
                parent::comillas_inteligentes( $_POST["c_url"]),
                parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                parent::comillas_inteligentes( trim($_POST["c_desc"])),
                parent::comillas_inteligentes( $_POST["status"]),
                parent::comillas_inteligentes( $_POST["horai"] ),
                parent::comillas_inteligentes( $_POST["horaf"] ),
                parent::comillas_inteligentes( $_POST["color"] ),
                parent::comillas_inteligentes( $_POST['id_calendar']) );

            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
            alert('The Calendar was Modified successfully');
            window.location='_home.php';    
            </script>"; 

        }
        else
        {
            $filename=parent::upload_image('c_imgn',$_POST["max_size"],($_POST['id_calendar']),'../images/events');

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["c_img1"]){unlink('../images/events/'.$_POST["c_img1"]);}
                        $query=sprintf("update calendar set 
                        repetir = %s,
                        title = %s,
                        c_url = %s,
                        date_start = %s,
                        date_end = %s,
                        c_desc = %s,
                        c_img = %s,
                        calendar_status = %s,
                        color = %s
                        where id_calendar = %s;",
                            parent::comillas_inteligentes( $_POST["repeat"]),
                            parent::comillas_inteligentes( $_POST["title"]),
                            parent::comillas_inteligentes( $_POST["c_url"]),
                            parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                            parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                            parent::comillas_inteligentes( trim($_POST["c_desc"])),
                            parent::comillas_inteligentes( $filename),
                            parent::comillas_inteligentes( $_POST["status"]),
                            parent::comillas_inteligentes( $_POST["color"] ),
                            parent::comillas_inteligentes( $_POST['id_calendar']) );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Calendar was Modified successfully');
                            window.location='_home.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_home.php';                    
                        </script>";     
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_home.php';                   
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_home.php';
                    </script>"; 
            }
        }
    }
	
	
	    public function edit_calendar_es()
    {    
        
            $query=sprintf("update calendar set 
            title_es = %s,
            c_desc_es = %s
            where id_calendar = %s;",
                parent::comillas_inteligentes( $_POST["title"]),
                parent::comillas_inteligentes( trim($_POST["c_desc"])),
                parent::comillas_inteligentes( $_POST['id_calendar']) );
				//echo  $query; die();

            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
            alert('The Calendar was Modified successfully');
            window.location='_home.php';    
            </script>"; 

       
    }

    public function edit_dates_2()
    {    
        if(isset($_POST["repeat"]) and $_POST["repeat"]=='on')
        {$_POST["repeat"]=1;}else{ $_POST["repeat"]=0;}

        if($_FILES['c_imgn']['tmp_name'] =="")
        {
            $query=sprintf("update calendar set 
            repetir = %s,
            title = %s,
            c_url = %s,
            date_start = %s,
            date_end = %s,
            c_desc = %s,
            hora_i = %s,
            hora_f = %s,
            color = %s
            where id_calendar = %s;",
                parent::comillas_inteligentes( $_POST["repeat"]),
                parent::comillas_inteligentes( $_POST["title"]),
                parent::comillas_inteligentes( $_POST["c_url"]),
                parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                parent::comillas_inteligentes( trim($_POST["c_desc"])),
                parent::comillas_inteligentes( $_POST["horai"] ),
                parent::comillas_inteligentes( $_POST["horaf"] ),
                parent::comillas_inteligentes( $_POST["color"] ),
                parent::comillas_inteligentes( $_POST['id_calendar']) );

            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
            alert('The Event was Modified successfully');
            window.location='_events.php';    
            </script>"; 

        }
        else
        {
            $filename=parent::upload_image('c_imgn',$_POST["max_size"],($_POST['id_calendar']),'images/events');

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["c_img1"]){unlink('../images/events/'.$_POST["c_img1"]);}
                        $query=sprintf("update calendar set 
                        repetir = %s,
                        title = %s,
                        c_url = %s,
                        date_start = %s,
                        date_end = %s,
                        c_desc = %s,
                        c_img = %s,
                        color = %s
                        where id_calendar = %s;",
                            parent::comillas_inteligentes( $_POST["repeat"]),
                            parent::comillas_inteligentes( $_POST["title"]),
                            parent::comillas_inteligentes( $_POST["c_url"]),
                            parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["start"]))), 
                            parent::comillas_inteligentes(date("Y-m-d", strtotime($_POST["end"]))),
                            parent::comillas_inteligentes( trim($_POST["c_desc"])),
                            parent::comillas_inteligentes( $filename),
                            parent::comillas_inteligentes( $_POST["color"] ),
                            parent::comillas_inteligentes( $_POST['id_calendar']) );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Event was Modified successfully');
                            window.location='_events.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_events.php';                    
                        </script>";     
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_events.php';                   
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_events.php';
                    </script>"; 
            }
        }
    }

    
    public function approve_dates($status)
    {     
	
	$des="";
	   if($status==1){
	   	   $des="Approved";

	   }elseif($status==4){
	   	   $des="Disapproved";

	   }else{
	   $status=1;
	   $des="Approved";
	   }
	   
       // parent::con();
        $query=sprintf("update calendar set 
        calendar_status = %s
        where id_calendar = %s;",
        $status,
        parent::comillas_inteligentes( $_POST["id_calendar"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["c_img"])){unlink('../images/events/'.$_POST["c_img"]);}
        echo "<script type='text/javascript'>
            alert('The Event was successfully $des');
            window.location='_approve_events.php';
        </script>";
    }
	
	public function approve_plans($status)
    {     
	
	$des="";
	   if($status==3){
	   	   $des="Approved";

	   }elseif($status==4){
	   	   $des="Disapproved";

	   }else{
	   $status=3;
	   $des="Approved";
	   }
	   
		
        $query=sprintf("update payment set 
            id_status = %s
            where idpayment = %s;",
                parent::comillas_inteligentes($status), 
                parent::comillas_inteligentes( $_POST['idpayment']) );
            
            mysqli_query($this->conex,$query);
			
		if($_POST["tipdocument"]==1 && $status==3){
		//clsificados
		$this->push_republish($_POST["id_user"],$_POST["monto"],$_POST["referencia"],$_POST["iddocument"]);
		}
		
		if($_POST["tipdocument"]==2 && $status==3){
		//sponsor
		$this->push_publish($_POST["id_user"],$_POST["monto"],$_POST["referencia"],$_POST["iddocument"],$_POST["id_plan"]);
		}
		
		if($_POST["tipdocument"]==3 && $status==3){
		//Plans
		$this->push_changeplan($_POST["id_user"],$_POST["id_plan"],$_POST["monto"],$_POST["referencia"]);
		}
		
        echo "<script type='text/javascript'>
            alert('The Payment was successfully $des');
            window.location='_approve_plans.php';
        </script>";
    }

    public function eli_dates()
    {     
       // parent::con();
        $query=sprintf("update calendar set 
        calendar_status = %s
        where id_calendar = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_calendar"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["c_img"])){unlink('../images/events/'.$_POST["c_img"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_home.php';
        </script>";
    }

    public function eli_dates_2()
    {     
       // parent::con();
        $query=sprintf("update calendar set 
        calendar_status = %s
        where id_calendar = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_calendar"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["c_img"])){unlink('../images/events/'.$_POST["c_img"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_events.php';
        </script>";
    }

	########################################################################## BLOGS

	//OK//Obtener todo de la tabla blogs
    public function get_blog_articles()
    {

        unset($this->blogs);
        $sql="select * from blogs where article_status=1 ORDER BY id_blogs DESC";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
	//OK//Obtener todo de la tabla blogs cat
    public function get_blog_articles_cat($id=0, $article_status=1)
    {

        unset($this->blogs);
		$where ="";
			if($id>0){
				$where .=" and article_category='".$id."' ";
			}
        $sql="select * from blogs where article_status=".$article_status."
		".$where."
		ORDER BY id_blogs DESC";
//echo $sql;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
	//OK//Obtener todo de la tabla blogs subjects
    public function get_blog_articles_subjects($id=0)
    {

        unset($this->blogs);
        $sql="select * from blogs where article_status=1
and subjects='".$id."'		ORDER BY id_blogs DESC";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
	//OK//Obtener todo de la tabla blogs subjects
    public function get_blog_articles_subjectscat($id=0, $cat, $article_status=1, $article_position=1)
    {
		$where="";
			if($cat){
			$where .=" and article_category='".$cat."'";
			}
			
			if($id){
			$where .=" and subjects='".$id."'";
			}
			
			if($article_position>=0){
			$where .=" and article_position='".$article_position."'";
			}
			
        unset($this->blogs);
        $sql="select * from blogs as b left join  subjects as s 
        on b.subjects=s.idsuj
        where  article_status in (".$article_status.")
		".$where."	ORDER BY id_blogs DESC";
		
        $res=mysqli_query($this->conex,$sql);
		
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
    
	public function get_blog_artlimit($id=0, $cat, $article_status=1, $article_position=1, $limit=50)
    {
		$where="";
			if($cat){
			$where .=" and article_category='".$cat."'";
			}
			
			if($id){
			$where .=" and subjects='".$id."'";
			}
			
			if($article_position>=0){
			$where .=" and article_position='".$article_position."'";
			}
			
        unset($this->blogs);
        $sql="select * from blogs as b left join  subjects as s 
        on b.subjects=s.idsuj
        where  article_status in (".$article_status.")
		".$where."	ORDER BY RAND(article_title) DESC Limit ".$limit;
		
        $res=mysqli_query($this->conex,$sql);
		//echo   "-->".$sql;
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
    //OK//Obtener todo de la tabla blogs subjects
    public function get_blog_article_filtrar($cat, $search, $year, $marca, $model, $preciomin, $preciomax, $limit=50)
    {
		$where="";
			if($cat){
			$where .=" and article_category='".$cat."'";
			}
			if($search){
			$where .=" and article_title like '%".$search."%'";
			}
            if($year){
			$where .=" and year like '%".$year."%'";
			}
			
			if($marca){
			$where .=" and article_author like '%".$marca."%'";
			}
			
			if($model){
			$where .=" and model like '%".$model."%'";
			}
			
			if($preciomin>0){
			$where .=" and issueno >= ".$preciomin;
			}
			
			if($preciomax>0){
			$where .=" and issueno<= ".$preciomax;
			}
			
			
        unset($this->blogs);
        $sql="select * from blogs as b left join  subjects as s 
        on b.subjects=s.idsuj
        where  article_status=1
		".$where."	ORDER BY  RAND(article_title) DESC Limit ".$limit;
				//echo   "-->".$sql;

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
    
     public function ejecutar($query)
    {            

                   $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                      $smss= strval(mysqli_error($this->conex));

						echo '<script type="text/javascript">
	                        alert("Error description: '.$smss.'");
	                    </script>';
                    }else{
	                    echo "<script type='text/javascript'>
	                        alert('Ejecutado');
	                    </script>";
                    }
               

    }
    
	public function get_blog_articles_limit($limit=50, $article_status=1)
    {

        unset($this->blogs);
        $sql="select * from blogs where article_status in(".$article_status.") ORDER BY id_blogs DESC Limit ".$limit;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
	public function get_blog_rangofecha($desde='', $hasta='', $article_status=1, $article_title='')
    {
		
		$where='';
        if($desde!=''){
         $where .=" and date(article_date)>='".$desde."' ";   
        } 
        
        if($hasta!=''){
         $where .=" and date(article_date)<='".$hasta."'  ";   
        }
        
        unset($this->blogs);
        $sql="select * from blogs where article_status in (".$article_status.")
 ".$where."
and article_title like '%".$article_title."%'
ORDER BY id_blogs DESC";
//echo   $sql;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            if (!isset($this->blogs))
            {
                return null;
            }
            else
            {
                return $this->blogs;
            }
        mysqli_free_result($reg);      
    }
	
	
	//OK//Obtener todo de la tabla blogs de los viejos
    public function get_blog_old_articles()
    {
        unset($this->blogs);
        $sql="select * from blogs where article_status=1 AND article_date=2012 ORDER BY id_blogs DESC";
        $res=mysqli_query($this->conex2,$sql);		
		if(mysqli_num_rows($res)>0)
        {
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->blogs[]=$reg;
            }
            
            return $this->blogs;    
        }
        else
        {
            return null;  
        }
			
			
        mysqli_free_result($reg);      
    }

    ///////////////////////////////////// SIGUIENTES DOS FUNCIONES EN DESUSO, EN CAMBIO SE UTILIZA get_blogs
    //ok//Obtener todo de la tabla blogs
    // public function get_blog_4()
    // {

    //     unset($this->blogs);
    //     $sql="( select * from blogs where article_status=1 and article_position = 1 ORDER BY id_blogs DESC LIMIT 4) UNION ( select * from blogs where article_status=1 and article_position = 0 ORDER BY id_blogs DESC limit 4 )";
    //     $res=mysqli_query($this->conex,$sql);
    //     while ($reg=mysqli_fetch_assoc($res))
    //     {
    //         $this->blogs[]=$reg;
    //     }
    //         if (!isset($this->blogs))
    //         {
    //             return null;
    //         }
    //         else
    //         {
    //             return $this->blogs;
    //         }
    //     mysqli_free_result($reg);      
    // }

    //ok//Obtener todo de la tabla blogs
    // public function get_last_blog_6()
    // {

    //     unset($this->blogs);
    //     $sql="( select * from blogs where article_status=1 ORDER BY id_blogs DESC LIMIT 6) UNION ( select * from blogs where article_status=1 and article_position = 0 ORDER BY id_blogs DESC limit 6 )";
    //     $res=mysqli_query($this->conex,$sql);
    //     while ($reg=mysqli_fetch_assoc($res))
    //     {
    //         $this->blogs[]=$reg;
    //     }
    //         if (!isset($this->blogs))
    //         {
    //             return null;
    //         }
    //         else
    //         {
    //             return $this->blogs;
    //         }
    //     mysqli_free_result($reg);      
    // }

    // obtener blogs deseados
    //primer campo el limited de lo que traera
    //estatus, sin son los seleccionados al home 1 y si son los ultimos agregados 0
    public function get_blogs($limited, $status)
    {

$sql="select * from blogs where article_status=1 and article_position ='".$status."' 
ORDER BY id_blogs DESC LIMIT ".$limited.";";

        unset($this->blogs);
        /*if ($status){
            $sql="( select * from blogs where article_status=1 and article_position = 1 ORDER BY id_blogs DESC LIMIT 4) UNION ( select * from blogs where article_status=1 and article_position = 0 ORDER BY id_blogs DESC limit 4 )";
        } else {
            $sql="( select * from blogs where article_status=1 and article_position = 1 ORDER BY id_blogs DESC LIMIT 6) 
			UNION ( select * from blogs where article_status=1 and article_position = 0 ORDER BY id_blogs DESC limit 6 )";
        }*/

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
        if (!isset($this->blogs))
        {
            return null;
        }
        else
        {
            return $this->blogs;
        }
        mysqli_free_result($reg);      
   }

 public function get_blogs_status($limited, $article_position, $article_status=1)
    {

$sql="select * from blogs where article_status=".$article_status." and article_position ='".$article_position."' 
ORDER BY id_blogs DESC LIMIT ".$limited.";";
//ECHO $sql;

        unset($this->blogs);

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
        if (!isset($this->blogs))
        {
            return null;
        }
        else
        {
            return $this->blogs;
        }
        mysqli_free_result($reg);      
   }


	//OK//Obtener los articulos del index
    public function get_imp_articles()

    {

        unset($this->blogs);
        $sql="select * from blogs where article_status=1 and article_position = 1";

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            return $this->blogs;  

        mysqli_free_result($reg);      

    }

    public function get_my_articles()
    {

        unset($this->blogs);
        $sql="select * from blogs where id_user_plan = '".$_SESSION["usuario_id"]."'";

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
            return $this->blogs;  

        mysqli_free_result($reg);      

    }

    public function get_articles_disapproved()
    {

        //unset($this->blogs);
        $sql="select * from blogs where article_status = 2";

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->blogs[]=$reg;
        }
        
        return $this->blogs;  

        mysqli_free_result($reg);      

    }

	public function send_mail_level($level, $tipo)
    {
		$u = new usuarios;
        $personas = $u->get_user_mail_by_level($level);
		
		//print_r($personas);

        if (!empty($personas)) 
        {
		$desti="";
			if($tipo==1){ $desti="Article";}
			if($tipo==2){ $desti="Event";}
			if($tipo==3){ $desti="Classified";}
			if($tipo==4){ $desti="Advertise";}
					
            $asunto  = " Creacion de $desti | The Visitor";
            $mensaje =  "We inform you that a new $desti has been successfully created on our website.";
			for ($i=0; $i < count($personas) ; $i++) {
			 $destino=$personas[$i]["person_email"];
            conectar::send_mail($destino, $mensaje, $asunto);
			}

        }
		}
		
		public function send_email()
    {
	
	$destino=$_POST["destino"];
	$email=$_POST["email"];
	$name=$_POST["name"];
	$phone=$_POST["phone"];
	$descrip=$_POST["descrip"];
	$asunto=$_POST["asunto"];
	$number=$_POST["number"];
	$mensaje="Comentario desde Clasificados de https://thevisitorpanama.com el producto ".$_POST["asunto"].", por ".$name.", numero de contacto	".$phone.", email ".$email.", descripcion: ".$descrip;
    conectar::send_mail($destino, $mensaje, $asunto);
	
		
	}
		
	//OK//Agregar un articulo
    public function add_article($url='_home.php')
    {    
        $id = parent::maxid('blogs','id_blogs');
        $filename=parent::upload_image('article_picture',$_POST["max_size"],($id+1),'../home/portafolio/imagenes');
        $id_status=$_POST["article_status"];
        if($id_status!=1){
            $id_status=3;
        }
        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {   if(isset($_POST["article_position"]) and $_POST["article_position"]=='on')
                    {$_POST["article_position"]=1;}else{ $_POST["article_position"]=0;}
					
                    $query=sprintf("insert into blogs(id_blogs, article_title, article_date, article_description, article_seo, 
					article_picture, article_author, article_category, article_position, article_status, article_seo_es,
					article_title_es, article_description_es, article_list, issueno, subjects)
					values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', '', '', %s, %s, %s);", 
                    parent::comillas_inteligentes( $_POST["article_title"]),
                    parent::comillas_inteligentes( $_POST["article_date"]." ".date( "h:i:s")), //strtotime() ) ), 
                    parent::comillas_inteligentes( $_POST["article_description"]),
                    parent::comillas_inteligentes( $_POST["article_seo"]),
                    parent::comillas_inteligentes( $filename ),
                    parent::comillas_inteligentes( $_POST["article_author"]),
					parent::comillas_inteligentes($_POST["category"]), // category
                    parent::comillas_inteligentes( $_POST["article_position"] ),
                    parent::comillas_inteligentes( $id_status ) ,// status
					parent::comillas_inteligentes( $_POST["article_list"] ),
                    parent::comillas_inteligentes( $_POST["issueno"]), // issueno
                    parent::comillas_inteligentes($_POST["subjects"]),
                    parent::comillas_inteligentes($_POST["year"]),
                    parent::comillas_inteligentes($_POST["model"]),
                    parent::comillas_inteligentes($_POST["link"])
                    );
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description: " . mysqli_error($this->conex));
                    }else{
						$this->send_mail_level(8, 1);
	                    echo "<script type='text/javascript'>
	                        alert('The Article was succesfully saved');
	                        window.location='".$url."';
	                    </script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='".$url."';                         
                    </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='".$url."';                    
                </script>";
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='".$url."';
                </script>";
        }


    }
 
	public function add_articlerelations($url='_articles_relation.php')
    {    
                    $article_title=$_POST["article_title"];
                    $id_blogs=$_POST["id_blogs"];
                    $obser=$_POST["obser"];
                    if($_FILES['article_picture']['tmp_name']!='')
                    {                  
                    $id = parent::maxid('relations_article','id_relat');
                    $filename=parent::upload_image('article_picture',$_POST["max_size"],$id_blogs."relat".($id+1),'../home/portafolio/imagenes');
                    }else{
                    $filename='';    
                    }
                    
                    $query=sprintf("INSERT INTO `relations_article`
                    (`id_relat`, `id_art`, `nombrerelac`, `descriprelac`, `fotorelac`, `id_status`)
					VALUES (null, %s, %s, %s, %s, %s);", 
					parent::comillas_inteligentes( $id_blogs ),
                    parent::comillas_inteligentes( $article_title), 
                    parent::comillas_inteligentes( $obser), 
                    parent::comillas_inteligentes( $filename), 
                    parent::comillas_inteligentes(1) 
                    );
					
                    $q = mysqli_query($this->conex,$query);
			
						
                    if(!$q) {
echo "<script type='text/javascript'>
	                        alert('The Retlations Article was error saved');
	                        window.location='".$url."?id=".$_POST["id_blogs"]."';
	                    </script>";
						}else{
	                    echo "<script type='text/javascript'>
	                        alert('The Retlations Article was succesfully saved');
	                        window.location='".$url."?id=".$_POST["id_blogs"]."';
	                    </script>";
                    }

    }
	public function edit_articlerelations($url='_articles_relation.php')
    {    
                    $article_title=$_POST["article_title"];
                    $id_blogs=$_POST["id_blogs"];
                    $obser=$_POST["obser"];
                    $id =$_POST["id_relat"];
                    $update="";
                    if($_FILES['article_picture']['tmp_name']!='')
                    {                  
                    $filename=parent::upload_image('article_picture',$_POST["max_size"],$id_blogs."relat".$id,'../home/portafolio/imagenes');
                    }else{
                    $filename='';    
                    }
                        if($filename!=''){
                     $update=", fotorelac='".$filename."' "; 
                        }
                    
                    
                    $query=sprintf("UPDATE  `relations_article`
                    Set `nombrerelac` =%s, `descriprelac`=%s ".$update."
                    where `id_relat`=%s and  `id_art`=%s;", 
                    parent::comillas_inteligentes( $article_title), 
                    parent::comillas_inteligentes( $obser), 
                    parent::comillas_inteligentes( $id), 
                    parent::comillas_inteligentes( $id_blogs ) 
                    );
					//echo $query; die();
                    $q = mysqli_query($this->conex,$query);
			
						
                    if(!$q) {
echo "<script type='text/javascript'>
	                        alert('The Retlations Article was error saved');
	                        window.location='".$url."?id=".$_POST["id_blogs"]."';
	                    </script>";
						}else{
	                    echo "<script type='text/javascript'>
	                        alert('The Retlations Article was succesfully saved');
	                        window.location='".$url."?id=".$_POST["id_blogs"]."';
	                    </script>";
                    }

    }

    public function add_article_2()
    {    
        $id = parent::maxid('blogs','id_blogs');
        $filename=parent::upload_image('article_picture',$_POST["max_size"],($id+1),'../home/portafolio/imagenes');
        $id_user = $_SESSION["usuario_id"];

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {   
                    $query=sprintf("insert into blogs values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', '', '', %s, '0');", 
                    parent::comillas_inteligentes( $_POST["article_title"]),
                    parent::comillas_inteligentes( $_POST["article_date"]." ".date( "h:i:s")), //strtotime() ) ), 
                    parent::comillas_inteligentes( $_POST["article_description"]),
                    parent::comillas_inteligentes( $_POST["article_seo"]),
                    parent::comillas_inteligentes( $filename ),
                    parent::comillas_inteligentes( $_POST["article_author"]),
                    parent::comillas_inteligentes( 0 ), // category
                    parent::comillas_inteligentes( 0 ),
                    parent::comillas_inteligentes( 2 ), // status
                    parent::comillas_inteligentes( $id_user )
                    );
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description: " . mysqli_error($this->conex));
                    }else{
						$this->send_mail_level(8, 1);
                        echo "<script type='text/javascript'>
                            alert('The Article was succesfully saved');
                            window.location='_articles.php';
                        </script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_articles.php';                         
                    </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_articles.php';                    
                </script>";
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_articles.php';
                </script>";
        }


    }

	
	//ok//Editar un Articulo
    public function edit_article($url='_home.php')
    {    
        if(isset($_POST["article_position"]) and $_POST["article_position"]=='on')
        {$_POST["article_position"]=1;}else{ $_POST["article_position"]=0;}
        $id_status=$_POST["article_status"];
        if($id_status!=1){
            $id_status=3;
        }

        if($_FILES['article_picturen']['tmp_name'] =="")
        {
            
            $query=sprintf("update blogs set 
            article_title = %s,
            article_date = %s,
            article_description = %s,
            article_seo = %s,
            article_author = %s,
            article_category = %s,
            article_position = %s,
			article_list = %s,
			subjects = %s,
            issueno = %s,
			article_status = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes( $_POST["article_title"]),
                parent::comillas_inteligentes( $_POST["article_date"]),
                parent::comillas_inteligentes( $_POST["article_descriptione"] ),
                parent::comillas_inteligentes( trim($_POST["article_seo"])),
                parent::comillas_inteligentes( $_POST["article_author"]),
                parent::comillas_inteligentes( $_POST["article_category"] ),
                parent::comillas_inteligentes( $_POST["article_position"]),
				parent::comillas_inteligentes( $_POST["article_list"]),
                parent::comillas_inteligentes( $_POST["subjects"]),
                parent::comillas_inteligentes( $_POST["issueno"]),
                parent::comillas_inteligentes($id_status),
                parent::comillas_inteligentes( $_POST['id_blogs']) );
                //echo $query;
            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
                alert('The Article was Modified successfully');
                window.location='".$url."';
            </script>";
        }
        else
        {
            $filename=parent::upload_image('article_picturen',$_POST["max_size"],($_POST['id_blogs']),'../home/portafolio/imagenes');

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["article_picture1"]){unlink('../home/portafolio/imagenes/'.$_POST["article_picture1"]);}
                        $query=sprintf("update blogs set 
                        article_title = %s,
                        article_date = %s,
                        article_description = %s,
                        article_seo = %s,
                        article_picture = %s,
                        article_author = %s,
                        article_category = %s,
						article_position = %s,
						article_list = %s,
						subjects = %s,
						issueno = %s,
						article_status = %s
                        where id_blogs = %s;",
                            parent::comillas_inteligentes( $_POST["article_title"]),
                            parent::comillas_inteligentes( $_POST["article_date"]),
                            parent::comillas_inteligentes( $_POST["article_descriptione"] ),
                            parent::comillas_inteligentes( trim($_POST["article_seo"])),
                            parent::comillas_inteligentes( $filename),
                            parent::comillas_inteligentes( $_POST["article_author"]),
                            parent::comillas_inteligentes( $_POST["article_category"]  ),
                            parent::comillas_inteligentes( $_POST["article_position"]),
							parent::comillas_inteligentes( $_POST["article_list"]),
							parent::comillas_inteligentes( $_POST["subjects"]),
							parent::comillas_inteligentes( $_POST["issueno"]),

							parent::comillas_inteligentes($id_status),
                            parent::comillas_inteligentes( $_POST['id_blogs']) );
                        mysqli_query($this->conex,$query);

                        echo "<script type='text/javascript'>
                            alert('The Article was Modified successfully');
                            window.location='".$url."';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='".$url."';                    
                        </script>";     
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='".$url."';                   
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='".$url."';
                    </script>"; 
            }
        }

    }
	
	
	//ok//Editar un Articulo
    public function edit_article_es($url='_home.php')
    {    
      
            $query=sprintf("update blogs set 
            article_title_es = %s,
            article_description_es = %s,
            article_seo_es = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes( $_POST["article_title"]),
                parent::comillas_inteligentes( $_POST["article_descriptione"] ),
                parent::comillas_inteligentes( trim($_POST["article_seo"])),
                parent::comillas_inteligentes( $_POST['id_blogs']) );
            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
                alert('The Article was Modified successfully');
                window.location='".$url."';
            </script>";


    }
	
	
	//obtener las fotos de los las propiedades por id
	public function get_gallery_project_by_id($id)
    {
        unset($this->services);
        $sql="select * from gallery as g, blogs as pr where pr.id_blogs = g.id_photo_gallery and pr.id_blogs=".$id.";";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->services[]=$reg;
        }
            if (!isset($this->services))
            {
                return 0;
            }
            else
            {
                return $this->services;
            }
        mysqli_free_result($reg);
    }
	

    public function edit_article_2()
    {  
        if($_FILES['article_picturen']['tmp_name'] =="")
        {
            $query=sprintf("update blogs set 
            article_title = %s,
            article_date = %s,
            article_description = %s,
            article_seo = %s,
            article_author = %s,
            article_category = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes( $_POST["article_title"]),
                parent::comillas_inteligentes( $_POST["article_date"]),
                parent::comillas_inteligentes( $_POST["article_descriptione"] ),
                parent::comillas_inteligentes( trim($_POST["article_seo"])),
                parent::comillas_inteligentes( $_POST["article_author"]),
                parent::comillas_inteligentes( 0 ), 
                parent::comillas_inteligentes( $_POST['id_blogs']) );
            mysqli_query($this->conex,$query);

            echo "<script type='text/javascript'>
                alert('The Article was Modified successfully');
                window.location='_articles.php';
            </script>";
        }
        else
        {
            $filename=parent::upload_image('article_picturen',$_POST["max_size"],($_POST['id_blogs']),'../home/portafolio/imagenes');
            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0')
                    {   
                        if($filename != $_POST["article_picture1"]){unlink('../home/portafolio/imagenes/'.$_POST["article_picture1"]);}
                        $query=sprintf("update blogs set 
                        article_title = %s,
                        article_date = %s,
                        article_description = %s,
                        article_seo = %s,
                        article_picture = %s,
                        article_author = %s,
                        article_category = %s,
                        article_position = %s
                        where id_blogs = %s;",
                            parent::comillas_inteligentes( $_POST["article_title"]),
                            parent::comillas_inteligentes( $_POST["article_date"]),
                            parent::comillas_inteligentes( $_POST["article_descriptione"] ),
                            parent::comillas_inteligentes( trim($_POST["article_seo"])),
                            parent::comillas_inteligentes( $filename),
                            parent::comillas_inteligentes( $_POST["article_author"]),
                            parent::comillas_inteligentes( 0 ),
                            parent::comillas_inteligentes( $_POST["article_position"]),
                            parent::comillas_inteligentes( $_POST['id_blogs']) );
                        mysqli_query($this->conex,$query);

                        echo "<script type='text/javascript'>
                            alert('The Article was Modified successfully');
                            window.location='_articles.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_articles.php';                    
                        </script>";     
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_articles.php';                   
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_articles.php';
                    </script>"; 
            }
        }

    }

    public function approve_article($status)
    {  
	
	 $des="";
	   if($status==1){
	   	   $des="Approved";

	   }elseif($status==4){
	   	   $des="Disapproved";

	   }else{
	   $status=1;
	   $des="Approved";
	   }
	   
        $query=sprintf("update blogs set 
            article_status = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes($status), 
                parent::comillas_inteligentes( $_POST['id_blogs']) );
            
            mysqli_query($this->conex,$query);

            echo "<script type='text/javascript'>
                alert('The Article was successfully  $des');
                window.location='_approve_articles.php';
            </script>";
    }

    public function change_article_position( $id_blogs, $cambio )
    {    
        $query=sprintf("update blogs set 
            article_position = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes( $cambio),
                parent::comillas_inteligentes( $id_blogs) );
            $resp = mysqli_query($this->conex,$query);

            if( $resp ){
                return 1;
            } 
            else{
                return 0;
            }
    }
        public function change_article_status( $id_blogs, $cambio )
    {    
        $query=sprintf("update blogs set 
            article_status = %s
            where id_blogs = %s;",
                parent::comillas_inteligentes( $cambio),
                parent::comillas_inteligentes( $id_blogs) );
            $resp = mysqli_query($this->conex,$query);

            if( $resp ){
                return 1;
            } 
            else{
                return 0;
            }
    }
 

 public function inser_foto( $id_blogs )
    {    
        $query=sprintf("INSERT INTO `foto_usuario`(`idmov`, `idblog`, `id_user`, `id_status`) VALUES (null,%s,%s,%s) ;",
                parent::comillas_inteligentes( $id_blogs),
                parent::comillas_inteligentes( $_SESSION["usuario_id"]),
                parent::comillas_inteligentes( 1) );
            $resp = mysqli_query($this->conex,$query);

            if( $resp ){
                return 1;
            } 
            else{
                return 0;
            }
    }

	
	
	public function get_articles_by_id($id)
    {        
        unset($this->item);
        $sql=sprintf("select * from blogs where article_status<>0 and id_blogs =%s;",parent::comillas_inteligentes($id));
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }
	
	public function get_blog_articles_relation($id, $id_art)
    {        
        unset($this->item);
        
        $where="";
        if($id){
          $where .='and id_relat='.$id;  
        } 
        
        if($id_art){
          $where .='and  r.id_art ='.$id_art;  
        }
        
        $sql=sprintf("select * from blogs as b
		inner join relations_article as r
		on r.id_art=b.id_blogs
		where article_status<>0 and r.id_status=1
		".$where."
		");
        $res=mysqli_query($this->conex,$sql);
	//	echo $sql;
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }
	
	    public function get_all_comentario_article($id_article)
    {
        unset($this->slider);
        $sql="SELECT `id`, `name`, `comment`, `id_article`, `fecha_coment` FROM `comments`
		WHERE `id_article`=".$id_article." order by fecha_coment, id_article;";
		//echo $sql;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->slider[]=$reg;
        }
            return $this->slider;
        mysqli_free_result($reg);
    }
		
		
	
		public function get_articles_by_relacion($id, $precio, $article_category, $subjects, $article_status=1)
    {        
        unset($this->item);
        $sql=sprintf("SELECT `id_blogs`, `article_title`, `article_date`, `article_description`, `article_seo`, 
		`article_picture`, `article_author`, `article_category`, `article_position`, `article_status`, `article_seo_es`, 
		`article_title_es`, `article_description_es`, `article_list`, `issueno`, `subjects` 
		FROM `blogs` WHERE article_status=".$article_status." and  `id_blogs`<>%s and `issueno`<=%s
and `article_category`=%s and `subjects`=%s order by issueno desc;"
,parent::comillas_inteligentes($id)
,parent::comillas_inteligentes($precio)
,parent::comillas_inteligentes($article_category)
,parent::comillas_inteligentes($subjects)
);
//echo $sql;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }


    //Obtener un articulo por su id VIEJA BD
    public function get_articles_by_idO($id)
    {        
        unset($this->item);
        $sql=sprintf("select * from blogs where  article_status<>0 and id_blogs =%s;",parent::comillas_inteligentes($id));
        $res=mysqli_query($this->conex2,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }   
    //OK
	
	
    public function eli_article($url='_blog.php')
    {     
        $query=sprintf("update blogs set 
        article_status = %s
        where id_blogs = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_blogs"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["article_picture"])){unlink('../home/portafolio/imagenes/'.$_POST["article_picture"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='".$url."';
        </script>";

    }	
	
	public function eli_articlerelations($url='_articles_relation.php')
    {     
        $query=sprintf("update relations_article set 
        id_status = %s
        where id_relat = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_relat"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["article_picture"])){unlink('../home/portafolio/imagenes/'.$_POST["article_picture"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='".$url."?id=".$_POST["id_art"]."';
        </script>";

    }	

     public function eli_article_2()
    {     
        $query=sprintf("update blogs set 
        article_status = %s
        where id_blogs = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_blogs"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["article_picture"])){unlink('../home/portafolio/imagenes/'.$_POST["article_picture"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_articles.php';
        </script>";

    }   

    public function select_keywords($words) // verifica si existe la palabra o frase
    {
        $query = "SELECT id_key from keywords where keyword='".$words."'";

        $response = mysqli_query($this->conex,$query);

        if ( mysqli_num_rows($response) > 0 )
            return mysqli_fetch_array($response)[0]; 
        else
            return NULL;
    }

    public function save_keywords($words) // sino existe guarda la palabra, en caso contrario suma la cantidad de veces que se ha buscado
    {
        $r = alldestinos::select_keywords($words);
        
        if ( $r > 0 )
        {
            $query = "UPDATE keywords set veces_busqueda = (veces_busqueda+1) where id_key=".$r;
        }    
        else
        {
            $query = "INSERT INTO keywords VALUES (NULL , '".$words."' , 1 )";
        }

        mysqli_query( $this->conex , $query );
    }
    //Obtener un articulo por cualquier palabra que coincida TODO LO NUEVO
    public function get_blog_articlesX($id, $limit=0)
    {        
        unset($this->item);

        $words_search = explode(" ", mysqli_real_escape_string($this->conex,$id));

        $columns = ['article_title','article_seo', 'article_description', 'DATE_FORMAT(article_date, "%Y-%m-%d")', 'article_author', 'article_seo_es', 'article_title_es', 'article_description_es'];
        $query = "";
					

        alldestinos::save_keywords($id);

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.="CAST(".$column." AS char) LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }
        $limitar="";
        if(intval($limit)>0){
             $limitar=" LIMIT ".$limit;
        }
        $sql="select * from blogs where article_status IN (1, 3) ".$query." ORDER BY id_blogs DESC ".$limitar.";";
		///	ECHO $sql; DIE();
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    } 
	public function get_blog_articlesX_cat($id, $cat, $article_status=1)
    {        
        unset($this->item);

        $words_search = explode(" ", mysqli_real_escape_string($this->conex,$id));

        $columns = ['article_title','article_seo', 'article_description', 'DATE_FORMAT(article_date, "%Y-%m-%d")', 'article_author', 'article_seo_es', 'article_title_es', 'article_description_es'];
        $query = "";
					

        alldestinos::save_keywords($id);

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.="CAST(".$column." AS char) LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }
        
        $sql="select * from blogs where article_status=".$article_status." and article_category='".$cat."'	 ".$query." ORDER BY id_blogs DESC";
		///	ECHO $sql; DIE();
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }
    //Obtener un articulo por cualquier palabra que coincida TODO LO VIEJO
    public function get_blog_articlesXY($id)
    {        
        unset($this->item);

        $words_search = explode(" ", mysqli_real_escape_string($this->conex,$id));

        $columns = ['article_title','article_seo', 'article_description'];
        $query = "";

        alldestinos::save_keywords($id);

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.=$column." LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }
        
        $sql="select * from blogs where article_status=1 ".$query." ORDER BY id_blogs DESC";

        $res=mysqli_query($this->conex2,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
            
        mysqli_free_result($res);

    }    
    //Obtener ediciones que coincidan con el año enviado TODO LO NUEVO
    public function get_news_year($year)
    {
        unset($this->magzs);
        
        $sql="select * from blogs where article_status=1 and  YEAR(article_date)=".$year;

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }
    
    public function get_medel($model)
    {
        unset($this->magzs);
        
        $sql="SELECT DISTINCT `model` 
        FROM `blogs` WHERE `model`<>'' 
        and model like '%".$model."%' GROUP BY `model` limit 10";
//echo $sql;
        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    } 
    
    public function get_article_author($article_author)
    {
        unset($this->magzs);
        
        $sql="SELECT DISTINCT `article_author` 
        FROM `blogs` WHERE `article_author`<>'' 
        and article_author like '%".$article_author."%' GROUP BY `article_author`
limit 10        ";
//echo $sql;
        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }
    //Obtener ediciones que coincidan con el año enviado TODO LO VIEJO
    public function get_news_yearx($year)
    {
        unset($this->magzs);
        
        $sql="select * from blogs where article_status=1 and YEAR(article_date)=".$year;

        $res=mysqli_query($this->conex2,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }


########################################################################### flipbook

    //ok//Obtener todo de la tabla blogs
#    public function get_all_magz()
#    {
#        unset($this->magzs);
        //parent::con();
#        $sql="select * from mags where mags_status=1 ORDER BY years DESC , months DESC;";
		
#        $res=mysqli_query($this->conex,$sql);
#        while ($reg=mysqli_fetch_assoc($res))
#        {
 #           $this->magzs[]=$reg;
#        }
#            if (!isset($this->magzs))
#            {
#                return null;
#            }
##            else
#            {
#                return $this->magzs;
#            }  
#        mysqli_free_result($reg);      
#    }

//ok//Obtener todo de la tabla mags
#    public function get_last_magz()
#    {
#	$currentm = date("m");
#	$currenty = date("Y");
#        unset($this->magzs);
#        //parent::con();
#        $sql="SELECT * FROM mags WHERE mags_status=1 AND months= {$currentm} AND years = {$currenty}
#		order by mags_id desc";
#        $res=mysqli_query($this->conex,$sql);
#        while ($reg=mysqli_fetch_assoc($res))
#        {
#            $this->magzs[]=$reg;
#        }
#            if (!isset($this->magzs))
#            {
#                return null;
#            }
#            else
#            {
#                return $this->magzs;
#            }  
#        mysqli_free_result($reg);      
#    }
	
#	 public function get_last_magz_new($limit)
#    {
#	$currentm = date("m");
#	$currenty = date("Y");
#	$fecha=date('Y-m-d');
#        unset($this->magzs);
        //parent::con();
#        $sql="SELECT * FROM mags WHERE mags_status=1 and
#		fechaini<='".$fecha."' and  fechafin>='".$fecha."' order by issueno desc limit $limit";
#        $res=mysqli_query($this->conex,$sql);
		//echo $sql;die();
#        while ($reg=mysqli_fetch_assoc($res))
#        {
#            $this->magzs[]=$reg;
#        }
#            if (!isset($this->magzs))
#            {
#                return null;
#            }
#            else
#            {
#                return $this->magzs;
#            }  
#        mysqli_free_result($reg);      
#    }
	
	
	
#	public function get_last_magz_ini($limit)
#    {
#	$currentm = date("m");
#	$currenty = date("Y");
#	$fecha=date('Y-m-d');
#        unset($this->magzs);
        //parent::con();
#        $sql="SELECT * FROM mags WHERE mags_status=1 and
#		fechaini<='".$fecha."' order by issueno desc limit $limit";
#        $res=mysqli_query($this->conex,$sql);
		//echo $sql;die();
#        while ($reg=mysqli_fetch_assoc($res))
#        {
#            $this->magzs[]=$reg;
#        }
#            if (!isset($this->magzs))
#            {
#                return null;
#            }
#            else
#            {
#                return $this->magzs;
#            }  
#			
#        mysqli_free_result($reg);      
 #   }

//ok//Obtener todo de la tabla get_last_magz_months_years
    public function get_last_mags_by_months_years($months, $years)
    {
	$currentm = $months;
	$currenty = $years;
        unset($this->magzs);
        //parent::con();
        $sql="SELECT * FROM mags WHERE mags_status=1 AND months= {$currentm} AND years = {$currenty}";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
		$sql="SELECT * FROM mags WHERE mags_status=1 AND months= {$currentm} AND years = {$currenty}";
        $res=mysqli_query($this->conex2,$sql); 
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
				
				if (!isset($this->magzs))
            {
                return null;
				
            }
            else
            {
                return $this->magzs;
            }  
				
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }

	
	//ok//Obtener todo de la tabla get_last_magz_months_years
    public function get_last_mags_by_months_years_new($months, $years, $issueno)
    {
	$currentm = $months;
	$currenty = $years;
	$cissueno = $issueno;
        unset($this->magzs);
        //parent::con();
        $sql="SELECT * FROM mags WHERE mags_status=1 AND issueno= {$cissueno} AND months= {$currentm} AND years = {$currenty}";
        $res=mysqli_query($this->conex,$sql);
		//echo  $sql;
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
		$sql="SELECT * FROM mags WHERE mags_status=1 AND issueno= {$cissueno} AND months= {$currentm} AND years = {$currenty}";
        $res=mysqli_query($this->conex2,$sql); 
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
				
				if (!isset($this->magzs))
            {
                return null;
				
            }
            else
            {
                return $this->magzs;
            }  
				
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }

//Obtener todo de la tabla blogs
    public function get_magz_by_id($id)
    {
        unset($this->magzs);
        //parent::con();
        $sql="select * from mags where mags_status=1 and mags_id=".$id;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }

    //Obtener un articulo por cualquier palabra que coincida TODO LO NUEVO
    public function get_all_magzX($id)
    {        
        unset($this->item);

        $words_search = explode(" ", trim($id));

        $columns = ['months','years', 'issueno','coverclient','copies'];
        $query = "";

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.=$column." LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }
        
        $sql="select * from mags where mags_status=1 ".$query." ORDER BY years DESC , months DESC";

        // EDICIONES DEL AÑO ACTUAL
        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
        mysqli_free_result($res);    
    }

    //Obtener un articulo por cualquier palabra que coincida EDICIONES PASADAS
    public function get_all_magzXY($id)
    {        
        unset($this->item);

        $words_search = explode(" ", trim($id));

        $columns = ['months','years', 'issueno','coverclient','copies'];
        $query = "";

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.=$column." LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }
        
        $sql="select * from mags where mags_status=1 ".$query." ORDER BY years DESC , months DESC";
     
        // EDICIONES PASADAS
        $res=mysqli_query($this->conex2,$sql); 
        
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
        if (!isset($this->item))
        {
            return null;
        }
        else
        {
            return $this->item;
        }
        mysqli_free_result($res);    
    }


    //Obtener ediciones que coincidan con el año enviado TODO LO NUEVO
    public function get_all_magzY($year)
    {
        unset($this->magzs);
        
        $sql="select * from mags where mags_status=1 and years=".$year." ORDER BY years DESC , months DESC";

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }
    //Obtener ediciones que coincidan con el año enviado  EDICIONES PASADAS
    public function get_all_magzYX($year)
    {
        unset($this->magzs);
        
        $sql="select * from mags where mags_status=1 and years=".$year." ORDER BY years DESC , months DESC";

        $res=mysqli_query($this->conex2,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->magzs[]=$reg;
        }
            if (!isset($this->magzs))
            {
                return null;
            }
            else
            {
                return $this->magzs;
            }  
        mysqli_free_result($reg);      
    }

    //Agregar la revista actual
    public function add_mags()
    {          
        $id = parent::maxid('mags','mags_id');
        $fileyear = strval($_POST["years"]);
        $filemonth = strval($_POST["months"]);
        $fileid = strval($id+1);
        $fn = "id-".$fileyear."-".$filemonth;
	if(!file_exists($root . "mag_past/covers/" . $fileyear)){
		//mkdir($root . "mag_past/covers/" . $fileyear);
		$filename=parent::upload_image('coverimg',$_POST["max_size"],($id+1).$fn,'mag_past/covers/'.$fileyear);
	} else {
		$filename=parent::upload_image('coverimg',$_POST["max_size"],($id+1).$fn,'mag_past/covers/'.$fileyear);
	}

        if ($filename != 2)
        {            
            if ($filename != 1)
            {
                if ($filename != 0)
                {
                    
                    $mag_url = "visitor{$_POST['issueno']}-{$_POST['months']}";
                    $name = md5(microtime(true)).'.pdf';
                    //move_uploaded_file($_FILES["coverpdf"]['tmp_name'], "../mag_past/past/".$name );
                    $query=sprintf("insert into mags (`mags_id`, `months`, `years`, `issueno`, `coverclient`, `coverimg`, `copies`, `mags_status`, `name_pdf`, `mag_url`, `coverclient_es`, `fechaini`, `fechafin`) 
					values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, '', %s, %s);",
                    parent::comillas_inteligentes( $_POST["months"]),
                    parent::comillas_inteligentes( $_POST["years"]),
                    parent::comillas_inteligentes( $_POST["issueno"]),
                    parent::comillas_inteligentes( $_POST["coverclient"]),
                    parent::comillas_inteligentes( $filename ),
                    parent::comillas_inteligentes( $_POST["editionurl"]),
                    1,
                    parent::comillas_inteligentes( $_POST["check"]),
                    parent::comillas_inteligentes($mag_url),
					parent::comillas_inteligentes( $_POST["fechaini"]),
					parent::comillas_inteligentes( $_POST["fechafin"])
                    );
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description: " . mysqli_error($this->conex));
                    }else{
	                    echo "<script type='text/javascript'>
	                        alert('The Past Edition was succesfully saved');
	                        window.location='_past.php';
	                    </script>";
                    }
                    
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_past.php';                                         
                    </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_past.php';                           
                </script>";
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_past.php';        
                </script>";
        }

    }

	

    //ok//Editar las ediciones pasadas
    public function edit_mags()
    {    
        if($_FILES['coverimgn']['tmp_name'] =="")
        {
                    $mag_url = "visitor{$_POST['issueno']}-{$_POST['months']}";        
            $name = md5(microtime(true)).'.pdf';
            if($_FILES['name_pdf']['tmp_name'] !="") 
                move_uploaded_file($_FILES["name_pdf"]['tmp_name'], "../mag_past/past/".$name );
            else
                $name = $_POST["name_pdf1"];

            $query=sprintf("UPDATE mags SET 
            months = %s,
            years = %s,
            issueno = %s,
            coverclient = %s,         
            copies = %s,
            mag_url = %s,
			fechaini=%s, 
			fechafin=%s
            where mags_id = %s;",
            parent::comillas_inteligentes( $_POST["months"]),
            parent::comillas_inteligentes( $_POST["years"]),
            parent::comillas_inteligentes( $_POST["issueno"]),
            parent::comillas_inteligentes( $_POST["coverclient"]),
            parent::comillas_inteligentes( $_POST["copies"]),   
            parent::comillas_inteligentes( $mag_url ),     
			parent::comillas_inteligentes( $_POST["fechaini"]),
			parent::comillas_inteligentes( $_POST["fechafin"]),            
            parent::comillas_inteligentes( $_POST["mags_id"]) );
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description:111 " . mysqli_error($this->conex));
                    }else{
	                    echo "<script type='text/javascript'>
	                        alert('The Past Edition was succesfully saved');
	                        window.location='_past.php';
	                    </script>";
                    }
        }
        else
        {
	    $fileyear = strval($_POST["years"]);
	    $fn = "id-".$fileyear."-".$filemonth;
            $filename=parent::upload_image('coverimgn',$_POST["max_size"],($_POST['mags_id']) . $fn,'mag_past/covers/' . $fileyear);
	 $mag_url = "visitor{$_POST['issueno']}-{$_POST['months']}";
            if ($filename != 2)
            {            
                if ($filename != 1)
                {
                    if ($filename != 0)
                    {   
//                        if($filename != $_POST["coverimg1"]){unlink('../mag_past/covers/'.$_POST["coverimg1"]);}

                        $query=sprintf("update mags set 
                        months = %s,
                        years = %s,
                        issueno = %s,
                        coverclient = %s,
                        coverimg = %s,
                        copies = %s,
                        mag_url = %s,
			fechaini=%s, 
			fechafin=%s
                        where mags_id = %s;",
                        parent::comillas_inteligentes( $_POST["months"]),
                        parent::comillas_inteligentes( $_POST["years"]),
                        parent::comillas_inteligentes( $_POST["issueno"]),
                        parent::comillas_inteligentes( $_POST["coverclient"]),
                        parent::comillas_inteligentes( $filename ),
                        parent::comillas_inteligentes( $_POST["copies"]),
                        parent::comillas_inteligentes( $mag_url ),    
						parent::comillas_inteligentes( $_POST["fechaini"]),
						parent::comillas_inteligentes( $_POST["fechafin"]),            						
                        parent::comillas_inteligentes( $_POST["mags_id"]) );
                        mysqli_query($this->conex,$query);
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description:222 " . mysqli_error($this->conex));
                    }else{
	                    echo "<script type='text/javascript'>
	                        alert('The Past Edition was succesfully saved');
	                        window.location='_past.php';
	                    </script>";
                    }
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_past.php';                    
                        </script>";     
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_past.php';                   
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_past.php';
                    </script>"; 
            }
        }

    }
    //ok
    public function eli_mags()
    {     
       // parent::con();
        $query=sprintf("update mags set 
        mags_status = %s
        where mags_id = %s;",
        0,
        parent::comillas_inteligentes( $_POST["mags_id"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["img"])){unlink('../mag_past/covers/'.$_POST["img"]);}
        //if(isset($_POST["pdf"])){unlink('../mag_past/past/'.$_POST["pdf"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_past.php';
        </script>";

    }   	


########################################################################### emails

	//Agregar cliente desde index
    public function add_person_index()
    {
        $person_name = $_POST["person_name"];
        $person_ape = $_POST["person_ape"];
        $person_email = $_POST["person_email"];
        $person_telefono = $_POST["person_telefono"];
        $person_history = 'visit'; //$_POST["person_history"];
        $u = new usuarios;
        $buscar = $u->get_persons_by_email($_POST['person_email']);

        if (empty($buscar)) 
        {
            $query=sprintf("insert into people(person_name,person_email,person_history, person_img ,person_type , person_check, person_phone) values (%s, %s, %s, %s, %s, %s, %s);",
            parent::comillas_inteligentes( $_POST["person_name"]." ".$_POST["person_ape"]),
            parent::comillas_inteligentes( $_POST["person_email"]),
            parent::comillas_inteligentes($person_history ),
            parent::comillas_inteligentes('default.png'),
            parent::comillas_inteligentes(6),
            parent::comillas_inteligentes(1),
            parent::comillas_inteligentes($person_telefono)
			);
            mysqli_query($this->conex,$query);
        }

			$destinatario="lcalderon@kolormedia.net";
			$asunto="Web contact: $person_history";
			$cabeceras="From: $person_name <$person_email>\r\n";
			$cabeceras .="Content-Type: text/html; charset=utf-8\r\n";
			$texto="<a href=\"www.kolormedia.net\"><img src=\"http://www.kolormedia.net/imgs/kmws_logo.png\"></a><br><br><b>Consulta desde TPGT Website:</b><br><br>";
			$texto = $texto . "<b>Nombre        :</b> " . $person_name . "<br>";
			$texto = $texto . "<b>Email         :</b> " . $person_email . "<br>";
			$texto = $texto . "<b>Motivo        :</b> " . $person_history . "<br>";
			mail ($destinatario , $asunto , $texto , $cabeceras);
            echo "<script type='text/javascript'>
                alert('THANK YOU!, We have recieved the good news.');
                window.location='index.php';   
            </script>";

    }
	
	
########################################################################### clasificados

    //ok//Obtener todo de la tabla classifieds 
    public function get_all_classif()
    {
        unset($this->classyf);
        $sql="select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p, paises as pp  where classif_status=1 and c.classif_iduser=u.id_user and u.id_person = p.id_person and pp.id_pais=p.country order by classif_date DESC, id_classif DESC";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
      
            if (!isset($this->classyf))
            {
                return null;
            }
            else
            {
                return $this->classyf;
            }  

        mysqli_free_result($res);      
    }
//Obtener todo de la tabla classifieds  status=2 (fueron pagados y no has sido aprobados)
    public function get_all_pay()
    {
        unset($this->classyf);
        //parent::con();
        $sql="select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p where classif_status=2 and c.classif_iduser=u.id_user and u.id_person = p.id_person order by classif_date desc";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
      
            if (!isset($this->classyf))
            {
                return null;
            }
            else
            {
                return $this->classyf;
            }  

        mysqli_free_result($res);      
    }


	//obtener clasificados con estatus 2
    public function get_classif_disapproved()
    {
        //unset($this->classyf);
        $sql="select * from classifieds where classif_status = 2";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        return $this->classyf;  
        mysqli_free_result($reg);      
    }


	//ok//Obtener todo de una clasificado por su id
    public function get_classif_by_id($id)
    {        
        unset($this->classyf);

        $sql="select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p, paises as pp where classif_status=1 and c.classif_iduser=u.id_user and u.id_person = p.id_person and pp.id_pais=p.country and id_classif=".$id;

  		$res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
           
            if (!isset($this->classyf))
            {
                return null;
            }
            else
            {
                return $this->classyf;
            }  

        mysqli_free_result($reg);
    }

        //Agregar un clasificado
    public function add_classified($name)
    {   
        $p = alldestinos::get_plan();// muestra plan activo

        if(isset($_SESSION["usuario_id"]) && $_SESSION["level"] == 1)//admin
        { 
            $user = $_SESSION["usuario_id"]; $status = 1;  
            $plan = 0; //el admin nunca tendra plan
        } 
        elseif(isset($_SESSION["usuario_id"]) && $_SESSION["level"] == 6)//web
        {   
            $user = $_SESSION["usuario_id"];  
			$status = 2;  			
            $plan = $p[0]['id_user_plan'];
            //EL USER WEB PUBLICA SIN PAGAR Y SE MANTIENEN EN STATUS 3
            $publ = alldestinos::get_public($p[0]['id_user_plan']); //Publicaciones hechas con plan actual
            $publ_disp = $p[0]['cantidad_p']- $publ[0]['total'];

            if( count($p) == 0  || $publ_disp == 0  ) // SIN PLAN ó SIN PUBLICACIONES DISPONIBLES
            {
                $status = 3; //status para publicaciones que no pertenecen  ningun plan
                $plan = 0; //mientras que no active ningun plan se le asigna 0
            } 
        } 

        $id = parent::maxid('classifieds','id_classif');
        $filename1=parent::upload_image('classif_picture',$_POST["max_size"],($id+1),'../images/classi');

        if($_FILES['classif_picture2']['tmp_name'] !="")
        {
            $filename2=parent::upload_image('classif_picture2',$_POST["max_size"],($id+1).'_2','../images/classi'); 
            $file2=$filename2;
        }
        else{   $filename2 = 3; $file2=""; }

        if($_FILES['classif_picture3']['tmp_name'] !="")
        {
            $filename3=parent::upload_image('classif_picture3',$_POST["max_size"],($id+1).'_3','../images/classi'); 
            $file3=$filename3;
        }
        else{   $filename3 = 3;  $file3="";}


        if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
        {            
            if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
            {
                if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                {
                    $query=sprintf("insert into classifieds values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                    parent::comillas_inteligentes( $_POST["classif_title"]),
                    parent::comillas_inteligentes( trim($_POST["classif_description"])),
                    parent::comillas_inteligentes( $_POST["classif_price"]),                    
                    parent::comillas_inteligentes(date("Y-m-d h:i:s")), //, strtotime($_POST["classif_date"])
                    parent::comillas_inteligentes( $filename1 ),
                    parent::comillas_inteligentes( $file2 ),
                    parent::comillas_inteligentes( $file3 ),
                    parent::comillas_inteligentes( 1 ), //position
                    $status,
                    parent::comillas_inteligentes( $user ),
                    parent::comillas_inteligentes( $_POST["state"]),
                    $plan
                    ); 
					//echo  $query; die();
                    $q = mysqli_query($this->conex,$query);
                    if(!$q) {
                        echo("Error description: " . mysqli_error($this->conex));
                    }else{
						$this->send_mail_level(8, 3);
	                    echo "<script type='text/javascript'>
	                        alert('The Classfied was succesfully saved');
	                        window.location='".$name.".php';
	                    </script>";
                    }
                }
                else
                {
                    if($filename1!='0' && $filename1!="")unlink('../images/classi/'.$filename1);
                    if($file2!='0' && $file2!="")unlink('../images/classi/'.$file2);
                    if($file3!='0' && $file3!="")unlink('../images/classi/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='".$name.".php';             
                    </script>";
                }
            }
            else
            {
                if($filename1!='1' && $filename1!="")unlink('../images/classi/'.$filename1);
                if($file2!='1' && $file2!="")unlink('../images/classi/'.$file2);
                if($file3!='1' && $file3!="")unlink('../images/classi/'.$file3);
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='".$name.".php';       
                </script>";
            }

        }
        else
        {
            if($filename1!='2' && $filename1!="")unlink('../images/classi/'.$filename1);
            if($file2!='2' && $file2!="")unlink('../images/classi/'.$file2);
            if($file3!='2' && $file3!="")unlink('../images/classi/'.$file3);
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='".$name.".php';
                </script>";
        }


    }

    //Editar un clasificado
    public function edit_clasifiied($name)

    {    
        if($_FILES['classif_picturen']['tmp_name'] =="" && $_FILES['classif_picture2n']['tmp_name'] =="" && $_FILES['classif_picture3n']['tmp_name'] =="")
        {
            
            $query=sprintf("update classifieds set 
            classif_title = %s,
            classif_price = %s,
            classif_description = %s,
            new_used = %s
            where id_classif = %s;",
                parent::comillas_inteligentes( $_POST["classif_title"]),
                parent::comillas_inteligentes( $_POST["classif_price"]),
                parent::comillas_inteligentes( $_POST["classif_description"]),
                parent::comillas_inteligentes( $_POST["state"]),
                parent::comillas_inteligentes( $_POST['id_classif']) );
            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
                alert('The Classified was Modified successfully');
                window.location='".$name.".php';
            </script>";
        }
        else
        {
            if($_FILES['classif_picturen']['tmp_name'] !="")
            {
                 $filename1=parent::upload_image('classif_picturen',$_POST["max_size"],$_POST['id_classif'].'_1','../images/classi');
                 $file1=$filename1;
            }
            else{   $filename1 = 3; $file1=""; }

            if($_FILES['classif_picture2n']['tmp_name'] !="")
            {
                $filename2=parent::upload_image('classif_picture2n',$_POST["max_size"],$_POST['id_classif'].'_2','../images/classi'); 
                $file2=$filename2;
            }
            else{   $filename2 = 3; $file2=""; }

            if($_FILES['classif_picture3n']['tmp_name'] !="")
            {
                $filename3=parent::upload_image('classif_picture3n',$_POST["max_size"],$_POST['id_classif'].'_3','../images/classi'); 
                $file3=$filename3;
            }
            else{   $filename3 = 3;  $file3="";}


            if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
            {            
                if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
                {
                    if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                    {  

                        if($file1 != $_POST["classif_picture"] && $file1!=""){unlink('../images/classi/'.$_POST["classif_picture"]);}
                        if($file2 != $_POST["classif_picture2"] && $file2!=""){unlink('../images/classi/'.$_POST["classif_picture2"]);}
                        if($file3 != $_POST["classif_picture3"] && $file3!=""){unlink('../images/classi/'.$_POST["classif_picture3"]);}
                        if($file1=="")$file1=$_POST["classif_picture"];
                        if($file2=="")$file2=$_POST["classif_picture2"];
                        if($file3=="")$file3=$_POST["classif_picture3"];
                        $query=sprintf("update classifieds set 
                        classif_title = %s,
                        classif_price = %s,
                        classif_description = %s,
                        new_used = %s,
                        classif_picture = %s,
                        classif_picture2 = %s,
                        classif_picture3 = %s
                        where id_classif = %s;",
                            parent::comillas_inteligentes( $_POST["classif_title"]),
                            parent::comillas_inteligentes( $_POST["classif_price"]),
                            parent::comillas_inteligentes( $_POST["classif_description"]),
                            parent::comillas_inteligentes( $_POST["state"]),
                            parent::comillas_inteligentes( $file1 ),
                            parent::comillas_inteligentes( $file2 ),
                            parent::comillas_inteligentes( $file3 ),
                            parent::comillas_inteligentes( $_POST['id_classif']) );
                        mysqli_query($this->conex,$query);

                        echo "<script type='text/javascript'>
                            alert('The Classified was Modified successfully');
                            window.location='".$name.".php';
                        </script>";
                    }
                    else
                    {
                        if($file1!='0' && $file1!="")unlink('../images/classi/'.$file1);
                        if($file2!='0' && $file2!="")unlink('../images/classi/'.$file2);
                        if($file3!='0' && $file3!="")unlink('../images/classi/'.$file3);
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='".$name.".php';                    
                        </script>";     
                    }
                }
                else
                {
                    if($file1!='1' && $file1!="")unlink('../images/classi/'.$file1); 
                    if($file2!='1' && $file2!="")unlink('../images/classi/'.$file2); 
                    if($file3!='1' && $file3!="")unlink('../images/classi/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='".$name.".php';                   
                    </script>";
                }

            }
            else
            {
                if($file1!='2' && $file1!="")unlink('../images/classi/'.$file1);
                if($file2!='2' && $file2!="")unlink('../images/classi/'.$file2);
                if($file3!='2' && $file3!="")unlink('../images/classi/'.$file3);
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='".$name.".php';
                    </script>"; 
            }
        }

    }


    public function eli_classified($name)
    {     
        $query=sprintf("update classifieds set 
        classif_status = %s
        where id_classif = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_classif"]) );
        mysqli_query($this->conex,$query);
        //if(isset($_POST["classif_picture1"])){unlink('../images/classi/'.$_POST["classif_picture1"]);}
        //if(isset($_POST["classif_picture2"])){unlink('../images/classi/'.$_POST["classif_picture2"]);}
        //if(isset($_POST["classif_picture3"])){unlink('../images/classi/'.$_POST["classif_picture3"]);}
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='".$name.".php';
        </script>";

    }   
	
	/*$idgroup=$this->get_user_id_group($_POST["iduser"]);
		if($idgroup<>6 && $idgroup<>0){
		$status=3;
		}*/
		
		
    public function approve_classified($name, $status)
    {     
       // parent::con();
	   $des="";
	   if($status==1){
	   	$des="Approved";
		
	   }elseif($status==4){
	   	   $des="Disapproved";

	   }else{
	   $status=1;
	   $des="Approved";
	   }
        $query=sprintf("update classifieds set 
        classif_status = %s
        where id_classif = %s;",
        $status,
        parent::comillas_inteligentes( $_POST["id_classif"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully $des');
            window.location='".$name.".php';
        </script>";

    } 

    //Obtener todo de la tabla classifieds , que coincida con las palabras claves
    public function get_all_classifX($id)
    {
        unset($this->classyf);

        $words_search = explode(" ", trim($id));

        $columns = ['classif_title','classif_description','classif_price','classif_date','classif_position', 'DATE_FORMAT(classif_date, "%Y-%m-%d")']; 

        $query = "";
        alldestinos::save_keywords($id);

        if(count($words_search)>0)
        {   
            $query = "AND ( ";
            foreach ($words_search as $word) 
            {
                foreach ($columns as $column) 
                {
                    $query.="CAST(".$column." AS char ) LIKE '%".$word."%' OR ";
                }
            }  
            $query = substr($query, 0, -3);
            $query .= " ) ";  
        }


        $sql="select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p, paises as pp where classif_status=1 and c.classif_iduser=u.id_user and u.id_person = p.id_person and pp.id_pais=p.country ".$query." order by classif_date desc";
        $res=mysqli_query($this->conex,$sql); 
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
            if (!isset($this->classyf))
            {
                return null;
            }
            else
            {
                return $this->classyf;
            }  
        mysqli_free_result($res);      
    }

    public function get_filter_classif($i)
    {

        switch ($i) {
            case 1:
                $order="c.classif_price desc"; /*de mayor a menor PRECIO*/  
                break;
            case 2:
                $order="c.classif_price asc";  /*de menor a mayor PRECIO*/   
                break;
            case 3:
                $order="c.id_classif desc"; /*Mas recientes ultimo a primer ID*/     
                break;
            case 4:
                $order="c.classif_date desc"; /*de mayor a menor FECHA*/  
                break;
            case 5:
                $order="c.classif_date asc"; /*de menor  a mayor FECHA*/  
                break;
        }

        $sql = "select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p, paises as pp where classif_status=1 and c.classif_iduser=u.id_user and u.id_person = p.id_person and pp.id_pais=p.country order by ".$order;

        $res = mysqli_query($this->conex, $sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

        mysqli_free_result($res); 
    }



    //ok//Obtener todo de la tabla paises
    public function get_all_country()
    {
        unset($this->country);

        $sql="select * from paises order by pais asc";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->country[]=$reg;
        }
      
            if (!isset($this->country))
            {
                return null;
            }
            else
            {
                return $this->country;
            }  

        mysqli_free_result($res);      
    }

  //Obtener todo de la tabla keywords
    public function get_all_keywords()
    {
        unset($this->country);

        $sql="select * from keywords order by id_key desc";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->country[]=$reg;
        }
      
            if (!isset($this->country))
            {
                return null;
            }
            else
            {
                return $this->country;
            }  

        mysqli_free_result($res);      
    }    

    //Obtener todo de la tabla classifieds por id_user (status=1 aprobado o status=2 por aprobar) 
    //status=3 no pagados
    public function get_all_classif_iduser($order)
    {
        unset($this->classyf);
        //parent::con();
        $sql="select *, IF (new_used = '1', 'New','Used') as new_used  from classifieds as c, users as u, people as p where (classif_status=1 or classif_status=2 or classif_status=3) and c.classif_iduser=u.id_user and u.id_person = p.id_person and c.classif_iduser='".$_SESSION["usuario_id"]."' order by c.ID_CLASSIF ".$order; 
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
      
            if (!isset($this->classyf))
            {
                return null;
            }
            else
            {
                return $this->classyf;
            }  

        mysqli_free_result($res);      
    }
    
    // PLAN ACTUAL DEL USUARIO
    public function get_plan() 
    {
        unset($this->classyf);
        $user = $_SESSION["usuario_id"];
        $sql="select * from user_plan as us, planesweb as p where us.id_plan!=4 and us.id_plan=p.id_plan and us.id_user='".$user."' and us.fecha_f > '".date('Y-m-d')."' order by us.id_user_plan desc limit 1";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }

    //VERIFICAR SI FUE ACTIVADO UN PLAN Y SI HAY PUBLICACIONES SIN PLAN SE LE DEBE ASIGNAR EL NUEVO
    public function assign_plan_classif() 
    {
        unset($this->classyf);

        $p = alldestinos::get_plan();// muestra plan activo
        if ($p)
        {
            $plan = $p[0]['id_user_plan'];
            $publ = alldestinos::get_public($p[0]['id_user_plan']); //Publicaciones hechas con plan actual
            $publ_disp = $p[0]['cantidad_p']- $publ[0]['total'];

            $sql="SELECT id_classif FROM classifieds WHERE classif_status=3 AND classif_iduser=".$_SESSION["usuario_id"]." AND id_user_plan=0 limit ".$publ_disp;
            

            $in = "(";
            if ($res=mysqli_query($this->conex,$sql)){
                while ($reg=mysqli_fetch_array($res))
                {
                    $in .= $reg['id_classif'].",";
                    $this->classyf[] = $reg;
                }
            }
            

            if (isset($this->classyf))
            {   
                $in = substr($in,0,-1).")";
                $sql="UPDATE classifieds SET classif_status=2, id_user_plan=".$plan." WHERE id_classif IN ".$in;
                $res=mysqli_query($this->conex,$sql);   
            }
            else
            {
                return null;
            }
        }
        else
        {
            return NULL;
        }
    }

    // SI EL USUARIO SE LE VENCIO EL PLAN Y NO TIENE NINGUNO ACTIVO, 
    //SE BUSCA LA FECHA DEL ULTIMO QUE ACTIVO
    //PARA INDICARLE AL USUARIO DESDE QUE FECHA ESTARA ACTIVO SU PLAN
    public function get_last_plan() 
    {
        unset($this->classyf);
        $user = $_SESSION["usuario_id"];
        
        $sql="select 'Basic' as nombre, '0.00' as costo, ADDDATE(us.fecha_f, INTERVAL 1 DAY) as fecha_i, ADDDATE(us.fecha_f, INTERVAL 31 DAY) as fecha_f from user_plan as us, planesweb as p where us.id_plan!=4 and us.id_plan=p.id_plan and us.id_user='".$user."' order by us.id_user_plan desc limit 1;";

        $res=mysqli_query($this->conex,$sql);

        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            alldestinos::activar_free($user,$this->classyf);
            return $this->classyf;
        }  
    }
    //cuando a un usuario se le vence el plan actual y no ha activado otro, se le activa un plan free
    public function activar_free($user,$dates) 
    {   

        if( $dates[0]['fecha_i'] == date('Y-m-d') )
        {
            $query=sprintf("insert into user_plan values (null, %s, %s, %s, %s, %s, %s, %s);",
            parent::comillas_inteligentes( $user ), 
            parent::comillas_inteligentes( 1 ), //plan 1=basic
            parent::comillas_inteligentes( 3 ), //tipopago 3=free
            parent::comillas_inteligentes( $dates[0]['fecha_i'] ) ,
            parent::comillas_inteligentes( $dates[0]['fecha_f'] ) ,
            parent::comillas_inteligentes( '0.00'), 
            parent::comillas_inteligentes( 'Free') );
            mysqli_query($this->conex,$query);
        }    
    }
	
	public function add_payment($name) 
    {   
		 if(isset($_SESSION["usuario_id"]) && $_SESSION['level']==1)//admin
        { 
            $user = $_SESSION["usuario_id"]; 
        } 
        elseif(isset($_SESSION["usuario_id"])&& $_SESSION['level']==6)//web
        {   
            $user = $_SESSION["usuario_id"];
		}
            $query=sprintf("INSERT INTO `payment`(`idpayment`, tipo, `referencia`, `monto`, `banco`, `fecha`,iddocument, id_user, `id_status`, tipdocument, id_plan) VALUES  (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
            parent::comillas_inteligentes( $_POST["tipo"] ),
            parent::comillas_inteligentes( $_POST["referencia"] ),
            parent::comillas_inteligentes( $_POST["monto"] ),
            parent::comillas_inteligentes( $_POST["bank"] ),
            parent::comillas_inteligentes( $_POST["fecha"] ),
            parent::comillas_inteligentes( $_POST["iddocument"] ),
            parent::comillas_inteligentes( $user ),
            parent::comillas_inteligentes(1),
            parent::comillas_inteligentes($_POST["tipdocument"]),
            parent::comillas_inteligentes($_POST["id_plan"])
			);
			//echo $query; die();
           $resp= mysqli_query($this->conex,$query);
		   
		   
					if($resp){
                    echo "<script type='text/javascript'>
                        alert('The payment  add successfully');
                        window.location='".$name.".php';
                    </script>";
					}else{
					echo "<script type='text/javascript'>
                        alert('The payment  not add');
                        window.location='".$name.".php';
                    </script>";
					}
    }
    
    // CLASIFICADOS PUBLICADOS POR EL USURIO USUARIO, SOLO LOS DEL PLAN ACTUAL
    public function get_public($id) 
    {
        unset($this->classyf);

        $sql="select count(*) as total from classifieds where id_user_plan='".$id."' and classif_iduser='".$_SESSION["usuario_id"]."'";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  
    }

    // CLASIFICADOS PUBLICADOS POR EL USURIO y que NO HAYAN SIDO ELIMINADOS
    public function get_public_all() 
    {
        unset($this->classyf);

        $sql="select count(*) as total from classifieds where classif_iduser='".$_SESSION["usuario_id"]."' and classif_status=1 or classif_status=2";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  
    }

    // TOURS o SPONSORS PUBLICADOS POR EL USUARIO, SOLO LOS DEL PLAN ACTUAL
    public function get_public_ts($id,$table) 
    {
        unset($this->classyf);

        $sql="select count(*) as total from ".$table." where id_user_plan='".$id."' and id_user='".$_SESSION["usuario_id"]."'";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  
    }

    // TOURS o SPONSORS PUBLICADOS POR EL USUARIO y NO HAYAN SIDO ELIMINADOS
    public function get_public_ts_all($table) 
    {
        unset($this->classyf);

        $sql="select count(*) as total from ".$table." where id_user='".$_SESSION["usuario_id"]."'";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  
    }


    // OBTENER TODOS LOS PLANES ACTIVOS EXCEPTUANDO EL DE REPUBLICACION
    public function get_all_plans() 
    {
        unset($this->classyf);

        $sql="select * from planesweb where id_plan!=4 and status=1";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }

    // OBTENER plan por id
    public function get_plan_by_id($id) 
    {
        unset($this->classyf);

        $sql="select * from planesweb where id_plan='".$id."' and status=1";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }

    // OBTENER tipos de publicidad 
    public function get_publicity() 
    {
        unset($this->classyf);

        $sql="select * from publicidad where status=1";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }

    // OBTENER tipos de publicidad por id
    public function get_publicity_by_id($id) 
    {
        unset($this->classyf);

        $sql="select * from publicidad where id_publicidad='".$id."' and status=1";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }
	
	//Obtener todo de la tabla sponsor by id
    public function get_spon_by_id($id)
    {
        unset($this->sponss);
        //parent::con();
        $sql="select * from sponsors where sponsor_status!=0 and id_sponsors=".$id;
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->sponss[]=$reg;
        }
            if (!isset($this->sponss))
            {
                return null;
            }
            else
            {
                return $this->sponss;
            }  
        mysqli_free_result($reg);      
    }
	
    //publicar por pago paypal
    public function push_publish($user,$monto,$codpago,$sponsor,$publi)
    {
	    //obtener la categoria y la posicion por el id_sponsor
        $info = $this->get_spon_by_id($sponsor);
		$dias_dur=$info[0]["dias_dur"];
		$fecha_ob=date('Y-m-d');
        //fechas para el nuevo sponsor
        $fecha_i = parent::date_x($fecha_ob,1);
		if($dias_dur>0){
        $fecha_f = parent::date_x($fecha_i,$dias_dur);
		}else{
		 $fecha_f =$fecha_i;
		}
        //PUBLICACION
        $query=sprintf("insert into user_publicidad values (null, %s, %s, %s, %s, %s, %s, %s, %s);", 
            parent::comillas_inteligentes( $user ),
            parent::comillas_inteligentes( $publi ),
            parent::comillas_inteligentes( $sponsor ),
            parent::comillas_inteligentes( 1 ),   //tipopago                 
            parent::comillas_inteligentes( $fecha_i ) ,
            parent::comillas_inteligentes( $fecha_f ) , 
            parent::comillas_inteligentes( $monto ),
            parent::comillas_inteligentes( $codpago )
        );
        mysqli_query($this->conex,$query);

        $query = "update sponsors set sponsor_status = 3 where id_sponsors = ".$sponsor;
        mysqli_query($this->conex,$query);
     
    }

    //republicar por pago paypal
    public function push_republish($user,$monto,$codpago,$classif)
    {
        //REPUBLICACION
        $query=sprintf("insert into user_plan values (null, %s, %s, %s, %s, %s, %s, %s);", 
            parent::comillas_inteligentes( $user ),
            parent::comillas_inteligentes( 4 ),
            parent::comillas_inteligentes( 1 ),   //tipopago                 
            parent::comillas_inteligentes( date('Y-m-d') ) ,
            parent::comillas_inteligentes( date('Y-m-d') ) , 
            parent::comillas_inteligentes( $monto ),
            parent::comillas_inteligentes( $codpago )
        );
		//echo  $query;
        mysqli_query($this->conex,$query);

        $query=sprintf("update classifieds set 
        classif_date = %s
        where id_classif = %s;",
            parent::comillas_inteligentes( date("Y-m-d")), 
            parent::comillas_inteligentes( $classif )
        );
        mysqli_query($this->conex,$query);
      
    }

    //cambiar de plan por pago paypal
    public function push_changeplan($user,$plan,$monto,$codpago)
    {
        //cambiar plan
        $query=sprintf("insert into user_plan values (null, %s, %s, %s, %s, %s, %s, %s);", 
            parent::comillas_inteligentes( $user ),
            parent::comillas_inteligentes( $plan ),
            parent::comillas_inteligentes( 1 ),   //tipopago                 
            parent::comillas_inteligentes( date('Y-m-d') ) ,
            parent::comillas_inteligentes( parent::date_30() ) , 
            parent::comillas_inteligentes( $monto ),
            parent::comillas_inteligentes( $codpago )
        );
        mysqli_query($this->conex,$query);
    }

    public function check_payment_code($code)
    {
        unset($this->slider);

        $sql="select * from user_plan where cod_pago ='".$code."'";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->slider[]=$reg;
        }
        if (!isset($this->slider))
        {
            return 0;
        }
        else
        {
            return 1;
        }
        mysqli_free_result($res);

    }

public function get_articles_max($article_status=1)
    {        
        unset($this->item2);
        unset($this->item);
        $sql=sprintf("select max(id_blogs) as max from blogs where article_status=".$article_status."");
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->item[]=$reg;
        }
		
        $sql_2=sprintf("select max(id_blogs) as max from blogs where article_status=".$article_status."");
        $res_2=mysqli_query($this->conex2,$sql_2);
        while ($reg_2=mysqli_fetch_assoc($res_2))
        {
            $this->item2[]=$reg_2;
        }
		
		
        if (!isset($this->item2))
        {
             $max1=0;
        }
        else
        {
             $max1=intval($this->item2);
        }
		
        if (!isset($this->item))
        {
             $max2=0;
        }
        else
        {
             $max2=intval($this->item[0]["max"]);
        }
		
		if($max1>=$max2){
		return $max1;
		}else{
		return $max2;

		}
            
        mysqli_free_result($res);

    }
	
	  // OBTENER por id
    public function get_horarios_id($id) 
    {
        unset($this->classyf);

        $sql="SELECT idhors, monday, tuesday, wednesday, thursday, friday, saturday, 
		sunday, description, id_status, id_calendar FROM hor_event 
		WHERE id_status=1 and id_calendar='".$id."' ";

        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->classyf[]=$reg;
        }
        mysqli_free_result($res); 
        
        if (!isset($this->classyf))
        {
            return null;
        }
        else
        {
            return $this->classyf;
        }  

    }
	
	public function add_comentario()
    {

    if (isset($_POST['id_article']) && intval($_POST['id_article'])>0) {

                    $query=sprintf("INSERT INTO `comments`(`id`, `name`, `comment`, `id_article`, `fecha_coment`)
					VALUES (null, %s, %s, %s, %s);",
                    parent::comillas_inteligentes( $_POST["users"] ),
                    parent::comillas_inteligentes( $_POST["comment"] ),
                    parent::comillas_inteligentes( $_POST["id_article"] ),
                    parent::comillas_inteligentes(date("Y-m-d H:i:s")));
					//echo  $query; die();
                    $resp=mysqli_query($this->conex,$query);
					if($resp){
						 echo "
<script type='text/javascript'>
                        alert('Created comments');
                        window.location='blog-item.php?id=".$_POST["id_article"]."';
                    </script>";
					}else{
                    echo "
<script type='text/javascript'>
                        alert('Not Created comments');
                        window.location='blog-item.php?id=".$_POST["id_article"]."';
                    </script>";
					}
	}else{
		          echo "
<script type='text/javascript'>
                        alert('Error, articulo no seleccionado');
                        window.location='home';
                    </script>";
	}
            
    }    
	
	
	 //OK//Agregar 
    public function add_horarios()
    {
     
					$query=sprintf("UPDATE  hor_event SET id_status=%s WHERE id_calendar=%s;",
                    parent::comillas_inteligentes(2),
                    parent::comillas_inteligentes($_POST["id_calendar"])

					);
                    $resp=mysqli_query($this->conex,$query);
					
					$filas=8;
				
					for($ls=1; $ls<$filas; $ls++){
					$monday = $_POST["monday"];
					$tuesday = $_POST["tuesday"];
					$wednesday = $_POST["wednesday"];
					$thursday = $_POST["thursday"];
					$friday = $_POST["friday"];
					$saturday = $_POST["saturday"];
					$sunday = $_POST["sunday"];
					$l=0;
					$m=0;
					$mi=0;
					$j=0;
					$v=0;
					$s=0;
					$d=0;
					if($monday==$ls){
					$l=1;
					}
					
					if($tuesday==$ls){
					$m=1;
					}
					
					if($wednesday==$ls){
					$mi=1;
					}
					
					if($thursday==$ls){
					$j=1;
					}
					
					if($friday==$ls){
					$v=1;
					}
					
					if($saturday==$ls){
					$s=1;
					}
					
					if($sunday==$ls){
					$d=1;
					}
					
					$description = $_POST["description".$ls];
					if(($l==1 || $m==1 || $mi==1 || $j==1 || $v==1 || $s==1 || $d==1) && $description<>''){
					
					
                    $query=sprintf("INSERT INTO hor_event(idhors, monday, tuesday, wednesday, thursday, friday, saturday, sunday, description, id_status, id_calendar) VALUES (NULL,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s);",
                    parent::comillas_inteligentes($l),
                    parent::comillas_inteligentes($m),
                    parent::comillas_inteligentes($mi),
                    parent::comillas_inteligentes($j),
                    parent::comillas_inteligentes($v),
                    parent::comillas_inteligentes($s),
                    parent::comillas_inteligentes($d),
                    parent::comillas_inteligentes($description),
                    parent::comillas_inteligentes(1),
                    parent::comillas_inteligentes($_POST["id_calendar"])

					);
                    $resp=mysqli_query($this->conex,$query);
					}
					
					}
					
					if($resp){
                    echo "<script type='text/javascript'>
                        alert('The schedule Created successfully');
                        window.location='_home.php';
                    </script>";
					}else{
					echo "<script type='text/javascript'>
                        alert('The schedule not Created');
                        window.location='_home.php';
                    </script>";
					}
		}
               

	
}
  
?>