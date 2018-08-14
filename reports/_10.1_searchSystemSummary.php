<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------

$params = [
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDuration',         //метрики
    'dimensions' => 'ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',                                         //сортировка
    //'group' => 'day',
    'limit' => 5
];

$contentJson = file_get_contents($url . '?' . http_build_query($params));

$data = json_decode($contentJson, true)['data'];
$tmpdata = [];

foreach ($data as $item) {
    $tmpdata[] = [
        //'date' => $item['dimensions'][0]['name'],
        'searchSystem' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
    ];
}

$searchSystemSummary = $tmpdata;
//var_dump($searchSystemSummary);
?>

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

