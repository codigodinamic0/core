<? 
require_once('../Connections/database.php'); 

$fecha2 = date( "Y-n-j" );
$OrigenArchivo = "../sitemap.xml"; 
function limpiar_url($url)
{
	$buscar = array('#',' ','@','.','+','<','/','Ñ','ñ','\'','(',')','?','z','"',':','á','é','í','ó','ú');
	$nuevo = array('numero','-','-','','','','-','N','n','-','','','','','','','a','e','i','o','u');
	for ($i = 0; $i < count($buscar); $i++)
    {
		$buscarcache[] = $buscar[$i];
	}
	$url = $url;
	$enlace = str_replace($buscarcache, $nuevo, $url);
	$enlace = strtolower($enlace);
	
	return $enlace;
}
//Creamos la cabecera del .xml
$codigo='<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


	
	$codigo.='<url>http://artecnologia.net<loc> 
	</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
   	$codigo.='<url>http://artecnologia.net/contactenos.php<loc> 
	</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
	
	
	
	//dinamicas de categorias

	 	$cpadre = array();
$db->select("sublinea","*","order by nombre_sublinea");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {  
		 
   $codigo .='<url>  <loc>'.limpiar_url($row['nombre_sublinea']).'_'.$row['id_sublinea'].'_sublinea';   
	$codigo .='</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
}

	//dinamicas de productos

	 $cpadre = array();
$db->select("producto","*","where estado_producto=1 order by id_producto desc  limit 100");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {	
		 
   $codigo .='<url>  <loc>'.limpiar_url($row['nombre_producto']).'_'.$row['id_sublinea'].'_'.$row['id_producto'].'_prod';   
	$codigo .='</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
}
$codigo .='</urlset> ';

//Ahora creamos el archivo con el código necesario
$path = "../sitemap.xml";
$modo = "w+";

if($codigo 
   && $OrigenArchivo) {
//   if(file_exists($OrigenArchivo)) {
   $fp = fopen($OrigenArchivo,"w+"); 
   fwrite($fp,$codigo); 
   fclose($fp);
 } else echo "<script>alert(' El archivo $OrigenArchivo / $FileXml no existe por favor lee la linea 3 del archivo xmlgallery.php ')</script>";



?>



