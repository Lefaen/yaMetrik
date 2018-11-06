<?php

interface iSql
{
    public static function start();
    public function addUser($login, $pass, $email);
    public function checkUser($login, $pass);
}

?>