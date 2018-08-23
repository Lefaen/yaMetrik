<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet9.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 11;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 40) {
        if (isset($searchPrases[$i])) {
            $time = $searchPrases[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $searchPrases[$i]['searchPrase'], $item->c[0]);
            checkChildXml('B' . $startString, $searchPrases[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $searchPrases[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $searchPrases[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $searchPrases[$i]['viewingDepth'], $item->c[4]);
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