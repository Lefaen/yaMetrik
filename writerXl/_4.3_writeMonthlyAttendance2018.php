<?php

$pathChartExcel = $pathToDiagram . 'chart2.xml';
//$pathChartExcel = $path . 'sheet4.xml';
//$xmlChart = simplexml_load_file($pathChartExcel);

if (file_exists($pathChartExcel)) {
    $xmlChart = simplexml_load_file($pathChartExcel);

    var_dump($xmlChart->plotArea->barChart->ser->cat->strRef->extLst->ext->fullRef->sqref);
    foreach ($xmlChart->children('c',true) as $item)
    {
        //$sourceStr = $item->plotArea->barChart->ser->cat->strRef->f;
        //$finalStr = str_replace('!$A$41:$A$47', '!$A$41:$A$49', $sourceStr);
        //$item->plotArea->barChart->ser->cat->strRef->f = $finalStr;

        //$sourceStr = $item->plotArea->barChart->ser->val->numRef->f;
        //$finalStr = str_replace('!$B$41:$B$47', '!$B$41:$B$49', $sourceStr);
        //$item->plotArea->barChart->ser->cat->strRef->f = $finalStr;



    }
} else {
    exit('Не удалось открыть файл test.xml.');
}
?>