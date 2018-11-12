<?php


class forgotPassController extends controllerBase
{
    function actionIndex($path)
    {
        $data = $this->model->getData();

        $this->view->createView($path . '/view.php', '', $data);

    }

    function __construct()
    {
        $this->model = new forgotPassModel();
        $this->view = new viewBase();
    }

}

?>