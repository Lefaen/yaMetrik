<?php

require_once '/interfaces/iUser.php';

class user implements iUser
{
    private $login;
    private $pass;

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function register($login, $pass)
    {
        //createStringDB
    }

    public  function autorisation($login, $pass)
    {
        //check field login & pass in db
    }
}

?>