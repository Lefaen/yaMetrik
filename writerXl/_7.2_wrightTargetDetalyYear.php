<?php
$nameList = 'Лист конверсия по неделям за год';
$pathListExcel = $path . 'sheet18.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 2;
$i = 0;
//var_dump($xml);

//var_dump($targetsYearSummary);


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


if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>