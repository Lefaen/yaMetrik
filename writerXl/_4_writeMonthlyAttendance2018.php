<?php
$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet3.xml';
$xml = simplexml_load_file($pathWrite);
$startString = 41;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str < 53) {
        if (isset($monthlyAttendance2018[$i])) {
            $time = $monthlyAttendance2018[$i]['time'] / 86400;

            echo $monthlyAttendance2018[$i]['month'];


            checkChildXml('A' . $startString, $monthlyAttendance2018[$i]['month'], $item->c[0]);
            checkChildXml('B' . $startString, $monthlyAttendance2018[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $monthlyAttendance2018[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $monthlyAttendance2018[$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $monthlyAttendance2018[$i]['forNew'] / 100, $item->c[4]);
            checkChildXml('F' . $startString, $monthlyAttendance2018[$i]['refusals'] / 100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);
            checkChildXml('H' . $startString, (int)$monthlyAttendance2018[$i]['achivments'], $item->c[7]);
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