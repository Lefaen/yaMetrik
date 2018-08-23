<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet10.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 11;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 35) {
        if (isset($popularPage[$i])) {
            $time = $popularPage[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $popularPage[$i]['signInPage'], $item->c[0]);
            checkChildXml('B' . $startString, $popularPage[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $popularPage[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $popularPage[$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $popularPage[$i]['forNew'] / 100, $item->c[4]);
            checkChildXml('F' . $startString, $popularPage[$i]['refusals'] / 100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);
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