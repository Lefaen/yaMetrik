<?
//-----------------------------------
//ГЕОГРАФИЯ--------------------------
//-----------------------------------

$params = null;
$params = [
    'ids' => $ids,//$_POST['ids'],                          //счетчик
    'oauth_token' => 'AQAAAAANfujIAAUHWDSXYI7X30Wpshlh3sksM7c',    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:percentBounce,ym:s:pageDepth,ym:s:avgVisitDuration',         //метрики
    'dimensions' => 'ym:s:regionCity',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'limit' => '25',
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
        'city' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
    ];
}
//var_dump($tmpdata);
?>


<table class="tableReports">
    <caption>География</caption>
    <tr>
        <th>Город</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Отказы</th>
        <th>Глубина просмотра</th>
        <th>Время на сайте</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['city']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['viewingDepth']; ?></td>
            <td><?= $elm['time']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
