<?php
$nameList = 'Лист поисковые фразы ЯД';
$pathListExcel = $path . 'sheet12.xml';

$xml = @simplexml_load_file($pathListExcel);
$startString = 11;
$i = 0;
//var_dump($xml);

foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if($str == 3) {
        checkChildXml('E3', $data['project'], $item->c[0]);

    }
    //var_dump($data['prasesInContext'][$i]);
    if ($str == $startString && $str <= 40) {
        if ($data['prasesInContext'][$i] != null) {
            $time = $data['prasesInContext'][$i]['time'] / 86400;
            checkChildXml('A' . $startString, $data['prasesInContext'][$i]['visit'], $item->c[0]);
            checkChildXml('B' . $startString, $data['prasesInContext'][$i]['users'], $item->c[1]);
            checkChildXml('C' . $startString, $data['prasesInContext'][$i]['refusals'] / 100, $item->c[2]);
            checkChildXml('D' . $startString, $data['prasesInContext'][$i]['viewingDepth'], $item->c[3]);
            checkChildXml('E' . $startString, $time, $item->c[4]);
            checkChildXml('F' . $startString, $data['prasesInContext'][$i]['companyYaDirect'], $item->c[5]);
            checkChildXml('G' . $startString, $data['prasesInContext'][$i]['directBanner'], $item->c[6]);

            //var_dump($data['prasesInContext'][$i]['visit']);

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

unset($data['prasesInContext']);
$data['statusSave'][] = array($nameList, $status);
//include './templateStatusSave.php';
?>