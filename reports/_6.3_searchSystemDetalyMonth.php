<?php
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$dateFinSearch = explode('-', $dateFin);
$dateFinSearch[1] = $dateFinSearch[1];
$dateStartSearch = explode('-', $dateStart);
$dateStartSearch[0] = $dateStartSearch[0]-1;
$dateStartSearch[1] = $dateStartSearch[1]+1;
$dateStartSearch[2] = $dateStartSearch[2];

$dateFinSearch = $dateFinSearch[0] . '-' . $dateFinSearch[1] . '-' . $dateFinSearch[2];
$dateStartSearch = $dateStartSearch[0] . '-' . $dateStartSearch[1] . '-' . $dateStartSearch[2];
//echo $dateStartTarget.'<br>';

$params = array(
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:startOfMonth,ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStartSearch,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSearch,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth,ym:s:<attribution>SearchEngineRoot',                                         //сортировка
    'group' => 'month',
    'limit' => 5000
);

$contentJsonTarget = file_get_contents($url . '?' . http_build_query($params));
$data = json_decode($contentJsonTarget, true);
//var_dump($data);
//var_dump($dataTarget);
$tmpdata = array();

//var_dump($data);
foreach ($data['data'] as $elm){

    $date = explode('-',$elm['dimensions'][0]['name']);
    $date = $date[0].'-'.$date[1];
    $tmpdata[] = array(
        'date' => $date,
        'searchSystem' => $elm['dimensions'][1]['name'],
        'visits' => $elm['metrics'][0],
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
$searchYear = $tmpdata;
//var_dump($searchYear);
//var_dump($targetsYear);
//Отправка данных на запись



?>