<?php
session_start();
/*
require_once('../Connections/connection.php'); 
$link = Connect();
*/
$matriz_url="http://mercadeoeninternet.net";  
$pagina="Panel administrativo"; 
if ($_SESSION['roll']==100) 
{
?>
	<script type="text/javascript">
	location.href="registro.php";
	</script>
<?php
} elseif($_SESSION['roll']!="") {
?>
 	<script type="text/javascript">
	location.href="panel.php";
	</script>
<?php
}
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
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		
	<!-- Internet Explorer .png-fix -->
	
	<!--[if IE 6]>
		<script type="text/javascript" src="js/DD_belatedPNG_0.0.7a.js"></script>
		<script type="text/javascript">
			DD_belatedPNG.fix('.png_bg, img, li');
		</script>
	<![endif]-->
	
</head>
  
<body id="login">
	<div id="login-wrapper" class="png_bg">
		<div id="login-top">
		<div id="mensaje-panel-alert" class="mensaje-panel-alert hide"></div>
		<!-- Logo (221px width) -->
		<a href="<?php echo $matriz_url ?>" target="_blank"><img id="logo" src="imgs/logo-codigo.png" alt="Panel Administrativo" /></a> </div> 
		<!-- End #logn-top -->			
		<div id="login-content" class="login-content" style="width: 450px;">
			<h1 style="position: inherit;">Restablecer su contraseña</h1></br>
			<p>Envíe su dirección de correo electrónico y le reenviaremos un mensaje con una clave para ingresar al sistema</p></br></br></br>
			<form name="form1" method="post" action="" id="form-remember-psw">
		  		<p style="text-align:center;">
					<label>Email: </label>
				  	<input type="email" required class="text-input" name="email" style="float:left;"/>
					<input class="button" type="submit" value="Enviar" style="display: inline-block; float: left; margin: 0 10px; "/>
				</p>
			  						
			</form>
		</div> <!-- End #login-content -->			
	</div> <!-- End #login-wrapper -->
	<script type="text/javascript">
		$(document).ready(function() {
			console.log("entro");
			$("#form-remember-psw").submit(function(){
				var email = $("#form-remember-psw").find("input").val();
				if(email != null && email != ""){
					$.ajax({
			           type: "POST",
			           url: "lib/server.php",
			           data: {
			           		action : "remember_psw",
			           		email : email 
			           }, // Adjuntar los campos del formulario enviado.
			           success: function(data)
			           {
			               if(data["msg"]==1){
			               		$("#mensaje-panel-alert").empty();
			               		$("#mensaje-panel-alert").append('A su email se acabo de enviar una nueva clave, por favor revise.');
			               		$("#mensaje-panel-alert").show();
			               		setTimeout(function(){
									$("#mensaje-panel-alert").hide();
								},5000);
			               }else if(data["msg"]==2){
			               		$("#mensaje-panel-alert").append('Ocurrio un problema. Por favor informe al administrador');
			               		$("#mensaje-panel-alert").show();
			               		$("#mensaje-panel-alert").empty();
			               		setTimeout(function(){
									$("#mensaje-panel-alert").hide();
								},10000);
			               }else if(data["msg"]==3){
			               		$("#mensaje-panel-alert").empty();
			               		$("#mensaje-panel-alert").append('No hay un usuario registrado con este email.');
			               		$("#mensaje-panel-alert").show();
			               		setTimeout(function(){
									$("#mensaje-panel-alert").hide();
								},5000);
			               }else if(data["msg"]==4){
			               		$("#mensaje-panel-alert").empty();
			               		$("#mensaje-panel-alert").append('Ocurrio un problema. No se pudo enviar el mensaje. Por favor informe al administrador');
			               		$("#mensaje-panel-alert").show();
			               		setTimeout(function(){
									$("#mensaje-panel-alert").hide();
								},10000);
			               }
			           }
			        });
		        }else{
		        	$("#mensaje-panel").append('Por favor ingrese un email');
		        	setTimeout(function(){
						$("#mensaje-panel").hide();
					},3000);
		        } 
		    	return false; // Evitar ejecutar el submit del formulario.
	 		});
		});
	</script>	
  </body>  
</html>
