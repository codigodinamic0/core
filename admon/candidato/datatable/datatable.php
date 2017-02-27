<?php
session_start();


mb_internal_encoding('UTF-8');



$aColumns = array('id', 'nombre', 'apellido', 'cedula', 'correo', 'fecha' );

  



$sIndexColumn = 'id';

  



$sTable = 'candidato';

  

$gaSql['user']     = 'axonicac_2015';

$gaSql['password'] = '4x0n1c4c2015';

$gaSql['db']       = 'axonicac_2015';

$gaSql['server']   = 'localhost';

$gaSql['port']     = 3306; 

 

$input =& $_GET;

 

$gaSql['charset']  = 'utf8';

 



$db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);

if (mysqli_connect_error()) {

    die( 'Error connecting to MySQL server (' . mysqli_connect_errno() .') '. mysqli_connect_error() );

}

 

if (!$db->set_charset($gaSql['charset'])) {

    die( 'Error loading character set "'.$gaSql['charset'].'": '.$db->error );

}

  

$sLimit = "";

if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {

    $sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );

}

  



$aOrderingRules = array();

if ( isset( $input['iSortCol_0'] ) ) {

    $iSortingCols = intval( $input['iSortingCols'] );

    for ( $i=0 ; $i<$iSortingCols ; $i++ ) {

        if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {

            $aOrderingRules[] =

                "`".$aColumns[ intval( $input['iSortCol_'.$i] ) ]."` "

                .($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');

        }

    }

}

 

if (!empty($aOrderingRules)) {

    $sOrder = " ORDER BY ".implode(", ", $aOrderingRules);

} else {

    $sOrder = "";

}

  



$iColumnCount = count($aColumns);

 

if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {

    $aFilteringRules = array();

    for ( $i=0 ; $i<$iColumnCount ; $i++ ) {

        if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {

            $aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string( $input['sSearch'] )."%'";

        }

    }

    if (!empty($aFilteringRules)) {

        $aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');

    }

}

  

// Individual column filtering

for ( $i=0 ; $i<$iColumnCount ; $i++ ) {

    if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {

        $aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string($input['sSearch_'.$i])."%'";

    }

}

 

if (!empty($aFilteringRules)) {
    $sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
} else {
    $sWhere = "";
}



$aQueryColumns = array();

foreach ($aColumns as $col) {

    if ($col != ' ') {

        $aQueryColumns[] = $col;

    }

}

 

$sQuery = "

    SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", $aQueryColumns)."`

    FROM `".$sTable."`".$sWhere.$sOrder.$sLimit;

 

$rResult = $db->query( $sQuery ) or die($db->error);

  

// Data set length after filtering

$sQuery = "SELECT FOUND_ROWS()";

$rResultFilterTotal = $db->query( $sQuery ) or die($db->error);

list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

 

// Total data set length

$sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM `".$sTable."`";

$rResultTotal = $db->query( $sQuery ) or die($db->error);

list($iTotal) = $rResultTotal->fetch_row();

  

  

/**

 * Output

 */

$output = array(

    "sEcho"                => intval($input['sEcho']),

    "iTotalRecords"        => $iTotal,

    "iTotalDisplayRecords" => $iFilteredTotal,

    "aaData"               => array(),

);

  

while ( $aRow = $rResult->fetch_assoc() ) {

    $row = array();

    for ( $i=0 ; $i<$iColumnCount ; $i++ ) {

        if ( $aColumns[$i] == 'version' ) {

            // Special output formatting for 'version' column

            $row[] = ($aRow[ $aColumns[$i] ]=='0') ? '-' : $aRow[ $aColumns[$i] ];

        } elseif ( $aColumns[$i] != ' ' ) {

            // General output

            $row[] = $aRow[ $aColumns[$i] ];

        }

    }

    $id = $aRow[$aColumns[0]];

    $cc =$aRow[$aColumns[3]];

                $recoje = '<a href="http://axonica.com.co/admon/registro.php?cc='.$cc.'"  class="icon-large icon-pencil" title="Editar">

                            <img src="candidato/edit_icon.png" alt="Editar"/>

                        </a>';
                if($_SESSION['roll']!=100){
                        $recoje .= '<a href="javascript:void(0)" id="can_'.$id.'" class="delete_can" title="Eliminar">

                            <img src="candidato/remove_icon.png" alt="Editar"/>

                        </a>'; }
                $row[] = $recoje;


    $output['aaData'][] = $row;

}

  

echo json_encode( $output );