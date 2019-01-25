<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------

$params = array(
    'ids' => $data['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDuration',         //метрики
    'dimensions' => 'ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $data['dateStart'],//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',                                         //сортировка
    //'group' => 'day',
    'limit' => 5
);

$opts = [
    "http" => [
        "method" => "GET",
        "header" => 'Authorization: OAuth ' . $data['token'] . "\r\n"
    ]
];
$context = stream_context_create($opts);
$contentJson = file_get_contents(self::build_query($data['url'], $params), false, $context);

$dataMetrika = json_decode($contentJson, true);
$tmpdata = array();

foreach ($dataMetrika['data'] as $item) {
    $tmpdata[] = array(
        //'date' => $item['dimensions'][0]['name'],
        'searchSystem' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
    );
}

$data['searchSystemSummary'] = $tmpdata;
//var_dump($searchSystemSummary);
?>
<?/*
<table class="tableReports">
    <caption>Поисковой трафик</caption>
    <tr>
        <th>Поисковая система</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Отказы</th>
        <th>Глубина просмотра</th>
        <th>Время на сайте</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['searchSystem']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['viewingDepth']; ?></td>
            <td><?= $elm['time']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
*/?>