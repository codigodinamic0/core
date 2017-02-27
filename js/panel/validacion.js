$(document).ready(function(){
    
    /*
    |--------------------------------------- 
    | validacion de fromulario usuario nuevo
    |---------------------------------------
    */ 
   
   $("#registrados").validate({
//        rules: {
//            nombre_registrado: "required",
//            apellido_registrado:"required",
//            direccion_registrado:"required",
//            telefono_registrado: {required: true, number: true},
//            celular_registrado: {required: true, number: true},
//            contacto_registrado:"required",
//            cargo_registrado:"required",
//            empresa_registrado:"required",
//            perfil_registrado:"required",
//            correo_registrado:{required: true,email: true},
//            skype_registrado:"required",
//            twitter_registrado:"required",
//            nit_registrado:{required: true, number: true},
//            nacio_registrado:{required: true,date: true},
//            usuario_registrado:"required",
//            contrasena_registrado:"required",
//            recontrasena_registrado:{equalTo: "#contrasena_registrado"},
//            tipo_registrado:"required",
//            esposa_registrado:"required",
//            hijos_registrado:{required: true, number: true},
//            img_registrado:{required: true, accept: "png|jpe?g|gif", filesize: 1048576},
//            mensaje_registrado:{ required: true, maxlength: 300}
//            },
        messages: {
            nombre_registrado: "<div class='error-inner'>Nombre es requerido</div>",
            apellido_registrado :"<div class='error-inner'>Apellido es requerido</div>",
            direccion_registrado: "<div class='error-inner'>Direccion es requerido</div>",
            telefono_registrado : "<div class='error-inner'>Tel es requerido, solo numeros</div>",
            celular_registrado : "<div class='error-inner'>cel es requerido, solo numeros</div>",
            contacto_registrado:"<div class='error-inner'>Contacto cel es requerido</div>",
            cargo_registrado:"<div class='error-inner'>Cargo es requerido</div>",
            empresa_registrado:"<div class='error-inner'>Empresa  es requerido</div>",
            perfil_registrado:"<div class='error-inner'>Empresa  es requerido</div>",
            correo_registrado:"<div class='error-inner'>El correo no es valido</div>",
            skype_registrado:"<div class='error-inner'>Skype es requerido</div>",
            twitter_registrado:"<div class='error-inner'>Twitter es requerido</div>",
            nit_registrado:"<div class='error-inner'>Nit es requerido,solo numeros</div>",
            nacio_registrado:"<div class='error-inner'>La fecha no es valida</div>",
            usuario_registrado:"<div class='error-inner'>Usuario es requerido</div>",
            contrasena_registrado:"<div class='error-inner'>Contraseña es requerido</div>",
            recontrasena_registrado:"<div class='error-inner'>Las contraseñas deben coincidir</div>",
            tipo_registrado:"<div class='error-inner'>Tipo es requerido</div>",
            esposa_registrado:"<div class='error-inner'>Esposa es requerido</div>",
            hijos_registrado:"<div class='error-inner'>Cantidad de hijso es requerido</div>",
            img_registrado:"<div class='error-inner'>El formato de imagen no es valido</div>",
            mensaje_registrado:"<div class='error-inner'>Mensaje es requerido,maximo 300 caracteres</div>"
        }
        
    });
    $("#registrados").submit(function(){
        if($(this).valid()==false){
          $("label[for='esposa_registrado']").css("position","absolute");
        }
        var photo = $("#img_registrado").val();
        if (!photo.match(/(?:gif|jpg|png|bmp)$/)||photo.lenght<0) {
            $("#imageError").html("<div class='error-inner'>La imagen no es valida</div>");
            //location.reload();
            return false;
        }
    })
})