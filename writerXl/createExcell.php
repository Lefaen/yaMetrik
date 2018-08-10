<?php
$pathTemplateFile = 'template/template.xlsx';
if (file_exists($pathTemplateFile)) {
    $pathDirectory = "project";

    if (!file_exists($pathDirectory)) {
        mkdir($pathDirectory, 0777);
        //echo 'create';
    }
    //else
    //    echo 'directory created';

    //echo $project;
    $pathDirectoryProject = $pathDirectory . '/' . $project;

    if (!file_exists($pathDirectoryProject)) {
        mkdir($pathDirectoryProject, 0777);
        //echo 'create';
    }
    //else
    //    echo 'directory created';

    $zip = new ZipArchive;
    $res = $zip->open($pathTemplateFile);
    if ($res === true) {
        $zip->extractTo('template');
        $zip->close();
    }
    $zip = null;


    include 'check.php';

    include '_1_writeTitleList.php';
    include '_2_writeCommonForTheMonth.php';
    include '_3.1_writeMonthlyAttendance2017.php';
    include '_3.2_writeMonthlyAttendance2018.php';
    //include 4;
    include '_5_writeGeography.php';
    include '_6.1_writeBrowsers.php';
    include '_6.2_writeResolution.php';

}
?>