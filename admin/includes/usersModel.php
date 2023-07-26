<?php 

class usuarios extends Conectar
{  
    private $user;
    private $usuario;
    private $grupo;
    private $person;
    private $category;
    private $conex;
    public function __construct()

    {

        $this->user=array();
        $this->group=array();
        $this->person=array();
        $this->usuario=array();
        $this->category=array();
        $this->conex=parent::con();
    }
    public function __destruct()

    {
        $this->user=array();
        $this->group=array();
        $this->person=array();
        $this->usuario=array();
        $this->category=array();
    }


    ########################################################################### people

	//ok//Obtener todo de la tabla people
    public function get_crowd()
    {
        unset($this->peoples);
        //parent::con();
        $sql="select * from people as p, groups as g where p.person_check!=0 and p.person_type=g.id_group";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->peoples[]=$reg;
        }
            if (!isset($this->peoples))
            {
                return null;
            }
            else
            {
                return $this->peoples;
            }  
        mysqli_free_result($reg);      
    }

       
    //Obtener datos de people por id_user
    public function get_crowid()
    {
        unset($this->peoples);
        if (isset($_SESSION['usuario_id'])){
            $id = $_SESSION['usuario_id'];
        }else{
            $id = $_SESSION['id'];
        }
        //parent::con();
        $sql="select * from users as u, people as g where u.id_group = g.person_type and u.id_status = '1' and u.id_user='".$id."'  and u.id_person= g.id_person";
        $res=mysqli_query($this->conex,$sql);
              
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->peoples[]=$reg;
        }
            if (!isset($this->peoples))
            {
                return null;
            }
            else
            {
                return $this->peoples;
            }  
        mysqli_free_result($res);      
    }
	
	//Obtener todo de una persona por su id
    public function get_person_by_classif($id)
    {        
        unset($this->peoples);

        $sql=sprintf("select * from people as ps, classifieds as c where ps.id_person = c.id_classif and ps.id_person=%s;", parent::comillas_inteligentes($id));

   		$res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->peoples[]=$reg;
        }
            if (!isset($this->peoples))
            {
                return null;
            }
            else
            {
                return $this->peoples;
            }  
        mysqli_free_result($reg);
    }


    //Obtener todo de la tabla de category
    public function get_categoria()
    {   
        //parent::con();
        $sql="select * from person_category";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->category[]=$reg;
        }
            return $this->category;        
    }

    //obtener la categoria de la tabla personas
    public function get_personas_categorias()
    {   
        //parent::con();
        $sql="select * from persons as p left join person_category as p_g on p.id_category = p_g.id_category";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->person[]=$reg;
        }
            return $this->person;        
    }


    //Obtener una persona por su id
    public function get_person_by_id($id)
    {
       // parent::con();
        $sql=sprintf
        (
        "select * from people where id_person = %s;",
        parent::comillas_inteligentes($id)
        );
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->person[]=$reg;
        }
            return $this->person;
        mysqli_free_result($reg);
    }
	
    //ok//Obtiene personas por el email
    public function get_persons_by_email($email)
    {
        //parent::con();
        $sql=sprintf("select * from people where person_email = %s;",parent::comillas_inteligentes($email));
		
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->person[]=$reg;
        }
            return $this->person;
        mysqli_free_result($res);
    }
	
	
    //Obtiene personas por la cedula
    public function get_persons_by_passport($passport)
    {
        //parent::con();
        $sql=sprintf("select * from persons where passport = %s;",parent::comillas_inteligentes($passport));
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->person[]=$reg;
        }
            return $this->person;
        mysqli_free_result($reg);  
    }


     //Agregar una persona 
    public function add_person_web($person_email, $person_name,$person_phone,$person_social,$person_company,$person_position,$person_type,$person_history, $country)
    {

        $buscar = usuarios::get_persons_by_email($person_email);

        if (empty($buscar)) 
        { 


                        $query=sprintf("insert into people values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);", 
                        parent::comillas_inteligentes( $person_name),
                        parent::comillas_inteligentes( 'no_image.jpg' ),
                        parent::comillas_inteligentes($person_email),
                        parent::comillas_inteligentes($person_phone),
                        parent::comillas_inteligentes( $person_social),
                        parent::comillas_inteligentes( $person_company),
                        parent::comillas_inteligentes( $person_position),
                        parent::comillas_inteligentes($person_type),
                        parent::comillas_inteligentes( 1 ),
                        parent::comillas_inteligentes( $person_history),
                         parent::comillas_inteligentes( $country)  ); 
                       $resp= mysqli_query($this->conex,$query);
                       return $resp;

        }    
        else
        {
           //edit
           
           $id_person=$buscar[0]["id_person"];
        $sql=sprintf("UPDATE people SET person_history=concat(person_history, ' ', %s) WHERE id_person=%s",
			parent::comillas_inteligentes( $person_history ),
            parent::comillas_inteligentes($id_person)

        );
            //echo $sql;
       $resp= mysqli_query($this->conex,$sql);
        return $resp;

        }

    }
    
    public function add_person()
    {


        $buscar = usuarios::get_persons_by_email($_POST['person_email']);

        if (empty($buscar)) 
        { 

            $filename=3;
            if($_FILES['person_img']['tmp_name'] !="")
            {       
                $id = parent::maxid('people','id_person');
                $filename=parent::upload_image('person_img',$_POST["max_size"],($id+1),'admin/images/people');
            }

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0') 
                    {
                        if($_FILES['person_img']['tmp_name'] ==""){$filename=$_POST["person_img1"];}

                        $query=sprintf("insert into people values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);", 
                        parent::comillas_inteligentes( $_POST["person_name"]),
                        parent::comillas_inteligentes( $filename ),
                        parent::comillas_inteligentes( $_POST["person_email"]),
                        parent::comillas_inteligentes( $_POST["person_phone"]),
                        parent::comillas_inteligentes( $_POST["person_social"]),
                        parent::comillas_inteligentes( $_POST["person_company"]),
                        parent::comillas_inteligentes( $_POST["person_position"]),
                        parent::comillas_inteligentes( $_POST["person_type"]),
                        parent::comillas_inteligentes( 1 ),
                        parent::comillas_inteligentes( $_POST["person_history"]),
                         parent::comillas_inteligentes( $_POST["country"] )  ); 
                        mysqli_query($this->conex,$query);
                        echo "<script type='text/javascript'>
                            alert('The Client was Created successfully');
                            window.location='_people.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_people.php';                       
                        </script>";  
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='_people.php';                    
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to create the record, the file must be an image'); 
                        window.location='_people.php';
                    </script>";
            }
        }    
        else
        {
            unset($buscar);

            echo "<script type='text/javascript'>
                alert('The email already exists in our Database');
                window.location='_people.php';
            </script>";
        }

    }

	//Editar una persona
    public function edit_person($name)
    {    
        //
        if(isset($_SESSION["id"])) $user = $_SESSION["id"]; else $user = $_SESSION["usuario_id"];

        $email_old  = usuarios::get_user_by_id($user)[0]['person_email'];

        $existe = "";

        if( $email_old != $_POST["person_email"] )
        {
            $existe = usuarios::get_persons_by_email($_POST['person_email']);
        }

        if (empty($existe)) 
        {

            if($_FILES['person_imgn']['tmp_name'] =="")
            {
                $query=sprintf("update people set 
                person_name = %s,
                person_email = %s,
                person_phone = %s,
                person_social = %s,
                person_company = %s,
                person_position = %s,
                person_type = %s,
                person_history = %s,
                country = %s
                where id_person = %s;",
                parent::comillas_inteligentes( $_POST["person_name"]),
                parent::comillas_inteligentes( $_POST["person_email"]),
                parent::comillas_inteligentes( $_POST["person_phone"]),
                parent::comillas_inteligentes( $_POST["person_social"]),
                parent::comillas_inteligentes( $_POST["person_company"]),
                parent::comillas_inteligentes( $_POST["person_position"]),
                parent::comillas_inteligentes( $_POST["person_type"]),
                parent::comillas_inteligentes( $_POST["person_history"]),
                parent::comillas_inteligentes( $_POST["country"] ),
                parent::comillas_inteligentes( $_POST["id_person"])
                );
                mysqli_query($this->conex,$query);
                echo "<script type='text/javascript'>
                    alert('The Registry was Modified successfully');
                    window.location='".$name.".php';
                </script>";

            }
            else
            {
                $filename=parent::upload_image('person_imgn',$_POST["max_size"],($_POST["id_person"]),'admin/images/people');

                if ($filename != '2')
                {            
                    if ($filename != '1')
                    {
                        if ($filename != '0')
                        {   
                            if($filename != $_POST["person_img1"] && $_POST["person_img1"]!="default.png"){unlink('../admin/images/people/'.$_POST["person_img1"]);}
                            $query=sprintf("update people set 
                            person_name = %s,
                            person_img = %s,
                            person_email = %s,
                            person_phone = %s,
                            person_social = %s,
                            person_company = %s,
                            person_position = %s,
                            person_type = %s,
                            person_history = %s
                            where id_person = %s;",
                            parent::comillas_inteligentes( $_POST["person_name"]),
                            parent::comillas_inteligentes( $filename ),
                            parent::comillas_inteligentes( $_POST["person_email"]),
                            parent::comillas_inteligentes( $_POST["person_phone"]),
                            parent::comillas_inteligentes( $_POST["person_social"]),
                            parent::comillas_inteligentes( $_POST["person_company"]),
                            parent::comillas_inteligentes( $_POST["person_position"]),
                            parent::comillas_inteligentes( $_POST["person_type"]),
                            parent::comillas_inteligentes( $_POST["person_history"]),
                            parent::comillas_inteligentes( $_POST["id_person"]) );

                            mysqli_query($this->conex,$query);
                            echo "<script type='text/javascript'>
                                alert('The Registry was Modified successfully');
                                 window.location='".$name.".php';
                            </script>";
                        }
                        else
                        {
                            echo "<script type='text/javascript'> 
                                alert('An error occurred while trying to upload the image, try again');   
                                 window.location='".$name.".php';                   
                            </script>";
                        }
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('The image exceeds the established weight, maximum allowed 200kb');    
                             window.location='".$name.".php';                   
                        </script>";
                    }

                }
                else
                {
                    echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to modify the record, the file must be an image'); 
                             window.location='".$name.".php';
                        </script>";
                }
            }
        }
        else
        {
            unset($buscar);

            echo "<script type='text/javascript'>
                alert('The email already exists in our Database');
                window.location='".$name.".php';
            </script>";       
            
        }    
    }


    public function eli_person()
    {     
       // parent::con();
        $query=sprintf("update people set 
        person_check = %s
        where id_person = %s;",
        0,
        parent::comillas_inteligentes( $_POST["id_person"]) );
        mysqli_query($this->conex,$query);
        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
            window.location='_people.php';
        </script>";

    } 	

     //Agregar una persona
    public function add_person_user()
    {


        $buscar = usuarios::get_persons_by_email($_POST['person_email']);

        if (empty($buscar)) 
        {  
            $filename='3';
            if($_FILES['person_img']['tmp_name'] !="")
            {       
                $id = parent::maxid('people','id_person');
                #$filename=parent::upload_image('person_img',$_POST["max_size"],($id+1),'*admin/images/people');
                $filename=parent::uploadImageFile($id+1);

            }

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0') 
                    {
                        if($_FILES['person_img']['tmp_name'] ==""){$filename=$_POST["person_img1"];}

                        $query=sprintf("insert into people values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);", 
                        parent::comillas_inteligentes( $_POST["person_name"]),
                        parent::comillas_inteligentes( $filename ),
                        parent::comillas_inteligentes( $_POST["person_email"]),
                        parent::comillas_inteligentes( $_POST["person_phone"]),
                        parent::comillas_inteligentes( NULL ), //person_social
                        parent::comillas_inteligentes( NULL ), //person_company
                        parent::comillas_inteligentes( NULL ), //person_position
                        6 , 1,
                        parent::comillas_inteligentes( NULL ),
                        parent::comillas_inteligentes( $_POST["country"] )  ); 
                        mysqli_query($this->conex,$query);
                        $id = mysqli_insert_id($this->conex);
                        if ( $id != 0 ) 
                        {  
                            $query=sprintf("insert into users values (null, %s, %s, %s, %s, %s);",
                            parent::comillas_inteligentes( $id ),
                            parent::comillas_inteligentes( md5(md5(md5($_POST["pass1"]))) ), 6 , 1, 1 );
                            mysqli_query($this->conex,$query);
                            $id = mysqli_insert_id($this->conex);

                            $query=sprintf("insert into user_plan values (null, %s, %s, %s, %s, %s, %s, %s);",
                            parent::comillas_inteligentes( $id ), 1 , 3 ,
                            parent::comillas_inteligentes( date('Y-m-d') ) ,
                            parent::comillas_inteligentes( parent::date_30() ) ,'0', 
                            parent::comillas_inteligentes( 'Free') );
                            // echo $query;
                            mysqli_query($this->conex,$query);
                            echo "<script type='text/javascript'>
                                    alert('The Client was Created successfully');
                                    window.location='admin/index.php';
                                  </script>"; 

                        }
                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='register.php';        
                        </script>";  
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 35kb');    
                        window.location='register.php';
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to create the record, the file must be an image'); 
                        window.location='register.php';
                    </script>";
            }
        }    
        else
        {
            unset($buscar);

            echo "<script type='text/javascript'>
                alert('The email already exists in our Database');
                window.location='register.php';
            </script>";
        }

    }
    ##############################################  GROUPS



    //Obtener todos los grupos

    public function get_groups()
    { 
        $sql="select * from groups";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->group[]=$reg;
        }
            return $this->group;        
    }



    //Obtener un grupo por id

    public function get_group_by_id($id)

    {

       // parent::con();

        $sql=sprintf("select * from groups where id_group = %s;",parent::comillas_inteligentes($id));



        $res=mysqli_query($this->conex,$sql);

        

        while ($reg=mysqli_fetch_assoc($res))

        {

            $this->person[]=$reg;

        }

            return $this->person;

        

        mysqli_free_result($reg);

    }

    

    ############################################## USERS

    //ok//Obtiene todos los usuarios

    public function get_users()
    {   
        $sql="select * from users as u, people as p, groups as g where u.id_person = p.id_person and u.id_group = g.id_group ";
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->user[]=$reg;
        }
            return $this->user;        
    }
    //Obtiene un usuario por id
    public function get_user_by_id($id)
    {
        //parent::con();
        $sql=sprintf("select * from users as u, people as p, groups as g where u.id_person = p.id_person and u.id_group = g.id_group and u.id_user = %s;",parent::comillas_inteligentes($id));
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->usuario[]=$reg;
        }
            return $this->usuario; 
    }
	
	//Obtiene un usuario por level
    public function get_user_mail_by_level($id)
    {
        //parent::con();
        $sql=sprintf("select person_email from users as u, people as p, groups as g where u.id_person = p.id_person and u.id_group = g.id_group and
		u.id_status = '1' and u.id_group = %s;",parent::comillas_inteligentes($id));
		//echo $sql; die();
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->usuario[]=$reg;
        }
            return $this->usuario; 
    }
	

    //Login de los usuarios
	
    public function login()
    {   
        //Si los datos estan vacios devuelve un error igual a 1
        if(empty($_POST["login"]) or empty($_POST["pass"]))
        {
            header("Location:".Conectar::ruta()."admin/?e=1");
            exit();
            echo "<script type='text/javascript'>
            alert('No puede haber campos vacios');
            window.location='index.php';
            </script>";
        }
        else
        {
			//print_r($_POST);
            $buscar = usuarios::get_persons_by_email($_POST['login']);
            if (empty($buscar)) 
            {

                echo "<script type='text/javascript'>
                    alert('Usuario o clave invalido');
                    window.location='".Conectar::ruta()."?e=2';
                </script>";
                
            }
            else
            {
                // "limpiamos" los campos del formulario de posibles códigos maliciosos
                $login = mysqli_real_escape_string($this->conex,$_POST['login']);
                $usuario_clave = mysqli_real_escape_string($this->conex,$_POST['pass']);
                //encripta lo que se envia por pass en md5.
                $password_recibida = md5(md5(md5($_POST["pass"])));
                $id_persona = $buscar[0]['person_email'];// modify
                // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
                $sql = mysqli_query($this->conex,"select * from users as u, people as g where u.id_group = g.person_type and u.id_status = '1' and g.person_email='".$id_persona."' and password='".$password_recibida."' and u.id_person= g.id_person");
			   if($row = mysqli_fetch_array($sql))
                {
					
					$_SESSION["usuario"]=$row["person_name"];

                    if ($row["id_group"]) 
                    {   
					

						$ruta="home/";
						
                        header("Location:".Conectar::ruta().$ruta);
                        $_SESSION["usuario_id"]=$row["id_user"];
                        $_SESSION["usuario_nom"]=$_POST["login"];
                        $_SESSION["level"]=$row["id_group"];
                        exit();
                    }
					
                }
                else
                {
                    echo "<script type='text/javascript'>
                        alert('El usuario y/o la contraseña no coinciden');
                        window.location='index.php';
                    </script>";
                    
                }
            }
        }
    }


    //////agrega usuarios a la app

    public function add_user()
    {


        $buscar = usuarios::get_persons_by_email($_POST['person_email']);

        if (empty($buscar)) 
        {  
            $filename='3';
            if($_FILES['person_img']['tmp_name'] !="")
            {       
                $id = parent::maxid('people','id_person');
                $filename=parent::upload_image('person_img',$_POST["max_size"],($id+1),'*images/people');
            }

            if ($filename != '2')
            {            
                if ($filename != '1')
                {
                    if ($filename != '0') 
                    {
                        if($_FILES['person_img']['tmp_name'] ==""){$filename=$_POST["person_img1"];}

                        $query=sprintf("insert into people values (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 0);", 
                        parent::comillas_inteligentes( $_POST["person_name"]),
                        parent::comillas_inteligentes( $filename ),
                        parent::comillas_inteligentes( $_POST["person_email"]),
                        parent::comillas_inteligentes( $_POST["person_phone"]),
                        parent::comillas_inteligentes( $_POST["person_social"]),
                        parent::comillas_inteligentes( $_POST["person_company"]),
                        parent::comillas_inteligentes( $_POST["person_position"]), 
                        parent::comillas_inteligentes( $_POST["person_type"]),  
                        parent::comillas_inteligentes( $_POST["person_check"]),
                        parent::comillas_inteligentes( $_POST["person_history"]) );
						//echo $query;
                        mysqli_query($this->conex,$query);
                        $id = mysqli_insert_id($this->conex);
                        if ( $id != 0 ) 
                        {  
                            $query=sprintf("insert into users values (null, %s, %s, %s, %s, %s);",
                            parent::comillas_inteligentes( $id ),
                            parent::comillas_inteligentes( md5(md5(md5($_POST["pass1"]))) ), 
                            parent::comillas_inteligentes( $_POST["person_type"]),   
                            parent::comillas_inteligentes( $_POST["person_check"]), 1 );
                            mysqli_query($this->conex,$query);

                            $id = mysqli_insert_id($this->conex);

                            
                            echo "<script type='text/javascript'>
                                    alert('The Client was Created successfully');
                                    window.location='';
                                  </script>"; 

                        }

                    }
                    else
                    {
                        echo "<script type='text/javascript'> 
                            alert('An error occurred while trying to upload the image, try again');   
                            window.location='_';        
                        </script>";  
                    }
                }
                else
                {
                    echo "<script type='text/javascript'> 
                        alert('The image exceeds the established weight, maximum allowed 200kb');    
                        window.location='';
                    </script>";
                }

            }
            else
            {
                echo "<script type='text/javascript'> 
                        alert('An error occurred while trying to create the record, the file must be an image'); 
                        window.location='';
                    </script>";
            }
        }    
        else
        {
            unset($buscar);

            echo "<script type='text/javascript'>
                alert('The email already exists in our Database');
                window.location='';
            </script>";
        }

    }

    

    //edita la informacion de los usuarios desde la tabla personas

    public function edit_user()
    {
        

    }



    //cambia el status de la tabla usuarios.
    public function delete_user()
    {

        $status = 2;

        $sql=sprintf("update users set id_status=%s where id_user=%s",        
        parent::comillas_inteligentes($status),
        parent::comillas_inteligentes( $_POST["id_person"])
        );

        mysqli_query($this->conex,$sql);

        echo "<script type='text/javascript'>
            alert('The Registry was successfully Deleted');
    		window.location='_users.php';
		</script>";
    }



    public function new_pass($name)
    {

        $id=$_POST["id"]; 

        //valida que los campos no esten vacios
        if( empty($_POST["password_new1"]) or empty($_POST["password_new2"]) )
        {
            echo "<script type='text/javascript'>
            alert('No puede haber campos vacios');
            window.location='".$name.".php';
            </script>";
        }
        else 
        {

            $id=$_POST["id"];
            $array_usuario = usuarios::get_user_by_id($id);

           /* $oldPass = $array_usuario[0]['password'];

            $pass_enviada=md5(md5(md5($_POST['password_actual'])));

            if ($pass_enviada==$oldPass) 
            {  */              
                $passnew1=md5(md5(md5($_POST["password_new1"])));
                $passnew2=md5(md5(md5($_POST["password_new2"])));

                //valida que la encriptacion de las contraseñas sea igual 
                if($passnew1!=$passnew2)
                {
                    echo "<script type='text/javascript'>
                    alert('La nueva contraseña no coinciden con su verificación');
                    window.location='".$name.".php';
                    </script>";
                }
                else
                {
                    //valida que la vieja contraseña sea distinta a la nueva
                    if ($oldPass!=$passnew1) 
                    {

                    $sql=sprintf("update users set password=%s where id_user=%s;",

                        parent::comillas_inteligentes($passnew1),
                        parent::comillas_inteligentes($id)

                    );

                    mysqli_query($this->conex,$sql);
                    echo "<script type='text/javascript'>
                    alert('Ha cambiado correctamente su contraseña');
                    window.location='".$name.".php';
                    </script>";

                    }
                    else
                    {
                        echo "<script type='text/javascript'>
                        alert('La contraseña nueva debe ser distinta a la vieja contraseña');
                        window.location='".$name.".php';
                        </script>";
                    }
                }
           /* }
            else
            {
                echo "<script type='text/javascript'>
                alert('Su contraseña actual no coincide');
                window.location='".$name.".php';
                </script>";
            }*/
        }     
    }

    public function enviar_correo_masivo($personas, $mensaje, $asunto)

    {

        for ($i=0; $i < count($personas) ; $i++) 
        { 
            Conectar::send_mail($personas[$i]['email'], $mensaje, $asunto);    
        }

        echo "<script type='text/javascript'>
            alert('Los correos se han enviado correctamente');
            window.location='personas_list.php';
            </script>";
    }

    public static function str_random() 
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,
        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    //Obtiene la contrasena
    public function get_pass($email)
    {   
        $pass=self::str_random();
        $person = usuarios::get_persons_by_email($email);
        $sql=sprintf("select id_user from users where id_status=1 and id_person = %s;",parent::comillas_inteligentes($person[0]['id_person']));
        $res=mysqli_query($this->conex,$sql);
        while ($reg=mysqli_fetch_assoc($res))
        {
            $this->user[]=$reg;
        }

        $sql="update users set password='".md5(md5(md5($pass)))."' where id_status=1 and id_user =".$this->user[0]['id_user'];
        $res=mysqli_query($this->conex,$sql);

        return $pass;        
    }

    public function forgot_pass()
    {
        $buscar = usuarios::get_persons_by_email($_POST['email']);

        if (empty($buscar)) 
        {
            echo "<script type='text/javascript'>
                alert('The email does not exist in our Database');
                window.location='personas_list.php';

            </script>";
        }
        else
        {
            $newpass = usuarios::get_pass($_POST['email']);
            $destino = $_POST['email'];
            $asunto  = " Password Recovery | The Visitor";
            $mensaje =  "Your password has been successfully re-established. To enter the site you must enter this temporary password: ". $newpass. "<br><br>Remember that when entering the platform you must change this password.";

            conectar::send_mail($destino, $mensaje, $asunto);

            echo "<script type='text/javascript'>
                alert('The new password has been sent to your email');
                window.location='index.php';

            </script>";

        }


    }

}
?>