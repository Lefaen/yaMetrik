<?
//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$urlForListTarget = 'https://api-metrika.yandex.ru/management/v1/counter/'.$data['ids'].'/goals?oauth_token='.$data['token'];
//echo $urlForListTarget;
$contentJson = file_get_contents($urlForListTarget);
$listTarget = json_decode($contentJson, true);
//var_dump($listTarget);

$params = array(
    'ids' => $data['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    'metrics' => '',         //метрики
    //'dimensions' => 'ym:s:date',                             //группировка
    'date1' => $data['dateStart'],//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $data['dateFin'],//$_POST['dateFin'];                 //дата окончания выгрузки
    //'sort' => 'ym:s:date',
    'group' => 'month',
    //'limit' => 1000
    //                                         //сортировка
);

//-----------------------------------
//ДОСТИЖЕНИЯ ЦЕЛЕЙ-------------------
//-----------------------------------

$dateFinTarget = explode('-', $data['dateFin']);
$dateFinTarget[1] = $dateFinTarget[1];
$dateStartTarget = explode('-', $data['dateStart']);
$dateStartTarget[0] = $dateStartTarget[0]-1;
$dateStartTarget[1] = $dateStartTarget[1];
$dateStartTarget[2] = $dateStartTarget[2];

$dateFinTarget = $dateFinTarget[0] . '-' . $dateFinTarget[1] . '-' . $dateFinTarget[2];
$dateStartTarget = $dateStartTarget[0] . '-' . $dateStartTarget[1] . '-' . $dateStartTarget[2];
//echo $dateStartTarget.'<br>';

$paramsTarget = array(
    'ids' => $data['ids'],                          //счетчик
    //'oauth_token' => $data['token'],    //токен
    //'metrics' => 'ym:s:goal'.$item['id'].'reaches',         //метрики
    'dimensions' => 'ym:s:startOfMonth',                                  //группировка
    'date1' => $dateStartTarget,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinTarget,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:startOfMonth',
    //'group' => 'month',
    //'limit' => 15000
    //                                         //сортировка
);

foreach ($listTarget['goals'] as $item)
{
    $params['metrics'] = 'ym:s:goal'.$item['id'].'conversionRate,ym:s:goal'.$item['id'].'reaches,ym:s:goal'.$item['id'].'visits';

    //var_dump($_POST);
    //echo $url . '?' . http_build_query($params);

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => 'Authorization: OAuth ' . $data['token'] . "\r\n"
        ]
    ];
    $context = stream_context_create($opts);
    $contentJson = file_get_contents(self::build_query($data['url'], $params), false, $context);

    //var_dump($contentJson);
    $dataMetrika = json_decode($contentJson, true);

    //var_dump($data);
    $tmpdata = array();

    foreach ($dataMetrika['data'] as $elm) {
        $tmpdata[] = array(
            'name' => $item['name'],
            'conversionRate' => $elm['metrics'][0],
            'reaches' => $elm['metrics'][1],
            'visits' => $elm['metrics'][2]
        );

    }


    $data['dataTargets'][] = $tmpdata[0];
    //var_dump($dataTargets);
    //echo $item['name'].':'.$dataTargets['conversionRate'].':'.$dataTargets['reaches'].':'.$dataTargets['visits'].'<br>';//Пишем в общий массив, отправляем на запись

    //Выборка Достижения целей по каждой цели за год

    $paramsTarget['metrics'] = 'ym:s:goal'.$item['id'].'reaches';
    $contentJsonTarget = file_get_contents(self::build_query($data['url'], $paramsTarget));


    $context = stream_context_create($opts);
    $contentJsonTarget = file_get_contents(self::build_query($data['url'], $paramsTarget), false, $context);

    $dataTarget = json_decode($contentJsonTarget, true);
    $tmpdata2 = array();
    foreach ($dataTarget['data'] as $target){

        $date = explode('-',$target['dimensions'][0]['name']);
        $date = $date[0].'-'.$date[1];
        $tmpdata2[] = array(
            'date' => $date,
            //'conversionRate' => $target['metrics'][0],
            'reaches' => $target['metrics'][0],
            //'visits' => $target['metrics'][2]
        );
    }

    $data['targetsYear'][] = $tmpdata2;
    $tmpdata2 = null;
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



$dateStartTarget = explode('-', $data['$dateStart']);
$yearArrayMonth = sortMonth($yearArrayMonth, $dateStartTarget[1]);
//var_dump($yearArrayMonth);

$targetsYearSummary = array();
//var_dump($targetsYear);
for($i = 0; $i < count($data['targetsYear']); $i++){
    foreach ($data['targetsYear'][$i] as $key => $val){
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
$data['targetsYearSummary'] = $targetsYearSummary;
$targetsYearSummary = null;
unset($data['targetsYear']);


    //var_dump($targetsYearSummary);
//$commonForTheMonth = $tmpdata;

?>