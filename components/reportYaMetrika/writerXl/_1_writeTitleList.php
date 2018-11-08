<?php

$nameList = 'Титульный лист';
$pathListExcel = $path . 'sheet1.xml';

$xml = simplexml_load_file($pathListExcel);
foreach ($xml->sheetData->row as $item) {
    //var_dump($item);
    foreach ($item->c as $elm) {
        checkChildXml('D24', $data['project'], $elm);
        checkChildXml('G35', $data['dateStart'], $elm);
        checkChildXml('I35', $data['dateFin'], $elm);
        checkChildXml('I39', $data['headProject'], $elm);
        checkChildXml('I40', $data['headDepartment'], $elm);
        checkChildXml('I41', $data['specialist'], $elm);
    }
}
if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
//include '/templateStatusSave.php';
$data['statusSave'][] = array($nameList, $status);
?>