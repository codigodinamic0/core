<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<script type="text/javascript">
	<!--
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
	//-->
</script>
<?php 
	$id=$_GET['id'];
	$idr=$_GET['idr'];
	$op=$_GET['op'];
	$t1="usuario";
	$valor=variable(7,2); 
	$modulo=$valor[0];

	if ($op=="1" && $_POST['login']<>"" ){ 
		/*validar que el email sea unico*/
		$db->select($t1, "id_usuario", "WHERE email='" . $_POST['email'] . "'");
		if($db->num_rows() > 0){
			$row = $db->fetch_assoc();
			if($row['id_usuario'] != $_POST['id']){
?>
				<script type="text/javascript">
					alert("Ya existe un usuario con este correo");
					window.location="<?= $_SERVER['PHP_SELF']?>?id=<?php echo $_POST['id']; ?>op=4";
					
				</script>
<?php
				exit;
			}
		}
		
		$sql = "UPDATE $t1 set login='" . sql_seguro($_POST['login']) . "'";
		if($_POST['password']){
			$sql = $sql . ", password= '" . hash_password($_POST['password']) . "'";
		}
		$sql = $sql . ", nombre_usuario= '" . sql_seguro($_POST['nombre_usuario']) . "'";
		$sql = $sql . ", email= '" . sql_seguro($_POST['email']) . "'";
		$sql = $sql . ", tipo= '" . sql_seguro($_POST['tipo']) . "'";
		$sql = $sql . " where id_usuario= '" . sql_seguro($_POST['id']) . "'";
		/*$res = @mysql_query($sql); if (!$res) { exit(mysql_error());*/
		$updatecontenido = $db->prepare($sql);
		$updatecontenido->execute();
		$updatecontenido->close();
	
?>
			<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=2";</script>
<?php
	}
?>

<?php 
	if ($op=="2" && $_POST['login']<>"" && $_POST['password']<>"") {

		/*validar que el email sea unico*/
		$db->select($t1, "email", "WHERE email='" . $_POST['email'] . "'");
		
		if($db->num_rows() <= 0 ){
			$sql = "INSERT INTO $t1(login, password, nombre_usuario, email, tipo) values ";
			$sql = $sql . " ('" . sql_seguro($_POST['login']) . "'";
			$sql = $sql . " ,'" . hash_password(sql_seguro($_POST['password'])). "'";
			$sql = $sql . " ,'" . sql_seguro($_POST['nombre_usuario']). "'";
			$sql = $sql . " ,'" . sql_seguro($_POST['email']). "'";							 
			$sql = $sql . " ,'" . sql_seguro($_POST['tipo']) . "')";

			//echo $sql;
		/*
			$res = @mysql_query($sql); if (!$res) { exit(mysql_error()); } 
			$id_generado = mysql_insert_id();
			*/

			$insertmatrix = $db->prepare($sql);
		  	$insertmatrix->execute();
		  	$id_generado = $insertmatrix->insert_id;
		  	$insertmatrix->close();
?>
			<script>window.location="<?= $_SERVER['PHP_SELF']?>?msg=1";</script>
<?php
		}else{
?>
			<script type="text/javascript">
				alert("Ya existe un usuario con este correo");
				window.location="<?= $_SERVER['PHP_SELF']?>";
			</script>
<?php
		}

 }?>


<?php if ($op=="3") { 

	$db->delete($t1,"where id_usuario='" . $_GET['idb'] . "'");
?>
<script>window.location="<?= $_SERVER['PHP_SELF']?>?op=4&msg=3&idr=<?php echo $idr ?>";</script>

<?php }?>

<?php 
	if ($id<>""){
		$op=1;
	}else{
		$op=2;
	}
