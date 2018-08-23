<?
//-----------------------------------
//ПОСЕЩАЕМОСТЬ ПО МЕСЯЦАМ------------
//-----------------------------------

$params = null;
$params = [
    'ids' => $ids,//$_POST['ids'],                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:sumPageViews,ym:s:percentNewVisitors,ym:s:percentBounce,ym:s:avgVisitDuration,ym:s:sumGoalReachesAny',         //метрики
    'dimensions' => 'ym:s:visitMonth',                                  //группировка
    'date1' => '2017-01-01',//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => '2018-01-01',//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:visitMonth',                                         //сортировка
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
        'month' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'shows' => $item['metrics'][2],
        'forNew' => $item['metrics'][3],
        'refusals' => $item['metrics'][4],
        'time' => $item['metrics'][5],
        'achivments' => $item['metrics'][6],
    ];
}
//var_dump($tmpdata);
$monthlyAttendance2017 = $tmpdata;
?>


<table class="tableReports">
    <caption>Посещаемость по месяцам 2017</caption>
    <tr>
        <th>Месяц</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Просмотры</th>
        <th>Для новых посетителей</th>
        <th>Отказы</th>
        <th>Время на сайте</th>
        <th>достеижения целей</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['month']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['shows']; ?></td>
            <td><?= $elm['forNew']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['time']; ?></td>
            <td><?= $elm['achivments']; ?></td>
        </tr>
    <? endforeach; ?>
</table>