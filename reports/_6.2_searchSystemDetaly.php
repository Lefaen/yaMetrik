<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------


$dateFinSearch = explode('-', $dateFin);
$dateStartSearch = null;
$dateStartSearch[0] = '';
$dateStartSearch[1] = $dateFinSearch[1] - $period;
$dateStartSearch[2] = '01';
$period = 6;
$year = 13;

$dateStartSearch[1] = $dateFinSearch[1] - $period;
if ($dateStartSearch[1] > 0) {
    $dateStartSearch[0] = $dateFinSearch[0];
    $dateStartSearch[1] = $dateStartSearch[1] + 1;
} elseif ($dateStartSearch[1] < 0) {
    //echo $dateFinSearch[1];
    $dateStartSearch[0] = $dateFinSearch[0] - 1;
    $dateStartSearch[1] = $year + $dateStartSearch[1];
} elseif ($dateStartSearch[1] == 0) {
    $dateStartSearch[0] = $dateFinSearch[0];
    $dateStartSearch[1] = 1;
}
$dateFinSearch = $dateFinSearch[0] . '-' . $dateFinSearch[1] . '-' . $dateFinSearch[2];
$dateStartSearch = $dateStartSearch[0] . '-' . $dateStartSearch[1] . '-' . $dateStartSearch[2];
echo $dateStartSearch . '<br>';
echo $dateFinSearch;


$params = [
    'ids' => $ids,                          //счетчик
    'oauth_token' => $token,    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:date,ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStartSearch,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFinSearch,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:date',                                         //сортировка
    //'group' => 'week',
    'limit' => 5000
];

$contentJson = file_get_contents($url . '?' . http_build_query($params));

$data = json_decode($contentJson, true)['data'];
$tmpdata = [];
foreach ($data as $item) {
    $tmpdata[] = [
        'date' => $item['dimensions'][0]['name'],
        'searchSystem' => $item['dimensions'][1]['name'],
        'visit' => $item['metrics'][0]
    ];
}

$searchSystemDetaly = $tmpdata;

$searchSystemDetalyWeek[] = array();


foreach ($searchSystemSummary as $system) {
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



    $date = explode('-', $dateStartSearch);
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

                    if ($elm['searchSystem'] == $system['searchSystem']) {


                        //$searchSystemDetalyWeek[]['date'] = $elm['date'];
                        //$searchSystemDetalyWeek[]['searchSystem'] = $elm['searchSystem'];
                        //$searchSystemDetalyWeek[]['visit'] = $elm['visit'];
                        $visit = $elm['visit'] + $visit;
                        if($day == $week){
                            echo '<tr>';
                            echo '<td>'.$elm['date'].'</td>';
                            echo '<td>' . $elm['searchSystem'] . '</td>';
                            echo '<td>' . $visit . '</td>';
                            echo '</tr>';

                            $searchSystemDetalyWeek[$system['searchSystem']]['date'][] = $elm['date'];
                            $searchSystemDetalyWeek[$system['searchSystem']]['searchSystem'][] = $elm['searchSystem'];
                            $searchSystemDetalyWeek[$system['searchSystem']]['visit'][] = $visit;
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
                    echo '<td>' . $system['searchSystem'] . '</td>';
                    echo '<td>' . $visit . '</td>';
                    echo '</tr>';

                    $searchSystemDetalyWeek[$system['searchSystem']]['date'][] = $date[0] . '-' . $date[1] . '-' . $j;
                    $searchSystemDetalyWeek[$system['searchSystem']]['searchSystem'][] = $system['searchSystem'];
                    $searchSystemDetalyWeek[$system['searchSystem']]['visit'][] = $visit;
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
//var_dump($searchSystemDetalyWeek['Яндекс']);
