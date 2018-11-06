<?php

require_once '/interfaces/iUser.php';

class user implements iUser
{
    private $login;
    private $pass;
    private $email;


    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getEmail()
    {
        return $this->email;
    }


    public function register($login, $pass, $email)
    {
        if(!empty($login) && !empty($pass) && !empty($email))
        {
            $user = new sqlClass();
            $status = $user->addUser($login, $pass, $email);
            return $status;
        }
    }

    public function signIn($login, $pass)
    {
        $sign = new sqlClass();
        $dataUser = $sign->checkUser($login, $pass);
        if($dataUser['id'] == false)
        {
            echo 'неверный логин/пароль';
        }
        else
        {
            $_SESSION['id'] = $dataUser['id'];
            $_SESSION['login'] = $dataUser['login'];


        }
    }

    public static function getListProjects($login)
    {
        $list = sqlClass::getListProject($login);
        return $list;
    }

    public static function addProject($login, $project, $counter)
    {
        if(sqlClass::addProject($login, $project, $counter))
            return true;
        else
            return false;
    }
    public static function deleteProject($login, $counter)
    {
        if(sqlClass::deleteProject($login, $counter))
            return true;
        else
            return false;
    }
}

?>