<?php

interface iSql
{
    public function connectSql($login, $pass, $host);
    public  function checkDataTable();
    public function createDataTable();
    public function createString($table, $string);
    public function deleteString($table, $string);
    public function updateString($table, $string);
}

?>