<?php
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$dateFinSearch = explode('-', $data['dateFin']);
$dateStartSearch = explode('-', $data['dateStart']);
$dateStartSearch[0] = $dateStartSearch[0]-1;
$dateStartSearch[1] = $dateStartSearch[1]+1;

$dateFinSearch = $dateFinSearch[0] . '-' . $dateFinSearch[1] . '-' . $dateFinSearch[2];
$dateStartSearch = $dateStartSearch[0] . '-' . $dateStartSearch[1] . '-' . $dateStartSearch[2];
//echo $dateStartTarget.'<br>';

$params = array(
    'ids' => $data['ids'],                          //счетчик
    'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:startOfMonth,ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStartSearch,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSearch,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth,ym:s:<attribution>SearchEngineRoot',                                         //сортировка
    'group' => 'month',
    'limit' => 5000
);

$contentJsonTarget = file_get_contents(self::build_query($data['url'], $params));
$dataMetrika = null;
$dataMetrika = json_decode($contentJsonTarget, true);
//var_dump($data);
//var_dump($dataTarget);
$tmpdata = array();

//var_dump($data);
foreach ($dataMetrika['data'] as $elm){

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
$data['searchYear'] = $tmpdata;
//var_dump($searchYear);
//var_dump($targetsYear);
//Отправка данных на запись



?>