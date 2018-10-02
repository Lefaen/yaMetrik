<?php
$nameList = 'Лист источники в динамике (по неделям)';
$pathListExcel = $path . 'sheet15.xml';
$xml = simplexml_load_file($pathListExcel);
$startString = 2;
$i = 0;
//var_dump($xml);
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
$i = 0;
foreach ($sourceDetalyWeek as $element) {

    if ($element != null) {

        foreach ($xml->sheetData->row as $item) {
            $str = (int)$item->attributes()->r;

            if($str == 1){
                checkChildXml($abc[$j][2] . 1, $element['source'][$i], $item->c[$numAbc+2]);
            }
            if ($str == $startString && $str <= 28) {
                if($element != null) {


                    checkChildXml($abc[$j][0] . $startString, $element['date'][$i], $item->c[$numAbc + 0]);
                    checkChildXml($abc[$j][1] . $startString, $element['source'][$i], $item->c[$numAbc + 1]);
                    checkChildXml($abc[$j][2] . $startString, $element['visit'][$i], $item->c[$numAbc + 2]);

                    $startString++;
                    $i++;
                }
            }
        }

        $i = 0;
        $numAbc = $numAbc + 3;
        if($numAbc > 12)
        {break;}
        $j++;
        $startString = 2;
    }

}


if ($xml->saveXML($pathListExcel)) {
    $status = true;
} else {
    $status = false;
}
include './templateStatusSave.php';
?>