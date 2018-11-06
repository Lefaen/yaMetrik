<?php


class signUpController extends controllerBase
{
    function actionIndex($path)
    {
        $data = $this->model->getData();


        //Если есть заявка, созадем пользователя
        $status = false;
        if (isset($data)) {
            $user = new user();
            $status = $user->register($data['login'], $data['pass'], $data['email']);
            $data['statusRegister'] = $status;
        }
            $this->view->createView($path . '/view.php', '', $data);
    }

    function __construct()
    {
        $this->model = new signUpModel();
        $this->view = new viewBase();
    }

}

?>