<?php
$nameList = 'Лист источники в динамике (по неделям)';
$pathListExcel = $path . 'sheet16.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 2;
$i = 0;
//var_dump($xml);

//var_dump($targetsYearSummary);


foreach ($targetsYearSummary as $element) {
    foreach ($xml->sheetData->row as $item) {
        $str = (int)$item->attributes()->r;
        if ($str == $startString && $str <= 50) {
            if ($element != null) {


                if((checkChildXml('A' . $startString, $element['date'], $item->c[0]) == true) && (checkChildXml('B' . $startString, $element['reaches'], $item->c[1]) == true) )
                {
                    $startString++;
                    break;
                }
            }
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