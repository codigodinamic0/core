<?php
$mes = array(
    'Diciembre',
	'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre');
$semana = array(
    'Domingo',
	'Lunes',
    'Martes',
    'Miercoles',
    'Jueves',
    'Viernes',
    'Sabado');
$fecha2 = date("Y-m-d");
function xecho($msg)
{
    $link = Connect();
    $sql = "INSERT INTO xecho(msg_xecho) values  ('" . $msg . "')";
    $res = mysql_query($sql);
}

function hash_password($s, $t = 2)
{
    for ($i = 0; $i < $t; $i++)
        $s = md5(sha1($s));
    return $s;
}

function get_random($t = 8)
{
    $cadena = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $new = "";
    for ($i = 0; $i < $t; $i++)
        $new .= substr($cadena, rand(1, strlen($cadena)), 1);
    return $new;
}

function fecha_escrita($date)
{

    if ($date == "")
        return $date;

    $mes = $GLOBALS['mes'];
    $semana = $GLOBALS['semana'];

    $fecha_hora = explode(' ', $date);

    $d = explode('-', $fecha_hora[0]);
    $dia_semana = date("w", mktime(0, 0, 0, $d[1], $d[2], $d[0]));
    $fecha_escrita = $semana[$dia_semana] . " " . (int)$d[2] . " de " . $mes[(int)$d[1]] .
        ", " . $d[0];

    if (isset($fecha_hora[1]))
    {
        $hora_min = explode(':', $fecha_hora[1]);
        $fecha_escrita .= " - " . $hora_min[0] . ":" . $hora_min[1];
    }

    return $fecha_escrita;
}

function fecha_escrita_array($date)
{

    if ($date == "")
        return $date;

    $mes = $GLOBALS['mes'];
    $semana = $GLOBALS['semana'];

    $d = explode('-', $date);
    $dia_semana = date("w", mktime(0, 0, 0, $d[1], $d[2], $d[0]));
    $fecha_escrita = $semana[$dia_semana] . "~" . (int)$d[2] . "~" . $mes[(int)$d[1]] . "~" . $d[0];
	
    return $fecha_escrita;
}

function limpiar_texto($str)
{
    $vocalti = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "n",
        "N",
        "'",
        "\\",
        "\"",
        "`",
        "´");
    $vocales = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "n",
        "N",
        "",
        "",
        "",
        "",
        "");
    return str_replace($vocalti, $vocales, $str);
}
function limpiar_url($url)
{
    $buscar = array(
        '#',
        ' ',
        '@',
        '.',
        '+',
        '<',
        '/',
        'Ñ',
        'ñ',
        '\'',
        '(',
        ')',
        '?',
        '>',
        '"',
        ':',
        'á',
        'é',
        'í',
        'ó',
        'ú',
        'Á',
        'É',
        'Í',
        'Ó',
        '`',
        '%',
		'&',
        'Ú');
    $nuevo = array(
        'numero',
        '-',
        '-',
        '',
        '',
        '',
        '-',
        'N',
        'n',
        '-',
        '',
        '',
        '',
        '',
        '',
        '',
        'a',
        'e',
        'i',
        'o',
        'u',
        'A',
        'E',
        'I',
        'O',
        '',
        '',
		'y',
        'U');
    for ($i = 0; $i < count($buscar); $i++)
    {
        $buscarcache[] = $buscar[$i];
    }
    $url = $url;
    $enlace = str_replace($buscarcache, $nuevo, $url);
    $enlace = strtolower($enlace);

    return $enlace;
}


function sql_seguro($str)
{
    $str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
    $str = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($str) :
        mysql_escape_string($str);
    return ($str);
}

function getMaxUpload()
{
    $up = str_replace("M", "", ini_get('upload_max_filesize'));
    $po = str_replace("M", "", ini_get('post_max_size'));
    return $up < $po ? $up : $po;
}

function esIE()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'],
        'MSIE') !== false))
        return true;
    else
        return false;
}

function echo_textarea($texto)
{
    $texto = str_replace(' ', '&nbsp;', $texto);
    $texto = strtr($texto, array(
        "\r\n" => '<br />',
        "\r" => '<br />',
        "\n" => '<br />'));
    return $texto;
}

