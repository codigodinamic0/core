<?php include('../lib/funciones.php'); ?>
<?php include('include_mysqli.php'); ?>
<script type="text/javascript" src="function.js"></script>
<?
//para verificar tamanos 
$id=$_GET['id'];
$idr=$_GET['idr'];
$op=$_GET['op'];
$t1="registrado";
$modulo="MODULO";

/*UPDATE*/
$estado_pregistrado = isset($_POST['estado_registrado']) ? "1" : "2";
if ($op=="1" ) {

}

/*INSERTAR*/
if($op=="2") { 

}
/*BORRAR*/
if($op=="3"){

}
if($id<>""){
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
			<? 
			if($msg<>""){
				if ($msg=="1"){ $valor=variable(16,2);$msg=$valor[0];}
				if ($msg=="2") {$valor=variable(17,2);$msg=$valor[0];}
				if ($msg=="3") {$valor=variable(18,2);$msg=$valor[0];}
				if ($msg=="4") {$valor=variable(19,2);$msg=$valor[0];}
			?>
				<div class="notification success png_bg">
					<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
					<div><?php echo $msg ?></div>
				</div>
			<?php
			}
			?>
			<p class="punteado"><strong>
				<?php $valor=variable(8,2); echo $valor[0]; ?> &nbsp;
				<?php echo $_SESSION['nombre_usuario'] ?>
			</strong></p>
			<div class="miga">            	
                <p>
                	<a href="panel.php"><?php $valor=variable(9,2); echo $valor[0]; ?></a>  
                	<a href="#" class="flecha_miga"><?php echo $modulo ?></a> 
                	<a href="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>" class="flecha_miga"><?php $valor=variable(3,2); echo $valor[0]; ?> <?php echo $modulo ?></a>
                </p>
                <p>&nbsp; </p>
                <div class="clear" style="padding-top:15px;"></div>
            	<h2>
            		<?php 
            			if($id){
            				$valor=variable(2,2); 
            				echo $valor[0];
            			}else{
            				$valor=variable(3,2); echo $valor[0];
            			}
        			?> 
        			<span class="urgente"><?php echo $modulo; ?>
            		</span>
            	</h2>
            </div>
			<div class="clear"></div>
			<!-- End .clear -->			
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="imgs/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
				<?php $valor=variable(95,2); echo $valor[1]; ?></div>
			</div>
		</div>
		<div class="clear"></div> <!-- End .clear -->
		<div class="content-box"><!-- Start Content Box -->
			<div class="content-box-header">
				<h3><img src="imgs/pencil (1).png" width="16" height="16" style="padding:5px;" /><?php echo $modulo ?> mysqli</h3>
				<!--
				<ul class="content-box-tabs">
					<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
					<li><a href="#tab2">Forms</a></li>
				</ul>
				-->
				<div class="clear"></div>
			</div> <!-- End .content-box-header -->
			<div class="content-box-content"><!-- End #tab1 -->
				<form action="<?= $_SERVER['PHP_SELF']?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
						<p>
							<label class="title">Destino : </label>
							<input name="destino" type="text" class="text-input small-input" id="destino" value="<?= $_GET['to']?>" size="32" />
						</p>
						<p>
							<label class="title">Asunto : </label>
							<input name="asunto" type="text" class="text-input small-input" id="asunto" value="" size="32" />
						</p>
						<p>
							<label class="title">Mensaje : </label>
							<textarea name="mensaje" cols="50" rows="5"></textarea>
						</p>
						<p>
							<input class="button" type="submit" value="Enviar"/>
						</p>
					</fieldset><!-- End .clear -->							
				</form>
				<!-- inicio lista -->  
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box"><!-- Start Content Box -->
					<div class="content-box-header">
						<h3 class="titu_secc">
							<?php $valor=variable(11,2); echo $valor[0]; ?> <a href="#" title="title" class="txt_verde"><?php echo $modulo ?></a>
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
							<form action="excel.php" method="post" target="_blank">
								<input type="hidden" name="sql" value="SELECT <?php echo $consultare ?> FROM registrado where id_registrado>12 order by nombre_registrado asc" />
								<input type="submit" class="botom2" value="<?php $valor=variable(96,2); echo $valor[0]; ?>"/>
							</form>
							<table>							
								<tfoot>
									<tr>
										<td colspan="7"><!-- End .pagination --></td>
								  	</tr>
								</tfoot>
								<tbody>
									<tr>
										<td valign="top">
											<a href="#" title="title" class="txt_verde">
												<?php $valor=variable(10,2); echo $valor[0]; ?> <?php echo $modulo ?>
											</a>
										</td>
										<td valign="top">
											<a href="#" title="title" class="txt_verde">
												<?php $valor=variable(77,2); echo $valor[0]; ?> <?php echo $modulo ?>
											</a>
										</td>
										<td valign="top">
											<a href="#" title="title" class="txt_verde">
												<?php $valor=variable(83,2); echo $valor[0]; ?> <?php echo $modulo ?>
											</a>
										</td>
										<td valign="top">
											<a href="#" title="title" class="txt_verde">
												<?php $valor=variable(81,2); echo $valor[0]; ?> <?php echo $modulo ?>
											</a>
										</td>
										<td class="txt_verde">
											<?php $valor=variable(14,2); echo $valor[0]; ?>
										</td>
									</tr>                         
									<?php
										$TAMANO_PAGINA =$_SESSION['paginador']; 
										$inicio = 0; 
										$pagina=1; 
										$texto="";
										if ($_SESSION['pag']) {
											$pagina = $_SESSION['pag'];
											$inicio = ($pagina - 1) * $TAMANO_PAGINA;
		        						}
		        						$db->select($t1,"*","where id_registrado>12 and idr='".$_GET['idr']."'  order by  nombre_registrado asc");
		                    			$num_total_registros = $db->num_rows();
		                    			//calculo el total de p&aacute;ginas 
										$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
					                    $db->select($t1,"*","where id_registrado>12 and idr='".$_GET['idr']."'  order by  nombre_registrado asc". " limit " . $inicio . "," . $TAMANO_PAGINA);
					                    //echo $sql;
					                    $loop=0;
					                    $cpadre = array();
					                    /*$db->last_query();*/
					                    while ($arraypadre = $db->fetch_array()) {
					                    	$cpadre[] = $arraypadre;
					                    }
					                    foreach($cpadre as $row){
		                    		?>
		                    				<tr>
												<td valign="top">
													<a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
														<?php echo $row['nombre_registrado']?> <?php echo $row['apellido_registrado']?>
													</a>
												</td>
												<td valign="top">
													<a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
														<?php echo $row['telefono_registrado']?>
													</a>
												</td>
										        <td valign="top">
										        	<a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
										        		<?php echo $row['correo_registrado']?>
										        	</a>
									        	</td>
										        <td valign="top">
										        	<a href="#" title="<?php echo $row['nombre_usuario']?>" class="txt_ingresar">
										        		<?php echo $row['empresa_registrado']?>
										        	</a>
										        </td>
										        <td><!-- Icons -->
										        	<a class=Ntooltip href="<?= $_SERVER['PHP_SELF']?>?id=<?= $row['id_registrado']?>&amp;op=4&idr=<?php echo $idr ?>" title="Edit">
										        		<img src="imgs/pencil.png" alt="Edit" />
										        		<span><?php $valor=variable(2,2); echo $valor[0]; ?> <?= $modulo; ?></span>
										        	</a>
										        	<a class=Ntooltip href="javascript:deletex('<?= $row['id_registrado']?>')" title="Delete">
										        		<img src="imgs/cross.png" alt="Delete" />
										        		<span><?php $valor=variable(1,2); echo $valor[0]; ?>  <?= $modulo; ?></span>
										        	</a>
										        </td>
										    </tr>
	                               <?php
	                           			}
	                       			?>
								</tbody>
							</table>
							<div class="pagination">
								<? 
									if (($total_paginas > 1)){
										if ($pagina!=1){
								?>
											<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina-1)?>&idr=<?php echo $idr ?>' title="<?php $valor=variable(12,2); echo $valor[0]; ?>"><?php $valor=variable(12,2); echo $valor[0]; ?></a>
								<?
										}
										for ($i=1;$i<=$total_paginas;$i++){
											if ($pagina == $i) {
								?>
												<a href='#' class="number current" title="<?= $pagina?>"> <?= $pagina?></a>
								<? 
											}else{
								?>
												<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= $i ?>&idr=<?php echo $idr ?>' class="number" title="<?= $i ?>"><?= $i?></a>
								<? 
											}
										}
										if ($total_paginas!=$pagina){
								?>
											<a href='<?= $_SERVER['PHP_SELF']?>?pg=<?= ($pagina+1)?>&idr=<?php echo $idr ?>' title="<?php $valor=variable(13,2); echo $valor[0]; ?>"><?php $valor=variable(13,2); echo $valor[0]; ?></a>
								<?
										}
									} 
								?>
								<br/>
							</div>
						</div>
						<form name="form" id="form">
							<?php $valor=variable(15,2); echo $valor[0]; ?>:
							<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
								<option value=""><?php $valor=variable(27,2); echo $valor[0]; ?></option>
								<?
									$cpadre = array();
									$db->select("pagina","*");
									/*$db->last_query();*/
									while ($arraypadre = $db->fetch_array()) {
										$cpadre[] = $arraypadre; 
									}
									foreach($cpadre as $row){
										if($row["numero"] == $_SESSION['pagina']){
								?>
											<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>" selected="selected">
												<?php echo utf8_encode($row['numero']) ?>
											</option>
								<?php
										}else{
								?>
											<option value="<?= $_SERVER['PHP_SELF']?>?paginar=<?php echo utf8_encode($row['numero']) ?>&idr=<?php echo $idr ?>">
												<?php echo utf8_encode($row['numero']) ?>
											</option>
								<?php
										}
									}
								?>
							</select>
						</form>
						<!-- End>
						<!-- End #tab1 -->
					</div> <!-- End .content-box-content -->
				</div><!-- fin lista -->
			</div> <!-- End .content-box-content -->
		</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
	    <?php include('pie.php'); ?>
	</div><!-- End #main-content -->
</div>
</body>
<script language="javascript">
	function deletex(id){
		if(confirm("<?php $valor=variable(43,2); echo $valor[0]; ?>")) {
			window.location="<?= $_SERVER['PHP_SELF']?>?idr=<?php echo $idr ?>&op=3&idb=" + id;
		}
	}
</script>
</html>

