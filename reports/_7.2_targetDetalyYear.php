<?php
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$dateFinTarget = explode('-', $dateFin);
$dateStartTarget = null;
$dateStartTarget[0] = '';
$dateStartTarget[1] = $dateFinTarget[1] - $period;
$dateStartTarget[2] = '01';
$period = 12;
$year = 13;

$dateStartTarget[1] = $dateFinTarget[1] - $period;
if ($dateStartTarget[1] > 0) {
    $dateStartTarget[0] = $dateFinTarget[0];
    $dateStartTarget[1] = $dateStartTarget[1] + 1;
} elseif ($dateStartTarget[1] < 0) {
    //echo $dateFinTarget[1];
    $dateStartTarget[0] = $dateFinTarget[0] - 1;
    $dateStartTarget[1] = $year + $dateStartTarget[1];
} elseif ($dateStartTarget[1] == 0) {
    $dateStartTarget[0] = $dateFinTarget[0];
    $dateStartTarget[1] = 1;
}
$dateFinTarget = $dateFinTarget[0] . '-' . $dateFinTarget[1] . '-' . $dateFinTarget[2];
$dateStartTarget = $dateStartTarget[0] . '-' . $dateStartTarget[1] . '-' . $dateStartTarget[2];
//echo $dateStartTarget.'<br>';

$paramsTarget = array(
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:goal'.$item['id'].'reaches',         //метрики
    'dimensions' => 'ym:s:startOfMonth',                                  //группировка
    'date1' => $dateStartTarget,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth',
    //'group' => 'month',
    //'limit' => 15000
    //                                         //сортировка
);

$contentJsonTarget = file_get_contents($url . '?' . http_build_query($paramsTarget));
$dataTarget = json_decode($contentJsonTarget, true);
$tmpdata2 = array();
foreach ($dataTarget['data'] as $target){

    $date = explode('-',$target['dimensions'][0]['name']);
    $date = $date[0].'-'.$date[1];
    $tmpdata2[] = array(
        'date' => $date,
        //'conversionRate' => $target['metrics'][0],
        'reaches' => $target['metrics'][0],
        //'visits' => $target['metrics'][2]
    );


    /*
    $tmpdata2[] = array(
        'date' => $target['dimensions'][0]['name'],
        //'conversionRate' => $target['metrics'][0],
        'reaches' => $target['metrics'][0],
        //'visits' => $target['metrics'][2]
    );
    */
}

$targetsYear[] = $tmpdata2;
$tmpdata2 = null;
//var_dump($targetsYear);
//Отправка данных на запись

?>