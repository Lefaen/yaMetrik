<?php
$nameList = 'Лист цели в динамике';
$pathListExcel = $path . 'sheet13.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 30;
$i = 0;

//var_dump($dataTargets);
foreach ($dataTargets as $goal) {

    foreach ($xml->sheetData->row as $item) {

        $str = (int)$item->attributes()->r;

        if ($str == 3) {
            //checkChildXml('C3', 'test', $item->c[0]);

        }

        if ($str == $startString && $str <= count($dataTargets)+$startString) {
            if ($goal != null) {

                //echo $dataTargets[$i]['month'];


                checkChildXml('A' . $startString, $goal['name'], $item->c[0]);
                checkChildXml('B' . $startString, $goal['visits'], $item->c[1]);
                checkChildXml('C' . $startString, $goal['reaches'], $item->c[2]);
                checkChildXml('D' . $startString, $goal['conversionRate'] / 100, $item->c[3]);

            }

        } else {
            //var_dump('no');
        }
        //var_dump($item);
    }
    $startString++;

}

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';

?>