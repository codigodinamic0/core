<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<?php if ($_SESSION['roll']==100) 
{
?>
	<script type="text/javascript">
	location.href="registro.php";
	</script>
<?php
} 
 ?>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
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
		<h2>Bienvenido <?php echo $_SESSION['nombre_usuario'] ?></h2>
		<p id="page-intro">&iquest;Qu&eacute; le gustar&iacute;a hacer?</p>
		
		<ul class="shortcut-buttons-set">
	  	<li>
				<a class="shortcut-button" href="usuario.php">
					<span>
		  			<img src="imgs/paper_content_pencil_48.png" alt="icon" /><br />
		  			Ingresar Digitadores</span>
		  	</a>
		  </li>
			
			<li>
				<a class="shortcut-button" href="palabra_matriz.php?idr=1">
					<span>
						<img src="imgs/paper_content_pencil_48.png" alt="icon" /><br />
						Palabras por idiomas del sitio
					</span>
				</a>
			</li>
		</ul>
		<!-- End .shortcut-buttons-set -->
		
    <div class="clear"></div> <!-- End .clear --><!-- End .content-box --><!-- End .content-box --><!-- End .content-box -->
		<div class="clear"></div>		
		
		<!-- Start Notifications --><!-- End Notifications -->		
		<?php include('pie.php'); ?>		
	</div> <!-- End #main-content -->
		
</div>
</body>
  
</html>

