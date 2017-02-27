<?
$url_site="http://codigodinamico.com/zenled";
$fecha2 = date( "Y-m-d" );
$OrigenArchivo = "../sitemap.xml"; 

//Creamos la cabecera del .xml
$codigo='<?xml version="1.0" encoding="utf-8"?><!-- Generated using : www.XmlSitemapGenerator.org : 2011-11-01 07-58-05 : FiZBy3LyW/DhWYa8rG7Fxw==--><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';


	
	$codigo.='<url><loc>'.$url_site.'
	</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
   	$codigo.='<url><loc> '.$url_site.'/contactenos.php
	</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
	

	
	//dinamicas de categorias

      $cpadre = array();
$db->select("sublinea","*"," order by sublinea.id_sublinea desc limit 50 ");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
      $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
  $codigo .='<url>  <loc>'.$url_site.'/linea-'.limpiar_url(utf8_encode($row['nombre_sublinea'])).'_'.$row['id_sublinea'].'__';  
	$codigo .='</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
}

	//dinamicas de productos

      $cpadre = array();
$db->select("producto","producto.nombre_producto, producto.id_producto, producto.id_sublinea","where  estado_producto=1 order by id_producto desc  limit 100");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
      $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
		 
   $codigo .='<url>  <loc>'.$url_site.'/producto-'.limpiar_url(utf8_encode($row['nombre_producto'])).'_'.$row['id_sublinea'].'_'.$row['id_producto'];   
	$codigo .='</loc>
   <lastmod>'.$fecha2.'</lastmod> 
   <priority>0.7</priority>
   </url> ';
}

//dinamicas contenidos

		 $cpadre = array();
$db->select("textos_r","*","where idr<>3  order by idt desc  limit 100");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
      $cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row) {
   $codigo .='<url>  <loc>'.$url_site.'/contenido-'.limpiar_url(utf8_encode($row['titulo'])).'_'.$row['idt'].'_'.$row['idr'];   
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