function ajustar_video($width, $height, $codigo)
{
    $patron = '/width="(\d+)"/i';
    $sustitución = 'width="' . $width . '"';
    $codigo = preg_replace($patron, $sustitución, $codigo);

    $patron = '/height="(\d+)"/i';
    $sustitución = 'height="' . $height . '"';
    return preg_replace($patron, $sustitución, $codigo);
}

function ieversion()
{
    ereg('MSIE ([0-9]\.[0-9])', $_SERVER['HTTP_USER_AGENT'], $reg);
    if (!isset($reg[1]))
        return - 1;
    else
        return floatval($reg[1]);
}


//Funcion para el manejo de Idimoma en el Sitio
//Tiene 2 parametros de Entrada
//1: El texto al que se le quiere Cambiar el idioma
//2: El idioma que maneja la session
function idioma($codigo, $idioma, $grupo)
{

    $consulta = "SELECT idpa.titulo_idpa, idpa.nombre_idpa, idpa.nota_idpa
            FROM
            palabra, idpa
            WHERE
            palabra.id_palabra=idpa.palabra  and idpa.idioma='" . $idioma .
        "' AND
            palabra.codigo_palabra = '" . $codigo . "' and idpa.idr='" . $grupo .
        "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $array = array($rowt['titulo_idpa'], $rowt['nota_idpa']);
}


//retorna un bit de imagenes que se utilizan
//para mostar las imagenes en el slide
//tiene un para metro de entrada que es opcionar
//y determina el idioma en el que va a
//mostrar las imagenes del slider
function Slider($id_slider)
{
    $sql2 = "SELECT * FROM rotan where id_rotan='" . $id_slider . "'";
    $res2 = @mysql_query($sql2);
    if (!$res2)
    {
        exit(mysql_error());
    }
    $row2 = mysql_fetch_array($res2);
    $ancho = $row2['ancho'];
    $alto = $row2['alto'];


    $sql = "SELECT * FROM slide where id_rotan='" . $id_slider .
        "'   order by rand()";
    $res = @mysql_query($sql);
    if (!$res)
    {
        exit(mysql_error());
    }
    $bit = "";
    while ($row = mysql_fetch_array($res))
    {
        //pregunto si existe url
        if ($row['url_slide'])
        {
            $bit .= '<a href="' . $row['url_slide'] . '" target="' . $row['abre_slide'] .
                '"><img src="imagenes/' . $row['img_slide'] . '"  border="0" width="' . $ancho .
                '" height="' . $alto . '" /></a>';

        } else
        {
            $bit .= '<img src="imagenes/' . $row['img_slide'] . '"  border="0" width="' . $ancho .
                '" height="' . $alto . '" />';
        }
        //termina si hay url

    }
    return $bit;

}


//esta funcion verifica si un archivo existe
//tiene 2 parametros de entrada uno es el directorio y el otro es el nombre
//del archivo que se va a verificar si existe
function verficarsiunarchivoexiste($localiza = '', $archivo)
{
    $directo = $localiza . $archivo;
    if (file_exists($directo))
    {
        return true;
    } else
    {
        return false;
    }

}
function ValidaMail($pMail)
{
    if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",
        $pMail))
    {
        return true;
    } else
    {
        return false;
    }
}


function variable($id_variable, $idr)
{

    $consulta = "SELECT
           valor_variable,
		   contenido_variable
            FROM
            variable
            WHERE
            codigo_variable = '" . $id_variable . "' and tipo_variable='" . $idr .
        "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $array = array($rowt['valor_variable'], $rowt['contenido_variable']);


}

function valor_texto_r($idt)
{

    $consulta = "SELECT
           titulo,
		   contenido
            FROM
            textos_r
            WHERE
            idt = '" . $idt . "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $array = array(utf8_encode($rowt['titulo']), utf8_encode($rowt['contenido']));


}


function valor_texto($id_texto)
{

    $consulta = "SELECT
           nombre_texto,
		   descripcion
            FROM
            texto
            WHERE
            id_texto = '" . $id_texto . "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $array = array(utf8_encode($rowt['nombre_texto']), utf8_encode($rowt['descripcion']));


}


