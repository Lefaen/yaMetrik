<?php

interface iSql
{
    public static function start();
    public static function getTable($table, array $fields);
    public static function getString(array $searchFields, $table);
    public static function setString(array $setFields, $table);
    public static function deleteString(array $searchFields, $table);
    public static function updateString(array $setFields, $table,$id);
}
interface iSqlUser
{
    public static function addUser($login, $pass, $email);
    public static function checkUser($login, $pass);
}

?>