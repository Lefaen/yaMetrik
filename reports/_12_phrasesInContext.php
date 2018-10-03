<?
//-----------------------------------
//ФРАЗЫ ПО КОНТЕКСТУ-----------------
//-----------------------------------

$params = null;
$params = array(
    'ids' => $ids,//$_POST['ids'],                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds',         //метрики
    'dimensions' => 'ym:s:<attribution>DirectClickOrder,ym:s:<attribution>DirectClickBanner,ym:s:<attribution>DirectSearchPhrase,ym:s:<attribution>DirectSearchPhrase',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'limit' => 40,
    //'sort' => 'ym:s:date',                                         //сортировка
);

//var_dump($_POST);
$contentJson = file_get_contents($url . '?' . http_build_query($params));


//var_dump($contentJson);
$data = null;
$data = json_decode($contentJson, true);
$tmpdata = null;
$tmpdata = array();
//var_dump($data);

foreach ($data['data'] as $item) {
    $tmpdata[] = array(
        'companyYaDirect' => $item['dimensions'][0]['name'],
        'directSearchPhrase' => $item['dimensions'][1]['name'],
        'directBanner' => $item['dimensions'][2]['name'],
        'visit' => $item['metrics'][0],
        'users' => $item['metrics'][1],
        'refusals' => $item['metrics'][2],
        'viewingDepth' => $item['metrics'][3],
        'time' => $item['metrics'][4],
    );
}
//var_dump($tmpdata);
//if($tmpdata != null){
    $prasesInContext = $tmpdata;
//var_dump($prasesInContext);
//}else{
    //echo 'Контекст не ведется';
//}

?>

<?/*
<table class="tableReports">
    <caption>Фразы по контексту</caption>
    <tr>
        <th>Визиты</th>
        <th>Посетители</th>
        <th>Отказы</th>
        <th>Глубина просмотра</th>
        <th>Время на сайте</th>
        <th>Кампания Яндекс.Директ</th>
        <th>Условие показа объявления</th>
    </tr>
    <? foreach ($prasesInContext as $elm): ?>
        <tr>
            <td><?= $elm['visit']; ?></td>
            <td><?= $elm['users']; ?></td>
            <td><?= $elm['refusals']; ?></td>
            <td><?= $elm['viewingDepth']; ?></td>
            <td><?= $elm['time']; ?></td>
            <td><?= $elm['companyYaDirect']; ?></td>
            <td><?= $elm['directBanner']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
*/?>