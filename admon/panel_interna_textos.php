<?php 
require_once('include_mysqli.php');  
$idr = $_GET["id"];
session_start(); 

if (!isset($_SESSION["id_usuario"])) {?><script>window.location="logeo.php?msg=1"</script> <? } 

$msg="";
$action="";

if (isset($_GET['action']) ) $action = $_GET['action'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
		<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Simpla Admin</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="js/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="js/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="js/jquery.datePicker.js"></script>
		<script type="text/javascript" src="js/jquery.date.js"></script>
		<!--[if IE]><script type="text/javascript" src="js/jquery.bgiframe.js"></script><![endif]-->

		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="js/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
        
        <link rel="stylesheet" href="css/formato_textos.css" type="text/css" />
		
	</head>
  
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<?php include('menu_izq.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<p class="punteado"><strong>Bienvenido C&oacute;digodin&aacute;mico</strong></p>
			<div class="miga">
            	
                <a href="#">Inicio</a>  <a href="#" class="flecha_miga">Videos</a> <a href="#" class="flecha_miga">Video_15_anios</a>
            
            <div class="clear"></div>
            <h2>Editando contenido <span class="urgente">Videos</span></h2>
            </div>
            
            
            
            <div class="clear"></div> <!-- End .clear -->
			
            <div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Usted est&aacute; editando la secci&oacute;n de videos.</div>
			</div>
            
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 class="titu_secc">Formatos de textos</h3>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
                
                	<p class="titu_secc">T&iacute;tulo para secci&oacute;n</p> <br />
                	
                    
                    <span>Titulo para categoria</span>
                	<p class="titu_cat">Categoria (4)</p>   <br /><br />
                    
                    <span>Clases para items, para títulos de contenidos</span>
                    
                    <p class="punteado">Texto borde inferior punteado</p>
                    
                    <p class="urgente">Texto rojo</p>
                    
                    <p class="doc"><strong>Contenido disponible</strong></p>
                    
                    <p class="doc_proteg">Contenido protegido</p>
                    
                    <p class="doc_destacado">Contenido item destacado</p>
                    
                    <a href="#" title="title" class="txt_ingresar txt_verde">Ingresar producto</a>   	
                    
                    <br /><br />

                    
                    <span class="destacado">Destacado</span>
                    
                    <span class="destacado_verde">Destacado</span>
                    
                    <br />
                    <br class="clear" />
                	
                    <a href="#" class="subir txt_verde">Subir archivo</a>
                    
                    <br class="clear" />
                    
                    <a href="#" class="subir_foto txt_verde">Subir Foto</a>
                    
                    <br class="clear" />
                    
                    <a href="#" class="subir_musica txt_verde">Subir MP3</a>
                    
                    <br class="clear" />
                    
                    <p class="avi">Video avi</p>
                    <p class="excel">Archivo excel</p>
                    <p class="exe">Archivo .exe</p>
                    <p class="mpg">VIdeo formato mpg</p>
                    <p class="pdf">Archivo PDF</p>
                    <p class="pp">Archivo Powerpoint</p>
                    <p class="word">Archivo Word</p>
                    <p class="zip">Archivo ZIP</p>
                    
                    <div class="clear"></div>
                    
                    <a href="#" class="editar">Editar</a>
                    <br class="clear" />
                    <a href="#" class="borrar">Borrar</a>
                    <br class="clear" />
                    <a href="#" class="herramientas">Herramientas</a>
                    <br class="clear" />
                     <a href="#" class="img_sec">Añadir imagenes secundarias</a>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
			
			<?php include('pie.php'); ?>
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>

