<?
//-----------------------------------
//ИСТОЧНИКИ, СВОДКА------------------
//-----------------------------------

//echo $dateFinSources;
$dateFinSources = explode('-', $dateFin);
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
echo $dateStartSources . '<br>';
echo $dateFinSources;


$params = null;
$params = [
    'ids' => $ids,//$_POST['ids'],                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:percentBounce,ym:s:pageDepth,ym:s:avgVisitDuration,ym:s:sumGoalReachesAny',         //метрики
    'dimensions' => 'ym:s:<attribution>TrafficSource',                                  //группировка
    'date1' => $dateStartSources,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSources,//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',                                         //сортировка
];

//var_dump($_POST);
$contentJson = file_get_contents($url . '?' . http_build_query($params));


//var_dump($contentJson);
$data = null;
$data = json_decode($contentJson, true)['data'];
$tmpdata = null;
$tmpdata = [];
//var_dump($data);

foreach ($data as $item) {
    $tmpdata[] = [
        'sources' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
        'targetVisits' => $item['metrics'][5],
    ];
}
//var_dump($tmpdata);
$sourcesSummary = $tmpdata;
?>


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
