<?php
$nameList = 'Лист популярные страницы';
$pathListExcel = $path . 'sheet13.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 11;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        //checkChildXml('E3', $project, $item->c[0]);

    }

    if ($str == $startString && $str <= 35) {
        if ($data['popularPage'][$i] != null) {
            $time = $data['popularPage'][$i]['time'] / 86400;
            checkChildXml('A' . $startString, $data['popularPage'][$i]['signInPage'], $item->c[0]);
            checkChildXml('B' . $startString, $data['popularPage'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['popularPage'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['popularPage'][$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $data['popularPage'][$i]['forNew'] / 100, $item->c[4]);
            checkChildXml('F' . $startString, $data['popularPage'][$i]['refusals'] / 100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);
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

unset($data['popularPage']);
$data['statusSave'][] = array($nameList, $status);
//include './templateStatusSave.php';
?>