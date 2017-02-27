<script type="text/javascript">
    $(document).ready(function(){
        $("#login").validationEngine()
                $("#register").validationEngine()
                $("#recovery").validationEngine()
                /*login*/
                $("#dologin").click(function(){
                     $('#login_modal').modal();  
                });
                 /*registro*/
                $("#doregister").click(function(){
                     $('#register_modal').modal();  
                });
                /*recuperar contraseña*/
                $("#remember").click(function(){
                    $('#recovery_modal').modal(); 
                });
                /*verificar correo*/
                $("#email").blur(function(){
                    $.post('<?php echo $dominio?>task/serve.php',
                          {
                              action:'checkEmail',
                              email:this.value,
                              "_": $.now()
                          },function(res){
                              if (res.msg=="exist") {
                                  $(".warning_msg").removeClass("none");
                                  $(".warning_msg").html("El correo ya esta asignado a una cuenta doral");
                                  $("#subregister").attr("disabled",true);
                              }else{
                                   $(".warning_msg").addClass("none");
                                   $(".warning_msg").html("");
                                   $("#subregister").removeAttr("disabled");
                              }
                                      
                          });
                });
                
               /*enviar formulario de registro*/
               $("#register").submit(function(e){
                   e.preventDefault();
                    

                   if($("#register").validationEngine('validate')){
                       $("#registerLoad").removeClass("none");
                       var fd = new FormData();
                       var file_data = $('input[type="file"]')[0].files;
                       fd.append("action", "doRegistro");
                       fd.append("nombre_registrado", $('#nombre_registrado').val());
                       fd.append("apellido_registrado", $('#apellido_registrado').val());
                       fd.append("correo_registrado", $('#email').val());
                       fd.append("contrasena_registrado", $('#contrasena_registrado').val());
                       fd.append("img_registrado", file_data[0]);
                      
                   
                       $.ajax({
                        url: '<?php echo $dominio?>task/serve.php',
                        data: fd,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(res){
                            $("#registerLoad").addClass("none");
                            
                              if (res.msg=="ok") {
                                  window.location.href=window.location.href;
                                  
                              }else{
                                  $("#registerError").removeClass("none");
                                  $("#registerError").html("Ha ocurrido un error inesperad, vuelve a intentarlo mas tarde")
                              }
                        }
                    });
                 }
                   return false;
               });
                
                /*login*/
                $("#login").submit(function(e){
                    e.preventDefault()
                 if($("#login").validationEngine('validate')){
                     $("#loginLoad").removeClass("none");
                     $.post('<?php echo $dominio?>task/serve.php',
                          {
                              action:'dologin',
                              email:$("#correo_registrado").val(),
                              password:$("#password").val(),
                              "_": $.now()
                          },function(res){
                               $("#loginLoad").addClass("none");
                              if (res.msg=="ok") {
                                  window.location.href=window.location.href;
                                 
                              }else{
                                  $("#loginError").removeClass("none");
                                  $("#loginError").html("El correo o la contraseña no existen");
                              }
                        });
                    }
                    return false;
                });
                /*recuperar contraseña*/
                $("#recovery").submit(function(e){
                    e.preventDefault();
                    
                 if($("#recovery").validationEngine('validate')){
                     $("#recoveryLoad").removeClass("none");
                     $.post('<?php echo $dominio?>task/serve.php',
                          {
                              action:'recoveryPassword',
                              email:$("#recovery_email").val(),
                              "_": $.now()
                          },function(res){
                               $("#recoveryLoad").addClass("none");
                              if (res.msg=="ok") {
                                  
                                 $("#recoverySuccess").removeClass("none");
                                 $("#recoverySuccess").html("Se ha enviado un correo electronico al "+$("#recovery_email").val()+" con la nueva contraseña solicitada");
                                 
                              }else{
                                  $("#recoveryError").removeClass("none");
                                  $("#recoveryError").html("El correo no se encuentra asociado a ninguna cuenta doral");
                              }
                        });
                    }
                    return false;
                });
                /*cerrar session*/
                $("#logout").click(function(){
                     $.post('<?php echo $dominio ?>task/serve.php',
                              {
                                  action:'logout',
                                  "_": $.now()
                              },function(res){
                                  if (res.msg=="ok") {
                                      location.reload();
                                      //window.location.href=window.location.href;

                                  }
                            });
                });
    });
