<?
//-----------------------------------
//ИСТОЧНИКИ, СВОДКА------------------
//-----------------------------------

//echo $dateFinSources;
$dateFinSources = explode('-', $data['dateFin']);
$dateStartSources = null;
$dateStartSources[0] = '';
$dateStartSources[1] = $dateFinSources[1] - $period;
$dateStartSources[2] = '01';
$period = 6;
$year = 13;

$dateStartSources[1] = $dateFinSources[1] - $period;
if ($dateStartSources[1] > 0) {
    $dateStartSources[0] = $dateFinSources[0];
    $dateStartSources[1] = $dateStartSources[1] + 1;
} elseif ($dateStartSources[1] < 0) {
    //echo $dateFinSources[1];
    $dateStartSources[0] = $dateFinSources[0] - 1;
    $dateStartSources[1] = $year + $dateStartSources[1];
} elseif ($dateStartSources[1] == 0) {
    $dateStartSources[0] = $dateFinSources[0];
    $dateStartSources[1] = 1;
}
$dateFinSources = $dateFinSources[0] . '-' . $dateFinSources[1] . '-' . $dateFinSources[2];
$dateStartSources = $dateStartSources[0] . '-' . $dateStartSources[1] . '-' . $dateStartSources[2];
//echo $dateStartSources . '<br>';
//echo $dateFinSources;


$params = null;
$params = array(
    'ids' => $data['ids'],//$_POST['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:percentBounce,ym:s:pageDepth,ym:s:avgVisitDuration,ym:s:sumGoalReachesAny',         //метрики
    'dimensions' => 'ym:s:<attribution>TrafficSource',                                  //группировка
    //'date1' => $dateStartSources,//$_POST['dateStart'];              //дата начала выгрузки
    //'date2' => $dateFinSources,//$_POST['dateFin'];                 //дата окончания выгрузки
    'date1' => $data['dateStart'],//$_POST['dateFin'];                 //дата окончания выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки

    //'sort' => 'ym:s:visits',                                         //сортировка
    'limit'=>1000
);

//var_dump($_POST);
$opts = [
    "http" => [
        "method" => "GET",
        "header" => 'Authorization: OAuth ' . $data['token'] . "\r\n"
    ]
];
$context = stream_context_create($opts);
$contentJson = file_get_contents(self::build_query($data['url'], $params), false, $context);


//var_dump($contentJson);
$dataMetrika = null;
$dataMetrika = json_decode($contentJson, true);
$tmpdata = null;
$tmpdata = array();
//var_dump($data);

foreach ($dataMetrika['data'] as $item) {
    $tmpdata[] = array(
        'sources' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
        'targetVisits' => $item['metrics'][5],
    );
}
//var_dump($tmpdata);
$data['sourcesSummary'] = $tmpdata;
?>

<?/*
<table class="tableReports">
    <caption>Источники сводка</caption>
    <tr>
        <th>Источник трафика</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Отказы</th>
        <th>Глубина просмотра</th>
        <th>Время на сайте</th>
        <th>Цлевые визиты</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['sources']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['viewingDepth']; ?></td>
            <td><?= $elm['time']; ?></td>
            <td><?= $elm['targetVisits']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
*/?>