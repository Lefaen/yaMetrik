<?php
$nameList = 'Лист технологии разрешение экрана';
$pathListExcel = $path . 'sheet9.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 48;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 57) {
        if (isset($data['resolution'][$i])) {
            $time = $data['resolution'][$i]['time'] / 86400;
            checkChildXml('A' . $startString, $data['resolution'][$i]['realResolution'], $item->c[0]);
            checkChildXml('B' . $startString, $data['resolution'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['resolution'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['resolution'][$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $data['resolution'][$i]['viewingDepth'], $item->c[4]);
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

unset($data['resolution']);
$data['statusSave'][] = array($nameList, $status);
//include './templateStatusSave.php';
?>