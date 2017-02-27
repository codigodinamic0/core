<?php include('include_mysqli.php'); ?>
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
			<p class="punteado"><strong>Bienvenido C&oacute;digodin&aacute;mico</strong></p>
			
			
			
			
		  <div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Formulario</h3>
					
					<!--<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div 
						<li><a href="#tab2">Forms</a></li>
					</ul>-->
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content"><!-- End #tab1 -->
					
                    
                  <form action="" method="post">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>Input peque&#324;o</label>
										<input class="text-input small-input" type="text" id="small-input" name="small-input" /> 
                                        
										<br /><small>Descripcion del campo</small>
								</p>
								
								<p>
									<label>Input mediano</label>
									<input class="text-input medium-input datepicker" type="text" id="medium-input" name="medium-input" /> 
                                    
								</p>
								
								<p>
									<label>Input completo</label>
									<input class="text-input large-input" type="text" id="large-input" name="large-input" />
								</p>
								
								<p>
									<label>Checkboxes</label>
									<input type="checkbox" name="checkbox1" /> This is a checkbox <input type="checkbox" name="checkbox2" /> And this is another checkbox
								</p>
								
								<p>
									<label>Radio buttons</label>
									<input type="radio" name="radio1" /> This is a radio button<br />
									<input type="radio" name="radio2" /> This is another radio button
								</p>
								
								<p>
									<label>Select</label>              
									<select name="dropdown" class="small-input">
										<option value="option1">Option 1</option>
										<option value="option2">Option 2</option>
										<option value="option3">Option 3</option>
										<option value="option4">Option 4</option>
									</select> 
								</p>
								
								<p>
									<label>Textarea </label>
									<textarea class="text-input textarea" id="textarea" name="textfield" cols="79" rows="15"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" value="Enviar" /> <br />

                                    
                                    <span class="input-notification error png_bg">Mensaje de error</span><br />

                                    <span class="input-notification success png_bg">Mensaje enviado</span>
                                    
								</p>
								
						  </fieldset><!-- End .clear -->
							
					  </form>
                    
                    
					      
					
			  </div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box --><!-- End .content-box --><!-- End .content-box --><!-- Start Notifications --><!-- End Notifications -->
			
			<?php include('pie.php'); ?>
			
		</div> <!-- End #main-content -->
		
	</div></body>
  
</html>

