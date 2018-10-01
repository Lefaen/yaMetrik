<?
//-----------------------------------
//ОБЩИЕ ПО МЕСЯЦУ--------------------
//-----------------------------------

$params = array(
    'ids' => 40592900,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:goal24788885visits',         //метрики
    'dimensions' => 'ym:s:date',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:date',
    'group' => 'day',
    'limit' => 1000
    //                                         //сортировка
);

//var_dump($_POST);
echo $url . '?' . http_build_query($params);

$contentJson = file_get_contents($url . '?' . http_build_query($params));


//var_dump($contentJson);
$data = json_decode($contentJson, true);

var_dump($data);
$tmpdata = array();
/*
foreach ($data['data'] as $item) {
    $tmpdata[] = array(
        'date' => $item['dimensions'][0]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'shows' => $item['metrics'][2],
        'forNew' => $item['metrics'][3],
        'refusals' => $item['metrics'][4],
        'time' => $item['metrics'][5]
    );
}
*/
var_dump($tmpdata);
$commonForTheMonth = $tmpdata;

?>
<?/*
<table class="tableReports">
    <caption>Общие по месяцу</caption>
    <tr>
        <th>Дата визита</th>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Просмотры</th>
        <th>Для новых посетителей</th>
        <th>Отказы</th>
        <th>Время на сайте</th>
    </tr>
    <? foreach ($tmpdata as $elm): ?>
        <tr>
            <td><?= $elm['date']; ?></td>
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