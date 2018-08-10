<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet6.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 48;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 57) {
        if (isset($resolution[$i])) {
            $time = $resolution[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $resolution[$i]['realResolution'], $item->c[0]);
            checkChildXml('B' . $startString, $resolution[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $resolution[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $resolution[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $resolution[$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    var_dump($item->c);
}

$xml->saveXML($pathWrite);
?>