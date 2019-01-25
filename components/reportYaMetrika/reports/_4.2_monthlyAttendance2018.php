<?
//-----------------------------------
//ПОСЕЩАЕМОСТЬ ПО МЕСЯЦАМ------------
//-----------------------------------

$params = null;
$params = array(
    'ids' => $data['ids'],//$_POST['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:sumPageViews,ym:s:percentNewVisitors,ym:s:percentBounce,ym:s:avgVisitDuration,ym:s:sumGoalReachesAny',         //метрики
    'dimensions' => 'ym:s:visitMonth',                                  //группировка
    'date1' => '2019-01-01',//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:visitMonth',                                         //сортировка
);

//var_dump($_POST);
$coef = 1;
while ($coef >= 1) {
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
        'month' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'shows' => $item['metrics'][2],
        'forNew' => $item['metrics'][3],
        'refusals' => $item['metrics'][4],
        'time' => $item['metrics'][5],
        'achivments' => $item['metrics'][6],
    );
}

    $coef = 0;
    foreach ($tmpdata as $item) {
        if (strpos((string)$item['visit'], '000') != false) {
            $coef++;
            if (strpos((string)$item['users'], '000') != false) {
                $coef++;
                if (strpos((string)$item['shows'], '000') != false) {
                    $coef++;
                }
            }
        }
    }

    $coef = $coef / count($tmpdata);

}
if ($coef < 1) {
    $data['monthlyAttendance2018'] = $tmpdata;
}else{
    $data['monthlyAttendance2018'] = null;
}

//$data['monthlyAttendance2018'] = $tmpdata;
?>

<?/*
<table class="tableReports">
    <caption>Посещаемость по месяцам 2018</caption>
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
*/?>