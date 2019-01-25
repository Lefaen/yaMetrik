<?
//-----------------------------------
//ПОСЕЩАЕМОСТЬ ПО МЕСЯЦАМ------------
//-----------------------------------

$params = null;
$params = array(
    'ids' => $data['ids'],//$_POST['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => 'ym:s:visits,ym:s:uniqUserID,ym:s:sumPageViews,ym:s:percentNewVisitors,ym:s:percentBounce,ym:s:avgVisitDuration,ym:s:sumGoalReachesAny',         //метрики
    'dimensions' => 'ym:s:startOfMonth',                                  //группировка
    'date1' => '2018-01-01',//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => '2018-12-31',//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth',                                         //сортировка
);

//var_dump($_POST);
$coef = 1;
while ($coef >= 1) {
    //var_dump('TEST');
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
//var_dump($tmpdata);

    $coef = 0;
    foreach ($tmpdata as $item) {
        if (strpos((string)$item['visit'], '00') != false) {
            $coef++;
            if (strpos((string)$item['users'], '00') != false) {
                $coef++;
                if (strpos((string)$item['shows'], '00') != false) {
                    $coef++;
                }
            }
        }
    }

    $coef = $coef / count($tmpdata);


}
if ($coef < 1) {
    $data['monthlyAttendance2017'] = $tmpdata;
}else{
    $data['monthlyAttendance2017'] = null;
}
//var_dump($coef);
?>
<? /*
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
*/ ?>