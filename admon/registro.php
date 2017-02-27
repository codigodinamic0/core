<?php include('../lib/funciones.php'); ?>
<?php
include('include_mysqli.php'); 
?>

<link rel="stylesheet" type="text/css" href="candidato/datatable/css/jquery.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="candidato/validationEngine.jquery.css">

<link rel="stylesheet" type="text/css" href="candidato/style.css">

<script type="text/javascript" src="candidato/jquery.validationEngine.js"></script>

<script type="text/javascript" src="candidato/jquery.validationEngine-es.js"></script>

<script type="text/javascript" src="candidato/mask.js"></script>

<script type="text/javascript" src="candidato/datatable/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="candidato/command2.js"></script>

<style type="text/css">
    #listcursos,#listoficios{
        margin-bottom: 5px;
    }
    .divautocompleta span, #listcursos span, #listoficios span, #resultoficioauto span{
          padding: 5px;
          display: inline-block;
          cursor: pointer;
          background: #fff;
          border: 1px solid gray;
          margin-left: 5px;
          margin-top: 5px;
          border-radius: 5px;
    }
</style>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->



    <?php include('menu_registro.php'); ?>



    <div id="main-content"> <!-- Main Content Section with everything -->

        <div id="message">

            <div class="alert alert-success"></div>

            <div class="alert alert-error"></div>

        </div>

        

        <noscript> <!-- Show a notification if the user has disabled javascript -->

        <div class="notification error png_bg">

            <div>

                Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.

            </div>

        </div>

        </noscript>



        <!-- Page Head -->

        <h2>Hojas de vida</h2>

        



        <div class="hojasvida">

            

            <form action="" method="post" class="gform" id="candidato">

                <label class="ti">Datos personales</label>

                

                <div class="sidel">
                    <div class="col col6">
                        <label>Tipo de documento:</label>
                        <select name="tipo_documento" id="tipo_documento">
                            <option value="">Selecciones tipo</option>
                            <?php 
                                $db->select("tipo","*"," where idr=44");
                                while ($datostd = $db->fetch_array()){
                            ?>
                                <option value="<?php echo $datostd['id_tipo']; ?>"><?php echo $datostd['nombre_tipo']; ?></option>
                            <?php
                                }
                            ?>
                        </select>

                        <img src="candidato/loader.gif" class="loader" alt="Cargando" title="Cargando"/>

                    </div>
                    <div class="col col6">

                        <label>Cedula:</label>

                        <input type="text" name="cedula" class="inputxt" id="cedula" /> 

                        <img src="candidato/loader.gif" class="loader" alt="Cargando" title="Cargando"/>

                    </div>

                    <div class="col col6">

                        <label>Primer nombre:</label>

                        <input type="text" name="nombre" class="inputxt" id="nombre" /> 

                    </div>

                    <div class="col col6">

                        <label>Segundo nombre:</label>

                        <input type="text" name="nombre1" class="inputxt" id="nombre1" />   

                    </div>

                    <div class="col col6">

                        <label>Primer apellido:</label>

                        <input type="text" name="apellido" class="inputxt" id="apellido"/>  

                    </div>

                    <div class="col col6">

                        <label>Segundo apellido:</label>

                        <input type="text" name="apellido1" class="inputxt" id="apellido1"/>    

                    </div>

                    <div class="col col6">

                        <label>Numero libreta militar:</label>

                        <input type="text" name="libreta_militar" 

                               onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')" 

                               onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               class="inputxt validate[custom[integer]]"

                               id="libreta_militar"/>   

                    </div>

                    <div class="col col6">

                        <label>Distrito libreta militar:</label>

                        <input type="text" name="distrito_militar"class="inputxt" id="distrito_militar" />  

                    </div>

                    <div class="col col6">

                        <label>Fecha de nacimiento (D-M-A): </label>

                        <input type="text" name="fecha_nacimiento" class="inputxt" id="fecha_nacimiento" placeholder="D-M-A" />  

                    </div>

                    <div class="col col6">

                        <label>Estado civil:</label>

                        <select name="estado_civil" class="select" id="estado_civil">

                            <?php

                            $estadoCivilQuery = $db->select('tipo','*','WHERE idr=35');

                            if($db->num_rows()):

                                while($row= $db->fetch_object()):

                            ?>

                            <option value="<?php echo $row->id_tipo?>"><?php echo $row->nombre_tipo?></option>

                            <?php 

                            endwhile;

                            endif;

                            ?>

                        </select>

                   </div>

                    <div class="col col6">

                        <label>Correo electronico:</label>

                        <input type="text" name="correo" class="inputxt validate[custom[email]]" id="correo"/>  

                    </div>

                    <div class="col col6">

                        <label>Dirección:</label>

                        <input type="text" name="direccion" class="inputxt" id="direccion"/>    

                    </div>

                    <div class="col col6">

                        <label>Departamento:</label>

                        <select name="departamento" class="select validate[required]" id="departamento">

                            <option value="0">Otro departamento</option>

                            <?php

                            $query = $db->select('departamento','id_departamento,codigo_pais,nombre_departamento','WHERE codigo_pais="COL"');

                            if($db->num_rows()):

                                while($row= $db->fetch_object()):

                            ?>

                            <option value="<?php echo $row->id_departamento?>"><?php echo $row->nombre_departamento?></option>

                            <?php 

                            endwhile;

                            endif;

                            ?>

                        </select>   

                    </div>

                    <div class="col col6">

                        <label>Ciudad:</label>

                        <select name="ciudad" class="select" id="ciudad">

                            <option value="">--seleccionar--</option>

                       </select>    

                    </div>

                   <div class="col col6">

                        <label>Barrio:</label>

                        <input type="text" name="barrio" class="inputxt" id="barrio"/>  

                    </div>

                   

                    <!-- <div class="col col6">

                        <label>Area telefono:</label>

                        <input type="text" name="area" class="inputxt" id="area"/>  

                    </div> -->
                     <div class="col col6">

                        <label>Telefono:</label>

                        <input type="text" name="telefono" 

                               onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               class="inputxt validate[custom[integer]]"

                               id="telefono"/>  

                    </div>

                    <div class="col col6">

                        <label>Telefono movil:</label>

                        <input type="text" name="movil"

                               onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               class="inputxt validate[custom[integer]]"

                               id="movil"/> 

                    </div>

                    <div class="col col6">

                        <label>Otro numero de contacto:</label>

                        <input type="text" name="telefono_contacto" 

                               onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                               class="inputxt validate[custom[integer]]"

                               id="telefono_contacto"/> 

                    </div>

                   

                    <!-- <div class="col col6">

                        <label>Estado:</label>

                        <select name="estado" class="select" id="estado">

                            <option value="1">Activo</option>

                            <option value="2">Inactivo</option>

                        </select>   

                    </div> -->

               <!-- </div> -->

                <!-- <div class="sider"> -->

                    <!-- <div class="userfoto">

                        <img src="candidato/default.png" alt="Usuario" title="Usuario" id="userfoto"/>

                    </div>

                    <div class="foto">

                            <div class="tomar">

                                <label>

                                    Foto

                                    <input type="file" name="foto" id="foto">

                                </label>

                            </div>

                        

                    </div> -->

                   <img src="candidato/loader.gif" class="loader img_loader" alt="Cargando" title="Cargando"/>

                   <p class='info info-error image_msg'></p>
                   <!-- academica 1 -->
                     <div class="col col12">

                        <label class="ti">Formación academica 1</label>

                     </div>

                   <div class="col col12">

                        <div class="chelist">
                        <?php 
                            $db->select("tipo","*","where idr=42 ");
                            $datorecoac = array();
                            while ($arrayrecac = $db->fetch_array()) {
                                $datorecoac[] = $arrayrecac;
                            }
                            foreach($datorecoac as $arrayrecac){
                        ?>
                            <div class="grup">                         

                                <label for="academico<?php echo $arrayrecac['id_tipo'] ?>"><input type="radio" name="academico" id="academico<?php echo $arrayrecac['id_tipo'] ?>" value="<?php echo $arrayrecac['id_tipo'] ?>" /> <?php echo $arrayrecac['nombre_tipo'] ?></label>

                            </div>
                        <?php 
                            }
                        ?>

                        </div>

                     </div>

                    

                    <div class="col col6">

                        <label>Institución:</label>

                        <input type="text" name="institucion" class="inputxt" id="institucion"/>    

                    </div>
                    <div class="col col6">

                        <label>Titulo obtenido:</label>

                        <input type="text" name="titulo_odtenido" class="inputxt" id="titulo_odtenido"/>    

                    </div>
                    <div class="col col6">

                        <label>Año finalización:</label>

                        <input type="text" name="ano_finalizacion" class="inputxt validate[custom[integer]]" id="ano_finalizacion" />   

                    </div>

                     <div class="col col6">

                        <label>Estudios en curso:</label>

                        <div class="rado">

                            <div class="grup">

                                <label>

                                    Si <input type="radio" name="estudia" value="1" id="estudia_si"/>

                                </label>

                            </div>

                            <div class="grup">

                                <label>

                                    No <input type="radio" name="estudia" id="estudia_no" value="2" />

                                </label>

                            </div>

                        </div>

                    </div>

                    <!--<div class="col col6">

                        <label>Horario de estudios actuales:</label>

                        <input type="text" name="horario_estudio" class="inputxt" id="horario_estudio"/>

                    </div>-->
                    <!-- academica 2 -->
                     <div class="col col12">

                        <label class="ti">Formación academica 2</label>

                     </div>

                   <div class="col col12">

                        <div class="chelist">

                            <?php 
                                foreach($datorecoac as $arrayrecac){
                            ?>
                                <div class="grup">                         

                                    <label for="academico1<?php echo $arrayrecac['id_tipo'] ?>"><input type="radio" name="academico1" id="academico1<?php echo $arrayrecac['id_tipo'] ?>" value="<?php echo $arrayrecac['id_tipo'] ?>" /> <?php echo $arrayrecac['nombre_tipo'] ?></label>

                                </div>
                            <?php 
                                }
                            ?>

                        </div>

                     </div>

                    <div class="col col6">

                        <label>Titulo obtenido:</label>

                        <input type="text" name="titulo_odtenido1" class="inputxt" id="titulo_odtenido1"/>    

                    </div>

                    <div class="col col6">

                        <label>Institución:</label>

                        <input type="text" name="institucion1" class="inputxt" id="institucion1"/>    

                    </div>

                    <div class="col col6">

                        <label>Año finalización:</label>

                        <input type="text" name="ano_finalizacion1" class="inputxt validate[custom[integer]]" id="ano_finalizacion1" />   

                    </div>

                     <div class="col col6">

                        <label>Estudios en curso:</label>

                        <div class="rado">

                            <div class="grup">

                                <label>

                                    Si <input type="radio" name="estudia1" value="1" id="estudia_si1"/>

                                </label>

                            </div>

                            <div class="grup">

                                <label>

                                    No <input type="radio" name="estudia1" id="estudia_no1" value="2" />

                                </label>

                            </div>

                        </div>

                    </div>

                    <!-- <div class="col col6">

                        <label>Horario de estudios actuales:</label>

                        <input type="text" name="horario_estudio1" class="inputxt" id="horario_estudio1"/>

                    </div> -->
                  <!--   <div class="col col12">

                        <label>Cursos:</label>
                        <div id="listcursos"></div>
                        <input type="text" name="cursos" id="cursos" class="inputxt" style="width:100px;"  />
                        <div class="divautocompleta" id="autocomnpleta"></div>

                     </div>

                    <div class="col col6">

                        <label>Otros cursos:</label>

                        <input type="text" name="otros_cursos" class="inputxt" id="otros_cursos"/>
                        <span style="margin-top:3px;display: block;"><b>Digita otros cursos separados por una " , " ejemplo: salud, bienestar</b></span>
                    </div> -->

                <!-- </div>end side -->

                <!-- <div class="sidel"> -->

                    

                <!-- </div>end sidel -->

                <!-- <div class="sider"> -->

                    

                    <div class="col col12">

                        <label class="ti">Información complementaria</label>

                    </div>

                    <!-- <div class="col col6">

                        <label>Trabaja actualmente:</label>

                        <select name="trabaja_actual" class="select" id="trabaja_actual">

                            <option value="1">Estoy desempleado</option>

                            <option value="2">Actualmente trabajo</option>

                        </select>

                    </div>

                    <div class="col col12">

                        <label>Disponibilidad horaria:</label>

                          <div class="rado">

                            <?php

                             $db->select('tipo','*','WHERE idr=37');

                             if($db->num_rows()):

                                 while($row= $db->fetch_object()):

                             ?>

                                 <div class="grup">

                                     <label>

                                         <?php echo $row->nombre_tipo ?> <input type="radio" class="availability" name="disponibilidad" value="<?php echo $row->id_tipo?>" />

                                     </label>

                                 </div>

                             <?php

                             endwhile;

                             endif;

                             ?>

                             </div>

                    </div> -->

                    <!--<div class="col col12">

                        <label>Área de interés:</label>

                        

                        <div class="chelist">

                             <?php

                            $query = $db->select('tipo','*','WHERE idr=38');

                            if($db->num_rows()):

                                while($row= $db->fetch_object()):

                            ?>

                            <div class="grup">

                                <input type="checkbox" class="interest" name="<?php echo strtolower(str_replace(" ","-", $row->nombre_tipo)) ?>" id="interes_<?php echo $row->id_tipo?>" value="<?php echo $row->id_tipo ?>" />

                                <label for="interes_<?php echo $row->id_tipo?>"><?php echo $row->nombre_tipo ?></label>

                            </div>

                            <?php

                            endwhile;

                            endif;

                            ?>

                        </div>-->

                     <!-- <div class="col col6">

                        <label>Agregue 3 oficios a los cuales desea aspirar:</label>
                        <div id="listoficios"></div>
                        <input type="text" name="oficio" class="inputxt" id="oficio"/>
                        <div id="resultoficioauto"></div>
                    </div>
 -->                    <div class="col col12">
                    <label>Llamar al candidado:</label>
                    <select name="descripcion_llamar" id="descripcion_llamar" >
                        <option value="">--No llamar--</option>
                        <?php 
                            $db->select("tipo","*","WHERE idr=43");
                            while ($arrayllti = $db->fetch_array()) {
                        ?>
                            <option value="<?php echo $arrayllti['id_tipo'] ?>"><?php echo $arrayllti['nombre_tipo'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    
                    </div>
                    </div>

                    <!--<div class="col col12">

                        <label>Actitudes:</label>

                        

                        <div class="chelist">

                             <?php

                            $query = $db->select('tipo','*','WHERE idr=39');

                            if($db->num_rows()):

                                while($row= $db->fetch_object()):

                            ?>

                            <div class="grup">

                                <input type="checkbox" class="attitudes" name="<?php echo strtolower(str_replace(" ","-", $row->nombre_tipo)) ?>" id="actitud_<?php echo $row->id_tipo?>" value="<?php echo $row->id_tipo ?>" />

                                <label for="actitud_<?php echo $row->id_tipo?>"><?php echo $row->nombre_tipo ?></label>

                            </div>

                            <?php

                            endwhile;

                            endif;

                            ?>

                        </div>

                     

                    </div>-->

<!--                    <div class="col col6">

                        <label>Contraseña:</label>

                        <input type="password" class="inputxt" name="contrasena" id="contrasena"/>

                        <input type="hidden" name="hcontrasena" id="hcontrasena" value=""/>

                    </div>-->

                    <!-- <div class="col col12">

                        <div class="rado">

                            <span>Está interesado en recibir en información de la empresa (cursos, notas de interés)</span><br>

                            <div class="grup">

                                <label>

                                    Si <input type="radio" name="boletin" value="1"/>

                                </label>

                            </div>

                            <div class="grup">

                                <label>

                                    No <input type="radio" name="boletin" value="0" />

                                </label>

                            </div>

                        </div>

                    </div> -->

                    <div class="col col12">

                        <label class="ti">Informacion laborar</label>
                        <input type="checkbox" value="Sin experencia laboral" id="sin_info_labora" name="sin_info_labora"> Sin experencia laboral
                         <input type="checkbox" value="1" id="independiente" name="independiente"> Independiente
                    </div>

                    

                    <div id="laborAdded" style="  float: left;  width: 100%;"></div><!--renderiza la info agregada-->

                    

                    <div id="infolaboral">

                          <div class="col col6">

                               <label>Nombre de la empresa:</label>

                               <input type="text" name="empresa_laboral" class="inputxt" id="empresa_laboral"/>

                           </div>

                           <div class="col col6">

                               <label>Cargo desempeñado:</label>

                               <input type="text" name="cargo_laboral" class="inputxt" id="cargo_laboral"/>

                           </div>

                           <div class="col col6">

                               <label>Fecha ingreso (D-M-A):</label>

                               <input type="text" name="ingreso_laboral" class="inputxt" id="ingreso_laboral" placeholder="D-M-A"  />

                           </div>

                           <div class="col col6">

                               <label>Fecha retiro (D-M-A):</label>

                               <input type="text" name="retiro_laboral" class="inputxt" placeholder="D-M-A" id="retiro_laboral"/>

                           </div>

                           <!-- <div class="col col6">

                               <label>Motivo de retiro :</label>

                                <select name="motivo_laboral" class="select" id="motivo_laboral">

                                 <?php

                                     $estadoCivilQuery = $db->select('tipo','*','WHERE idr=40');

                                     if($db->num_rows()):

                                         while($row= $db->fetch_object()):

                                     ?>

                                     <option value="<?php echo $row->id_tipo?>"><?php echo $row->nombre_tipo?></option>

                                     <?php 

                                     endwhile;

                                     endif;

                                     ?>

                                 </select>

                           </div> -->

                           <!-- <div class="col col6">

                               <label>Salario basico:</label>

                               <input type="text" name="salario_laboral"

                                      onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                                      onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                                      class="inputxt validate[custom[integer]]"

                                      id="salario_laboral"/>

                           </div>

                           <div class="col col12">

                               <label>Funciones realizadas (Breve descripción):</label>

                               <textarea class="inputxt" name="funciones_laboral" id="funciones_laboral" rows="5"></textarea>

                           </div>

                           <div class="col col6">

                               <label>Telefono empresa:</label>

                               <input type="text" class="inputxt validate[custom[integer]]"

                                      onKeyPress="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                                      onkeyup   ="if(this.value.match(/\D/)) this.value=this.value.replace(/\D/g,'')"

                                      name="telefono_laboral" 

                                      id="telefono_laboral"/>

                           </div>

                           <div class="col col6">

                               <label>Jefe inmediato:</label>

                               <input type="text" class="inputxt" name="jefe_laboral" id="jefe_laboral"/>

                           </div> -->

                            <div class="col col12">

                                <a href="javascript:void(0)" class="laborBtn laborSave" id="saveLabor">Guardar</a>

                                <a href="javascript:void(0)" class="laborBtn" id="cancelLabor">Cancelar</a>

                                <img class="loader loader_labor" title="Cargando" alt="Cargando" src="candidato/loader.gif">

                            </div>

                            <input type="hidden" id="id_laboral" value="0"/>

                       

                    </div><!--end toClone-->

                    

                   

                 

                     <div class="col col12">

                        

                            <a href="javascript:void(0)" class="addLabor">Añadir información laboral</a>

                         

                     </div> 

                </div><!--end sider-->

                

                <input type="hidden" name="id" id="id" value=""/>

                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION['id_usuario']?>"/>

                

                <div class="col col12">

                    <div class="botones">

                        <button class="btn verde">Guardar</button>

                    <!-- </div> -->

                </div>

            </form>

        <!-- </div> -->



        <div class="clear"></div> <!-- End .clear --><!-- End .content-box --><!-- End .content-box --><!-- End .content-box -->

        <div class="clear"></div>

        <table id="cand" class="display" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th>ID</th>
<!--  -->
                        <th>Nombre</th>

                        <th>Apellido</th>

                        <th>Cedula</th>

                        <th>Correo</th>

                        <th>Fecha de creación</th>

                                                <th data-bSortable="false">Acciónes</th>

                                                

                    </tr>

                </thead>



                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th>Nombre</th>

                        <th>Apellido</th>

                        <th>Cedula</th>

                        <th>Correo</th>

                        <th>Fecha de creación</th>

                                                <th data-bSortable="false">Acciónes</th>

                    </tr>

                </tfoot>

            </table>

            <script type="text/javascript">
            var limitoficio=0;
            $(function(){
                $(window).load(function(){
                    <?php if(@$_GET['cc']!=""){ ?>
                        $("#cedula").blur();
                        listarcursos();
                        listaroficios();
                    <?php } ?>
                });
                    
                $("#cursos").keyup(function(){
                    $("#autocomnpleta").html("");
                    dat = $(this).val().split(",");
                    num = dat.length-1;
                    if (dat[num]=="") { return false; }
                    $.ajax({
                    data: {"cod":1,"dato":dat[num] },
                          url:   "candidato/ajax.php",
                          type:  'POST',
                          beforeSend: function () 
                          {

                          },
                          success:  function (response) {
                            console.log(response);
                            
                            $("#autocomnpleta").html(response);
                          }
                      });
                })
                $("#oficio").keyup(function(){
                    $("#resultoficioauto").html("");
                    dat = $(this).val().split(",");
                    num = dat.length-1;
                    if (dat[num]=="") { return false; }
                    $.ajax({
                    data: {"cod":5,"dato":dat[num] },
                          url:   "candidato/ajax.php",
                          type:  'POST',
                          beforeSend: function () 
                          {

                          },
                          success:  function (response) {
                            console.log(response);
                            
                            $("#resultoficioauto").html(response);
                          }
                      });
                })
            })
            function guardarrelacioncurso(num,txt){
                $.ajax({
                    data: {"cod":2,"num":num,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        $("#autocomnpleta").html("");
                        console.log(response);
                        $("#cursos").val("");
                        $("#cursos").focus();
                        listarcursos();
                      }
                  });
            }
            function eliminacursos(num){
                $.ajax({
                    data: {"cod":3,"num":num,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        console.log(response);
                        listarcursos();
                      }
                  });
            }
            function listarcursos(){
                $.ajax({
                    data: {"cod":4,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        console.log(response);
                        $("#listcursos").html(response);
                      }
                  });
            }
            function guardarrelacionoficio(num,txt){
                if(limitoficio==1) { return false; }
                $.ajax({
                    data: {"cod":6,"num":num,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        console.log(response);
                        $("#resultoficioauto").html("");
                        $("#oficio").val("");
                        $("#oficio").focus();
                        listaroficios();
                      }
                  });
            }
            function eliminaoficios(num){
                $.ajax({
                    data: {"cod":7,"num":num,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        console.log(response);
                        listaroficios();
                      }
                  });
            }
            function listaroficios(){
                $.ajax({
                    data: {"cod":8,"doc":$("#cedula").val() },
                      url:   "candidato/ajax.php",
                      type:  'POST',
                      beforeSend: function () 
                      {

                      },
                      success:  function (response) {
                        console.log(response);
                        d = response.split(",");
                        if (d.length>=3) { limitoficio=1; }else{ limitoficio=0; }
                        
                        $("#listoficios").html(response);
                      }
                  });
            }
            </script>


        <!-- Start Notifications --><!-- End Notifications -->



        <?php include('pie.php'); ?>



    </div> <!-- End #main-content -->



</div></body>



</html>







