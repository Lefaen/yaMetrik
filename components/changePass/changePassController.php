<?php


class changePassController extends controllerBase
{
    function actionIndex($path)
    {
        //$data = $this->model->getData();

        //$data['statusPassRepeat'] = true;
        //$data['statusCheckUser'] = true;

        $dataUser = sqlClass::checkUser($_SESSION['login'], $_POST['oldPass']);
        //var_dump($dataUser);
        if($_POST['newPassRepeat'] == $_POST['newPass'])
        {
            if(!empty($dataUser))
            {
                user::changePass($dataUser['id'], $_POST['newPassRepeat']);
                $data['statusCheckUser'] = true;
                $data['statusPassRepeat'] = true;
            }
            else
            {
                $data['statusCheckUser'] = false;
            }
        }
        else
        {
            $data['statusPassRepeat'] = false;
        }
        $this->view->createView($path . '/view.php', '', $data);
    }

    function __construct()
    {
        $this->view = new viewBase();
    }
}

?>