<?php
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$paramsTarget = array(
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:goal'.$item['id'].'reaches',         //метрики
    'dimensions' => 'ym:s:startOfMonth',                                  //группировка
    'date1' => '2018-01-01',//$_POST['dateStart'];              //дата начала выгрузки
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
    $tmpdata2[] = array(
        'date' => $target['dimensions'][0]['name'],
        //'conversionRate' => $target['metrics'][0],
        'reaches' => $target['metrics'][0],
        //'visits' => $target['metrics'][2]
    );
}

$targetsYear[] = $tmpdata2;
$tmpdata2 = null;
//var_dump($targetsYear);
//Отправка данных на запись

?>