<?
    interface iUser
    {
        public function register($login, $pass, $email);
        public function signIn($login, $pass);
        public function changePass($id, $pass);
        public function sendEmailPass($login);

    }
?>