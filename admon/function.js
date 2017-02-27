// JavaScript Document
function objetus() {
	var xmlhttp=false;
	try	{
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
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

