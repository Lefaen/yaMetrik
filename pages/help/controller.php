<?php


class controller extends controllerBase
{
    function actionIndex($path)
    {

        $this->view->createView($path.'/view.php', 'template.php');
    }
}

?>