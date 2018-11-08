<?php
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$dateFinTarget = explode('-', $data['dateFin']);
$dateFinTarget[1] = $dateFinTarget[1];
$dateStartTarget = explode('-', $data['dateStart']);
$dateStartTarget[0] = $dateStartTarget[0]-1;
$dateStartTarget[1] = $dateStartTarget[1]+1;
$dateStartTarget[2] = $dateStartTarget[2];

$dateFinTarget = $dateFinTarget[0] . '-' . $dateFinTarget[1] . '-' . $dateFinTarget[2];
$dateStartTarget = $dateStartTarget[0] . '-' . $dateStartTarget[1] . '-' . $dateStartTarget[2];
//echo $dateStartTarget.'<br>';

$paramsTarget = array(
    'ids' => $data['ids'],                          //счетчик
    'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:goal'.$item['id'].'reaches',         //метрики
    'dimensions' => 'ym:s:startOfMonth',                                  //группировка
    'date1' => $dateStartTarget,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinTarget,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth',
    //'group' => 'month',
    //'limit' => 15000
    //                                         //сортировка
);

$contentJsonTarget = file_get_contents(self::build_query($data['url'], $paramsTarget));
$dataTarget = json_decode($contentJsonTarget, true);
//var_dump($dataTarget);
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

$data['targetsYear'][] = $tmpdata2;
$tmpdata2 = null;
//var_dump($targetsYear);
//Отправка данных на запись

?>