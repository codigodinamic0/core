$(document).ready(function(){
    'use strict';
    
    /*si llega la cedula por get*/
    var ccParam =(typeof _GET('cc') !== "undefined")?_GET('cc'):null;
   
    if(ccParam!=null){
        $("#cedula").val(ccParam);
        $("#cedula").trigger('change');
    }
    
    $("#candidato").validationEngine();
    /*inhabilito todos los campos si no existe la cedula*/
    $('#candidato').find('input, textarea, button, select,checkbox,radio,a').not( "#cedula" ).prop('disabled',true);
    
    $("#fecha_nacimiento").mask("9999-99-99", {placeholder: 'yyyy-mm-dd'});
    $("#ingreso_laboral").mask("9999-99-99", {placeholder: 'yyyy-mm-dd'});
    $("#retiro_laboral").mask("9999-99-99", {placeholder: 'yyyy-mm-dd'});
    $("#ano_finalizacion").mask("9999",{placeholder: 'yyyy'});
    
    /*validacion de fechas*/
   
    
    uploadImagen('foto');
    /*obtener ciudades por departamento*/
        $("#departamento").change(function(){
            $.post('candidato/server.php',{action:'getCities',depto:this.value},function(res){
                $("#ciudad").html(res);
            });
        });
        
   /*verificar si el susuario ya existe*/
    $("#cedula").blur(function(){
        $(".loader").show("fast");
        
            $(':input','#candidato')
                .not(':hidden,:radio,:checkbox,#cedula')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
         $("#laborAdded").html("");
         $("#userfoto").attr('src','candidato/default.png');
        $.post('candidato/server.php',{action:'checkUser',cc:this.value,user:$("#id_usuario").val()},function(res){
          
            if(res.status=='ok'){
                $('#candidato').find('input, textarea, button, select,checkbox,radio,a').prop('disabled',false);
                $(".alert-error").hide('fast');
                
                if(res.data){
                    
                     var city=res.data.ciudad;
                    /*poblacion fregular de la tabla candidato*/
                    $.each(res.data,function(name,value){
                        if(name=='id'){
                           $("#id").val(value);
                       } 
                       if(name=='nombre'){
                           $("#nombre").val(value);
                       } 
                       if(name=='nombre1'){
                           $("#nombre1").val(value);
                       }
                       if(name=='apellido'){
                           $("#apellido").val(value);
                       } 
                       if(name=='apellido1'){
                           $("#apellido1").val(value);
                       } 
                       if(name=='libreta_militar'){
                           $("#libreta_militar").val(value);
                       } 
                       if(name=='distrito_militar'){
                           $("#distrito_militar").val(value);
                       } 
                       if(name=='fecha_nacimiento'){
                           $("#fecha_nacimiento").val(value);
                       } 
                       if(name=='estado_civil'){
                           $("#estado_civil option[value='" + value + "']").prop('selected',true);
                           $("#estado_civil option[value='" + value + "']").attr('selected','selected');
                       } 
                       if(name=='correo'){
                           $("#correo").val(value);
                       } 
                       if(name=='direccion'){
                           $("#direccion").val(value);
                       } 
                       if(name=='departamento' ){

                          $("#departamento option[value='" + value + "']").prop('selected',true);
                          $("#departamento option[value='" + value + "']").attr('selected','selected');
                          $.post('candidato/server.php',{action:'getCities',depto:value,selected:city},function(res){
                                $("#ciudad").html(res);
                            });

                       } 
                       if(name=='ciudad'){
                             $("#ciudad option[value='" + value + "']").prop('selected',true);
                             $("#ciudad option[value='" + value + "']").attr('selected','selected');
                       } 
                       if(name=='barrio'){
                           $("#barrio").val(value);
                       } 
                       if(name=='telefono'){
                           $("#telefono").val(value);
                       } 
                       if(name=='area'){
                           $("#area").val(value);
                       } 
                       if(name=='movil'){
                           $("#movil").val(value);
                       } 
                       if(name=='telefono_contacto'){
                           $("#telefono_contacto").val(value);
                       } 
                       if(name=='estado'){
                           $("#estado option[value='" + value + "']").prop('selected',true);
                       } 
                       if(name=='foto'){
                           var pic = (value==0)?'candidato/default.png':(value==''||value==null)?'candidato/default.png':'../../imagenes/foto/thumb/'+value;
                           $("#userfoto").attr('src',pic);
                       } 
                       if(name=='academico'){
                           $("#academico"+value).attr("checked",true);
                       } 
                       if(name=='titulo_odtenido'){
                           $("#titulo_odtenido").val(value);
                       }
                       if(name=='institucion'){
                           $("#institucion").val(value);
                       }
                       if(name=='ano_finalizacion'){
                           $("#ano_finalizacion").val(value);
                       }
                       if(name=='estudia'){
                           if(value>0){
                               $("input[name=estudia][value='"+value+"']").prop("checked",true);
                               $("input[name=estudia][value='"+value+"']").attr("checked","checked");
                           }
                       }
                        if(name=='horario_estudio'){
                           $("#horario_estudio").val(value);
                        }
                        if(name=='academico1'){
                           $("#academico1"+value).attr("checked",true);
                        } 
                        if(name=='titulo_odtenido1'){
                           $("#titulo_odtenido1").val(value);
                       }
                       if(name=='institucion1'){
                           $("#institucion1").val(value);
                       }
                       if(name=='ano_finalizacion1'){
                           $("#ano_finalizacion1").val(value);
                       }
                       if(name=='estudia1'){
                           if(value>0){
                               $("input[name=estudia1][value='"+value+"']").prop("checked",true);
                               $("input[name=estudia1][value='"+value+"']").attr("checked","checked");
                           }
                       }
                        if(name=='horario_estudio1'){
                           $("#horario_estudio1").val(value);
                        }
                        if(name=='otros_cursos'){
                           $("#otros_cursos").val(value);
                       }
                        if(name=='disponibilidad'){
                           $("input[name=disponibilidad][value='"+value+"']").prop("checked",true);
                           $("input[name=disponibilidad][value='"+value+"']").attr("checked","checked");
                       }
                       if(name=='trabaja_actual'){
                           $("#trabaja_actual option[value='" + value + "']").prop('selected',true);
                           $("#trabaja_actual option[value='" + value + "']").attr('selected','selected');
                       } 
                       
                       if (name=="descripcion_llamar")
                        {
                          $("#descripcion_llamar").val(value);
                        };
                      if (name=="sin_info_labora") 
                      {
                        console.log("sin_info_labora--"+value);
                        if (value!="") { $("input[name=sin_info_labora]").prop("checked",true); };
                      };
                       /*if(name=='contrasena'){
                           $("#contrasena").val(value);
                           $("#hcontrasena").val(value);
                        }*/
                         if(name=='boletin'){
                           $("input[name=boletin][value='"+value+"']").prop("checked",true);
                           $("input[name=boletin][value='"+value+"']").attr('checked','checked');
                       }
                    });
                    /*poblacion regular de la tabla relacion para los cursos*/
                    $.each(res.relacion,function(i,v){
                          $("input[name="+v.name+"][value='"+v.id+"']").prop("checked",true);
                          $("input[name="+v.name+"][value='"+v.id+"']").attr('selected','selected');;
                    });
                    /*mostrar informacion laboral*/
                    $("#laborAdded").html('');
                    var innerHtml='';
                        $.each(res.work,function(i,v){

                            innerHtml+='<div class="showLaborInfo labor_'+v.id_laboral+'">\n\
                                      <a href="javascript:void(0)" class="edit_labor controlInfoAdded" id="labor_'+v.id_laboral+'">\n\
                                        <img class="loader edit_labor_'+v.id_laboral+'" title="Cargando" alt="Cargando" src="candidato/loader.gif">\n\
                                        <img src="candidato/edit_icon.png" alt="editar" title="Editar"/>\n\
                                      </a>\n\
                                      <a href="javascript:void(0)" class="remove_labor controlInfoAdded" id="labor_remove_'+v.id_laboral+'">\n\
                                            <img src="candidato/remove_icon.png" alt="Borrar" title="Borrar"/>\n\
                                      </a>';
                            $.each(v,function(i,v){
                                    if(v!='0000-00-00'&&i!='id_laboral'&&v!=0){
                                        if (i=='motivo_laboral') {
                                          i="Fecha retiro";
                                        };
                                        if (i=='ingreso_laboral') {
                                          i="Fecha ingreso";
                                        };
                                        if (i=='cargo_laboral') {
                                          i="Cargo desempeñado";
                                        };
                                        innerHtml+='<label class="ti">'+capitalize(i.replace('_',' '))+': \n\
                                                    <span class="infoLaborAdded">'+v+'</span></label>';
                                    }
                            });   
                             innerHtml+='</div>';
                        });

                        $("#laborAdded").append(innerHtml);
                }else{
                    $("#id").val(res.id);
                }/*end res data*/
               
                
           }else if(res.status=='invalid'){
                $(".alert-error").html('Ha ocurrido un error, el campo no es valido');
                $(".alert-error").show('fast');
                $(document).scrollTop( $("#message").offset().top ); 
             }else{
                $(".alert-error").html('Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde');
                $(".alert-error").show('fast');
                $(document).scrollTop( $("#message").offset().top ); 
            }
            $(".loader").hide("fast");
        });
    });
     
    /*agregar informacion laboral*/
    $(".addLabor").click(function(){
       var currentId =$("#id").val();
       if(currentId!=''){
           
        $("#infolaboral").show("fast");
        $(".addLabor").hide();
       
        }else{
            $(".alert-error").html('Ha ocurrido un error, por favor ingrese numero de cedula');
            $(".alert-error").show('fast');
            $(document).scrollTop( $("#message").offset().top ); 
            closeMessage('alert-error');
       }
    });
    /*guardar informacion laboral*/
    $(document).delegate('#saveLabor','click',function(){
        var formData= $("#infolaboral").find('input, textarea,select').serializeArray();
        var isEmpty=0;
        var currentId =$("#id").val();
        var labor=$("#id_laboral").val();
        $.each(formData,function(i,v){
            if(v.value!=''){
                isEmpty++;
            }
        });
        if(isEmpty>0){
        $(".loader_labor").show("fast");
            
           $.post('candidato/server.php',{action:'addLabor',data:JSON.stringify(formData),candidato:currentId,id_labor:labor},function(res){
                $(".loader_labor").hide("fast");
                $('.info').remove();
               if(res.status=="ok"){
                   
                   var infoExist=$($('.labor_'+res.labor)).length;
                   var innerHtml='<div class="showLaborInfo labor_'+res.labor+'">\n\
                                  <a href="javascript:void(0)" class="edit_labor controlInfoAdded" id="labor_'+res.labor+'">\n\
                                    <img class="loader edit_labor_'+res.labor+'" title="Cargando" alt="Cargando" src="candidato/loader.gif">\n\
                                    <img src="candidato/edit_icon.png" alt="editar" title="Editar"/>\n\
                                  </a>\n\
                                  <a href="javascript:void(0)" class="remove_labor controlInfoAdded" id="labor_remove_'+res.labor+'">\n\
                                        <img src="candidato/remove_icon.png" alt="Borrar" title="Borrar"/>\n\
                                  </a>';
                    $.each(formData,function(i,v){
                        var rightValue='';
                        if(v.value!=''&&v.value!=0&&v.value!='0000-00-00'){
                            if(v.name=='motivo_laboral'){
                                rightValue=res.motivo;
                            }else{
                                rightValue =v.value;
                            }
                            
                            innerHtml+='<label class="ti">'+capitalize(v.name.replace('_',' '))+':\n\
                                        <span class="infoLaborAdded">'+rightValue+'</span></label>';
                        }
                    });
                    innerHtml+='</div>';
                    
                  $("<p class='info info-succes'>La información se agrego correctamente</p>").insertBefore("#infolaboral");
                  /*controles*/
                  if(infoExist){
                    $('.labor_'+res.labor).replaceWith(innerHtml);
                  }else{
                    $("#laborAdded").prepend(innerHtml);
                      
                  }
                  /*se limpia el formulario*/
                  $.each(formData,function(i,v){
                      $('#'+v.name).val('');
                  });
                  $("#infolaboral").hide();
                  $(".addLabor").show();
                  $("#id_laboral").val(0);
                  closeMessage('info');
                  
               }else{
                  $("<p class='info info-error'>Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde</p>").insertBefore("#infolaboral");
               }
           });
        }
    });
    /*editar informacion laboral*/
    $(document).delegate('.edit_labor','click',function(){
        var currentId =this.id.split('_');
        $("#id_laboral").val(currentId[1]);
        $(".edit_labor_"+currentId[1]).show();
        $.post('candidato/server.php',{action:'getLaborInfo',id_labor:currentId[1]},function(res){
            if(res.status=='ok'){
                
                $.each(res.data,function(i,v){
                    if(i=='motivo_laboral'){
                        $("#motivo_laboral option[value='" + v + "']").prop('selected',true);
                    }else{
                        
                        $("#"+i).val(v);
                    }
                });
                
                $(".edit_labor_"+currentId[1]).hide();
                $("#infolaboral").show();
                $(document).scrollTop( $("#infolaboral").offset().top );
                $(".addLabor").hide();
            }else{
                $("<p class='info info-error'>Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde</p>").insertBefore("#infolaboral");
            }
             
        });
   });
   /*borrar informacion laboral*/
   $(document).delegate('.remove_labor','click',function(){
       var currentId =this.id.split('_');
       var veri= confirm('¿Esta seguro de aplicar esta acción?');
        if (veri) {
            $(".edit_labor_"+currentId[2]).show();
            $.post('candidato/server.php',{action:'removeLaborInfo',id_labor:currentId[2]},function(res){
                $(".edit_labor_"+currentId[2]).hide();
                if(res.status=='ok'){
                    $('.labor_'+currentId[2]).remove();
                    $("#id_laboral").val(0);
                }else{
                    $("<p class='info info-error'>Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde</p>").insertBefore("#infolaboral");
                }
            });
        }
   })
    /*cnacelar el agregado de informacion laboral*/
    $(document).delegate('#cancelLabor','click',function(){
        $("#infolaboral").hide();
        $(".addLabor").show();
        $("#id_laboral").val(0);
    });
        
    /*grabar cambios en tiempo real*/
     $("input,radio,checkbox,select,textarea").change(function() {
        if(this.name!='cedula'){
            saveCandidato();
        }
    });
    /*grabar contraeña*/
/*    $("#contrasena").change(function(){
        var currentId =$("#id").val();  
         var clearData ={
            'contrasena':$("#contrasena").val() 
         }
        $.post('candidato/server.php',{action:'save',candidato:currentId,data:JSON.stringify(clearData)});
    });*/
        
     /*serializar formulario*/ 
     $("#candidato").submit(function(e){
         e.preventDefault();
         location.href="registro.php";
         var valid = $("#candidato").validationEngine('validate');
    
         if(valid){
             
             if(saveCandidato()){
                $(':input','#candidato')
                .not(':hidden,:radio,:checkbox,#cedula')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
                $("#userfoto").attr('src','candidato/default.png');
                $("#laborAdded").html("");
                $('#candidato').find('input, textarea, button, select,checkbox,radio,a').not( "#cedula" ).prop('disabled',true);
                $(".alert-success").html('!Información guardad satisfactoriamente');
                $(".alert-success").show('fast');
                $(document).scrollTop( $("#message").offset().top ); 
                /*refresco el datatable */initDatatable();
             }else{
                $(".alert-error").html('Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde');
                $(".alert-error").show('fast');
                $(document).scrollTop( $("#message").offset().top ); 
             }
         }
     });
     /*datatable*/
     initDatatable();
     /*borrar registro del datatable*/
     $(document).delegate('.delete_can','click',function(){
         var id = this.id.split('_');
         var very = confirm('¿Esta seguro de aplicar la acción?');
         if(very){
             $.post('candidato/server.php',{action:'delete',candidato:id[1]},function(res){
                 if(res.status=='ok'){
                     /*refresco el datatable */initDatatable();
                 }else{
                    $(".alert-error").html('Ha ocurrido un error inesperado, vuelve a intentarlo mas tarde');
                    $(".alert-error").show('fast');
                    $(document).scrollTop( $("#message").offset().top );
                 }
             });
         }
       
     })
  });      
    
