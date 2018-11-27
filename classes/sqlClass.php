<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/iSql.php';


class sqlClass implements iSql, iSqlUser
{
    private static $login = 'root';
    private static $pass = '';
    private static $host = '127.0.0.1:3306';
    private static $db = 'seoreport';
    private static $charset = 'utf8';

    /*private static $login = 'seoreport';
    private static $pass = 'TKjQSxdA';
    private static $host = 'localhost';
    private static $db = 'seoreport';
    private static $charset = 'utf8';*/


    private static function dataConnections()
    {
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=' . self::$charset;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dataConnections = array(
            'dsn' => $dsn,
            'opt' => $opt
        );
        return $dataConnections;
    }

    public static function start()//create tables
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `login` varchar(30) NOT NULL,
                `pass` varchar(255) NOT NULL,
                `email` varchar(50) NOT NULL,
                `group` varchar(1),
                PRIMARY KEY (`id`)
                )";
        $res = $pdo->query($query);


        $pdo = null;


        return $res;
    }

    public static function getTable($table, array $fields = null)
    {
        $strFields = null;
        if($fields == null)
        {
            $strFields = '*';
        }else
        {
            $i = 0;
            $count = count($fields);
            foreach ($fields as $value)
            {
                $i++;
                if($i != $count)
                    $strFields .= "$value,";
                else
                    $strFields .= "$value";
            }
        }
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "SELECT $strFields FROM `$table`";
        $res = $pdo->query($query);
        //$pdo = null;
        $res = $res->fetchAll();
        $pdo = null;
        return $res;
    }
//string functions
    public static function getString(array $searchFields, $table)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "SELECT * FROM `$table` WHERE ";
        $where = null;
        $count = count($searchFields);
        $i = 0;
        $executePdo = array();
        foreach ($searchFields as $key => $value) {
            $i++;
            if ($i != $count)
                $where .= $key . ' = :' . $key . ' AND ';
            else
                $where .= $key . ' = :' . $key;
            $executePdo[':'.$key] = $value;
        }

        $query = $query . $where;
        $res = $pdo->prepare($query);
        $res->execute($executePdo);
        $res = $res->fetch();
        $pdo = null;
        return $res;
    }
    public static function setString(array $setFields, $table)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $count = count($setFields);
        $i = 0;
        $setStr = null;
        foreach ($setFields as $key => $value) {
            $i++;
            if($i != $count)
                $setStr .= "`$key`=:$key,";
            else
                $setStr .= "`$key`=:$key";
        }

        $query = "INSERT INTO `$table` SET $setStr";
        $res = $pdo->prepare($query);
        $res->execute($setFields);
        $pdo = null;
        return $res;
    }
    public static function deleteString(array $searchFields, $table)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $count = count($searchFields);
        $i = 0;
        $setStr = null;
        foreach ($searchFields as $key => $value) {
            $i++;
            if($i != $count)
                $setStr .= "`$key`=:$key,";
            else
                $setStr .= "`$key`=:$key";
        }

        $query = "DELETE FROM `$table` WHERE $setStr";
        $res = $pdo->prepare($query);
        $res->execute($searchFields);
        $pdo = null;
    }
    public static function updateString(array $setFields, $table, $id)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $count = count($setFields);
        $i = 0;
        $setStr = null;
        foreach ($setFields as $key => $value) {
            $i++;
            if($i != $count)
                $setStr .= "`$key`=:$key,";
            else
                $setStr .= "`$key`=:$key";
        }
        $setFields['id'] = $id;
        $query = "UPDATE `$table` SET $setStr WHERE id=:id";
        $res= $pdo->prepare($query);
        $res->execute($setFields);
        return $res;
    }

//user functions
    public static function addUser($login, $pass, $email)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $check = self::getString(array('login' => $login), 'users');
        if ($check == true) {
            return false;
        } else {
            $setFields = array(
                'login' => $login,
                'pass' => $hash,
                'email' => $email
            );
            self::setString($setFields, 'users');

            return true;
        }
    }
    public static function checkUser($login, $pass)
    {
        $dataUser = self::getString(array('login' => $login), 'users');
        if(password_verify($pass, $dataUser['pass']))
        {
            return $dataUser;
        }
        {
            return false;
        }
    }

//project functions
    public static function createTableProjects($login)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "CREATE TABLE IF NOT EXISTS `$login` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `projectName` varchar(30) NOT NULL,
                `counter` varchar(20) NOT NULL,
                `headProject` varchar(20) NOT NULL,
                `headDepartment` varchar(20) NOT NULL,
                `specialist` varchar(20) NOT NULL,
                `client` varchar(30) NOT NULL,
                PRIMARY KEY (`id`)
                )";
        $pdo->query($query);
        $pdo = null;
    }

    public static function addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client)
    {
        self::createTableProjects($login);
        $dataProject = self::getString(array('counter' => (string)$counter), $login);
        if($dataProject == false)
        {
            $setFields = array(
                'projectName' => $project,
                'counter' => $counter,
                'headProject' => $headProject,
                'headDepartment' => $headDepartment,
                'specialist' => $specialist,
                'client' => $client
            );
            self::setString($setFields, $login);

            return true;
        }
        else
        {
            return false;
        }
    }
    public static function deleteProject($login, $counter)
    {
        $searchFields = array(
            'counter' => $counter
        );
        self::deleteString($searchFields, $login);
    }
    public static function getListProject($login, $group = null)
    {
        $listProjects = null;
        if($group == null)
        {
            $listProjects[] = self::getTable($login);
        }
        elseif ($group == 1)
        {
            $users = self::getTable('users', array('login'));
            $listProjects = array();
            foreach ($users as $user)
            {
                $listProjects[] = self::getTable($user['login']);
            }
        }
        return $listProjects;

    }



}

?>