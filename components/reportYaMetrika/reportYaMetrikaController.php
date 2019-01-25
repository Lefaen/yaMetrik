<?php

class reportYaMetrikaController extends controllerBase
{
    private static function build_query($url, array $params)
    {
        $getString = null;
        foreach ($params as $key => $value)
        {
                $getString .= $key . '=' . $value . '&';
         }
         $getString = $url . '?' . $getString;
        return$getString;
    }
    function actionIndex($path)
    {
        $pathComponent = $path;
        $path = null;
        if (isset($_SESSION['id'])) {
            $data = $this->model->getData();




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


            if (isset($_POST['submit'])) {
                $data['statusField'] = 'Введите данные';
                if ($_POST['id'] != null && $_POST['dateStart'] != null && $_POST['dateFin'] != null) {

                    $data['statusField'] = null;
                    if($_SESSION['login'] != 'test')
                    {
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
                        include 'writerXl/createExcell.php';
                    }else
                    {
                        //include 'reports/_3_commonForTheMonth.php'; //Общие по месяцу
                        include 'reports/_4.1_monthlyAttendance2017.php'; //Посещаемость по месяцам 2017
                        include 'reports/_4.2_monthlyAttendance2018.php'; //Посещаемость по месяцам 2018
                        //include 'reports/_5.1_sourcesSummary.php'; //Источники сводка
                        //include 'reports/_5.2_sourcesDetaly.php'; //Источники сводка
                        //include 'reports/_6.1_searchSystemSummary.php';//Поисковой трафик сумарный
                        //include 'reports/_6.2_searchSystemDetalyWeek.php';//Поисковой трафик детально по неделям
                        //include 'reports/_6.3_searchSystemDetalyMonth.php';//Поисковой трафик детально по месяцам
                        //include 'reports/_7.1_targetSummaryMonth.php';//Цели в динамике суммарный за месяц
                        //include 'reports/_8_geography.php'; //География
                        //include 'reports/_9.1_browsers.php'; //Технологии Браузеры
                        //include 'reports/_9.2_resolution.php'; //Технологии Разрешение
                        //include 'reports/_10_devices.php'; //Устройства
                        //include 'reports/_11_searchPhrases.php'; //Поисковые фразы
                        //include 'reports/_12_phrasesInContext.php';//Фразы по контексту
                        //include 'reports/_13_popularPages.php'; //Популярные страницы
                        include 'writerXl/createExcell.php';
                    }


                } else {
                    $data['statusField'] = 'Введены не все данные';
                }

            }
            $this->view->createView($pathComponent . '/view.php', '', $data);
        }
    }

    function __construct()
    {
        $this->model = new reportYaMetrikaModel();
        $this->view = new viewBase();
    }

}

?>