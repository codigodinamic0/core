<?php
require_once("Connections/database.php");
require ("lib/functions.php");
require ("include/guardian.php");

$palabra = $_POST['palabra'];
$fecha2 = date("Y-n-j");
@session_start();

$valor=variable(4,1); 
$dominio = $valor[0];

$_SESSION['dominio']=$dominio;
$current_page=basename(htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"));
$pagiactual = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$active_menu =basename($pagiactual);
//verifico el idioma
if($_GET['idioma']){
    $idioma=$_GET['idioma'];
    $_SESSION['idioma']=$_GET['idioma'];
}elseif ($_SESSION['idioma'])
{
    $idioma = $_SESSION['idioma'];
} elseif ($_COOKIE["idioma"])
{
    $idioma = $_COOKIE["idioma"];
} else
{
    $idioma = 1;
}

$db->setNames("utf8");
//cuando llegue categoria capturo u titulo e imagen
$db->select("categoria,idmo","categoria.img,categoria.img1,categoria.nombre_categoria,categoria.descripcion_categoria,categoria.ubica_categoria,categoria.amigable_categoria,categoria.de,categoria.id_categoria,idmo.idioma","WHERE categoria.modulo=idmo.id_idmo AND (id_categoria='" .$_GET['categoria']."' OR amigable_categoria='".$_GET['amigable_categoria']."')");

$row_categoria = $db->fetch_array();
$cabe = $row_categoria['img'];
$categoria = $row_categoria['nombre_categoria'];
$des_categoria = $row_categoria['descripcion_categoria'];
$ubica_categoria = $row_categoria['ubica_categoria'];
$amigable_categoria = $row_categoria['amigable_categoria'];
$de = $row_categoria['de'];
$id_categoria = $row_categoria['id_categoria'];
$id_cat = $row_categoria['id_categoria'];
$img_categoria = $row_categoria['img'];
$img_categoria1 = $row_categoria['img1'];
$db->select("categoria", "img,nombre_categoria","WHERE id_categoria='" . sql_seguro($row_categoria['de']) ."' OR id_categoria='" . sql_seguro($_GET['grupo']) ."'");
if($db->num_rows()>0){
    $row_cat = $db->fetch_array();
    $img_grupo = $row_cat['img'];
    $grupo = $row_cat['nombre_categoria'];
}
//para detectar la carpeta de archivos
if ($_GET['id_idmo'] <> "" or $_GET['id_modulo'] <> ""){
    $db->select("idmo,modulo","idmo.nombre_idmo,modulo.nombre_modulo,modulo.codigo_modulo,idmo.nombre_idmo"," WHERE idmo.modulo=modulo.id_modulo AND ( id_idmo='" . sql_seguro($_GET['id_idmo']) . "' OR modulo.id_modulo='".sql_seguro($_GET['id_modulo'])."')");
    $row_modulo = $db->fetch_array();
    $carpeta = $row_modulo['nombre_modulo'];
    $id_matrix=$row_modulo['codigo_modulo'];
    $nombre_idmo=$row_modulo['nombre_idmo'];
    $id_modulo=$row_modulo['modulo'];
}
if ($_GET['id'] <> "" || $_GET['amigable_matrix'] <> ""){
    if($_GET['amigable_matrix'] <> ""){
        $db->select("matrix,modulo,idmo", "matrix.nombre_matrix,matrix.id_matrix,matrix.descripcion_matrix,matrix.seo_matrix,modulo.nombre_modulo,matrix.img_matrix,idmo.idioma","WHERE matrix.id_idmo=idmo.id_idmo and idmo.modulo=modulo.id_modulo AND (amigable_matrix='".sql_seguro($_GET['amigable_matrix'])."')");
    }
    if($_GET['id'] <> ""){
        $db->select("matrix,modulo,idmo", "matrix.nombre_matrix,matrix.id_matrix,matrix.descripcion_matrix,matrix.seo_matrix,modulo.nombre_modulo,matrix.img_matrix,idmo.idioma","WHERE matrix.id_idmo=idmo.id_idmo and idmo.modulo=modulo.id_modulo AND (id_matrix='".sql_seguro($_GET['id'])."')");    
    }
    $row_matrix = $db->fetch_array();
    $carpeta = $row_matrix['nombre_modulo'];
    $titulo = $row_matrix['nombre_matrix'];
    $id_matrix= $row_matrix['id_matrix'];
    $descripcion_sitio = $row_matrix['descripcion_matrix'];
    $seo = $row_matrix['seo_matrix'];
    if ($row_matrix['img_matrix']){
        $metaimg='<meta property="og:image" content="'.$dominio.'imagenes/'.$carpeta.'/imagen1/'.$row_matrix['img_matrix'].'"/>';
        $linkimagen='<Link  rel = "image_src"  href ="'.$dominio.'imagenes/'.$carpeta.'/imagen1/'.$row_matrix['img_matrix'].'"/>';
    }

}else if($_GET['categoria'] <> "" or $_GET['amigable_categoria'] <> ""){
    $titulo = $row_categoria['nombre_categoria'];
    $descripcion_sitio = $row_categoria['descripcion_categoria'];
    
}elseif ($_GET['grupo']){
    $db->select("categoria","id_categoria,nombre_categoria,descripcion_categoria,img, img1","where id_categoria='".sql_seguro($_GET['grupo'])."'");
    $row_grupo = $db->fetch_array();
    $grupo = $row_grupo['id_categoria'];
    $titulo = $row_grupo['nombre_categoria'];
    $descripcion_sitio = $row_grupo['descripcion_categoria'];
    $img_categoria = $row_grupo['img'];
    $img_categoria1 = $row_grupo['img1'];
    
} elseif ($_GET['id_idmo']){
    $db->select("idmo,modulo","idmo.nombre_idmo,idmo.idioma,modulo.nombre_modulo,modulo.descripcion_modulo","WHERE idmo.modulo=id_modulo AND id_idmo='".sql_seguro($_GET['id_idmo'])."'");
    $row_modulo = $db->fetch_array();
    $titulo = $row_modulo['nombre_idmo'];
    /*
    $valor = idioma(1, $idioma, 26);
    $descripcion_sitio = $valor[1];
    */
    $descripcion_sitio = $row_modulo['descripcion_modulo'];
    $carpeta = $row_modulo['nombre_modulo'];
    
} elseif ($_GET['id_modulo']){
    $db->select("modulo,idmo","modulo.*,idmo.nombre_idmo ","WHERE id_modulo='".sql_seguro($_GET['id_modulo'])."' AND idmo.modulo=modulo.id_modulo AND idmo.idioma='".$idioma."'");
    $row_modulo = $db->fetch_array();
    $titulo = $row_modulo['nombre_idmo'];
    /*
    $valor = idioma(1, $idioma, 26);    
    $descripcion_sitio = $valor[1];
    */
    $descripcion_sitio = $row_modulo['descripcion_modulo'];
} else{
    $valor = idioma(1, $idioma, 26);
    $titulo = $valor[0];
    $descripcion_sitio = $valor[1];
}
if  (!$descripcion_sitio){
	$valor = idioma(1, $idioma, 26);
	 $descripcion_sitio = $valor[1]; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php if ($metaimg) {echo $metaimg; 
echo $linkimagen; } else {?>
<meta property="og:image" content="<?php echo $dominio ?>logo.png"/><Link rel = "image_src" href = "<?php echo $dominio ?>logo.png" />
<?php }?>
<meta name="description" content="<?php echo substr(strip_tags($descripcion_sitio),0,180); ?>" />
<meta name="keywords" content="<?php if (!$seo)
{ $valor = idioma(2, $idioma, 26);
echo $valor[0];
} else
{ echo $seo; } ?>">
<meta charset="utf-8" />
<meta property="fb:app_id" content="{214333568724952}"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="DC.title" content="Core +" />
<meta name="geo.region" content="CO-ANT" />
<meta name="geo.placename" content="Medell&iacute;n" />
<meta name="geo.position" content="6.235925;-75.575137" />
<meta name="ICBM" content="6.235925, -75.575137" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $titulo ?> </title>

<!-- CSS  -->

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo $dominio;?>css/font-awesome-4.6.3/css/font-awesome.min.css">  

  <link href="<?php echo $dominio;?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>owl.carousel/assets/owl.carousel.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>owl.carousel/assets/owl.theme.default.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>css/animate.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>css/default.css" />

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>css/component.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>css/lightslider.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $dominio;?>css/circle.css">

  <link href="<?php echo $dominio;?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <script src="<?php echo $dominio;?>js/jquery-1.11.3.min.js"></script>

  <script type="text/javascript" src="<?php echo $dominio;?>js/angular.min.js"></script>

  <script type="text/javascript" src="<?php echo $dominio;?>js/materialize.min.js"></script>

  <script src="<?php echo $dominio;?>js/angular-materialize.js"></script>

  <script type="text/javascript" src="<?php echo $dominio;?>owl.carousel/owl.carousel.js"></script>

  <script type="text/javascript" src="<?php echo $dominio;?>js/lightslider.js" ></script>

 <script src="<?php echo $dominio;?>js/init.js"></script>

<?php
    if($idioma == 2){
?>
        <script type="text/javascript" src="<?php echo $dominio; ?>js/formValidate-en.js" ></script>
<?php
    }else{
?>
        <script type="text/javascript" src="<?php echo $dominio; ?>js/formValidate-es.js" ></script>
<?php        
    }
?>

<script type="text/javascript" src="<?php echo $dominio; ?>js/formValidate.js" ></script>
<link rel="stylesheet" href="<?php echo $dominio; ?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo $dominio; ?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $dominio; ?>lib/alerta_css/sweetalert.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo $dominio; ?>lib/alerta_css/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var dominio = '<?php echo $dominio ?>';
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55b0039d5a8abee9"></script>
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51eef2d10f08b5a5"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'right',
      'numPreferredServices' : 6
    }   
  });
  
</script>
-->
<!-- favicon links -->
<link rel="icon" type="image/ico" href="<?php echo $dominio; ?>favicon.ico" />

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
</script>
<?php include "include/scripts.php"; ?>
</head>