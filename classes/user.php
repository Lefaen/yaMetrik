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
        if (!empty($login) && !empty($pass) && !empty($email)) {
            $status = sqlClass::addUser($login, $pass, $email);
            sqlClass::createTableProjects($login);
            return $status;
        }
    }

    public function signIn($login, $pass)
    {
        $dataUser = sqlClass::checkUser($login, $pass);
        if ($dataUser['id'] == false) {
            echo 'неверный логин/пароль';
        } else {
            $_SESSION['id'] = $dataUser['id'];
            $_SESSION['login'] = $dataUser['login'];


        }
    }

    public static function changePass($id, $pass)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $setFields = array('pass' => $hash);
        sqlClass::updateString($setFields, 'users', $id);
    }

    public static function sendEmailPass($login)
    {
        $dataUser = sqlClass::getString(array('login' => $login), 'users');

        if ($login == $dataUser['login']) {
            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
            $max = 6;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--)
                $password .= $chars[rand(0, $size)];
            self::changePass($dataUser['id'], $password);
            if (mail($dataUser['email'], "Уважаемый $login", "ваш новый пароль: $password")) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function getListProjects($login)
    {
        $dataUser = sqlClass::getString(array('login' => $login), 'users');
        $list = sqlClass::getListProject($login, $dataUser['group']);
        return $list;
    }

    public static function addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client)
    {
        if (sqlClass::addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client))
            return true;
        else
            return false;
    }

    public
    static function deleteProject($login, $counter)
    {
        if (sqlClass::deleteProject($login, $counter))
            return true;
        else
            return false;
    }
}

?>