<?php
$nameList = 'Лист география';
$pathListExcel = $path . 'sheet8.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 26;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $data['project'], $item->c[0]);

    }

    if ($str == $startString && $str <= 50) {
        if (isset($data['geography'][$i])) {
            $time = $data['geography'][$i]['time'] / 86400;

            //echo $data['geography'][$i]['month'];


            checkChildXml('A' . $startString, $data['geography'][$i]['city'], $item->c[0]);
            checkChildXml('B' . $startString, $data['geography'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['geography'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['geography'][$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $data['geography'][$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    //var_dump($item);
}

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
unset($data['geography']);
$data['statusSave'][] = array($nameList, $status);
//include '/templateStatusSave.php';
?>