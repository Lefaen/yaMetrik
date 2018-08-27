<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------


$dateFinSource = explode('-', $dateFin);
$dateStartSource = null;
$dateStartSource[0] = '';
$dateStartSource[1] = $dateFinSource[1] - $period;
$dateStartSource[2] = '01';
$period = 6;
$year = 13;

$dateStartSource[1] = $dateFinSource[1] - $period;
if ($dateStartSource[1] > 0) {
    $dateStartSource[0] = $dateFinSource[0];
    $dateStartSource[1] = $dateStartSource[1] + 1;
} elseif ($dateStartSource[1] < 0) {
    //echo $dateFinSource[1];
    $dateStartSource[0] = $dateFinSource[0] - 1;
    $dateStartSource[1] = $year + $dateStartSource[1];
} elseif ($dateStartSource[1] == 0) {
    $dateStartSource[0] = $dateFinSource[0];
    $dateStartSource[1] = 1;
}
$dateFinSource = $dateFinSource[0] . '-' . $dateFinSource[1] . '-' . $dateFinSource[2];
$dateStartSource = $dateStartSource[0] . '-' . $dateStartSource[1] . '-' . $dateStartSource[2];
echo $dateStartSource . '<br>';
echo $dateFinSource;


$params = [
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:date,ym:s:<attribution>TrafficSource',                                  //группировка
    'date1' => $dateStartSource,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSource,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:date',                                         //сортировка
    //'group' => 'week',
    'limit' => 15000
];

$contentJson = file_get_contents($url . '?' . http_build_query($params));

$data = json_decode($contentJson, true)['data'];
$tmpdata = [];
foreach ($data as $item) {
    $tmpdata[] = [
        'date' => $item['dimensions'][0]['name'],
        'source' => $item['dimensions'][1]['name'],
        'visit' => $item['metrics'][0]
    ];
}

$sourceDetaly = $tmpdata;

$sourceDetalyWeek[] = array();


foreach ($sourcesSummary as $source) {
    $i = 1;
    ?>

    <table class="tableReports">
        <caption>Поисковой трафик</caption>
        <tr>
            <th>Поисковая система</th>
            <th>Визиты</th>
            <th>Посетители</th>
        </tr>
    <?

    //var_dump($searchSystemDetaly);



    $date = explode('-', $dateStartSource);
    for ($n = 1; $n <= $period; $n++) {


        $numberDays = cal_days_in_month(CAL_GREGORIAN, (int)$date[1], (int)$date [0]);
        $numberDays;
        $day = 0;
        $week = 7;
        $visit = 0;
        for ($j = 1; $j <= $numberDays; $j++) {
            $dateElm = null;

            $day = $day +1;
            foreach ($tmpdata as $elm) {

                $dateElm = explode('-', $elm['date']);
                if ($dateElm[2] == $j && $dateElm[1] == $date[1]) {

                    //var_dump($elm);

                    if ($elm['source'] == $source['sources']) {


                        //$sourceDetalyWeek[]['date'] = $elm['date'];
                        //$sourceDetalyWeek[]['searchSystem'] = $elm['source'];
                        //$sourceDetalyWeek[]['visit'] = $elm['visit'];
                        $visit = $elm['visit'] + $visit;
                        if($day == $week){
                            echo '<tr>';
                            echo '<td>'.$elm['date'].'</td>';
                            echo '<td>' . $elm['source'] . '</td>';
                            echo '<td>' . $visit . '</td>';
                            echo '</tr>';

                            $sourceDetalyWeek[$source['sources']]['date'][] = $elm['date'];
                            $sourceDetalyWeek[$source['sources']]['source'][] = $elm['source'];
                            $sourceDetalyWeek[$source['sources']]['visit'][] = $visit;
                            $visit = 0;
                        }

                        break;
                    } else
                        $dateElm = null;

                } else {
                    $dateElm = null;
                    continue;
                }
            }
            if ($dateElm == null) {
                if($day == $week){
                    echo '<tr>';
                    echo '<td>' . $date[0].'-'.$date[1].'-' .$j . '</td>';
                    echo '<td>' . $source['sources'] . '</td>';
                    echo '<td>' . $visit . '</td>';
                    echo '</tr>';

                    $sourceDetalyWeek[$source['sources']]['date'][] = $date[0] . '-' . $date[1] . '-' . $j;
                    $sourceDetalyWeek[$source['sources']]['source'][] = $source['sources'];
                    $sourceDetalyWeek[$source['sources']]['visit'][] = $visit;
                    $visit = 0;
                }


            }
            if($day == $week)
            {
                $day = 0;
            }
        }

        $date[1] = (int)$date[1] + 1;
        //echo $date[1];






    }
    echo '</table>';
}
//var_dump($sourceDetalyWeek['Яндекс']);
