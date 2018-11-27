<?php


$nameList = 'Лист оглавления';
$pathListExcel = $path . 'sheet2.xml';

$xml = simplexml_load_file($pathListExcel);
foreach ($xml->sheetData->row as $item) {
    //var_dump($item);
    foreach ($item->c as $elm) {
        checkChildXml('E3', $data['project'], $elm);
        checkChildXml('A6', $data['client'], $elm);
        checkChildXml('B26', $data['client'], $elm);
        checkChildXml('F9', $data['headProject'], $elm);
    }
}
if($xml->saveXML($pathListExcel))
{
    $status = true;
}else{
    $status = false;
}
//include '/templateStatusSave.php';
$data['statusSave'][] = array($nameList, $status);
?>