<?php


$nameList = 'Лист оглавления';
$pathListExcel = $path . 'sheet2.xml';

$xml = simplexml_load_file($pathListExcel);
foreach ($xml->sheetData->row as $item) {
    //var_dump($item);
    foreach ($item->c as $elm) {
        checkChildXml('E3', $project, $elm);
        checkChildXml('A6', $client, $elm);
        checkChildXml('B26', $client, $elm);
        checkChildXml('F9', $headProject, $elm);
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