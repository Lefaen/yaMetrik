<?
//-----------------------------------
//ИСТОЧНИКИ, СВОДКА------------------
//-----------------------------------


$dateFinSource = explode('-', $data['dateFin']);
$dateStartSource = null;
$dateStartSource[0] = '';
$dateStartSource[1] = $dateFinSource[1] - $period;
$dateStartSource[2] = '01';
$period = 6;
$year = 13;

$dateStartSource[1] = $dateFinSource[1] - $period;
if ($dateStartSource[1] > 0) {
    $dateStartSource[0] = $dateFinSource[0];
    $dateStartSource[1] = $dateStartSource[1] + 1;
} elseif ($dateStartSource[1] < 0) {
    //echo $dateFinSource[1];
    $dateStartSource[0] = $dateFinSource[0] - 1;
    $dateStartSource[1] = $year + $dateStartSource[1];
} elseif ($dateStartSource[1] == 0) {
    $dateStartSource[0] = $dateFinSource[0];
    $dateStartSource[1] = 1;
}
$dateFinSource = $dateFinSource[0] . '-' . $dateFinSource[1] . '-' . $dateFinSource[2];
$dateStartSource = $dateStartSource[0] . '-' . $dateStartSource[1] . '-' . $dateStartSource[2];
//echo $dateStartSource . '<br>';
//echo $dateFinSource;


$params = array(
    'ids' => $data['ids'],                          //счетчик
    'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits',         //метрики
    //'accuracy' => 'full',
    'date1' => $dateStartSource,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    'dimensions' => 'ym:s:startOfWeek,ym:s:<attribution>TrafficSource',                                  //группировка
    //'include_undefined' => true,
    'sort' => 'ym:s:<attribution>TrafficSource,ym:s:startOfWeek',                                            //сортировка
    //'group' => 'week',
    'limit' => 15000
);

$contentJson = file_get_contents(self::build_query($data['url'], $params));
$dataMetrika = null;
$dataMetrika = json_decode($contentJson, true);
//var_dump($data);
$tmpdata = array();
foreach ($dataMetrika['data'] as $item) {
    $tmpdata[] = array(
        'source' => $item['dimensions'][1]['name'],
        'date' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0]

    );
}

$data['sourceDetaly'] = $tmpdata;
//$sourceDetalyWeek[] = array();

//var_dump($sourceDetaly);
//var_dump($sourceDetalyWeek['Яндекс']);
