<?php
$nameList = 'Лист поисковые фразы ЯД';
$pathListExcel = $path . 'sheet11.xml';

$xml = simplexml_load_file($pathListExcel);
$startString = 11;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        //checkChildXml('E3', $project, $item->c[0]);

    }

    if ($str == $startString && $str <= 40) {
        if (isset($prasesInContext[$i])) {
            $time = $prasesInContext[$i]['time'] / 86400;
            checkChildXml('A' . $startString, $prasesInContext[$i]['visit'], $item->c[0]);
            checkChildXml('B' . $startString, $prasesInContext[$i]['users'], $item->c[1]);
            checkChildXml('C' . $startString, $prasesInContext[$i]['refusals'], $item->c[2]);
            checkChildXml('D' . $startString, $prasesInContext[$i]['viewingDepth'], $item->c[3]);
            checkChildXml('E' . $startString, $time, $item->c[4]);
            checkChildXml('F' . $startString, $prasesInContext[$i]['companyYaDirect'], $item->c[5]);
            checkChildXml('G' . $startString, $prasesInContext[$i]['directSearchPhrase'], $item->c[6]);

            //var_dump($prasesInContext[$i]['visit']);

            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
    //var_dump($item);
}

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>