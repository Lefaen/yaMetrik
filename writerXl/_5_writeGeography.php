<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet5.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 26;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str <= 50) {
        if (isset($geography[$i])) {
            $time = $geography[$i]['time'] / 86400;

            //echo $geography[$i]['month'];


            checkChildXml('A' . $startString, $geography[$i]['city'], $item->c[0]);
            checkChildXml('B' . $startString, $geography[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $geography[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $geography[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $geography[$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    //var_dump($item);
}

$xml->saveXML($pathWrite);
?>