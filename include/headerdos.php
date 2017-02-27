<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo $dominio?>third_party/autocomplete/jquery-ui.js"></script>	
<div class="container-fluid headerdos">
		<div class="container">
			<i class="abrmend"></i>
			<a href="<?php echo $dominio?>"><img src="<?php echo $dominio ?>images/logo.png" alt="Digital-Doral" title="Digital-Doral" class="img-responsive"></a>		
			<div class="businisesion">
				<form id="products_search" method="get">
					<input type="text" id="tags">
                                        <input type="hidden" id="hq" name="q" value="0"/>
                                        <button></button>
				</form>
				<div class="btnses">
                                    <?php if(isset($_SESSION['is_logged'])):?>
                                        <a id="logout" href="javascript:void(0)" title="Acceder">Cerrar sesión</a>
                                    <?php else:?>
                                       <a id="dologin" href="javascript:void(0)" title="Acceder">Acceder</a>
                                           |
                                       <a id="doregister" href="javascript:void(0)" title="Registro">Registro</a>
                                    <?php endif;?>
					
				</div>
			</div>
			
		</div>
		<div class="mendos">
			<span class="cerrmendos"></span>
			<ul>
                           	<li><a href="#"><span class="ico5"></span> Digital Doral</a></li>
				<li><a href="<?php echo $dominio?>actividades/"><span class="ico1"></span>Actividades</a></li>
				<li><a href="<?php echo $dominio?>actualidades/"><span class="ico2"></span>Actualidad digital</a></li>
				<li><a href="<?php echo $dominio?>index.php"><span class="ico3"></span>Comunidad</a></li>
				<li><a href="<?php echo $dominio?>contactanos/"><span class="ico4"></span>Contacto</a></li>
			</ul>
			<div class="redes">
				<a href="<?php $variable = variable(3,1); echo $variable[0]?>" target="_blank">Facebook</a>
				<a href="<?php $variable = variable(5,1); echo $variable[0]?>" target="_blank">Twiteer</a>
				<a href="<?php $variable = variable(4,1); echo $variable[0]?>" target="_blank">Instagram</a>
				<a href="<?php $variable = variable(6,1); echo $variable[0]?>" target="_blank">Google +</a>
                        </div>
			<hr>
			<div class="items">
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 tempor incididunt ut.
			</div>
			<div class="items">
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 tempor incididunt ut.
			</div>
			<span class="logpie"></span>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			$(".abrmend").click(function(){
				$(".mendos").show();
			});
			$(".cerrmendos").click(function(){
				$(".mendos").hide();
			});
		});
                /*autocompletado productos*/
                $(function() {
                    $( "#tags" ).autocomplete({
                        minLength: 1,
                        source: '<?php echo $dominio?>task/serve.php?action=getProducts',
                        select: function( event, ui ) {  
                            //$("#hq").val(ui.item.id);
                            window.location='<?php echo $dominio?>'+ui.item.amigable+'/'+ui.item.id+'/cod6/';
                        }
                    });
                  });
                  /*submit search*/
                  $("#products_search").submit(function(){
                      var q=$("#tags").val();
                     window.location='<?php echo $dominio?>colecciones_destacadas.php?q='+q+'&action=search';
                     return false;
                  });
	</script>