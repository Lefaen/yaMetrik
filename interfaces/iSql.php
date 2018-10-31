<?php

interface iSql
{
    public static function start();
    public function addUser($login, $pass, $email);

    public function deleteString($table, $string);
    public function updateString($table, $string);
}

?>