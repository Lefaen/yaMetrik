<?php

require_once '/interfaces/iUser.php';

class user implements iUser
{
    private $login;
    private $pass;
    private $email;

    public function __construct($login, $pass, $email)
    {
        $this->setLogin($login);
        $this->setPass($pass);
        $this->setEmail($email);
        $this->register();
    }

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


    public function register()
    {
        if(!empty($this->getLogin()) && !empty($this->getPass()) && !empty($this->getEmail()))
        {
            $user = new sqlClass();
            $user->addUser($this->getLogin(), $this->getPass(), $this->getEmail());
            $user = null;
        }

    }

    public  function autorisation($login, $pass)
    {
        //check field login & pass in db
    }
}

?>