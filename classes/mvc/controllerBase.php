<?php

class controllerBase
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new viewBase();
    }
    function actionIndex()//default
    {

    }
}

?>