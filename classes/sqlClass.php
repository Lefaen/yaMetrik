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
            $dsn = 'mysql:host='.self::$host.';dbname='.self::$db.';charset='.self::$charset;
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
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
                `pass` varchar(16) NOT NULL,
                `email` varchar(50) NOT NULL,
                PRIMARY KEY (`id`)
                )";
            $res = $pdo->query($query);
            $pdo = null;



            return $res;
        }

        public function addUser($login,$pass,$email)
        {

            //var_dump('add user '.$login.' Success');
            $check = $this->checkString($login, 'users');
            if($check == true)
            {
                echo 'this user is already registered';
            }
            else
            {
                echo 'add user Success';//register
                $dataConnections = self::dataConnections();
                $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
                $allowed = array("login","pass","email"); // allowed fields
                $query = "INSERT INTO `users` SET `login`=:login, `pass`=:pass, `email`=:email";
                $res = $pdo->prepare($query);
                $res->execute(
                    array(
                        'login' => $login,
                        'pass' => $pass,
                        'email' => $email
                        ));
            }
        }
        private function checkString($field, $table)
        {
            $dataConnections = self::dataConnections();
            $pdo = new PDO($dataConnections['dsn'], self::$login, self::$pass, $dataConnections['opt']);
            $res = $pdo->prepare("SELECT pass FROM `$table` WHERE login = ?");
            $res->execute(array($field));
            $res = $res->fetch();
            $pdo = null;
            if(empty($res))
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        public function deleteString($table, $string)
        {

        }
        public function updateString($table, $string)
        {

        }
    }

?>