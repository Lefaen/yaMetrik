<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------


$dateFinSearch = explode('-', $data['dateFin']);
$dateStartSearch = null;
$dateStartSearch[0] = '';
$dateStartSearch[1] = $dateFinSearch[1] - $period;
$dateStartSearch[2] = '01';
$period = 6;
$year = 13;

$dateStartSearch[1] = $dateFinSearch[1] - $period;
if ($dateStartSearch[1] > 0) {
    $dateStartSearch[0] = $dateFinSearch[0];
    $dateStartSearch[1] = $dateStartSearch[1] + 1;
} elseif ($dateStartSearch[1] < 0) {
    //echo $dateFinSearch[1];
    $dateStartSearch[0] = $dateFinSearch[0] - 1;
    $dateStartSearch[1] = $year + $dateStartSearch[1];
} elseif ($dateStartSearch[1] == 0) {
    $dateStartSearch[0] = $dateFinSearch[0];
    $dateStartSearch[1] = 1;
}
$dateFinSearch = $dateFinSearch[0] . '-' . $dateFinSearch[1] . '-' . $dateFinSearch[2];
$dateStartSearch = $dateStartSearch[0] . '-' . $dateStartSearch[1] . '-' . $dateStartSearch[2];
//echo $dateStartSearch . '<br>';
//echo $dateFinSearch;


$params = array(
    'ids' => $data['ids'],                          //счетчик
    'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:startOfWeek,ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStartSearch,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSearch,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:<attribution>SearchEngineRoot,ym:s:startOfWeek',                                         //сортировка
    //'group' => 'week',
    'limit' => 5000
);

$contentJson = file_get_contents(self::build_query($data['url'], $params));

$dataMetrika = json_decode($contentJson, true);
$tmpdata = array();
foreach ($dataMetrika['data'] as $item) {
    $tmpdata[] = array(
        'date' => $item['dimensions'][0]['name'],
        'searchSystem' => $item['dimensions'][1]['name'],
        'visit' => $item['metrics'][0]
    );
}

$data['searchSystemDetaly'] = $tmpdata;

//var_dump($searchSystemDetaly);