</script>
<!--login-->
        <div class="modal fade" id="login_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#e3e3e3;color:#676767">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Acceder</h4>
                    </div>
                    <form  class="form-horizontal" role="form"  id="login" name="login" method="post">
                        <div class="modal-body">
                            
                                <div class="center none" id="loginLoad">
                                    <img src="<?php echo $dominio?>assets/images/reload.GIF" width="60" alt="Cargando" title="Cargando"/>
                                </div>
                            
                                <div class="alert alert-success none" id="loginSucces"></div>
                                <div class="alert alert-danger none" id="loginError"></div>
                                <div class="center">
                                    <a href="<?php echo $dominio?>?provider=Facebook">
                                        <img src="<?php echo $dominio?>assets/images/fblogin.png" alt="Iniciar sesión con facebook" title="Iniciar sesión con facebook"/>
                                    </a>
                                </div>
                            
                                <div class="form-group col-md-12">
                                        <label>Correo</label>
                                        <input type="text" class="form-control validate[required,custom[email]]" name="correo_registrado" id="correo_registrado">
                                 </div>
                                <div class="form-group col-md-12">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control validate[required,]" name="password" id="password">
                                 </div>
                        <button class="btn btn-default" style="background:#e3e3e3;color:#676767" type="submit">Iniciar sesión</button>    
                        </div>
                    </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" style="background: #d8d933;color:#fff" data-dismiss="modal">Cerrar</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.login -->
        <!--register-->
        <div class="modal fade" id="register_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#e3e3e3;color:#676767">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Registro</h4>
                    </div>
                    <form  class="form-horizontal" role="form"  id="register" name="register" method="post">
                        <div class="modal-body">
                            <div class="center none" id="registerLoad">
                                <img src="<?php echo $dominio?>assets/images/reload.GIF" width="60" alt="Cargando" title="Cargando"/>
                            </div>
                            
                                <div class="alert alert-success none" id="registerSucces"></div>
                                <div class="alert alert-danger none" id="registerError">Ha ocurrido un error inesperad, vuelve a intentarlo mas tarde</div>
                            
                            
                                <div class="form-group col-md-12">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control validate[required]" name="nombre_registrado" id="nombre_registrado">
                                </div>
                                <div class="form-group col-md-12">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control validate[required]" name="apellido_registrado" id="apellido_registrado">
                                 </div>
                                <div class="form-group col-md-12">
                                        <label>Correo</label>
                                        <input type="text" class="form-control validate[required,custom[email]]" name="correo_registrado" id="email">
                                        <p class="warning_msg none"></p>
                                </div>
                                <div class="form-group col-md-12">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control validate[required]" name="contrasena_registrado" id="contrasena_registrado">
                                </div>
                                <div class="form-group col-md-12">
                                        <label>Avatar</label>
                                        <input type="file" class="validate[custom[validateMIME[image/jpeg|image/png|image/gif]]]" name="img_registrado" id="img_registrado">
                                 </div>
                            <button class="btn btn-default" id="subregister" style="background:#e3e3e3;color:#676767" type="submit">Enviar</button>    
                        </div>
                    </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" style="background: #d8d933;color:#fff" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-default" id="remember" style="background: #d8d933;color:#fff" >Recordar contraseña</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.register -->
        
        <!--recovery-->
        <div class="modal fade" id="recovery_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#e3e3e3;color:#676767">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Recuperar contraseña</h4>
                    </div>
                    <form  class="form-horizontal" role="form"  id="recovery" name="recovery" method="post">
                        <div class="modal-body">
                            
                                <div class="center none" id="recoveryLoad">
                                    <img src="<?php echo $dominio?>assets/images/reload.GIF" width="60" alt="Cargando" title="Cargando"/>
                                </div>
                            
                                <div class="alert alert-success none" id="recoverySuccess"></div>
                                <div class="alert alert-danger none" id="recoveryError"></div>
                            
                                <div class="form-group col-md-12">
                                        <label>Correo</label>
                                        <input type="text" class="form-control validate[required,custom[email]]" name="recovery_email" id="recovery_email">
                                 </div>
                            <button class="btn btn-default" style="background:#e3e3e3;color:#676767" type="submit">Recuperar</button>    
                        </div>
                    </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" style="background: #d8d933;color:#fff" data-dismiss="modal">Cerrar</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.recovery -->

