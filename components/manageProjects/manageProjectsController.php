<?php

class manageProjectsController extends controllerBase
{
    function actionIndex($path)
    {

        if(isset($_SESSION['id']))
        {
            $data = $this->model->getData();
            $this->view->createView($path . '/view.php', '', $data);
        }
        if(isset($_GET['deleteProject']))
        {
            sqlClass::deleteProject($_SESSION['login'], $_GET['deleteProject']);
            exit("<meta http-equiv='refresh' content='0; url= /manage'>");

        }
    }

    function __construct()
    {
        $this->model = new manageProjectsModel();
        $this->view = new viewBase();
    }

}

?>