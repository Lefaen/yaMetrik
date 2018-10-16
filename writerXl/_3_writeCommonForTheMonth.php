<?php
$nameList = 'Лист трафик по дням';
$pathListExcel = $path . 'sheet3.xml';

$xml = simplexml_load_file($pathListExcel);
//$commonForTheMonth;
$startString = 38;
//$dateFinWrite = explode('-', $dateFin);
//$dateFinWrite = $dateFinWrite[2];
//echo $dateFinWrite;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {


    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $project, $item->c[0]);

    }

    if ($str == 10) {
        checkChildXml('C10', $dateStart, $item->c[1]);
        checkChildXml('E10', $dateFin, $item->c[3]);
        //var_dump($item);
    }

    if ($str == 14) {
        foreach ($item->c as $elm){
            deleteChildXml('B'.$str, 'v', $elm);
            deleteChildXml('C'.$str, 'v', $elm);
            deleteChildXml('D'.$str, 'v', $elm);
            deleteChildXml('E'.$str, 'v', $elm);
            deleteChildXml('G'.$str, 'v', $elm);
        }
    }
    if ($str == $startString) {
        if(isset($commonForTheMonth[$i]))
        {
            $time = $commonForTheMonth[$i]['time']/86400;

            checkChildXml('A' . $startString, $commonForTheMonth[$i]['date'], $item->c[0]);
            checkChildXml('B' . $startString, $commonForTheMonth[$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $commonForTheMonth[$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $commonForTheMonth[$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $commonForTheMonth[$i]['forNew']/100, $item->c[4]);
            checkChildXml('F' . $startString, $commonForTheMonth[$i]['refusals']/100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);

            $i++;
            $startString++;
            //var_dump($item->c);
        }

    } else {
        //var_dump('no');
    }
}
if($xml->saveXML($pathListExcel))
{
    $status = true;
}else{
    $status = false;
}
include './templateStatusSave.php';
?>