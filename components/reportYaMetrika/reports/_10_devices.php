<?
//-----------------------------------
//РАЗРЕШЕНИЕ-------------------------
//-----------------------------------

$params = null;
$params = array(
    'ids' => $data['ids'],//$_POST['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:percentBounce,ym:s:pageDepth,ym:s:avgVisitDuration',         //метрики
    'dimensions' => 'ym:s:deviceCategory',                                  //группировка
    'date1' => $data['dateStart'],//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',                                         //сортировка
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
        'deviceType' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
    );
}
//var_dump($tmpdata);
$data['devices'] = $tmpdata;
?>

<?/*
<table class="tableReports">
    <caption>Устройства</caption>
    <tr>
        <th>Тип устройства</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Отказы</th>
        <th>Глубина просмотра</th>
        <th>Время на сайте</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['deviceType']; ?></td>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['viewingDepth']; ?></td>
            <td><?= $elm['time']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
*/?>