<?
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$urlForListTarget = 'https://api-.default.yandex.ru/management/v1/counter/'.$ids.'/goals?oauth_token='.$token;
//echo $urlForListTarget;
$contentJson = file_get_contents($urlForListTarget);
$listTarget = json_decode($contentJson, true);
//var_dump($listTarget);

$params = array(
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => '',         //метрики
    //'dimensions' => 'ym:s:date',                             //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',
    'group' => 'month',
    //'limit' => 1000
    //                                         //сортировка
);

foreach ($listTarget['goals'] as $item)
{
    $params['metrics'] = 'ym:s:goal'.$item['id'].'conversionRate,ym:s:goal'.$item['id'].'reaches,ym:s:goal'.$item['id'].'visits';

    //var_dump($_POST);
    //echo $url . '?' . http_build_query($params);

    $contentJson = file_get_contents($url . '?' . http_build_query($params));

    //var_dump($contentJson);
    $data = json_decode($contentJson, true);

    //var_dump($data);
    $tmpdata = array();

    foreach ($data['data'] as $elm) {
        $tmpdata[] = array(
            'name' => $item['name'],
            'conversionRate' => $elm['metrics'][0],
            'reaches' => $elm['metrics'][1],
            'visits' => $elm['metrics'][2]
        );

    }


    $dataTargets[] = $tmpdata[0];
    //var_dump($dataTargets);
    //echo $item['name'].':'.$dataTargets['conversionRate'].':'.$dataTargets['reaches'].':'.$dataTargets['visits'].'<br>';//Пишем в общий массив, отправляем на запись

    //Выборка Достижения целей по каждой цели за год

    include '_7.2_targetDetalyYear.php';

}
$yearArrayMonth = null;
$yearArrayMonth = array(
    '01' => '',
    '02' => '',
    '03' => '',
    '04' => '',
    '05' => '',
    '06' => '',
    '07' => '',
    '08' => '',
    '09' => '',
    '10' => '',
    '11' => '',
    '12' => ''
);



$dateStartTarget = explode('-', $dateStart);
$yearArrayMonth = sortMonth($yearArrayMonth, $dateStartTarget[1]);
//var_dump($yearArrayMonth);

$targetsYearSummary = array();
//var_dump($targetsYear);
for($i = 0; $i < count($targetsYear); $i++){
    foreach ($targetsYear[$i] as $key => $val){
        foreach ($yearArrayMonth as $month => $itemMonth)
        {
            $date = explode('-', $val['date']);
            if((int)$month == (int)$date[1])
            {
                //var_dump($val);
                $targetsYearSummary[$val['date']] += $val['reaches'];
                //var_dump($targetsYearSummary[$key]);
            }

            //echo($date[1]);
        }
        //echo $targetsYearSummary[$key]['date'].'<br>';
        //var_dump($targetsYearSummary);
    }
}



    //var_dump($targetsYearSummary);
//$commonForTheMonth = $tmpdata;

?>