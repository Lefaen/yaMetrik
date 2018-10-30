<?php


class signUpController extends controllerBase
{
    function actionIndex($path)
    {

        $this->view->createView($path.'/view.php', 'template.php');
    }
}

?>