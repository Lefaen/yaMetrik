<?php
$nameList = 'Лист источники в динамике (общие)';
$pathListExcel = $path . 'sheet5.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 30;
$i = 0;
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $data['project'], $item->c[0]);

    }

    if ($str == $startString && $str <= 34) {
        if (isset($data['sourcesSummary'][$i])) {
            $time = $data['sourcesSummary'][$i]['time'] / 86400;

            //echo $data['sourcesSummary'][$i]['month'];


            checkChildXml('A' . $startString, $data['sourcesSummary'][$i]['sources'], $item->c[0]);
            checkChildXml('B' . $startString, $data['sourcesSummary'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['sourcesSummary'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['sourcesSummary'][$i]['refusals'] / 100, $item->c[3]);
            checkChildXml('E' . $startString, $data['sourcesSummary'][$i]['viewingDepth'], $item->c[4]);
            checkChildXml('F' . $startString, $time, $item->c[5]);
            checkChildXml('G' . $startString, $data['sourcesSummary'][$i]['targetVisits'], $item->c[6]);
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
//include './templateStatusSave.php';
//unset($data['sourcesSummary']);
$data['statusSave'][] = array($nameList, $status);
?>