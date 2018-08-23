<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet11.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 30;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 34) {
        if (isset($searchSystemSummary[$i])) {
            $time = $searchSystemSummary[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $searchSystemSummary[$i]['searchSystem'], $item->c[0]);
            checkChildXml('B' . $startString, $searchSystemSummary[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $searchSystemSummary[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $searchSystemSummary[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $searchSystemSummary[$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    //var_dump($item->c);
}

$xml->saveXML($pathWrite);
?>