<?
require_once('../Connections/database.php');
if($_POST['Submit'] == "Eliminar") {
	for($s=0;$s<count($_POST['del']);$s++) {
		// OJO MIRA COMO MODIFIQUE EL CAMPO id PASO A LLAMARSe id[$s]
		$db->delete("producto","where id_producto = '" . $_POST['del'][$s] . "'");
	}
}


if($_POST['Submit'] == "Guardar") {
	for($s=0;$s<count($_POST['id_producto']);$s++) {
		// OJO MIRA COMO MODIFIQUE EL CAMPO id PASO A LLAMARSe id[$s]
		$sql = "UPDATE producto set 
		nombre_producto='" . $_POST['titulo'][$s] . "'"; 
		$sql = $sql . " where id_producto = '" . $_POST['id_producto'][$s] . "' ";

		echo $sql."<hr>";
	  $updatecontenido = $db->prepare($sql);
  $updatecontenido->execute();
  $updatecontenido->close();

	}
}
include ('genero_xml.php');

//foreach ($_POST as $name => $value ) echo (" $name => $value  <br> ");
?>

<script>window . location="productos.php?idr=<?= $_GET['idr'] ?>&rand=<?= rand(1,65000)?>";</script>

<!--
<script>window . location="admin_listado1.php?&msg=2&rand=<?= rand(1,65000)?>&id_linea=<?= $_POST['id_linea'] ?>&idsublinea=<?= $_POST['idsublinea'] ?>";</script>

-->