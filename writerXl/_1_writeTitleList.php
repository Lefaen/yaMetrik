<?php


$pathWrite = 'C:\OpenServer\domains\yaMetrik\template/xl/worksheets/sheet1.xml';
$xml = simplexml_load_file($pathWrite);


foreach ($xml->sheetData->row as $item) {
    //var_dump($item);
    foreach ($item->c as $elm) {
        checkChildXml('D24', $project, $elm);
        checkChildXml('G35', $dateStart, $elm);
        checkChildXml('I35', $dateFin, $elm);
        checkChildXml('I39', $headProject, $elm);
        checkChildXml('I40', $headDepartment, $elm);
        checkChildXml('I41', $specialist, $elm);
    }
}
$xml->saveXML($pathWrite);