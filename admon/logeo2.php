<?php 
	require_once("../Connections/database.php");
	include "../lib/funciones.php";
?>
<?php
	$db->select("usuario","*"," WHERE login='" . sql_seguro($_POST['login']) . "' AND password='" . hash_password($_POST['password']) . "'");
	$row = $db->fetch_assoc();	
	if ($row['id_usuario']) {
		session_start();
		$_SESSION['id_usuario']=$row['id_usuario'];
		$_SESSION['nombre_usuario']=$row['nombre_usuario'];
		$_SESSION['roll']=$row['tipo'];	
?>
		<script>window.location="panel.php"</script>
<?php
		exit;
	}
	else
	{
?>
		<script>window.location="logueo.php?msg=1"</script>
<?php
		exit;
	}
?>