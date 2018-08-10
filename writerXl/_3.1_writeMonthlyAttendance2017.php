<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet3.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 28;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str < 40) {
        if (isset($monthlyAttendance2017[$i])) {
            $time = $monthlyAttendance2017[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $monthlyAttendance2017[$i]['month'], $item->c[0]);
            checkChildXml('B' . $startString, $monthlyAttendance2017[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $monthlyAttendance2017[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $monthlyAttendance2017[$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $monthlyAttendance2017[$i]['forNew'] / 100, $item->c[4]);
            checkChildXml('F' . $startString, $monthlyAttendance2017[$i]['refusals'] / 100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);
            checkChildXml('H' . $startString, (int)$monthlyAttendance2017[$i]['achivments'], $item->c[7]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
}

$xml->saveXML($pathWrite);
?>