var closeMessage=function(div){
    setInterval(function(){ $('.'+div).fadeOut(2000) }, 4000);
} 
var capitalize=function (s){
    return s[0].toUpperCase() + s.slice(1);
}
var  isValidEmailAddress =function(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(email);
};
var saveCandidato =function(){
    
    var currentId =$("#id").val();  
    var courses=[],interest=[], attitudes=[];
    var response=false;
        var academico = 0;
        $("input[name=academico]").each(function(){
            if ($(this).is(":checked")) { academico=$(this).val();  };
        })
        var academico1 = 0;
        $("input[name=academico1]").each(function(){
            if ($(this).is(":checked")) { academico1=$(this).val();  };
        })
        console.log(academico);
        var clearData ={
             'id_registrado':$("#id_usuario").val() , 
             'nombre':$("#nombre").val() , 
             'nombre1':$("#nombre1").val() ,
             'apellido':$("#apellido").val() ,
             'apellido1':$("#apellido1").val() , 
             'cedula' :$("#cedula").val(), 
             'libreta_militar' :$("#libreta_militar").val(),
             'distrito_militar' :$("#distrito_militar").val(), 
             'estado':$("#estado").val() , 
             'fecha_nacimiento':$("#fecha_nacimiento").val() , 
             'estado_civil' :$("#estado_civil").val(), 
             'direccion' :$("#direccion").val(), 
             'barrio' :$("#barrio").val(), 
             'departamento' :$("#departamento").val(), 
             'ciudad':$("#ciudad").val() , 
             'telefono' :$("#telefono").val(),
             'area' :$("#area").val(), 
             'movil' :$("#movil").val(), 
             'telefono_contacto':$("#telefono_contacto").val() , 
             'correo' :(isValidEmailAddress($("#correo").val()))?$("#correo").val():'', 
             'academico':academico, 
             'titulo_odtenido' :$("#titulo_odtenido").val(), 
             'institucion' :$("#institucion").val(), 
             'ano_finalizacion' :$("#ano_finalizacion").val(), 
             'estudia' :($("#estudia_si").is(':checked'))?1:2, 
             'horario_estudio' :$("#horario_estudio").val(), 
             'academico1':academico1, 
             'titulo_odtenido1' :$("#titulo_odtenido1").val(), 
             'institucion1' :$("#institucion1").val(), 
             'ano_finalizacion1' :$("#ano_finalizacion1").val(), 
             'estudia1' :($("#estudia_si1").is(':checked'))?1:2, 
             'horario_estudio1' :$("#horario_estudio1").val(), 
             'otros_cursos' :$("#otros_cursos").val(), 
             'disponibilidad' :$("input[name=disponibilidad]:checked").val(), 
             'trabaja_actual' :$("#trabaja_actual").val(), 
             'boletin' :$("input[name=boletin]:checked").val(), 
             'descripcion_llamar':$("#descripcion_llamar").val(),
             'sin_info_labora':($("#sin_info_labora").is(':checked'))?$("#sin_info_labora").val():"",
        };
        /*cursos*/
        $(".courses").each(function(i,v){
            if($(this).is(":checked")){
                courses.push(v.value);
            }
        });
        /*intereses*/
        $(".interest").each(function(i,v){
            if($(this).is(":checked")){
                interest.push(v.value);
            }
        });
        /*actitudes*/
       
        $(".attitudes").each(function(i,v){
            if($(this).is(":checked")){
                attitudes.push(v.value);
            }
        });
        console.log("entra");
        var data= $.ajax({
            type: "POST",
            url: 'candidato/server.php',
            data: {
                    action:'save',
                    candidato:currentId,
                    data:JSON.stringify(clearData),
                    courses:JSON.stringify(courses),
                    interest:JSON.stringify(interest),
                    attitudes:JSON.stringify(attitudes)
                  },
            async: false,
            success:function(res){
                console.log(res.status);
                if(res.status=='ok'){
                     response= true;
                 }else{
                     response= false;
                 }
            }
          });
            return response;
         
}
var uploadImagen =function(control){
     var formdata = new FormData();  
     $("#"+control).unbind("change").on("change", function() {
        var file = this.files[0];
        var flag=true;
        if(!this.value.match(/(\.png|\.jpg|\.jpeg)$/i)||this.files[0].size>10485760){ 
            flag=false;
              if(this.files[0].size>10485760){
                    $(".image_msg").html("El tamaño del archivo sobrepasa el limite");
                }
            $(".image_msg").html("Formato de archivo incorrecto,solo(png|jpg|gif)");
        }
        if (formdata&&flag) {
            $(".image_msg").html("");
            formdata.append("action", "addImage");
            formdata.append("picture", file);
            formdata.append("relation", $("#id").val());
            $(".img_loader").show();
            $.ajax({
                url: 'candidato/server.php',
                type: "POST",
                data: formdata,
                processData:false,
                contentType: false,
                success:function(res){
                    $(".img_loader").hide();
                    if(res.status=="ok"){
                        $("#userfoto").attr('src',res.pic+'?'+new Date().getTime());
                    }else{
                       $(".image_msg").html("Ha ocurrido un error inesperado,vuelve a intentarlo mas tarde");
                    }
                }
            });
        }                       
    });
}
var initDatatable= function(){
    $('#cand').dataTable({
                "bDestroy" : true,
		            "bProcessing": true,
                "bServerSide": true,
                "iDisplayLength": 10,
                "bFilter": true,
                "sPaginationType": "full_numbers",
                 "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ entradas por pagina",
                    "sZeroRecords": "Sin entradas por mostrar",
                    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "sInfoFiltered": "(filtrado de _MAX_ total entradas)",
                    "sProcessing": "Procesando",
                    "sSearch": "Buscar:",
                    "oPaginate": { 
                        "sFirst": "Primera",
                        "sLast": "Ultima",
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior" 
                    },
                   },
                   "aaSorting": [[0, 'desc']],
                   "sAjaxSource": "candidato/datatable/datatable.php",
                   "aoColumnDefs": [{"bSortable":false,"aTargets":[6]}] 
	});
}
var _GET =function (name){
   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
       return decodeURIComponent(name[1]);
}

var RangeDate =function(date){
    var startDate = new Date(1800, 0, 1);
    var endDate = new Date(2008, 0, 1);     
    if (startDate < date && date < endDate) {
       return true; 
    }
   return false;
}


