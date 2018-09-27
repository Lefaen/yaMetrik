<?php
$nameList = 'Лист технологии браузеры';
$pathListExcel = $path . 'sheet8.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 26;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $project, $item->c[0]);

    }


    if ($str == $startString && $str <= 30) {
        if (isset($browsers[$i])) {
            $time = $browsers[$i]['time'] / 86400;

            //echo $browsers[$i]['month'];


            checkChildXml('A' . $startString, $browsers[$i]['city'], $item->c[0]);
            checkChildXml('B' . $startString, $browsers[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $browsers[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $browsers[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $browsers[$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    //var_dump($item->c);
}

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>