<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/iUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/iProjects.php';

class user implements iUser, iProjects
{

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
            return false;
        } else {
            $_SESSION['id'] = $dataUser['id'];
            $_SESSION['login'] = $dataUser['login'];
            $this->login = $dataUser['login'];
            $this->id = $dataUser['id'];

            return true;
        }
    }
    public function changePass($id, $pass)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $setFields = array('pass' => $hash);
        sqlClass::updateString($setFields, 'users', $id);
    }
    public function sendEmailPass($login)
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


    public function getListProjects($login)
    {
        $dataUser = sqlClass::getString(array('login' => $login), 'users');
        $list = sqlClass::getListProject($login, $dataUser['group']);
        return $list;
    }
    public function addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client)
    {
        if (sqlClass::addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client))
            return true;
        else
            return false;
    }
    public function deleteProject($login, $counter)
    {
        if (sqlClass::deleteProject($login, $counter))
            return true;
        else
            return false;
    }
}

?>