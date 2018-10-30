<?
    interface iUser
    {
        public function setLogin($login);
        public function setPass($pass);
        public function getLogin();
        public function getPass();
        public function register($login, $pass);
        public  function autorisation($login, $pass);
    }
?>