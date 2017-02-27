// JavaScript Document
function objetus() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
        try
        {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E)
        {
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
                xmlhttp = new XMLHttpRequest();
        }
    }
    return xmlhttp; 
}
function select_location(urls,id,fields){
   var objetoAjax=objetus();
//   open("/lead_location.php?url=" + urls + "&id=" + id + "&field=" + fields);
	objetoAjax.open("GET","/lead_location.php?url=" + urls + "&id=" + id + "&field=" + fields ,true);
	   objetoAjax.onreadystatechange=function() {
		if (objetoAjax.readyState==4) { 
			document.getElementById('select_' + fields ).innerHTML = objetoAjax.responseText;
		}
   }
   objetoAjax.send(null);
}
function Showcategoria(datos){
   var objetoAjax=objetus();
	divResultado = document.getElementById('subcategorias');

	objetoAjax.open("GET", 'subcategoria.php?categoria=' + datos);
	objetoAjax.onreadystatechange=function() {
		if (objetoAjax.readyState==4) {
			divResultado.innerHTML = objetoAjax.responseText
		}
	}
	objetoAjax.send(null)
}
function Showcategoriaa(datos){
   var objetoAjax=objetus();
	divResultado = document.getElementById('subcategoriasa');

	objetoAjax.open("GET", 'subcategoriaa.php?categoria=' + datos);
	objetoAjax.onreadystatechange=function() {
		if (objetoAjax.readyState==4) {
			divResultado.innerHTML = objetoAjax.responseText
		}
	}
	objetoAjax.send(null)
}


function Showdepartamento(datos){
   var objetoAjax=objetus();
	divResultado = document.getElementById('iddepartamento');

	objetoAjax.open("GET", 'departamentos.php?pais_registrado=' + datos);
	objetoAjax.onreadystatechange=function() {
		if (objetoAjax.readyState==4) {
			divResultado.innerHTML = objetoAjax.responseText
		}
	}
	objetoAjax.send(null)
	
	
	
}
function Showciudad(datos){
   var objetoAjax=objetus();
	divResultado = document.getElementById('idciudad');

	objetoAjax.open("GET", 'ciudades.php?id_departamento=' + datos);
	objetoAjax.onreadystatechange=function() {
		if (objetoAjax.readyState==4) {
			divResultado.innerHTML = objetoAjax.responseText
		}
	}
	objetoAjax.send(null)
}
/*enviar correos con phpmailer*/
function sendPHPMailer($to, $subject, $message){
    require 'PHPMailer/PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = "mail.desarrollosglobales.com";
    //Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication
    $mail->Username = "info@desarrollosglobales.com";
    //Password to use for SMTP authentication
    $mail->Password = "Systemas12345";
    //Set who the message is to be sent from
    $mail->setFrom('info@desarrollosglobales.com', 'Core +');
    //Set an alternative reply-to address
    $mail->addReplyTo('info@desarrollosglobales.com', 'Core +');
    //Set who the message is to be sent to
    $mail->addAddress($to);
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($message);

    //send the message, check for errors
    if (!$mail->send()) {
        return false;
        //echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return true;
        //echo "Message sent!";
    }
}