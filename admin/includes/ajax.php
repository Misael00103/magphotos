<?php
include 'config.php';
include 'allPages.php';
include 'menuModel.php';
include 'allPanama.php';
include 'companiaModel.php';
include('validate.php'); 

$bl = new pages;
$menu = new menu;
  $imp = new alldestinos;
$compa = new compania;

  $compania=$compa->get_compania();
  $nombempresa=$compania[0]["nombre_compania"];
  $email_compania=$compania[0]["email_compania"];
  $email2_compania=$compania[0]["email2_compania"];
  $telefono_compania=$compania[0]["telefono_compania"];
  $direccion_compania=$compania[0]["direccion_compania"];
  $web_compannia=$compania[0]["web"];
  $moneda_def=$compania[0]["moneda"];
  
$palabraclave = strval($_POST['busqueda']);
$id_page = strval($_POST['id_page']);
$operacion = strval($_POST['operacion']);
$Resultado=array();
$i=0;
			if($operacion =="PAGES"){

		if($palabraclave){
    $pages = $bl->get_pages_limit($id_page, $palabraclave, 30 );	
	          for ($i=0; $i < count($pages); $i++) {
				$Resultado[] ="page-".$pages[$i]['name_page'];
			  }
		}
		
			echo json_encode($Resultado);
			
			}
			elseif($operacion =="PADRE"){

		if($palabraclave){
    $padre = $menu->get_menu_limit('', '', $palabraclave, 30);	
	          for ($i=0; $i < count($padre); $i++) {
				$Resultado[] =$padre[$i]['id_menu']." | ".$padre[$i]['name_menu'];
			  }
		}
		
			echo json_encode($Resultado);
			}elseif($operacion =="ARTICLES"){

		if($palabraclave){
	$bloglist =    $imp->get_blog_articlesX($palabraclave, 15);	
	          for ($i=0; $i < count($bloglist); $i++) {
				$Resultado[] =$bloglist[$i]['id_blogs']." | ".$bloglist[$i]['article_title'];
			  }
		}
		
			echo json_encode($Resultado);
			}elseif($operacion =="ARTICLES2"){

		if($palabraclave){
	$bloglist =    $imp->get_blog_articlesX($palabraclave, 15);	
	          for ($i=0; $i < count($bloglist); $i++) {
				$Resultado[] =$bloglist[$i]['article_title'];
			  }
		}
		
			echo json_encode($Resultado);
			}elseif($operacion =="MODEL"){

		if($palabraclave){
	$bloglist =    $imp->get_medel($palabraclave);	
	          for ($i=0; $i < count($bloglist); $i++) {
				$Resultado[] =$bloglist[$i]['model'];
			  }
		}
		
			echo json_encode($Resultado);
			}elseif($operacion =="MAKE"){

		if($palabraclave){
	$bloglist =    $imp->get_article_author($palabraclave);	
	          for ($i=0; $i < count($bloglist); $i++) {
				$Resultado[] =$bloglist[$i]['article_author'];
			  }
		}
		
			echo json_encode($Resultado);
			}
			
			elseif($operacion =="FILTRARART"){
				$search=$_POST['search-criteria'];
				$year=$_POST['year'];
				$cat=$_POST['cat'];
				$marca=$_POST['marca'];
				$model=$_POST['model'];
				$preciomin=$_POST['preciomin'];
				$preciomax=$_POST['preciomax'];
                $bloglist = $imp->get_blog_article_filtrar($cat, $search, $year, $marca, $model, $preciomin, $preciomax, 50);
			//	echo "pasooo";
				$respuesta='<div class="resp-tabs-container">
				 <div id="pagination-1" class="pastlistsubgrid" style="display:flex;flex-wrap:wrap;align-content:space-between;">
				';
					if(count($bloglist)>0){
                for ($n=0; $n < count($bloglist); $n++) 
                { 
				
	
$respuesta .='<div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                      					<a class="tituloart" href="items/'.$bloglist[$n]['id_blogs'].'/'.urls_amigables($bloglist[$n]["article_title"]).'">
  <img src="images/art/'.$bloglist[$n]['article_picture'].'" alt="" class="pro-image-front">
                        <img src="images/art/'.$bloglist[$n]['article_picture'].'" alt="" class="pro-image-back">
                        <span class="product-new-top">'.$bloglist[$n]['namesub'].'</span>
						</a>
                   
				   </div>
					<div class="item-info-product ">
                        <h4><a class="tituloart" href="items/'.$bloglist[$n]['id_blogs'].'/'.urls_amigables($bloglist[$n]["article_title"]).'">
                        '.$bloglist[$n]['article_title'].'</a></h4>
						<h5 class="markart" style="display:none;">'.$bloglist[$n]['article_author'].'</h5>
						<h5 class="madelclass" style="display:none;">'.$bloglist[$n]['model'].'</h5>
						<h5 class="yearclass" style="display:none;">'.$bloglist[$n]['year'].'</h5>
                        <div class="info-product-price">
                         
                          <span> '.$moneda_def.'</span> <span class="item_price"> '.$bloglist[$n]['issueno'].' </span>

						</div>
						                          <small style="color:#3BB349;font-weight: bold;">'.$bloglist[$n]['article_author'].' | '.$bloglist[$n]['model'].'</small>

                    </div>
                    </div>
                </div>';
			  }
					}else{
				$respuesta .='<div class="clearfix"><h2>not result</h2></div>';
					}

			$respuesta .='<div class="clearfix"></div>
			</div>

			</div>';
			
			echo 	$respuesta;
			}

	?>