<?php

require_once '/interfaces/iSql.php';


class sqlClass implements iSql
{
    private static $login = 'root';
    private static $pass = '';
    private static $host = '127.0.0.1:3306';
    private static $db = 'seoreport';
    private static $charset = 'utf8';


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
                PRIMARY KEY (`id`)
                )";
        $res = $pdo->query($query);
        $pdo = null;


        return $res;
    }

    public function addUser($login, $pass, $email)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $check = self::checkString(array('login' => $login), 'users');
        if ($check == true) {
            return false;
        } else {
            //echo 'add user Success';//register
            $dataConnections = self::dataConnections();
            $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
            $allowed = array("login", "pass", "email"); // allowed fields
            $query = "INSERT INTO `users` SET `login`=:login, `pass`=:pass, `email`=:email";
            $res = $pdo->prepare($query);
            $res->execute(
                array(
                    'login' => $login,
                    'pass' => $hash,
                    'email' => $email
                ));
            $pdo = null;
            return true;
        }
    }

    private static function checkString(array $fields, $table)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "SELECT * FROM `$table` WHERE ";
        $where = null;
        $count = count($fields);
        $i = 0;
        $executePdo = array();
        foreach ($fields as $key => $value) {
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

    private function insertString($string, $table)
    {
        //update
    }

    public function checkUser($login, $pass)
    {
        $dataUser = self::checkString(array('login' => $login), 'users');
        if(password_verify($pass, $dataUser['pass']))
        {
            return $dataUser;
        }
        {
            return false;
        }
    }

    public static function createTableProjects($login)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "CREATE TABLE IF NOT EXISTS `$login` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `projectName` varchar(30) NOT NULL,
                `counter` varchar(20) NOT NULL,
                PRIMARY KEY (`id`)
                )";
        $pdo->query($query);
        $pdo = null;
    }
    public static function addProject($login, $project, $counter)
    {
        self::createTableProjects($login);
        $dataProject = self::checkString(array('counter' => (string)$counter), $login);
        if($dataProject == false)
        {
            $dataConnections = self::dataConnections();
            $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
            $allowed = array("login", "pass", "email"); // allowed fields
            $query = "INSERT INTO `$login` SET `projectName`=:projectName, `counter`=:counter";
            $res = $pdo->prepare($query);
            $res->execute(
                array(
                    'projectName' => $project,
                    'counter' => $counter
                ));
            $pdo = null;

            return true;
        }
        else
        {
            return false;
        }
    }
    public static function getListProject($login)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "SELECT * FROM `$login`";
        $res = $pdo->query($query);
        //$pdo = null;
        $res = $res->fetchAll();
        $pdo = null;
        return $res;
        //var_dump($res);


    }

    public static function deleteProject($login, $counter)
    {
        $dataConnections = self::dataConnections();
        $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
        $query = "DELETE FROM `$login` WHERE counter = :counter ";
        $res = $pdo->prepare($query);
        $res->execute(array(':counter' => $counter));
        $pdo = null;
    }

}

?>