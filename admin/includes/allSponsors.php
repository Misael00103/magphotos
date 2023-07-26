<?php

class allsponsors extends Conectar
{
	private $sponss;
	private $sponssmf;
	private $searchout;
	private $providerrr;
	private $tourss;
	private $toursfotos;
	private $provincia;
    private $conex;
    public function __construct()
    {
		$this->sponss=array();
		$this->sponssmf=array();
		$this->searchout=array();
		$this->providerrr=array();
		$this->tourss=array();
		$this->toursfotos=array();
		$this->provincia=array();
        $this->conex=parent::con();
    }
    public function __destruct()
    {
		$this->sponss=array();
		$this->sponssmf=array();
		$this->searchout=array();
		$this->providerrr=array();
		$this->tourss=array();
		$this->toursfotos=array();
		$this->provincia=array();
    }

########################################################################### sponsors

    //ok//Obtener todo de la tabla sponsor
    public function get_all_sponsors()
    {
        unset($this->sponss);
        //parent::con();
        $sql="select *, IF (sponsor_position = '1', 'Custom','Shared') as position,
		(select person_name from users as u, people as per WHERE u.id_user=s.id_user and u.id_person=per.id_person) as autor
		from sponsors as s, publicidad as p where s.sponsor_status!=0 
		and p.id_publicidad=s.sponsor_category ORDER BY id_sponsors desc";
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

    //Obtener todo de la tabla sponsor status 3 =  ya fueron pagados
    public function get_sponsors_pay()
    {
        unset($this->sponss);
        //parent::con();
        $sql="select * from sponsors where sponsor_status=2";
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

//Obtener todo de la tabla sponsor by id
    public function get_sponsors_by_id($id)
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

    //Obtener todo de la tabla sponsor pór usuario
    public function get_sponsors_user()
    {
        unset($this->sponss);
        //parent::con();
        $sql="(select *, IF (sponsor_position = '1', 'Custom','Shared') as position from sponsors, publicidad  where sponsor_category=id_publicidad and sponsor_status!=0 and id_user='".$_SESSION["usuario_id"]."' order by id_sponsors desc)
		union (select *, IF (sponsor_position = '1', 'Custom','Shared') as position from sponsors, publicidad  where sponsor_category=id_publicidad and sponsor_status=5 and id_user='0' order by id_sponsors desc)";
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

    //Obtener todo de la tabla sponsor pór usuario
    public function get_sponsors_user_nopay()
    {
        unset($this->sponss);
        //parent::con();
        $sql="select * from sponsors, publicidad  where sponsor_category=id_publicidad and sponsor_status!=0 and sponsor_status=2 and id_user='".$_SESSION["usuario_id"]."' order by id_sponsors desc";
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

    //OK//Obtener todo de la tabla sponsor segun la categoria y la posicion enviadas y se retornaran solo la cntidad de registros solicitados con limit
    public function get_sponsors_cat_pos($categoria,$position,$limit)
    {
        unset($this->sponss);

      //  $sql="select * from sponsors where sponsor_status=1 and sponsor_category=".$categoria." and sponsor_position=".$position. " limit ".$limit;
        $sql = "select * from user_publicidad as up, sponsors as s where sponsor_status=3 and up.fecha_f >= '".date('Y-m-d')."' 
		and up.id_sponsor=s.id_sponsors and sponsor_category=".$categoria." 
		and sponsor_position=".$position. " order by up.fecha_f asc limit ".$limit;
		//echo $sql;
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

    //Obtener la fecha del ultimo sponsor publicado en una categoria y la posicion especifica
    public function get_sponsors_final($categoria,$position)
    {
        unset($this->sponss);

        $sql = "select up.fecha_f from user_publicidad as up, sponsors as s where sponsor_status=1 and up.fecha_f > '".date('Y-m-d')."' and up.id_sponsor=s.id_sponsors and sponsor_category=".$categoria." and sponsor_position=".$position. " order by up.fecha_f desc limit 1";

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

//Obtener la info de sponsors para el index
    public function get_mainof_sponsors()
    {
        unset($this->sponssmf);
        //parent::con();
        $sql="select id_sponsors, sponsor_name, sponsor_seo, sponsor_img, sponsor_url from sponsors where sponsor_position = 0";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->sponssmf[]=$reg;
        }
            return $this->sponssmf;  
        mysqli_free_result($reg);      
    }

//Agregar un sponsor

    public function add_sponsors($name)
    {   
        if(isset($_SESSION["usuario_id"])){ 
            //$user = $_SESSION["usuario_id"];
             
			if(isset($_POST["publicar"]) and $_POST["publicar"]=='on')
             {
			 $user =$_SESSION["usuario_id"];
			 $status = 3;
			 }else{
			 $status = 5;
			 $user = 0;
			 }
					
              
        } //admin
        else{   
            $user = $_SESSION["id"];  
            $status = 2;   
        } //provider 

        $id = parent::maxid('sponsors','id_sponsors');
        $filename1=parent::upload_image('sponsor_img',$_POST["max_size"],($id+1).'_1','images/sponsors');
        if($_FILES['sponsor_img2']['tmp_name'] !="")
        {
            $filename2=parent::upload_image('sponsor_img2',$_POST["max_size"],($id+1).'_2','images/sponsors'); 
            $file2=$filename2;
        }
        else{   $filename2 = 3; $file2=""; }

        if($_FILES['sponsor_img3']['tmp_name'] !="")
        {
            $filename3=parent::upload_image('sponsor_img3',$_POST["max_size"],($id+1).'_3','images/sponsors'); 
            $file3=$filename3;
        }
        else{   $filename3 = 3;  $file3="";}


        if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
        {            
            if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
            {
                if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                {
                    $query=sprintf("insert into sponsors values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '".date('Y-m-d')."');",
                        parent::comillas_inteligentes( $_POST["sponsor_name"]),
                        parent::comillas_inteligentes( $_POST["sponsor_seo"]),
                        parent::comillas_inteligentes( $_POST["sponsor_category"]),
                        parent::comillas_inteligentes( $_POST["price"] ),
                        parent::comillas_inteligentes( $_POST["sponsor_position"]),
                        parent::comillas_inteligentes( $filename1 ),
                        parent::comillas_inteligentes( $file2 ),
                        parent::comillas_inteligentes( $file3 ),
                        parent::comillas_inteligentes( $_POST["sponsor_url"]), 
                        parent::comillas_inteligentes( $status ),
                        parent::comillas_inteligentes( $user ),
                        parent::comillas_inteligentes( $_POST["dias"] )
                    );
                    mysqli_query($this->conex,$query);

                    if(isset($_SESSION["usuario_id"]) && $status==3)
                    { 
                        require_once("allPanama.php");
                        $p = new alldestinos;
                        $id = mysqli_insert_id($this->conex);
                        $p->push_publish($user,"0.00","Free",$id,$_POST["sponsor_category"]);
                    }
					 $d = new alldestinos;
					 $d->send_mail_level(8, 4);
        
                    echo "<script type='text/javascript'>
                        alert('The sponsors was Created successfully');
                        window.location='".$name.".php';
                    </script>"; 
                }
                else
                {
                    if($filename1!='0' && $filename1!="")unlink('../images/sponsors/'.$filename1);
                    if($file2!='0' && $file2!="")unlink('../images/sponsors/'.$file2);
                    if($file3!='0' && $file3!="")unlink('../images/sponsors/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='".$name.".php';                     
                    </script>";
                }
            }
            else
            {

                if($filename1!='1' && $filename1!="")unlink('../images/sponsors/'.$filename1);
                if($file2!='1' && $file2!="")unlink('../images/sponsors/'.$file2);
                if($file3!='1' && $file3!="")unlink('../images/sponsors/'.$file3);
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='".$name.".php';              
                </script>"; 
            }

        }
        else
        {
            if($filename1!='2' && $filename1!="")unlink('../images/sponsors/'.$filename1);
            if($file2!='2' && $file2!="")unlink('../images/sponsors/'.$file2);
            if($file3!='2' && $file3!="")unlink('../images/sponsors/'.$file3);
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='".$name.".php';  
                </script>";
        }


    }

	

 //Editar fechas del Calendario

    public function edit_sponsors($name)

    {        
	
        if($_FILES['sponsor_imgn']['tmp_name'] =="" && $_FILES['sponsor_img2n']['tmp_name'] =="" && $_FILES['sponsor_img3n']['tmp_name'] =="")
        {
		if($_POST["price"]){
		$cond=" , price='".$_POST["price"]."'";
		}else{
		$cond=" ";
		}
		
		
            $query=sprintf("update sponsors set 
            sponsor_name = %s,
            sponsor_seo = %s,
            sponsor_category = %s,
            sponsor_position = %s,
            sponsor_url = %s ,
            dias_dur = %s 
			".$cond." 
            where id_sponsors = %s;",
                parent::comillas_inteligentes( $_POST["sponsor_name"]),
                parent::comillas_inteligentes( $_POST["sponsor_seo"]),
                parent::comillas_inteligentes( $_POST["sponsor_category"]),
                parent::comillas_inteligentes( $_POST["sponsor_position"]),
                parent::comillas_inteligentes( $_POST["sponsor_url"]),
				parent::comillas_inteligentes( $_POST["dias"] ), 
                parent::comillas_inteligentes( $_POST['id_sponsors']) );			
			  $resp=mysqli_query($this->conex,$query);
						if($resp && $name=='sponsor'){
					$user = $_SESSION["usuario_id"];  
					$query=sprintf("update sponsors set 
					sponsor_status = %s,
					id_user = %s
					where id_sponsors = %s;",
					2,
					$user,
					parent::comillas_inteligentes( $_POST["id_sponsors"]) );
					$resp=mysqli_query($this->conex,$query);
						}
					if($resp){
            echo "<script type='text/javascript'>
                alert('The Sponsor was Modified successfully');
                window.location='".$name.".php';
            </script>";
			}else{
			 echo "<script type='text/javascript'>
                alert('The Sponsor was Modified error');
                window.location='".$name.".php';
            </script>";
			}

        }
        else
        {
            if($_FILES['sponsor_imgn']['tmp_name'] !="")
            {
                 $filename1=parent::upload_image('sponsor_imgn',$_POST["max_size"],$_POST['id_sponsors'].'_1','images/sponsors');
                 $file1=$filename1;
            }
            else{   $filename1 = 3; $file1=""; }

            if($_FILES['sponsor_img2n']['tmp_name'] !="")
            {
                $filename2=parent::upload_image('sponsor_img2n',$_POST["max_size"],$_POST['id_sponsors'].'_2','images/sponsors'); 
                $file2=$filename2;
            }
            else{   $filename2 = 3; $file2=""; }

            if($_FILES['sponsor_img3n']['tmp_name'] !="")
            {
                $filename3=parent::upload_image('sponsor_img3n',$_POST["max_size"],$_POST['id_sponsors'].'_3','images/sponsors'); 
                $file3=$filename3;
            }
            else{   $filename3 = 3;  $file3="";}


            if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
            {            
                if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
                {
                    if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                    {   
                        if($file1 != $_POST["sponsor_img"] && $file1!=""){unlink('../images/sponsors/'.$_POST["sponsor_img"]);}
                        if($file2 != $_POST["sponsor_img2"] && $file2!=""){unlink('../images/sponsors/'.$_POST["sponsor_img2"]);}
                        if($file3 != $_POST["sponsor_img3"] && $file3!=""){unlink('../images/sponsors/'.$_POST["sponsor_img3"]);}
                        if($file1=="")$file1=$_POST["sponsor_img"];
                        if($file2=="")$file2=$_POST["sponsor_img2"];
                        if($file3=="")$file3=$_POST["sponsor_img3"];

                        $query=sprintf("update sponsors set 
                        sponsor_name = %s,
                        sponsor_seo = %s,
                        sponsor_category = %s,
                        sponsor_position = %s,
                        sponsor_url = %s,
                        sponsor_img = %s,
                        sponsor_img2 = %s,
                        sponsor_img3 = %s,
						dias_dur = %s 
                        where id_sponsors = %s;",
                            parent::comillas_inteligentes( $_POST["sponsor_name"]),
                            parent::comillas_inteligentes( $_POST["sponsor_seo"]),
                            parent::comillas_inteligentes( $_POST["sponsor_category"]),
                            parent::comillas_inteligentes( $_POST["sponsor_position"]),
                            parent::comillas_inteligentes( $_POST["sponsor_url"]),
                            parent::comillas_inteligentes( $file1 ),
                            parent::comillas_inteligentes( $file2 ),
                            parent::comillas_inteligentes( $file3 ),
							parent::comillas_inteligentes( $_POST["dias"] ), 
                            parent::comillas_inteligentes( $_POST['id_sponsors']) );
                        $resp=mysqli_query($this->conex,$query);
						if($resp && $name=='sponsor'){
					$user = $_SESSION["usuario_id"];  
					$query=sprintf("update sponsors set 
					sponsor_status = %s,
					id_user = %s
					where id_sponsors = %s;",
					2,
					$user,
					parent::comillas_inteligentes( $_POST["id_sponsors"]) );
					$resp=mysqli_query($this->conex,$query);
						}
						
						if($resp){
                        echo "<script type='text/javascript'>
                            alert('The Sponsor was Modified successfully');
                            window.location='".$name.".php';
                        </script>";
						}else{
						  echo "<script type='text/javascript'>
                            alert('The Sponsor was Modified error');
                            window.location='".$name.".php';
                        </script>";
						}
                    }
                    else
                    {
                        if($file1!='0' && $file1!="")unlink('../images/sponsors/'.$file1);
                        if($file2!='0' && $file2!="")unlink('../images/sponsors/'.$file2);
                        if($file3!='0' && $file3!="")unlink('../images/sponsors/'.$file3);
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='".$name.".php';                 
                        </script>";
                    }
                }
                else
                { 

                    if($file1!='1' && $file1!="")unlink('../images/sponsors/'.$file1); 
                    if($file2!='1' && $file2!="")unlink('../images/sponsors/'.$file2); 
                    if($file3!='1' && $file3!="")unlink('../images/sponsors/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='".$name.".php';         
                    </script>"; 
                }

            }
            else
            {
                if($file1!='2' && $file1!="")unlink('../images/sponsors/'.$file1);
                if($file2!='2' && $file2!="")unlink('../images/sponsors/'.$file2);
                if($file3!='2' && $file3!="")unlink('../images/sponsors/'.$file3);
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to create the record, the file must be an image'); 
                        window.location='".$name.".php';
                    </script>";
            }
        }


    }

    public function eli_sponsors($name)
    {     
        $query=sprintf("update sponsors set 
        sponsor_status = %s
        where id_sponsors = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_sponsors"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='".$name.".php';
        </script>";

    }
	
	 public function tomar_sponsors($name)
    {     
		if(isset($_SESSION["usuario_id"])){ $user = $_SESSION["usuario_id"]; } //admin        else{   $user = $_SESSION["id"];  } //provider
        $query=sprintf("update sponsors set 
        sponsor_status = %s,
        id_user = %s
        where id_sponsors = %s;",
        2,
        $user,
        parent::comillas_inteligentes( $_POST["id_sponsors"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The publication now belongs to you');
            window.location='".$name.".php';
        </script>";

    }

    public function approve_sponsor($name, $status)
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
	   
        $query=sprintf("update sponsors set 
        sponsor_status = %s
        where id_sponsors = %s;",
        $status,
        parent::comillas_inteligentes( $_POST["id_sponsors"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully $des');
            window.location='".$name.".php';
        </script>";

    }
	
########################################################################### providers

    //ok//Obtener todo de la tabla providers
    public function get_all_providers()
    {
        unset($this->providerrr);

        $sql="select * from providers where provider_status=1 order by id_provider desc";
        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->providerrr[]=$reg;
            }
            mysqli_free_result($res); 
            return $this->providerrr;
        }
        else
        {
            return null;
        }


    }

    //Agregar providers
    public function add_providers()
    {
        $id = parent::maxid('providers','id_provider');
        $filename=parent::upload_image('provider_logo',$_POST["max_size"],($id+1),'images/providers');
        if (is_string($filename)){ $_POST["provider_logo"] = $filename; $filename=3;}

        if ($filename != '2')
        {            
            if ($filename != '1')
            {
                if ($filename != '0')
                {
                    $query=sprintf("insert into providers values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                    parent::comillas_inteligentes( $_POST["provider_name"]),
                    parent::comillas_inteligentes( $_POST["provider_web"]),
                    parent::comillas_inteligentes( $_POST["provider_phone"]),
                    parent::comillas_inteligentes( $_POST["provider_whatsapp"]),
                    parent::comillas_inteligentes( $_POST["provider_location"]),
                    parent::comillas_inteligentes( $_POST["provider_description"]),
                    parent::comillas_inteligentes( $_POST["provider_logo"]),
                    parent::comillas_inteligentes( $_POST["provider_quality"]),
                    parent::comillas_inteligentes( 1 ), //status
                    parent::comillas_inteligentes( 1 )  //position
                    );
                    mysqli_query($this->conex,$query);
                    echo "<script type='text/javascript'>
                        alert('The Provider was Created successfully');
                        window.location='_providers.php';
                    </script>";
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='_providers.php';                  
                    </script>";  
                }
            }
            else
            { 
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='_providers.php';                 
                </script>";   
            }

        }
        else
        {
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='_providers.php';
                </script>";
        }
    }

    public function edit_providers()
    { 
        if($_FILES['provider_logon']['tmp_name'] =="")
        {
            $query=sprintf("update providers set 
            provider_name = %s,
            provider_web = %s,
            provider_phone = %s,
            provider_whatsapp = %s,
            provider_location = %s,
            provider_description = %s,
            provider_quality = %s
            where id_provider = %s;",
                parent::comillas_inteligentes( $_POST["provider_name"]),
                parent::comillas_inteligentes( $_POST["provider_web"]),
                parent::comillas_inteligentes( $_POST["provider_phone"]),
                parent::comillas_inteligentes( $_POST["provider_whatsapp"]),
                parent::comillas_inteligentes( $_POST["provider_location"]),
                parent::comillas_inteligentes( $_POST["provider_description"]),
                parent::comillas_inteligentes( $_POST["provider_quality"]),
                parent::comillas_inteligentes( $_POST["id_provider"]) );
            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
                alert('The Provider was Modified successfully');
                window.location='_providers.php';
            </script>";

        }
        else
        {
            $filename=parent::upload_image('provider_logon',$_POST["max_size"],($_POST["id_provider"]),'images/providers');
            $file=$filename; 
            if (is_string($filename)){ $_POST["provider_logon"] = $filename; $filename=3;}

            if ($filename != 2)
            {            
                if ($filename != 1)
                {
                    if ($filename != 0)
                    {    
                        if($file != $_POST["provider_logo1"]){unlink('../images/providers/'.$_POST["provider_logo1"]);}
                        $query=sprintf("update providers set 
                        provider_name = %s,
                        provider_web = %s,
                        provider_phone = %s,
                        provider_whatsapp = %s,
                        provider_location = %s,
                        provider_description = %s,
                        provider_quality = %s,
                        provider_logo = %s
                        where id_provider = %s;",
                            parent::comillas_inteligentes( $_POST["provider_name"]),
                            parent::comillas_inteligentes( $_POST["provider_web"]),
                            parent::comillas_inteligentes( $_POST["provider_phone"]),
                            parent::comillas_inteligentes( $_POST["provider_whatsapp"]),
                            parent::comillas_inteligentes( $_POST["provider_location"]),
                            parent::comillas_inteligentes( $_POST["provider_description"]),
                            parent::comillas_inteligentes( $_POST["provider_quality"]),
                            parent::comillas_inteligentes( $_POST["provider_logon"] ),
                            parent::comillas_inteligentes( $_POST["id_provider"]) );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Provider was Modified successfully');
                            window.location='_providers.php';
                        </script>";   
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_providers.php';                         
                        </script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_providers.php';                    
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to modify the record, the file must be an image'); 
                        window.location='_providers.php';
                    </script>";
            }
        }
    }
	
    //Eliminar providers
    public function eli_providers()
    {     

        $query=sprintf("update providers set 
        provider_status = %s
        where id_provider = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_provider"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_providers.php';
        </script>";
    }

	//Obtener todo de una proveedores por su id
    public function get_providers_by_tour($id)
    {        
        unset($this->sponss);

        $sql=sprintf("select * from providers as pv, tours as t where tour_status=1 and pv.id_provider = t.id_provider and t.id_tours=%s;", parent::comillas_inteligentes($id));

   		$res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->sponss[]=$reg;
        }
            return $this->sponss;
        mysqli_free_result($reg);
    }
	
########################################################################### tours

//Obtener todo de la tabla tours
    public function get_all_tours()
    {
        unset($this->tourss);
        //parent::con();
        $sql="select * from tours where tour_status=1 order by id_tours desc";
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

//Obtener todos los tours de un usuario en especifico
    public function get_tours_user()
    {
        unset($this->tourss);
        $sql="select * from tours where tour_status=1 and id_user='".$_SESSION["usuario_id"]."'";
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

//Obtener todos los tours con sus fotos
    public function get_tours_fotos()
    {
        unset($this->tourss);
        //parent::con();
        $sql="select * from tours as t, fotos_tours as f where t.id_tours = f.id_foto_t and tour_status=1";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->tourss[]=$reg;
        }
            if (!isset($this->tourss))
            {
                return null;
            }
            else
            {
                return $this->tourss;
            }  
        mysqli_free_result($reg);      
    }
	
	//Obtener todo de una provincia por su id
    public function get_tour_por_id($id)
    {        
        unset($this->tourss);

        $sql=sprintf("select * from tours as t, provincias as p where tour_status=1 and p.id_provincia = t.id_provincia and t.id_tours=%s;", parent::comillas_inteligentes($id));

   		$res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->tourss[]=$reg;
        }
            if (!isset($this->tourss))
            {
                return null;
            }
            else
            {
                return $this->tourss;
            }  
        mysqli_free_result($reg);
    }
	
	//Obtener todo de una tour por su id
    public function get_fotos_tours_by_id($id)
    {        
        unset($this->toursfotos);

        $sql=sprintf("select * from tours as t, fotos_tours as ft where t.tour_status=1 and t.id_tours = ft.id_foto_t and t.id_tours=%s", parent::comillas_inteligentes($id));

   		$res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->toursfotos[]=$reg;
        }
            if (!isset($this->toursfotos))
            {
                return null;
            }
            else
            {
                return $this->toursfotos;
            }  
        mysqli_free_result($res);
    }
	
	
	//Obtener todo los tours por provincia segun id
    public function get_tours_por_provincia_por_id($id)
    {        
        unset($this->tourss);

        $sql=sprintf("select * from tours as t, provincias as p where t.tour_status=1 and p.id_provincia = t.id_provincia and p.id_provincia=%s;", parent::comillas_inteligentes($id));

        $res=mysqli_query($this->conex,$sql);

        /* By Glairet Gonzalez, Kolormedia
        | Desc: Sino devuelve ningun registro no realiza ninguna acción
        | Update: 05/02/2018*/
        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->tourss[]=$reg;
            }

            mysqli_free_result($res);    
            return $this->tourss;
        }
        else
        {
            return null;
        }
    }

   //Obtener un tours por cualquier palabra que coincida
    public function get_tour_keyword($id)
    {        
        unset($this->item);

        $words_search = explode(" ", mysqli_real_escape_string($this->conex,$id));

        $columns = ['tour_name','tour_description','tour_require','tour_name_es', 'tour_description_es', 'tour_require_es', 'tour_duration'];
        $query = "";

        $d = new alldestinos;
        $d->save_keywords($id);

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
        
        $sql="select * from tours where tour_status=1 ".$query." ORDER BY id_tours DESC";

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

//Agregar un sponsor

    public function add_tours($name)

    {
        if(isset($_SESSION["usuario_id"])){ $user = $_SESSION["usuario_id"]; } //admin
        else{   $user = $_SESSION["id"];  } //provider

        $id = parent::maxid('tours','id_tours');
        $filename1=parent::upload_image('tour_img',$_POST["max_size"],($id+1).'_1','images/tours');
        if($_FILES['tour_img2']['tmp_name'] !="")
        {
            $filename2=parent::upload_image('tour_img2',$_POST["max_size"],($id+1).'_2','images/tours'); 
            $file2=$filename2;
        }
        else{   $filename2 = 3; $file2=""; }

        if($_FILES['tour_img3']['tmp_name'] !="")
        {
            $filename3=parent::upload_image('tour_img3',$_POST["max_size"],($id+1).'_3','images/tours'); 
            $file3=$filename3;
        }
        else{   $filename3 = 3;  $file3="";}


        if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
        {            
            if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
            {
                if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                {   
                    require_once("allPanama.php");
                    $p = new alldestinos;
                    $plan = $p->get_plan(); 
                    $plan = $plan[0]['id_user_plan'];
                    $query=sprintf("insert into tours values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                        parent::comillas_inteligentes( $_POST["tour_name"]),
                        parent::comillas_inteligentes( $_POST["tour_description"]),
                        parent::comillas_inteligentes( $_POST["tour_require"]), 
                        parent::comillas_inteligentes( NULL ), 
                        parent::comillas_inteligentes( NULL ), 
                        parent::comillas_inteligentes( NULL ),
                        parent::comillas_inteligentes( $_POST["tour_duration"]),
                        parent::comillas_inteligentes( $filename1 ),
                        parent::comillas_inteligentes( $file2 ),
                        parent::comillas_inteligentes( $file3 ),
                        parent::comillas_inteligentes( $_POST["tour_price"]),
                        parent::comillas_inteligentes( $_POST["tour_map"]),
                        parent::comillas_inteligentes( $_POST["id_provincia"]),
                        parent::comillas_inteligentes( $_POST["id_provider"]),
                        parent::comillas_inteligentes( 1 ), //position
                        parent::comillas_inteligentes( 1 ), //status
                        parent::comillas_inteligentes( $user ),
                        parent::comillas_inteligentes( $plan )
                    ); 
                    mysqli_query($this->conex,$query);
                    echo "<script type='text/javascript'>
                            alert('The Tour was Created successfully');
                            window.location='".$name.".php';
                          </script>"; 


                }
                else
                {
                    if($filename1!='0' && $filename1!="")unlink('../images/tours/'.$filename1);
                    if($file2!='0' && $file2!="")unlink('../images/tours/'.$file2);
                    if($file3!='0' && $file3!="")unlink('../images/tours/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to upload the image, try again');   
                        window.location='".$name.".php';                     
                    </script>";
                }
            }
            else
            {

                if($filename1!='1' && $filename1!="")unlink('../images/tours/'.$filename1);
                if($file2!='1' && $file2!="")unlink('../images/tours/'.$file2);
                if($file3!='1' && $file3!="")unlink('../images/tours/'.$file3);
                echo "<script type='text/javascript'> 
                    alert('The image exceeds the established weight, maximum allowed 200kb');    
                    window.location='".$name.".php';              
                </script>"; 
            }

        }
        else
        {
            if($filename1!='2' && $filename1!="")unlink('../images/tours/'.$filename1);
            if($file2!='2' && $file2!="")unlink('../images/tours/'.$file2);
            if($file3!='2' && $file3!="")unlink('../images/tours/'.$file3);
            echo "<script type='text/javascript'> 
                    alert('An error occurred while trying to create the record, the file must be an image'); 
                    window.location='".$name.".php';  
                </script>";
        }


    }


 public function edit_tours($name)

    {        
        if($_FILES['tour_imgn']['tmp_name'] =="" && $_FILES['tour_imgn2']['tmp_name'] =="" && $_FILES['tour_imgn3']['tmp_name'] =="")
        {
            $query=sprintf("update tours set 
            tour_name = %s,
            tour_description = %s,
            tour_require = %s,
            tour_duration = %s,
            tour_price = %s,
            id_provincia = %s,
            id_provider = %s
            where id_tours = %s;",
                parent::comillas_inteligentes( $_POST["tour_name"]),
                parent::comillas_inteligentes( $_POST["tour_description"]),
                parent::comillas_inteligentes( $_POST["tour_require"]), 
                parent::comillas_inteligentes( $_POST["tour_duration"]),
                parent::comillas_inteligentes( $_POST["tour_price"]),
                parent::comillas_inteligentes( $_POST["id_provincia"]),
                parent::comillas_inteligentes( $_POST["id_provider"]),
                parent::comillas_inteligentes( $_POST["id_tours"] )
            );
            mysqli_query($this->conex,$query);
            echo "<script type='text/javascript'>
                alert('The Sponsor was Modified successfully');
                window.location='".$name.".php';
            </script>";

        }
        else
        {
            if($_FILES['tour_imgn']['tmp_name'] !="")
            {
                 $filename1=parent::upload_image('tour_imgn',$_POST["max_size"],$_POST['id_tours'].'_1','images/tours');
                 $file1=$filename1;
            }
            else{   $filename1 = 3; $file1=""; }

            if($_FILES['tour_imgn2']['tmp_name'] !="")
            {
                $filename2=parent::upload_image('tour_imgn2',$_POST["max_size"],$_POST['id_tours'].'_2','images/tours'); 
                $file2=$filename2;
            }
            else{   $filename2 = 3; $file2=""; }

            if($_FILES['tour_imgn3']['tmp_name'] !="")
            {
                $filename3=parent::upload_image('tour_imgn3',$_POST["max_size"],$_POST['id_tours'].'_3','images/tours'); 
                $file3=$filename3;
            }
            else{   $filename3 = 3;  $file3="";}

            
            if ($filename1 != '2' && $filename2 != '2' && $filename3 != '2')
            {            
                if ($filename1 != '1' && $filename2 != '1' && $filename3 != '1')
                {
                    if ($filename1 != '0' && $filename2 != '0' && $filename3 != '0')
                    {   
                        if($file1 != $_POST["tour_img"] && $file1!=""){unlink('../images/tours/'.$_POST["tour_img"]);}
                        if($file2 != $_POST["tour_img2"] && $file2!=""){unlink('../images/tours/'.$_POST["tour_img2"]);}
                        if($file3 != $_POST["tour_img3"] && $file3!=""){unlink('../images/tours/'.$_POST["tour_img3"]);}
                        if($file1=="")$file1=$_POST["tour_img"];
                        if($file2=="")$file2=$_POST["tour_img2"];
                        if($file3=="")$file3=$_POST["tour_img3"];

                        $query=sprintf("update tours set 
                        tour_name = %s,
                        tour_description = %s,
                        tour_require = %s,
                        tour_duration = %s,
                        tour_price = %s,
                        id_provincia = %s,
                        id_provider = %s,
                        tour_pic = %s,
                        tour_pic2 = %s,
                        tour_pic3 = %s
                        where id_tours = %s;",
                            parent::comillas_inteligentes( $_POST["tour_name"]),
                            parent::comillas_inteligentes( $_POST["tour_description"]),
                            parent::comillas_inteligentes( $_POST["tour_require"]), 
                            parent::comillas_inteligentes( $_POST["tour_duration"]),
                            parent::comillas_inteligentes( $_POST["tour_price"]),
                            parent::comillas_inteligentes( $_POST["id_provincia"]),
                            parent::comillas_inteligentes( $_POST["id_provider"]),
                            parent::comillas_inteligentes( $file1 ),
                            parent::comillas_inteligentes( $file2 ),
                            parent::comillas_inteligentes( $file3 ),
                            parent::comillas_inteligentes( $_POST["id_tours"] )
                        );
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Sponsor was Modified successfully');
                            window.location='".$name.".php';
                        </script>";
                    }
                    else
                    {
                        if($file1!='0' && $file1!="")unlink('../images/tours/'.$file1);
                        if($file2!='0' && $file2!="")unlink('../images/tours/'.$file2);
                        if($file3!='0' && $file3!="")unlink('../images/tours/'.$file3);
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='".$name.".php';                 
                        </script>";
                    }
                }
                else
                { 

                    if($file1!='1' && $file1!="")unlink('../images/tours/'.$file1); 
                    if($file2!='1' && $file2!="")unlink('../images/tours/'.$file2); 
                    if($file3!='1' && $file3!="")unlink('../images/tours/'.$file3);
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='".$name.".php';         
                    </script>"; 
                }

            }
            else
            { 
                if($file1!='2' && $file1!="")unlink('../images/tours/'.$file1);
                if($file2!='2' && $file2!="")unlink('../images/tours/'.$file2);
                if($file3!='2' && $file3!="")unlink('../images/tours/'.$file3);
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to create the record, the file must be an image'); 
                        window.location='".$name.".php';
                    </script>";
            }
        }


    }

    public function eli_tours($name)
    {     
        $query=sprintf("update tours set 
       tour_status = %s
        where id_tours = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_tours"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='".$name.".php';
        </script>";

    }
########################################################################### provincia	

	//Obtener todo de una provincia por su id
    public function get_provincia_por_id($id)
    {        
        unset($this->provincia);

        $sql=sprintf("select * from provincias where id_provincia=$id;", parent::comillas_inteligentes($id));

   		$res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->provincia[]=$reg;
            }
           
            mysqli_free_result($res);
            return $this->provincia;   
        }
        else
        {
            return null;
        }
    }


    //ok//Obtener todas las provincia
    public function get_provincia()
    {        
        unset($this->provincia);

        $sql=sprintf("select * from provincias");

        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->provincia[]=$reg;
            }
           
            mysqli_free_result($res);
            return $this->provincia;   
        }
        else
        {
            return null;
        }
    } //ok//Obtener todas las provincia
	
	
    public function get_sponsor_report($fechames, $idperson, $id_group)
    {        
        unset($this->report);

        $sql=sprintf("SELECT count( s.`id_sponsors` ) AS cant, sum( COALESCE( s.`price` , 0 ) ) AS total, s.`id_user` , s.`sponsor_status` , `person_name`
FROM `sponsors` AS s
INNER JOIN users AS u ON s.`id_user` = u.`id_user`
INNER JOIN people AS p ON p.`id_person` = u.`id_person`
WHERE u.`id_group` ='".$id_group."' 
AND p.id_person ='".$idperson."'
AND SUBSTRING( `fecha_spon` , 1, 7 ) = '".$fechames."'
GROUP BY s.`id_user` , s.`sponsor_status`");
//echo $sql."<br>";
        $res=mysqli_query($this->conex,$sql);
	if($res){
        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->report[]=$reg;
            }
			}
           
            mysqli_free_result($res);
            return $this->report;   
        }
        else
        {
            return null;
        }
    }	
	
    public function get_sponsor_person($anno, $id_group)
    {        
        unset($this->report);

        $sql=sprintf("SELECT  p.`id_person`,  `person_name`
FROM `sponsors` as s 
inner join users as u on s.`id_user`=u.`id_user`
inner join people as p on p.`id_person`=u.`id_person`
WHERE u.`id_group`='".$id_group."' and SUBSTRING(`fecha_spon`, 1, 4)='".$anno."'
group by  p.`id_person`, `person_name`");

        $res=mysqli_query($this->conex,$sql);

        if(mysqli_num_rows($res)>0){
            while ($reg=mysqli_fetch_assoc($res))
            {
                $this->report[]=$reg;
            }
           
            mysqli_free_result($res);
            return $this->report;   
        }
        else
        {
            return null;
        }
    }
	

}
?>