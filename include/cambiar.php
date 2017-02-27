<?php
	session_start();
	$sesion = session_id();
	$_SESSION['idioma']=$_GET['idioma'];
	setCookie("idioma",$_GET['idioma'],time() +3600*24*365);

?>
	<script>window.location="../index.php"</script>
<?php
exit;

?>