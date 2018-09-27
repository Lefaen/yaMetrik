<?
//-----------------------------------
//РАЗРЕШЕНИЕ-------------------------
//-----------------------------------

$params = null;
$params = [
    'ids' => $ids,//$_POST['ids'],                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits,ym:s:users,ym:s:pageviews,ym:s:percentNewVisitors,ym:s:bounceRate,ym:s:avgVisitDurationSeconds',         //метрики
    'dimensions' => 'ym:s:startURLHash',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'limit' => '25'
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
        'signInPage' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'shows' => $item['metrics'][2],
        'forNew' => $item['metrics'][3],
        'refusals' => $item['metrics'][4],
        'time' => $item['metrics'][5],

    ];
}
//var_dump($tmpdata);
$popularPage = $tmpdata;
?>

<?/*
<table class="tableReports">
    <caption>Популярные страницы</caption>
    <tr>
        <th>Страница входа</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Просмотры</th>
        <th>Доля новых пользователей</th>
        <th>Отказы</th>
        <th>Время на сайте</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['signInPage']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['shows']; ?></td>
            <td><?= $elm['forNew']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['time']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
*/?>