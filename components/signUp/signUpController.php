<?php


class signUpController extends controllerBase
{
    function actionIndex($path)
    {
        $data = $this->model->getData();
        $this->view->createView($path . '/view.php', '', $data);

        //Если есть заявка, созадем пользователя
        if (isset($data)) {
            $user = new user($data['login'], $data['pass'], $data['email']);
        }
    }

    function createUser()
    {

    }

    function __construct()
    {
        $this->model = new signUpModel();
        $this->view = new viewBase();
    }

}

?>