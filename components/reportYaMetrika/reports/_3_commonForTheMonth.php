<?
//-----------------------------------
//ОБЩИЕ ПО МЕСЯЦУ--------------------
//-----------------------------------

$params = array(
    'ids' => $data['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:users,ym:s:pageviews,ym:s:percentNewVisitors,ym:s:bounceRate,ym:s:avgVisitDurationSeconds',         //метрики
    'dimensions' => 'ym:s:date',                                  //группировка
    'date1' => $data['dateStart'],//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:date'                                         //сортировка
);

//var_dump($_POST);


//$contentJson = file_get_contents($data['url'] . '?' . http_build_query($params));

$opts = [
    "http" => [
        "method" => "GET",
        "header" => 'Authorization: OAuth ' . $data['token'] . "\r\n"
    ]
];
$context = stream_context_create($opts);
$contentJson = file_get_contents(self::build_query($data['url'], $params), false, $context);

//var_dump($contentJson);
$dataMetrika = json_decode($contentJson, true);
$tmpdata = array();

foreach ($dataMetrika['data'] as $item) {
    $tmpdata[] = array(
        'date' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'shows' => $item['metrics'][2],
        'forNew' => $item['metrics'][3],
        'refusals' => $item['metrics'][4],
        'time' => $item['metrics'][5]
    );
}


$data['commonForTheMonth'] = $tmpdata;

?>