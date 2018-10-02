<head>
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
            <input name="headProject" value="Горячев А.А." type="text" />
        </div>
        <div>
            <label>Руководитель отдела:</label>
            <input name="headDepartment" value="Семенова Н.В." type="text" />
        </div>
        <div>
            <label>Ведущий специалист проекта:</label>
            <input name="specialist" value="Лотц О.А" type="text" />
        </div>
        <div>
            <label>Обращение к клиенту</label>
            <input name="client" value="Уважаемый Олег" type="text" />
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

//$path = "C:/OSpanel/domains/yaMetrik/template/xl/worksheets/";
$path = "template/xl/worksheets/";
$pathToDiagram = 'template/xl/charts/';
$status = null;
//var_dump($_POST);

if (!isset($_POST['submit'])) {
    echo '<div>Введите данные</div>';
} else {
    if ($_POST['ids'] != null && $_POST['dateStart'] != null && $_POST['dateFin'] != null) {

        //include 'reports/_3_commonForTheMonth.php'; //Общие по месяцу
        //include 'reports/_4.1_monthlyAttendance2017.php'; //Посещаемость по месяцам 2017
        //include 'reports/_4.2_monthlyAttendance2018.php'; //Посещаемость по месяцам 2018
        //include 'reports/_5.1_sourcesSummary.php'; //Источники сводка
        //include 'reports/_5.2_sourcesDetaly.php'; //Источники сводка
        //include 'reports/_6.1_searchSystemSummary.php';//Поисковой трафик сумарный
        //include 'reports/_6.2_searchSystemDetaly.php';//Поисковой трафик детальный
        include 'reports/_7.1_targetSummaryMonth.php';//Цели в динамике суммарный за месяц
        //include 'reports/_7_geography.php'; //География
        //include 'reports/_8.1_browsers.php'; //Технологии Браузеры
        //include 'reports/_8.2_resolution.php'; //Технологии Разрешение
        //include 'reports/_9_devices.php'; //Устройства
        //include 'reports/_10_searchPhrases.php'; //Поисковые фразы
        //include 'reports/_11_phrasesInContext.php';//Фразы по контексту
        //include 'reports/_12_popularPages.php'; //Популярные страницы

//include 'reports/_5.2_sourcesDetaly_V2.0.php'; //Источники сводка
        include 'writerXl/createExcell.php';

    } else {
        echo '<div class="errorReports">' . 'Введены не все данные' . '</div>';
    }
    //var_dump($_POST);

}
?>

</body>