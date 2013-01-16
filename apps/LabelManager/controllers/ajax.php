<?php
/**
     * Server-side processing based on DataTables
     * @author Alan Jardin, Daniel Sum
     * @version 0.9
     * @package arx
     * @comments : modified for arx
     * @licence : GPL
*/
header('Content-type: text/html; charset=UTF-8'); // force header UTF-8
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */

require_once dirname(__FILE__).'/../core.php';
u::header('json');
//predie(count(ORM::for_table('t_labels')->raw_query('SELECT * FROM t_labels')->find_many()));

/* DB table to use */
$sTable = "t_labels";

$aColumns = array('id','name', 'isocode', 'value', 'context');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "name";

/*
 * Paging
 */
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
    //TODO : LIMIT PARSER
    $sLimit = "LIMIT ".( $_GET['iDisplayStart'] ).", ".
        ( $_GET['iDisplayLength'] );
}

/*
 * Ordering
 */
if ( isset( $_GET['iSortCol_0'] ) ) {
    /*TODO : ORDERING*/
    $sOrder = "ORDER BY  ";
    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
            $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                 ".( $_GET['sSortDir_'.$i] ) .", ";
        }
    }

    $sOrder = substr_replace( $sOrder, "", -2 );
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}

/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if ($_GET['sSearch'] != "") {
    /*TODO : WHERE function*/
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        $sWhere .= $aColumns[$i]." LIKE '%".( $_GET['sSearch'] )."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';

}

/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
    /* TODO : bSearchable
    */
    if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i]." LIKE '%".($_GET['sSearch_'.$i])."%' ";
    }
}

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
    SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
    FROM   $sTable
    $sWhere
    $sOrder
    $sLimit
";
$rResult = ORM::for_table('t_labels')->raw_query($sQuery, array())->find_many();

/* Data set length after filtering
$sQuery = "
    SELECT FOUND_ROWS()
";
$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);*/
$iFilteredTotal = count(ORM::for_table('t_labels')->raw_query($sQuery, array())->find_many());

//Total data set length
$sQuery = "
    SELECT COUNT(".$sIndexColumn.")
    FROM   $sTable
";
/* $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
$aResultTotal = mysql_fetch_array($rResultTotal);*/
$iTotal = count(ORM::for_table('t_labels')->raw_query($sQuery, array())->find_many());

/*
 * Output
 */

$aJson = array();

$aJson['sEcho'] =  intval($_GET['sEcho']);

$aJson['iTotalRecords'] =  $iTotal;

$aJson['iTotalDisplayRecords'] = $iFilteredTotal;

foreach ($rResult as $key=>$oRow) {
    $aRow = $oRow->as_array();

    foreach ($aRow as $key2=>$v) {
        $aJson['aaData'][$key][] = $v;
    }

    /*
     * Optional Configuration:
     * If you need to add any extra columns (add/edit/delete etc) to the table, that aren't in the
     * database - you can do it here
     */

    if (isset($_GET['extraColumnsNb'])) {
        for ($i = 0; $i < $_GET['extraColumnsNb']; $i++) {
            $aJson['aaData'][$key][] = "";
        }
    }
}

u::json_die($aJson);