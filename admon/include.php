<?php require_once('../Connections/connection.php'); 
$link = Connect();
$matriz_url="http://codigodinamico.com/"; 
include("modulos.php");
$pagina="Panel administrativo"; 
$msg=$_GET['msg'];
session_start();

if($_GET['paginar']){
$_SESSION['pag']=1;
$_SESSION['paginador']=$_GET['paginar'];
}
elseif($_SESSION['paginador']){
$_SESSION['paginador']=$_SESSION['paginador'];
} else {
$_SESSION['paginador']=1000;
}



if($_GET['pg']){
$_SESSION['pag']=$_GET['pg'];
}
elseif($_SESSION['pag']){
$_SESSION['pag']=$_SESSION['pag'];
} else {
$_SESSION['pag']="";
}

if($_GET['chino']){

$_SESSION['chino']=$_GET['chino'];
}
elseif($_SESSION['chino']){
$_SESSION['chino']=$_SESSION['chino'];
} else {
$_SESSION['chino']=1;
}
if($_SESSION['chino']==1) mysql_query("SET NAMES 'utf8'");
if (!isset($_SESSION["id_usuario"])) {?><script>window.location="logueo.php?msg=1"</script> <?
exit;
 } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $pagina ?></title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/formato_textos.css" type="text/css" />
<!--<link href="../js/jquery/color_picker/color_picker.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/panel/jquery-1.7.1.min.js"></script><br />
<!--<script src="../js/panel/jquery/ifx.js" type="text/javascript"></script>-->
<script src="../js/panel/idrop.js" type="text/javascript"></script>
<script src="../js/panel/idrag.js" type="text/javascript"></script>
<script src="../js/panel/iutil.js" type="text/javascript"></script>
<script src="../js/panel/islider.js" type="text/javascript"></script>
<!--<script src="../js/panel/color_picker/color_picker.js" type="text/javascript"></script>-->
<script type="text/javascript" src="../js/panel/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="../js/panel/facebox.js"></script>
<script type="text/javascript" src="../js/panel/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="../js/panel/jquery.datePicker.js"></script>
<script type="text/javascript" src="../js/panel/jquery.date.js"></script>
<script src="<?php echo $dominio?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo $dominio?>plugins/ckeditor/sample.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../js/panel/epoch/epoch_styles.css">
<script type="text/javascript" src="../js/panel/epoch/epoch_classes.js"></script>
<script type="text/javascript">  
window.onload = function () {
	new Epoch('epoch_popup','popup',document.getElementById('fecha'));
	new Epoch('epoch_popup','popup',document.getElementById('nacio_registrado'));
	new Epoch('epoch_popup','popup',document.getElementById('evento_matrix'));
};
</script>
<script type="text/javascript">
function saveContent() {
	  document.getElementById('renglon_contenido').style.display = "none";
	  CKEDITOR.instances.contenido_1.updateElement(); 
	  var data = CKEDITOR.instances.contenido_1.getData(); 
	  CKEDITOR.instances.contenido_1.destroy(); 
	}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}


<!--para validar numeros-->
var no_digito = /\D/g;
</script>
</head>
<body>