
<?php 
$aquien_llega=$_POST['asunto'];
 
 $destinatario =$aquien_llega;

//Asunto
$asunto = " Contactenos "; 
///cuerpo del mensaje
$cuerpo = '  
<table style="font-family: Tahoma;
	font-size: 15px;
	color: #333333; width:500px; background: #C06 margin:15px; ">
 <tr>
    <td colspan="2" align="center"><div  style="background-color: #FFB821;
	font-family: tahoma;
	font-size: 14px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFFFFF;">Correo enviado desde contacto de tramontana</div></td>
  </tr>
   <tr >
    <td width="232"><div  style="padding:5px; text-align:right;">
      <div align="right" class="blanco">Nombre :</div>
    </div></td>
    <td width="256"><div align="left">'.$_POST['nombre'].'</div></td>
  </tr>
  
  <tr >
    <td width="232"><div  style="padding:5px; text-align:right;">
      <div align="right" class="blanco">Email :</div>
    </div></td>
    <td width="256"><div align="left">'.$_POST['mail'].'</div></td>
  </tr>

   <tr >
    <td width="232"><div  style="padding:5px; text-align:right;">
      <div align="right" class="blanco">Teléfono :</div>
    </div></td>
    <td width="256"><div align="left">'.$_POST['telefono'].'</div></td>
  </tr>
  <tr >
    <td width="232"><div  style="padding:5px; text-align:right;">
      <div align="right" class="blanco">Celular :</div>
    </div></td>
    <td width="256"><div align="left">'.$_POST['celular'].'</div></td>
  </tr>
  
  
   <tr >
    <td width="232"><div  style="padding:5px; text-align:right;">
      <div align="right" class="blanco">Comentario :</div>
    </div></td>
    <td width="256"><div align="left">'.$_POST['comen'].'</div></td>
  </tr>
  
</table>


'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8"; 

//dirección del remitente 
$headers .= "From: 	tramontana.com --- info@tramontana.com   \r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To:info@tramontana.com \r\n"; 


mail($destinatario,$asunto,$cuerpo,$headers); 

// mail('jhumamc@gmail.com',$asunto,$cuerpo,$headers);  
 
 
 
 
 //finaliza envio de correo
 ?>