<?php
$nameList = 'Лист источники в динамике (по неделям)';
$pathListExcel = $path . 'sheet16.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 2;
$abc = array(
    0 => array(
        0 => 'A',
        1 => 'B',
        2 => 'C',
    ),
    1 => array(
        0 => 'D',
        1 => 'E',
        2 => 'F',
    ),
    2 => array(
        0 => 'G',
        1 => 'H',
        2 => 'I',
    ),
    3 => array(
        0 => 'J',
        1 => 'K',
        2 => 'L',
    ),
    4 => array(
        0 => 'M',
        1 => 'N',
        2 => 'O',
    ),

);
$numAbc = 0;
$j = 0;
$firstItaration = true;

$arrayOfWeek = array(
    'name' => $sourcesSummary[0]['sources'],
    'count' => null,
    'week' => array()
);
foreach ($sourcesSummary as $key => $source) {
//echo $key;
    $count = 0;
    $startString = 2;
    foreach ($sourceDetaly as $element) {
        if ($source['sources'] == $element['source']) {
            if ($firstItaration == true) {
                if ($arrayOfWeek['name'] == $element['source'] && $firstItaration == true) {
                    $arrayOfWeek['week'][] = $element['date'];
                }

                foreach ($xml->sheetData->row as $item) {
                    $str = (int)$item->attributes()->r;

                    if ($str == $startString && $str <= 28) {

                        checkChildXml($abc[$j][0] . $startString, $element['date'], $item->c[$numAbc + 0]);
                        checkChildXml($abc[$j][1] . $startString, $element['source'], $item->c[$numAbc + 1]);
                        checkChildXml($abc[$j][2] . $startString, $element['visit'], $item->c[$numAbc + 2]);
                        $startString++;
                        break;

                    }
                }
            }
            //$count = $startString;
            if ($firstItaration != true) {

                foreach ($xml->sheetData->row as $item2) {

                    $str = (int)$item2->attributes()->r;


                    if ($str == $startString && $str <= 28) {
                        if ($arrayOfWeek['week'][$count] == $element['date']) {
                            checkChildXml($abc[$j][0] . $startString, $element['date'], $item2->c[$numAbc + 0]);
                            checkChildXml($abc[$j][1] . $startString, $element['source'], $item2->c[$numAbc + 1]);
                            checkChildXml($abc[$j][2] . $startString, $element['visit'], $item2->c[$numAbc + 2]);

                            $startString++;
                            $count++;
                            break;
                        } else {
                            //var_dump($element['date']);
                            checkChildXml($abc[$j][0] . $startString, $arrayOfWeek['week'][$count], $item2->c[$numAbc + 0]);
                            checkChildXml($abc[$j][1] . $startString, $element['source'], $item2->c[$numAbc + 1]);
                            checkChildXml($abc[$j][2] . $startString, '0', $item2->c[$numAbc + 2]);
                            $startString++;
                            $count++;

                            continue;
                        }
                    }
                    //}
                }
            }
        }
        //$startString++;
        //$count++;
    }

    $firstItaration = false;
    $numAbc = $numAbc + 3;
    $j++;
    $startString = 2;

}
//var_dump($arrayOfWeek);
//var_dump($xml);

if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>