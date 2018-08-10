<?
//-----------------------------------
//ПОИСКОВОЙ ТРАФИК-------------------
//-----------------------------------

$params = [
    'ids' => $ids,                          //счетчик
    'oauth_token' => 'AQAAAAANfujIAAUHWDSXYI7X30Wpshlh3sksM7c',    //токен
    'metrics' => 'ym:s:visits',         //метрики
    'dimensions' => 'ym:s:date,ym:s:<attribution>SearchEngineRoot',                                  //группировка
    'date1' => $dateStart,//$_POST['dateStart'];              //дата начала выгрузки
    'date2' => $dateFin,//$_POST['dateFin'];                 //дата окончания выгрузки
    'sort' => 'ym:s:date',                                         //сортировка
    'group' => 'week',
    'limit' => 1000
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
?>

<?
var_dump($searchSystemSummary);


?>
<? foreach ($searchSystemSummary as $system): ?>


    <? $i = 1; ?>
    <table class="tableReports">
        <caption>Поисковой трафик</caption>
        <tr>
            <th>Поисковая система</th>
            <th>Визиты</th>
            <th>Посетители</th>
        </tr>
        <? ?>
        <?

        $date = explode('-', $dateStart);
        $numberDays = cal_days_in_month(CAL_GREGORIAN, (int)$date[1], (int)$date [0]);
        $numberDays;


        for ($j = 1; $j <= $numberDays; $j++) {
            $dateElm = null;
            foreach ($tmpdata as $elm) {


                $dateElm = explode('-', $elm['date']);
                if ($dateElm[2] == $j) {

                    if ($elm['searchSystem'] == $system['searchSystem']) {
                        echo '<tr>';
                        echo '<td>' . $elm['date'] . '</td>';
                        echo '<td>' . $elm['searchSystem'] . '</td>';
                        echo '<td>' . $elm['visit'] . '</td>';
                        echo '</tr>';
                        break;
                    }else
                    $dateElm = null;

                } else {
                    $dateElm = null;
                    continue;
                }
            }
            if ($dateElm == null) {
                echo '<tr>';
                echo '<td>' . $j . '</td>';
                echo '<td>' . 0 . '</td>';
                echo '<td>' . 0 . '</td>';
                echo '</tr>';
            }

        }


        ?>
    </table>
    <br>
<? endforeach; ?>

