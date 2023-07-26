<?php 
  include('../../admin/includes/config.php');
  include('../../admin/includes/usersModel.php');
  include('../../admin/includes/allPanama.php');
  include('../../admin/includes/validate.php');
    validate_user2();
	  $bl = new alldestinos;
	 $subjects = $bl->get_all_subjects();
	 $bloglist = $bl->get_blog_articles_subjectscat(0,0, 1, '-1');
	
	 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <title>Porfafolios-MAGphotos</title>
</head>

<body>

    <div class="contenedor">
        <header>
            <div class="logo">
                <h1>MAGphotos</h1>
                <p>Photo Studio</p>
            </div>
            <form action="">
                <input type="text" class="barra-busqueda" id="barra-busqueda" placeholder="Buscar">
            </form>
            <div class="categorias" id="categorias">
                <a href="#" class="activo">Todos</a>
				
				<?php  
              for ($m=0; $m < count($subjects); $m++) { 
    
                  ?>
				  
                <a href="#<?=$subjects[$m]["idsuj"]; ?>"><?=$subjects[$m]["namesub"]; ?></a>
				
				<?php  
              }
    
                  ?>
            </div>
        </header>

        <section class="grid" id="grid">
		    <?php  
          $j=0;
            for ($i=0; $i < count($bloglist); $i++) { ?>
            <div class="item"  data-categoria="<?=strtolower($bloglist[$i]["namesub"]); ?>" data-etiquetas="<?=$bloglist[$i]["article_title"]; ?>" data-descripcion="<?=$bloglist[$i]['article_title']; ?>">
                <div class="item-contenido">
                    <img blogs="<?=strtolower($bloglist[$i]["id_blogs"]); ?>" src="imagenes/<?=$bloglist[$i]['article_picture']; ?>" title="<?=$bloglist[$i]["namesub"]; ?>">
				
                </div>
            </div>
			
			 <?php  
			}
			?>

            
        </section>

        <section class="overlay" id="overlay">
            <div class="contenedor-img">
                <button id="btn-cerrar-popup"><i class="fas fa-times"></i></button>
                <img src="" alt="">
            </div>
            <p class="descripcion"></p>
            <p class="agregar"></p>
        </section>

        <footer class="contenedor">
            <div class="redes-sociales">
                <div class="contenedor-icono">
                    <a href="https://twitter.com/MisaelBeriguete" target="_blank" class="twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
                <div class="contenedor-icono">
                    <a href="https://www.facebook.com/Misael2508/" target="_blank" class="facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
                <div class="contenedor-icono">
                    <a href="https://www.instagram.com/misaeel_7/" target="_blank" class="instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="creado-por">
                <p>Sitio diseñado por <a href="#">MisaelDevloper</a> - <a href="https://misaelportafolio.netlify.app/">MisaelDevloper</a></p>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
    <script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
	<script src="../../admin/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <script src="main.js"></script>
</body>

</html>