<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet7.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 27;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 29) {
        if (isset($devices[$i])) {
            $time = $devices[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $devices[$i]['deviceType'], $item->c[0]);
            checkChildXml('B' . $startString, $devices[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $devices[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $devices[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $devices[$i]['viewingDepth'], $item->c[4]);
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