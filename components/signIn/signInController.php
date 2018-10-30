<?php


class signInController extends controllerBase
{
    function __construct()
    {
        $this->model = new signInModel();
        $this->view = new viewBase();
    }

    function actionIndex($path)
    {
        $data = $this->model->getData();
        $this->view->createView($path.'/view.php', '', $data);
    }
}

?>