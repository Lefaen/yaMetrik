<?php

class reportYaMetrikaController extends controllerBase
{
    function actionIndex($path)
    {

        if(isset($_SESSION['id']))
        {
            $data = $this->model->getData();
            $this->view->createView($path . '/view.php', '', $data);
        }
    }

    function __construct()
    {
        $this->model = new reportYaMetrikaModel();
        $this->view = new viewBase();
    }

}

?>