<?php
$nameList = 'Лист поисковой трафик (общий)';
$pathListExcel = $path . 'sheet6.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 30;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $data['project'], $item->c[0]);

    }

    if ($str == $startString && $str <= 34) {
        if (isset($data['searchSystemSummary'][$i])) {
            $time = $data['searchSystemSummary'][$i]['time'] / 86400;
            checkChildXml('A' . $startString, $data['searchSystemSummary'][$i]['searchSystem'], $item->c[0]);
            checkChildXml('B' . $startString, $data['searchSystemSummary'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['searchSystemSummary'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['searchSystemSummary'][$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $data['searchSystemSummary'][$i]['viewingDepth'], $item->c[4]);
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
//include '/templateStatusSave.php';
$data['statusSave'][] = array($nameList, $status);
?>