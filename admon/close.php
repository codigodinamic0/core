<? 
/*require_once('../Connections/connection.php'); 
$link = Connect();
*/
$matriz_url="http://satis.com.co/";  
$pagina="Panel administrativo";
session_start(); 
session_destroy();
if (!isset($_SESSION["id_usuario"])) {?><script>window.location="index.php?msg=1"</script> <? }  
 ?>
 <?php include('../lib/funciones.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
		<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $pagina ?></title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
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
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="js/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		
	</head>
  
	<body id="login">
		<?  
$msg="";
if(isset($_GET['msg'])) $msg=$_GET['msg'];

if($msg=="1") $msg="Login/Password incorrectos, favor verificar";
?>



		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			<p align="center" class="campos_style"><?= $msg?></p>
				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<a href="<?php echo $matriz_url ?>" target="_blank"><img src="imgs/logo-codigo.png" alt="Panel Administrativo" id="logo" /></a> </div> 
			<!-- End #logn-top -->
			
			<div id="login-content">
				
				<form name="form1" method="post" action="logeo2.php">
				  <p>
					<label>
                    <?php $valor=variable(4,2); echo $valor[0]; ?>
					</label>
					  <input type="text" class="text-input" name="login"/>
					</p>
				  <div class="clear"></div>
				  <p>
				  <label>
                  <?php $valor=variable(5,2); echo $valor[0]; ?>
				  </label>
					  <input type="password" class="text-input" name="password" />
					</p>
					
				  <div class="clear"></div>
					<p>
						<a href="recordar_contrasena.php" style="color: #5499C7; padding: 20px 5px; display: inline-block;">Recordar Password</a>
						<input class="button" type="submit" value="<?php $valor=variable(3,2); echo $valor[0]; ?>" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
  
</html>
