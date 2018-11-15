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
        $user = project::$userHref;
        
        $data = $this->model->getData();
        if(!empty($data['login'] && !empty($data['pass'])))
        {

            $user->signIn($data['login'], $data['pass']);
        }
        if(isset($_SESSION['id']))
        {
            $this->view->createView($path.'/viewIsLogin.php', '', $data);
        }
        else
        {
            $this->view->createView($path.'/view.php', '', $data);
        }
        if($data['logout'] == true)
        {
            $uri = explode('?', $_SERVER['REQUEST_URI']);
            $_SESSION = array();
            exit("<meta http-equiv='refresh' content='0; url= $uri[0]'>");
        }

    }
}

?>