function contar_producto($id_matrix)
{

    $consulta = "SELECT
           count(secundaria.idr) as  total 
            FROM
           secundaria
            WHERE
          secundaria.idr= '" . $id_matrix . "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);


    return $rowt['total'];


}
$valid_formats = array(
    "jpg",
    "png",
    "gif",
    "bmp",
    "JPG");
function archivos_extencion_tamano($archivoa, $nombre, $tamano)
{
    if (is_array($archivoa))
    {
        $valid_formats = $archivoa;
        if (strlen($nombre))
        {
            list($txt, $ext) = explode(".", $nombre);
            if (in_array($ext, $valid_formats) && $size < (1024 * 1024))
            {
                $actual_image_name = time() . substr($txt, 5) . "." . $ext;
                return true;
            } else
            {
                return false;
            }
        } else
        {
            return false;
        }
    } else
    {
        return false;
    }

}


function caracteres_especiales($caracter)
{
    $ascii = array(
        "à" => "&#192;",
        "À" => "&#224;",
        "è" => "&#232;",
        "È" => "&#232;",
        "ü" => "&#252;",
        "Ü" => "&#252;",
        "ñ" => "&#241;",
        "Ñ" => "&#241;",
        "'" => "&#39;",
        "Ÿ" => "&#255;",
        "ÿ" => "&#255;",
        "ë" => "&#235;",
        "Ë" => "&#235;",
        "ò" => "&#242;",
        "Ò" => "&#242;",
        "ì" => "&#236;",
        "Ì" => "&#236;",
        "Ù" => "&#249;",
        "ù" => "&#249;",
        "ú" => "&#250;",
        "Ú" => "&#250;",
        "ï" => "&#239;",
        "î" => "&#238;",
        "ö" => "&#246;",
        "Ö" => "&#246;",
        "á" => "&#225;",
        "Á" => "&#225;",
        "ó" => "&#243;",
        "Ó" => "&#243;",
        "é" => "&#233;",
        "É" => "&#233;",
        "í" => "&#237;",
        "Í" => "&#237;",
        "Å" => "&#197;",
        "å" => "&#229;",
        "c" => "&#263;",
        "C" => "&#263;",
        "Ó" => "&#243;",
        "ó" => "&#243;",
        "S" => "&#347;",
        "s" => "&#347;",
        "A" => "&#261;",
        "a" => "&#261;",
        "E" => "&#281;",
        "e" => "&#281;",
        "L" => "&#322;",
        "l" => "&#322;",
        "N" => "&#324;",
        "n" => "&#324;",
        "Z" => "&#378;",
        "z" => "&#378;",
        "Z" => "&#380;",
        "z" => "&#380;");
    $array_buscar = array();
    $array_nuevo = array();
    foreach ($ascii as $key => $value)
    {
        $array_buscar[] = $key;
        $array_nuevo[] = $value;
    }

    $palabra = str_replace($array_buscar, $array_nuevo, $caracter);

    return $palabra;

}

function menu_recursivo($id = null)
{
    $menu = "";
    $de = "";
    if (!is_null($id))
    {
        $de = "WHERE de={$id}";
    } else
    {
        $de = "WHERE de=''";
    }

    $sql = "SELECT * FROM `categoria` {$de}";
    $res = @mysql_query($sql);
    if (!$res)
    {
        exit(mysql_error());
    }
    if (mysql_num_rows($res) >= 1)
    {
        $menu .= "<ul>";
        while ($row = mysql_fetch_array($res))
        {
            $menu .= "<li>{$row['nombre_categoria']}</li>";
            $menu .= menu_recursivo($row['id_categoria']);
        }
        $menu .= "</ul>";
    }

    return $menu;

}


