<?php
$mes = array(
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
    'Noviembre',
    'Diciembre');
$mesAbre = array(
    'Ene',
    'Feb',
    'Mar',
    'Abr',
    'May',
    'Jun',
    'Jul',
    'Ago',
    'Sep',
    'Oct',
    'Nov',
    'Dic');
$semana = array(
    'Domingo',
	'Lunes',
    'Martes',
    'Miercoles',
    'Jueves',
    'Viernes',
    'Sabado');
$fecha2 = date("Y-m-d");

$arrayMonth=array(
    "12"=>'Diciembre',
    "01"=>'Enero',
    "02"=>'Febrero',
    "03"=>'Marzo',
    "04"=>'Abril',
    "05"=>'Mayo',
    "06"=>'Junio',
    "07"=>'Julio',
    "08"=>'Agosto',
    "09"=>'Septiembre',
    "10"=>'Octubre',
    "11"=>'Noviembre'
);
$arrayShortMonth=array(
    "12"=>'Dic',
    "01"=>'Ene',
    "02"=>'Feb',
    "03"=>'Mar',
    "04"=>'Abr',
    "05"=>'Mayo',
    "06"=>'Jun',
    "07"=>'Jul',
    "08"=>'Ago',
    "09"=>'Sep',
    "10"=>'Oct',
    "11"=>'Nov'
);
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
    global $db;
    $str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
    $str = function_exists("mysql_real_escape_string") ? $db->scape_string($str) :
        $db->scape_string($str);
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
   global $db;
   $db->select("palabra,idpa","idpa.titulo_idpa, idpa.nombre_idpa, idpa.nota_idpa","WHERE palabra.id_palabra=idpa.palabra  AND idpa.idioma='" . $idioma ."' AND palabra.codigo_palabra = '" . $codigo . "' AND idpa.idr='" . $grupo ."'");
   $consulta = $db->fetch_array();
   return $array = array($consulta['titulo_idpa'], $consulta['nota_idpa']);
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
function variable($id_variable, $idr)
{
    global $db;
    $db->select("variable","valor_variable,contenido_variable,script_variable"," WHERE codigo_variable = '" . $id_variable . "' and tipo_variable='" . $idr ."'");
    $rowt = $db->fetch_array();
    return $array = array($rowt['valor_variable'], $rowt['contenido_variable'], $rowt['script_variable']);
}
function contar_secundaria($id_matrix)
{
    global $db;
    $db->select("secundaria","count(secundaria.idr) as total ","WHERE secundaria.idr= '" . $id_matrix . "'");
    $rowt =$db->fetch_array();
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
    global $db;
    $db->select("categoria","amigable_categoria","WHERE id_categoria='{$id}'");
    $row2 = $db->fetch_array();
    return $row2['amigable_categoria'];
}

function idmo($id)
{
    global $db;
    $db->select("idmo","nombre_idmo","WHERE id_idmo='{$id}'");
    $row2 = $db->fetch_array();
    return limpiar_url($row2['nombre_idmo']);
}
function modulo($id)
{
    global $db;
    $db->select("modulo","nombre_modulo","WHERE id_modulo='{$id}'");
    $row2 = $db->fetch_array();
    return limpiar_url($row2['nombre_modulo']);
}
/**
 * @return nombre
 **/
function matrix($id)
{
    global $db;
    $db->select("matrix","amigable_matrix","WHERE id_matrix='{$id}'");
    $row2 = $db->fetch_array();
    return $row2['amigable_matrix'];
}
//Funcion que se Utiliza Para el Manejo de las Imagenes Multi-idioma del Sitio
//Funcion que Recibe dos parametros de entrada el id de la Imagen y el idioma en q se quiere mostrar
//echo imagenes_idio(1,1);
//esta Funcion Devuelve un String q es el Nombre de la Imagen

function imagenes_idio($id, $idio)
{
    global $db;
    $db->select("idima","idma_imagen","WHERE id_imagen={$id} and `id_idioma`={$idio}");
    $rowt =$db->fetch_array();
    return $rowt['idma_imagen'];
}
function mostrar_nombre_tipo($id = null)
{
    global $db;
    $option = "";
    $db->select("vtalla","nombre_matrix","WHERE id_matrix={$id}");
    $row_banco = $db->fetch_array();
    $option = $row_banco['nombre_matrix'];
    return $option;
}

function redirect($url){
    return header("Location: {$url}");
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
//usuarios en linea
function getUsersOnline($REMOTE_ADDR,$PHP_SELF){
    global $db;
    $timeoutseconds = 300; 
    $timestamp = time();
    $timeout = $timestamp - $timeoutseconds;
    $prepend=array(
        'timestamp'=>$timestamp,
        'ip'=>$REMOTE_ADDR,
        'file'=>$PHP_SELF,
    );
    $insert=$db->insert("usuariosonline",$prepend);
    $delete = $db->delete("usuariosonline","WHERE timestamp<$timeout");
    $db->select("usuariosonline","DISTINCT ip","WHERE file='$PHP_SELF'");
    $user = $db->num_rows();
    if (!($user)) {
        print("ERROR: " . mysql_error() . "\n");
    }
    return $user;
}
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

//////////////////////////////////////////////////// 
//Encriptar datos
////////////////////////////////////////////////////
function encrypt($string, $key,$encode=1) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   $code= base64_encode($result);
   if($encode=="1")$code= urlencode(base64_encode($result));
   return $code;
}
//////////////////////////////////////////////////// 
//Desencriptar datos
////////////////////////////////////////////////////
function decrypt($string, $key,$encode=1) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   $code= $result;
   if($encode=="1")$code= urldecode($result);   
   return $code;
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
?>
