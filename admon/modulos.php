<?php
function modulos($opcion = null, $array = null)
{
    global $db;
    //Borrado de Todas Las Vistas

    $cpadre = array();
    $db->select("modulo","*");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $row) {
        
        $sqlbv = "DROP VIEW IF EXISTS v{$row['nombre_modulo']}";
        $db->consulta_s($sqlbv);
    }
    //Fin


    //Creacion de Los Modulos
    $cpadre = array();
    $db->select("modulo","*");
    /*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
        $cpadre[] = $arraypadre; 
    }
    foreach ($cpadre as $row) {

        $db->select("moca INNER JOIN campo ON campo.id_campo = moca.campo","moca.modulo, moca.campo, campo.nombre_campo", "where moca.modulo={$row['id_modulo']}");

        if ($db->num_rows() > 0) {
            $create = "CREATE VIEW v{$row['nombre_modulo']} AS SELECT";
            $campos = "";
            $cpadre = array();
            while ($arraypadre = $db->fetch_array()) {
                $cpadre[] = $arraypadre; 
            }
            foreach ($cpadre as $row2) {

                $campos .= "matrix.{$row2['nombre_campo']}, ";
            }

            $campos = substr($campos, 0, -2);

            $create = $create . " " . $campos .
                " ,idmo.nombre_idmo,idmo.idioma,idmo.modulo as 'id_modulo' FROM matrix,idmo,idioma WHERE matrix.id_idmo=idmo.id_idmo and idioma.id_idioma=idmo.idioma and idmo.modulo={$row['id_modulo']}";

            $db->consulta_s($create);

        }


    }
    //Fin Creacion


}

?>