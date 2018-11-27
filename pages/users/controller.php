<?php


class controller extends controllerBase
{
    function actionIndex($path)
    {
        $dataUser = sqlClass::getString(array('login'=>$_SESSION['login']), 'users');
        if($dataUser['group'] == 1)
        {
            $this->view->createView($path.'/view.php', 'template.php');
        }

    }
}

?>