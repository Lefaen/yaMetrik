<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet5.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 30;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $project, $item->c[0]);

    }

    if ($str == $startString && $str <= 34) {
        if (isset($sourcesSummary[$i])) {
            $time = $sourcesSummary[$i]['time'] / 86400;

            //echo $sourcesSummary[$i]['month'];


            checkChildXml('A' . $startString, $sourcesSummary[$i]['sources'], $item->c[0]);
            checkChildXml('B' . $startString, $sourcesSummary[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $sourcesSummary[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $sourcesSummary[$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $sourcesSummary[$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            checkChildXml('G' . $startString, $sourcesSummary[$i]['targetVisits'], $item->c[6]);
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