<head>
    <link href="style.css" rel="stylesheet"/>
    <meta charset="utf-8">
    <title>Отчет</title>
</head>
<body>
<?
$projects = array(

)

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


    </div>
    <input name="submit" type="submit"/>
</form>
<?php

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
//var_dump($_POST);

if (!isset($_POST['submit'])) {
    echo '<div>Введите данные</div>';
} else {
    if ($_POST['ids'] != null && $_POST['dateStart'] != null && $_POST['dateFin'] != null) {

        //include '/reports/_2_commonForTheMonth.php'; //Общие по месяцу
        //include '/reports/_3.1_MonthlyAttendance2017.php'; //Посещаемость по месяцам 2017
        //include '/reports/_3.2_monthlyAttendance2018.php'; //Посещаемость по месяцам 2018
        //include '/reports/_4_sourcesSummary.php'; //Источники сводка
        //include '/reports/_5_geography.php'; //География
        //include '/reports/_6.1_browsers.php'; //Технологии Браузеры
        //include '/reports/_6.2_resolution.php'; //Технологии Разрешение
        //include '/reports/_7_devices.php'; //Устройства
        //include '/reports/_8_searchPhrases.php'; //Поисковые фразы
        //include '/reports/_9_popularPages.php'; //Популярные страницы
        include 'reports/_10.1_searchSystemSummary.php';//Поисковой трафик сумарный
        //$searchSystemSummary;
        include 'reports/_10.2_searchSystemDetaly.php';//Поисковой трафик детальный

        //include '/writerXl/createExcell.php';
    } else {
        echo '<div class="errorReports">' . 'Введены не все данные' . '</div>';

    }

}
?>

</body>