function menu_recursivo_tipos($id = null, $tipo = null)
{
    $menu = "";
    $de = "";
    if (!is_null($id))
    {
        $de = "WHERE de={$id}";
    } else
    {
        $de = "WHERE de=''";
    }

    $sql = "SELECT * FROM `categoria` {$de}";
    $res = @mysql_query($sql);
    if (!$res)
    {
        exit(mysql_error());
    }
    if (mysql_num_rows($res) >= 1)
    {
        $menu .= "<ul>";
        while ($row = mysql_fetch_array($res))
        {


            $menu .= "<li class='btn_menu1'><a class='color' href='articulos.php?categoria={$row['id_categoria']}&id_idmo={$row['modulo']}'>{$row['nombre_categoria']}</a></li>";
            $menu .= menu_recursivo_tipos($row['id_categoria'], $tipo);


        }
        $menu .= "</ul>";
    }

    return $menu;

}

function rm_recursive($filepath)
{
    if (is_dir($filepath) && !is_link($filepath))
    {
        if ($dh = opendir($filepath))
        {
            while (($sf = readdir($dh)) !== false)
            {
                if ($sf == '.' || $sf == '..')
                {
                    continue;
                }
                if (!rm_recursive($filepath . '/' . $sf))
                {
                    throw new Exception($filepath . '/' . $sf . ' could not be deleted.');
                }
            }
            closedir($dh);
        }
        return rmdir($filepath);
    }
    return unlink($filepath);
}


function categoria($id)
{
    $sql2 = "SELECT * FROM  `categoria` where id_categoria='{$id}'";
    $res2 = @mysql_query($sql2);
    if (!$res2)
    {
        exit(mysql_error());
    }
    $row2 = mysql_fetch_array($res2);
    return $row2['amigable_categoria'];
}

function idmo($id)
{
    $sql2 = "SELECT * FROM  `idmo` where id_idmo='{$id}'";
    $res2 = @mysql_query($sql2);
    if (!$res2)
    {
        exit(mysql_error());
    }
    $row2 = mysql_fetch_array($res2);
    return limpiar_url($row2['nombre_idmo']);
}
function modulo($id)
{
    $sql2 = "SELECT * 
FROM  `modulo` where id_modulo='{$id}'";
    $res2 = @mysql_query($sql2);
    if (!$res2)
    {
        exit(mysql_error());
    }
    $row2 = mysql_fetch_array($res2);
    return limpiar_url($row2['nombre_modulo']);
}
/**
 * @return nombre
 **/
function matrix($id)
{
    $sql2 = "SELECT * FROM  `matrix` where id_matrix='{$id}'";
    $res2 = @mysql_query($sql2);
    if (!$res2)
    {
        exit(mysql_error());
    }
    $row2 = mysql_fetch_array($res2);
    return $row2['amigable_matrix'];
}


//Funcion que se Utiliza Para el Manejo de las Imagenes Multi-idioma del Sitio
//Funcion que Recibe dos parametros de entrada el id de la Imagen y el idioma en q se quiere mostrar
//echo imagenes_idio(1,1);
//esta Funcion Devuelve un String q es el Nombre de la Imagen

function imagenes_idio($id, $idio)
{

    $consulta = "SELECT * FROM `idima` WHERE `id_imagen`={$id} and `id_idioma`={$idio}";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $rowt['idma_imagen'];
}
/*
include ('js/panel/mailer/class.phpmailer.php');
include ('js/panel/mailer/class.smtp.php');
//clase para enviar con gmail smtp
function mail_with_smtp($host, $user, $pass, $from, $to, $subject, $msg)
{
    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP

    try
    {
        $mail->Host = $user; // SMTP server
        $mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = $user; // GMAIL username
        $mail->Password = $pass; // GMAIL password
        $mail->AddAddress($to, 'codigo dinamico');
        $mail->SetFrom($from, 'desde la web');
        $mail->AddReplyTo($from, 'usuario de la web');
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML($msg);
        //$mail->AddAttachment('images/phpmailer.gif');      // attachment
        //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
        $mail->Send();
        echo "Mensaje enviado</p>\n";
    }
    catch (phpmailerException $e)
    {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    }
    catch (exception $e)
    {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}
*/
function variables($codigo, $idioma, $grupo)
{

    $consulta = "SELECT idpa.titulo_idpa, nota_idpa
            FROM
            palabra, idpa
            WHERE
            palabra.id_palabra=idpa.palabra  and idpa.idioma='" . $idioma .
        "' AND
            palabra.codigo_palabra = '" . $codigo . "' and idpa.idr='" . $grupo .
        "'";
    $rest = @mysql_query($consulta);
    if (!$rest)
    {
        exit(mysql_error());
    }
    $rowt = mysql_fetch_array($rest);
    return $rowt['titulo_idpa'];
}