?>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<?php include('menu_izq.php'); ?>
	<div id="main-content"> <!-- Main Content Section with everything -->
		<div id="miga">
			<noscript><!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						<?php $valor=variable(22,2); echo $valor[1]; ?>
					</div>
				</div>
			</noscript>
			<?php 
				if ($msg<>"") {
					if ($msg=="1"){ $valor=variable(16,2);$msg=$valor[0];}
					if ($msg=="2"){ $valor=variable(17,2);$msg=$valor[0];}
					if ($msg=="3"){ $valor=variable(18,2);$msg=$valor[0];}
					if ($msg=="4"){ $valor=variable(19,2);$msg=$valor[0];}
			?>
					<div class="notification success png_bg">
						<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div><?php echo $msg; ?></div>
					</div>
			<?php
				}
			?>
			<p class="punteado"><strong>
				<?php $valor=variable(8,2); echo $valor[0]; ?>&nbsp;   
				<?php echo $_SESSION['nombre_usuario']; ?>
			</strong></p>
			<div class="miga">
				<a href="panel.php"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  <a href="#" class="flecha_miga"><?php echo $modulo ?></a>
				<div class="clear"></div>
				<h2>
					<?php
						if($id){
							$valor=variable(2,2);
							echo $valor[0];
						}else{
							$valor=variable(3,2);
							echo $valor[0];
						}
					?>
						<span class="urgente">
							<?php
								echo $modulo;
							?> 
                    		<?php
	                    		$db->select($t1, "*", "WHERE id_usuario='" . $_GET['id'] . "'");
	                    		$row = $db->fetch_assoc();
                    		?>
                    		<?php
                    		echo $row["nombre_usuario"];?>
                    	</span>
                </h2>
            </div>
            <div class="clear"></div>
            <!-- End .clear -->
			
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					<?php $valor=variable(23,2); echo $valor[1]; ?>
				.</div>
			</div>
		</div>


		<div class="clear"></div> <!-- End .clear -->
		<div class="content-box"><!-- Start Content Box -->
			<div class="content-box-header">
				<h3 class="img_admin"><?php echo $modulo; ?></h3>
					<!--
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>
					-->
				<div class="clear"></div>
			</div> <!-- End .content-box-header -->
			<div class="content-box-content"><!-- End #tab1 -->
				<form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" name="usuarios" id="usuarios">
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
						<label>
							<?php $valor=variable(10,2); echo $valor[0]; ?>
							<?php echo $modulo; ?>
						</label>
						<input name="nombre_usuario" type="text" class="text-input small-input"  id="nombre_usuario" value="<?= $row["nombre_usuario"]?>" size="32" />
						</p>
						<label>
							<?php $valor=variable(4,2); echo $valor[0]; ?>
						</label>
						<input name="login" type="text" class="text-input small-input"  id="login" value="<?= $row["login"]?>" size="32" />
						</p>
						<p>
							<label>
								<?php $valor=variable(5,2); echo $valor[0]; ?>
								<?php echo $modulo; ?>
							</label>
							<input name="password" type="text" class="text-input small-input" id="password" value="" size="32" />
						</p>
						<p>
							<label>
								Email
								<?php echo $modulo; ?>
							</label>
							<input name="email" type="email" class="text-input small-input" id="password" required value="<?= $row["email"]?>" size="32" />
						</p>
						<p>
							<label> 
								<?php $valor=variable(184,2); echo $valor[0]; ?>
								<?php echo $modulo; ?>
							</label>
							<select name="tipo" class="small-input" id="tipo">
							<?php
								if($_SESSION['roll']==20) {
									$ter=" AND id_tipo=20";
								}
					        	$arr_tipo = array();
					        	$db->select("tipo", "*", "WHERE idr=9".$ter);
					        	while($arraypadre = $db->fetch_array()){
									$arr_tipo[] = $arraypadre; 
						    	}
						    	foreach ($arr_tipo as $row_banco){
				        	?>
				        			<?php 
				        				if ($row["tipo"] == $row_banco['id_tipo']) { 
		        					?>
		        							<option value="<?= $row_banco['id_tipo'];?>" selected="selected">
		        								<?php echo $row_banco['nombre_tipo'];?>
		        							</option>
        							<?php
        								}
        								else{
									?>
											<option value="<?= $row_banco['id_tipo'];?>">
												<?php echo $row_banco['nombre_tipo'];?>
											</option>
									<?php
										}
									?>
							<?php
								}
							?>
							</select>
						</p>
						<p>
							<input class="button" type="submit" value="<?php if($id){$valor=variable(2,2); echo $valor[0];} else{$valor=variable(3,2); echo $valor[0];}?>
							<?php echo $modulo; ?>" />
							<input name="id" type="hidden" id="id" value="<?= $row["id_usuario"]?>" /><br />
						</p>
					</fieldset><!-- End .clear -->
				</form>

				<!-- inicio lista -->
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box"><!-- Start Content Box -->
					<div class="content-box-header">
						<h3 class="titu_secc">
							<?php $valor=variable(11,2); echo $valor[0]; ?>
							<a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a>
						</h3>
						<div class="clear"></div>
					</div> <!-- End .content-box-header -->
					<div class="content-box-content">
						<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
							<!--<div class="notification attention png_bg">
								<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
								<div>
									This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
								</div>
							</div>-->
							<table>
								<tfoot>
									<tr>
										<td colspan="5">
											<!-- End .pagination -->
										</td>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td valign="top">
											<a href="#" title="title" class="txt_verde">
											<?php $valor=variable(10,2); echo $valor[0]; ?>
											<?php echo $modulo; ?></a>
										</td>
										<td>
											<a href="#" title="title" class="txt_ingresar">
												<span class="txt_verde">
													<?php $valor=variable(4,2); echo $valor[0]; ?>
												</span>
											</a>
										</td>
										<td class="txt_verde"><?php $valor=variable(14,2); echo $valor[0]; ?></td>
									</tr>                         
									<?php
										if($_SESSION['roll']==20){
											$rer=" and id_usuario='".$_SESSION['id_usuario']."' ";
										}
										$TAMANO_PAGINA =$_SESSION['paginador']; 
										$inicio = 0; 
										$pagina=1; 
										$texto="";
										if ($_SESSION['pag']) {
											$pagina = $_SESSION['pag'];
											$inicio = ($pagina - 1) * $TAMANO_PAGINA;
										} 
				
	 									/*
										$sql= "SELECT * FROM $t1 where id_usuario>1 $rer  order by  id_usuario asc";
										//echo $sql;
										$res = @mysql_query($sql);
										if (!$res) {
											exit(mysql_error());
										}
										$num_total_registros = mysql_num_rows($res);
										*/

										$db->select($t1, "*", "where id_usuario>1 $rer  order by  id_usuario asc");
										$num_total_registros = $db->num_rows();
										//calculo el total de p&aacute;ginas 
										$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

										/*
										$sql = $sql . " limit " . $inicio . "," . $TAMANO_PAGINA ;
										$res = @mysql_query($sql);
										if (!$res) { 
											exit(mysql_error());
										}
										*/
										//echo $sql;
										$arr_usr = array();
										$db->select($t1, "*", "where id_usuario>1 $rer  order by  id_usuario asc LIMIT ".$inicio.", ".$TAMANO_PAGINA);
										$loop=0;
										//while  ($row = mysql_fetch_array($res)) {
										while ($arraypadre = $db->fetch_array()) {
											$arr_usr[] = $arraypadre; 
									    }
										foreach ($arr_usr as $row) {
									?>
	                            
									<tr>
										<td valign="top">
											<a href="#" title="<?php echo $row['nombre_usuario'];?>" class="txt_ingresar">
											<?php echo $row['id_usuario'];?>-<?php echo $row['nombre_usuario'];?>
											<span class="urgente">(
												<?php													
													$db->select("tipo", "*", "WHERE id_tipo='".$row['tipo']."'");
													$rowt = $db->fetch_assoc();
												?>
	                      						<?php echo $rowt['nombre_tipo']; ?>
	                  						)</span>
	                  						</a>
	                  					</td>
										<td>
											<a href="#" title="<?php echo $row['login']?>">
												<span class="titu_cat">
													<?php echo $row['login'];?>
												</span>
											</a>
										</td>
										<td>
											<!-- Icons -->
											<a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_usuario']?>&amp;op=4" title="Edit">
											 	<img src="imgs/pencil.png" alt="Edit" />
												<span>
													<?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?>
												</span>
											</a>
											<a class=Ntooltip href="javascript:deletex('<?= $row['id_usuario']?>')" title="Delete">
												<img src="imgs/cross.png" alt="Delete" />
												<span>
													<?php $valor=variable(1,2); echo $valor[0]; ?>  <?= $modulo; ?>
												</span>
											</a>
										</td>
									</tr>
	                               <?php }?>
								</tbody>
							</table>
							<div class="pagination">
								<?php
									if (($total_paginas > 1)){
								?>
								<?php
										if ($pagina!=1){
								?>
											<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>">
												<?php $valor=variable(12,2); echo $valor[0]; ?>
											</a>
								<?php
										}
								?>
								<?php
										for ($i=1;$i<=$total_paginas;$i++){
											if ($pagina == $i){
								?>
												<a href='#' class="number current" title="<?= $pagina?>"> <?php echo $pagina?></a>
								<?php
											}else{
								?>
												<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>' class="number" title="<?= $i ?>">
													<?php echo $i;?>
												</a>
								<?php
											}
								?>
								<?php
										}
								?>

								<?php 
										if ($total_paginas!=$pagina){
								?>
											<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>">
												<?php $valor=variable(13,2); echo $valor[0]; ?>
											</a>
								<?php
										}
								?>
	      						<?php
	      							}
	  							?>
	  							<br />
							</div>
						</div>
						<form name="form" id="form">
							<?php $valor=variable(15,2); echo $valor[0]; ?>:
							<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
								<option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
								<?php
									$arr_pag = array();
									$db->select("pagina", "*");
									while ($arraypadre = $db->fetch_array()) {
										$arr_pag[] = $arraypadre; 
								    }
									foreach ($arr_pag as $row){
								?>
								<?php
										if($row["numero"] == $_SESSION['pagina']){
								?>
											<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>" selected="selected">
												<?php echo utf8_encode($row['numero']); ?>
											</option>
								<?php
										}else{
								?>
											<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>">
												<?php echo utf8_encode($row['numero']); ?>
											</option>
								<?php
									}
								?>
								<?php
									}
								?>
							</select>
						</form>
						<!-- End>
						<!-- End #tab1 -->
					</div> <!-- End .content-box-content -->
				</div>
				<!-- fin lista -->
			</div> <!-- End .content-box-content -->
		</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
	    	<?php include('pie.php'); ?>
		</div> 
		<!-- End #main-content -->
</div></body>
<script language="javascript">
	function deletex(id){
		if(confirm("Esta seguro de eliminar el registro?")) {
			window.location="<?= $_SERVER['PHP_SELF']?>?op=3&idb=" + id;
		}
	}
</script>
</html>

