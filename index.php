<?
ini_set('display_errors', 1);

require_once '/classes/mvc/modelBase.php';
require_once '/classes/mvc/viewBase.php';
require_once '/classes/mvc/controllerBase.php';
require_once '/classes/mvc/route.php';
require_once '/classes/mvc/component.php';
require_once '/classes/user.php';
require_once '/classes/sqlClass.php';

Route::start();//prepare routing
sqlClass::start();//prepare tables

?>


<?/*<head>
    <link href="style.css" rel="stylesheet"/>
    <meta charset="utf-8">
    <title>Отчет</title>
</head>
<body>
<?
include 'counters.php';//счетчики токен
if($_GET['id'] == 1)
{
    $projects = null;
    $projects = $projectsVoronchihin;
}
?>
<form class="formReport" method="post" action="/">
    <div class="fieldReports">
        <div>
            <label>Отчет по проекту</label>
            <select name="ids">
                <?
                foreach ($projects as $key => $value): ?>
                    <option value="<?= $value . '_' . $key ?>"><?= $key; ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div>
            <label>номер счетчика: </label>
        </div>
        <div>
            <label>Период выгрузки:<br></label>
            <span>С</span><input name="dateStart" type="date" value="<?= $_POST['dateStart'] ?>">
            <span>По</span><input name="dateFin" type="date" value="<?= $_POST['dateFin'] ?>">
        </div>
        <div>
            <label>Руководитель проекта:</label>
            <input name="headProject" value="" type="text" />
        </div>
        <div>
            <label>Руководитель отдела:</label>
            <input name="headDepartment" value="" type="text" />
        </div>
        <div>
            <label>Ведущий специалист проекта:</label>
            <input name="specialist" value="" type="text" />
        </div>
        <div>
            <label>Обращение к клиенту</label>
            <input name="client" value="" type="text" />
        </div>


    </div>
    <input name="submit" type="submit"/>
</form>
<?php

//Данные выгрузки
$url = 'https://api-metrika.yandex.ru/stat/v1/data';

$idsProject = explode('_', $_POST['ids']);
$ids = $idsProject[0];
$project = $idsProject[1];
$idsProject = null;
$dateStart = $_POST['dateStart'];
$dateFin = $_POST['dateFin'];

$headProject = $_POST['headProject'];
$headDepartment = $_POST['headDepartment'];
$specialist = $_POST['specialist'];
$client = $_POST['client'];

//$path = "C:/OSpanel/domains/yaMetrik/template.php/xl/worksheets/";
$path = "template.php/xl/worksheets/";
$pathToDiagram = 'template.php/xl/charts/';
$status = null;
//var_dump($_POST);

function sortMonth($array, $month)
{
    $tmpArray = array();
    $newArray = array();
    foreach ($array as $k => $v) {
        if (($k != $month) && (int)$k < (int)$month) {
            $tmpArray[$k] = $v;
        } elseif ((int)$k >= (int)$month) {
            $newArray[$k] = $v;
        }
        //var_dump($key);
    }

    $array = null;
    $array = $newArray;
    $array = $array + $tmpArray;
    //var_dump($array);
    return $array;
}

if (!isset($_POST['submit'])) {
    echo '<div>Введите данные</div>';
} else {
    if ($_POST['ids'] != null && $_POST['dateStart'] != null && $_POST['dateFin'] != null) {

        include 'reports/_3_commonForTheMonth.php'; //Общие по месяцу
        include 'reports/_4.1_monthlyAttendance2017.php'; //Посещаемость по месяцам 2017
        include 'reports/_4.2_monthlyAttendance2018.php'; //Посещаемость по месяцам 2018
        include 'reports/_5.1_sourcesSummary.php'; //Источники сводка
        include 'reports/_5.2_sourcesDetaly.php'; //Источники сводка
        include 'reports/_6.1_searchSystemSummary.php';//Поисковой трафик сумарный
        include 'reports/_6.2_searchSystemDetalyWeek.php';//Поисковой трафик детально по неделям
        include 'reports/_6.3_searchSystemDetalyMonth.php';//Поисковой трафик детально по месяцам
        include 'reports/_7.1_targetSummaryMonth.php';//Цели в динамике суммарный за месяц
        include 'reports/_8_geography.php'; //География
        include 'reports/_9.1_browsers.php'; //Технологии Браузеры
        include 'reports/_9.2_resolution.php'; //Технологии Разрешение
        include 'reports/_10_devices.php'; //Устройства
        include 'reports/_11_searchPhrases.php'; //Поисковые фразы
        include 'reports/_12_phrasesInContext.php';//Фразы по контексту
        include 'reports/_13_popularPages.php'; //Популярные страницы

//include 'reports/_5.2_sourcesDetaly_V2.0.php'; //Источники сводка
        include 'writerXl/createExcell.php';

    } else {
        echo '<div class="errorReports">' . 'Введены не все данные' . '</div>';
    }
    //var_dump($_POST);

}
?>

</body>
*/?>