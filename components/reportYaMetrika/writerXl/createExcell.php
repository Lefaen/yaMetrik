<?php
$pathTemplateFile = 'components/reportYaMetrika/template/template.xlsx';
if (file_exists($pathTemplateFile)) {
    $pathDirectory = "components/reportYaMetrika/project";

    if (!file_exists($pathDirectory)) {
        mkdir($pathDirectory, 0777);
        //echo 'create';
    }
    //else
    //    echo 'directory created';

    //echo $project;
    $pathDirectoryProject = $pathDirectory . '/' . $data['project'];


    if (!file_exists($pathDirectoryProject)) {
        mkdir($pathDirectoryProject, 0777);
        //echo 'create';
    }
    //else
    //    echo 'directory created';

    $zip = new ZipArchive;
    $res = $zip->open($pathTemplateFile);
    if ($res === true) {
        $zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/components/reportYaMetrika/template');
        $zip->close();
    }
    $zip = null;

    $path = "components/reportYaMetrika/template/xl/worksheets/";
    include 'check.php';
    include '_1_writeTitleList.php';
    include '_2_writeContent.php';
    include '_3_writeCommonForTheMonth.php';
    include '_4.1_writeMonthlyAttendance2017.php';
    include '_4.2_writeMonthlyAttendance2018.php';
    include '_5.1_writeSourcesSummary.php';
    include '_5.2_writeSourcesDetaly.php';
    include '_6.1_writeSearchSystemSummary.php';
    include '_6.2_writeSearchSystemDetalyWeek.php';
    include '_6.3_WrightSearchSystemDetalyMonth.php';
    include '_7.1_wrightTargetSummaryMonth.php';
    include '_7.2_wrightTargetDetalyYear.php';
    include '_8_writeGeography.php';
    include '_9.1_writeBrowsers.php';
    include '_9.2_writeResolution.php';
    include '_10_writeDevices.php';
    include '_11_writeSearchPhrases.php';
    include '_12_writePhrasesInContext.php';
    include '_13_writePopularPages.php';

    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                    continue;

                $file = realpath($file);
                $file = str_replace('\\', '/', $file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }
        return $zip->close();
    }

    $path = '/components/reportYaMetrika/' . 'project/' . $data['project'] . '/' . $data['dateFin'] . '_' . $data['project'] . '_Статистический_отчет_по_продвижению_v1.xlsx';
    //$path2 = iconv('utf-8','windows-1251',$path);
    Zip($_SERVER['DOCUMENT_ROOT'] . '/components/reportYaMetrika/template/', $_SERVER['DOCUMENT_ROOT'] . $path);
    $data["linkReport"] = $path;
}


?>