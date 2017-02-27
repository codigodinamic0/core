<div id="sidebar">
	<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
		<h1 id="sidebar-title"><a href="#"><?php $valor=variable(26,2); echo $valor[0]; ?></a></h1>
		<!-- Logo (221px wide) -->
		<a href="<?php echo $matriz_url ?>" target="_blank">
			<img src="imgs/logo-codigo.png" name="logo" width="77" border="0" id="logo" />
		</a>
		<!-- Sidebar Profile links -->
		<div id="profile-links">
			<?php $valor=variable(20,2); echo $valor[0]; ?>, <a href="#" title="<?php echo $_SESSION['nombre_usuario'] ?>"><?php echo $_SESSION['nombre_usuario'] ?></a>
			<a href="panel.php" class="home"><?php $valor=variable(9,2); echo $valor[0]; ?></a> | 
			<a href="close.php" class="salir" title="Sign Out"><?php $valor=variable(25,2); echo $valor[0]; ?></a>
		</div>

		<ul id="main-nav">  <!-- Accordion Menu -->
		
			<li><a href="#" class="nav-top-item">Candidatos</a>
				<ul>
					<?php

						$arr_opt = array();
						$db->select("menu_r", "*", "WHERE menu_r.idr=103 ORDER BY menu_r.nombre_l");
						while($arraypadre = $db->fetch_array()){
							$arr_opt[] = $arraypadre; 
					    }
					    foreach ($arr_opt as $row_opt){
					?>
					<li>
						<a href="<?php echo $row_opt['url']?>"><?php echo $row_opt['nombre_l']; ?></a>
					</li>
					<?php //FIN ROW2
						}
					?>
				</ul>
			</li>
			
		


	  </ul>
	</li>
	<!-- fin departamentos para ver ciudades  -->
</ul> <!-- End #main-nav -->
</div>
</div>