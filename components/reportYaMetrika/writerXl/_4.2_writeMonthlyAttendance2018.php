<?php
$nameList = 'Лист трафик по месяцам 2018';
$pathListExcel = $path . 'sheet4.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 41;
$i = 0;
$arrayMonth = array(
    '1' => 'Январь',
    '2' => 'Февраль',
    '3' => 'Март',
    '4' => 'Апрель',
    '5' => 'Май',
    '6' => 'Июнь',
    '7' => 'Июль',
    '8' => 'Август',
    '9' => 'Сентябрь',
    '10' => 'Октябрь',
    '11' => 'Ноябрь',
    '12' => 'Декабрь'
);
//var_dump($xml);
foreach ($xml->sheetData->row as $item) {

    $str = (int)$item->attributes()->r;

    if ($str == $startString && $str < 53) {
        if (isset($data['monthlyAttendance2018'][$i])) {
            $time = $data['monthlyAttendance2018'][$i]['time'] / 86400;
            checkChildXml('A' . $startString,$arrayMonth[$data['monthlyAttendance2018'][$i]['month']].'-2019', $item->c[0]);
            checkChildXml('B' . $startString, $data['monthlyAttendance2018'][$i]['visit'], $item->c[1]);
            checkChildXml('C' . $startString, $data['monthlyAttendance2018'][$i]['users'], $item->c[2]);
            checkChildXml('D' . $startString, $data['monthlyAttendance2018'][$i]['shows'], $item->c[3]);
            checkChildXml('E' . $startString, $data['monthlyAttendance2018'][$i]['forNew'] / 100, $item->c[4]);
            checkChildXml('F' . $startString, $data['monthlyAttendance2018'][$i]['refusals'] / 100, $item->c[5]);
            checkChildXml('G' . $startString, $time, $item->c[6]);
            checkChildXml('H' . $startString, (int)$data['monthlyAttendance2018'][$i]['achivments'], $item->c[7]);
            $i++;
            $startString++;
        }

    } else {
        //var_dump('no');
    }
}


if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}

//include './templateStatusSave.php';
//include '_4.3_writeMonthlyAttendance2018.php';
unset($data['monthlyAttendance2018']);
$data['statusSave'][] = array($nameList, $status);
?>