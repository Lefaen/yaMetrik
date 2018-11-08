<?php
$nameList = 'Лист поисковые фразы';
$pathListExcel = $path . 'sheet11.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 11;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('C3', $data['project'], $item->c[0]);

    }

    if ($str == $startString && $str <= 40) {
        if (isset($data['searchPrases'][$i])) {
            $time = $data['searchPrases'][$i]['time'] / 86400;
            checkChildXml('A' . $startString, $data['searchPrases'][$i]['searchPrase'], $item->c[0]);
            checkChildXml('B' . $startString, $data['searchPrases'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['searchPrases'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['searchPrases'][$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $data['searchPrases'][$i]['viewingDepth'], $item->c[4]);
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

unset($data['searchPrases']);
$data['statusSave'][] = array($nameList, $status);
//include '/templateStatusSave.php';
?>