function mostrar_nombre_tipo($id = null)
{
    $option = "";

    $sql_banco = "SELECT * FROM vtalla where id_matrix={$id}";
    $res_banco = @mysql_query($sql_banco);
    if (!$res_banco)
    {
        exit(mysql_error());
    }
    $row_banco = mysql_fetch_array($res_banco);
    $option = $row_banco['nombre_matrix'];

    return $option;
}

function redirect($url){
    return header("Location: {$url}");
}
////////////////////////////////////////////////////
//Obtener estrellas
////////////////////////////////////////////////////
function get_stars($id,$tipo){
$link = Connect();
$points=0;
$stars="";
$query_RsV = "SELECT SUM(valor) as valor,COUNT(id_comentario) as cont FROM votos WHERE id_comentario =".$id." AND id_tipo=".$tipo;
$RsV = mysql_query($query_RsV, $link) or die(mysql_error());
$row_RsV = mysql_fetch_assoc($RsV);
$totalRows_RsV = mysql_num_rows($RsV);
if($totalRows_RsV<>0){
	if($row_RsV['valor']<>"")$points=@round($row_RsV['valor']/$row_RsV['cont']);
	for($i=1;$i<=5;$i++){
		if($points<$i){
			$stars.='<img src="images/estrella_roja.png">';
		}else{
			$stars.='<img src="images/estrella_amarilla.png">';
		}
	}
}
return $stars;
mysql_free_result($RsV);
}
////////////////////////////////////////////////////
//Obtener puntajes de las votaciones
////////////////////////////////////////////////////
function get_valores_stars($id,$tipo){
$link = Connect();
$valor=0;
$query_RsV = "SELECT SUM(valor) as valor,COUNT(id_comentario) as cont FROM votos WHERE id_tipo=".$tipo." AND id_comentario =".$id;
$RsV = mysql_query($query_RsV, $link) or die(mysql_error());
$row_RsV = mysql_fetch_assoc($RsV);
$totalRows_RsV = mysql_num_rows($RsV);
if($totalRows_RsV<>0){
	$valor=@round($row_RsV['valor']/$row_RsV['cont']);
}
return $valor;
mysql_free_result($RsV);
}

function check_email($email) 
{
	// Primero, checamos que solo haya un símbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo inválido por número incorrecto de caracteres en una parte, o número incorrecto de símbolos @
    return false;
  }
  // se divide en partes para hacerlo más sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio válido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
}
/*
 * crear ckeditor
 * @param textarea: identificador del textarea a crear
 * @param toolbar: basic|standar|full
 */
function wysiwyg($textarea,$toolbar="basic"){
    include("plugins/ckeditor/wysiwyg.php");
}

/*amigable matrix*/
function amigable_matrix($id){
   $sql_am = "SELECT amigable_matrix FROM matrix WHERE id_matrix={$id}";
    $res_am = mysql_query($sql_am)or die("Error: ".  mysql_error());
    if(mysql_num_rows($res_am)){
        return mysql_fetch_assoc($res_am);
    }else{
        return false;
    }
}
/*amigable categoria*/
function amigable_categoria($id){
   $sql_am = "SELECT amigable_categoria FROM categoria WHERE id_categoria={$id}";
    $res_am = mysql_query($sql_am)or die("Error: ".  mysql_error());
    if(mysql_num_rows($res_am)){
        return mysql_fetch_assoc($res_am);
    }else{
        return false;
    }
}

/*ordenar json por ubica_matrix*/
function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {  
    $position = array();  
    $newRow = array();  
    foreach ($toOrderArray as $key => $row) {  
            $position[$key]  = $row[$field];  
            $newRow[$key] = $row;  
    }  
    if ($inverse) {  
        arsort($position);  
    }  
    else {  
        asort($position);  
    }  
    $returnArray = array();  
    foreach ($position as $key => $pos) {       
        $returnArray[] = $newRow[$key];  
    }  
    return $returnArray;  
}  
?>