<?php
$nameList = 'Лист поисковых систем по месяцам за год';
$pathListExcel = $path . 'sheet19.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 2;
$i = 0;

//var_dump($searchYear);

$yearArrayMonth = null;
$yearArrayMonth = array(
    '01' => '',
    '02' => '',
    '03' => '',
    '04' => '',
    '05' => '',
    '06' => '',
    '07' => '',
    '08' => '',
    '09' => '',
    '10' => '',
    '11' => '',
    '12' => ''
);
$searchYearSummary = array();
$dateStartSearch = explode('-', $dateStart);
//var_dump($dateStartSearch);



$yearArrayMonth = sortMonth($yearArrayMonth, $dateStartSearch[1]+2);
//var_dump($yearArrayMonth);

//var_dump($yearArrayMonth);



foreach ($yearArrayMonth as $key => $month) {
    $dateElm = '';
    $visitsForMonth = null;
    foreach ($searchYear as $elm) {
        if ($elm['searchSystem'] != null) {
            $date = explode('-', $elm['date']);
            if ($key == $date[1]) {
                $dateElm = $date[0] .'-'. $date[1];
                $visitsForMonth = $visitsForMonth + $elm['visits'];
            }
        }
    }

    foreach ($xml->sheetData->row as $item) {
        $str = (int)$item->attributes()->r;
        if ($str == $startString && $str <= 13) {
            //if ($date != null) {
            if($dateElm == '')
            {
                continue;
            }
            if((checkChildXml('A' . $startString, $dateElm, $item->c[0]) == true) && (checkChildXml('B' . $startString, $visitsForMonth, $item->c[1]) == true) )
            {
                $startString++;
                break;
            }
            //}
        }
    }
}


/*
foreach ($targetsYearSummary as $date => $reaches) {
    foreach ($xml->sheetData->row as $item) {
        $str = (int)$item->attributes()->r;
        if ($str == $startString && $str <= 50) {
            //if ($date != null) {


            if((checkChildXml('A' . $startString, $date, $item->c[0]) == true) && (checkChildXml('B' . $startString, $reaches, $item->c[1]) == true) )
            {
                $startString++;
                break;
            }
            //}
        }
    }
}
*/

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>