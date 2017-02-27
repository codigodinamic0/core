<?php if ($_FILES['img_matrix']['name'] != "") {
	$valid_formats = array(
        "jpg",
        "png",
        "gif",
        "bmp",
        "JPG");
			$name = $_FILES['img_matrix']['name'];
			$size = $_FILES['img_matrix']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen1
}


//preguntamos si hay imagen 2
if ($_FILES['img1_matrix']['name'] != "") {
	$valid_formats = array(
        "jpg",
        "png",
        "gif",
        "bmp",
        "JPG");
			$name = $_FILES['img1_matrix']['name'];
			$size = $_FILES['img1_matrix']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen2
}

//preguntamos si hay imagen 3
if ($_FILES['img2_matrix']['name'] != "") {
	$valid_formats = array(
        "jpg",
        "png",
        "gif",
        "bmp",
        "JPG");
			$name = $_FILES['img2_matrix']['name'];
			$size = $_FILES['img2_matrix']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen2
}



//preguntamos si hay  flas
if ($_FILES['flas']['name'] != "") {
	$valid_formats = array(
        "swf",
        "SWF");
			$name = $_FILES['flash']['name'];
			$size = $_FILES['flash']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen2
}


//preguntamos por el archivos
if ($_FILES['archivo']['name'] != "") {
	$valid_formats = array(
"jpg", "png", "gif","bmp", "JPG","txt","zip","ZIP","SWF","SWF","doc","docx","xls","ppt","pdf","psd",);
			$name = $_FILES['archivo']['name'];
			$size = $_FILES['archivo']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen1
}



//preguntamos por el archivos
if ($_FILES['mp3']['name'] != "") {
	$valid_formats = array(
"MP3", "mp3", "mpg");
			$name = $_FILES['mp3']['name'];
			$size = $_FILES['mp3']['size'];
					list($txt, $ext) = explode(".", $name);
					if(!in_array($ext,$valid_formats) or $size>($maximo))
						{
							?>
<script>javascript:history.back(alert("<?php $valor = variable(135, 2);
echo $valor[1]; ?>"));</script>
							
							<?php
						}					
//cierro si hay imagen1
}
?>