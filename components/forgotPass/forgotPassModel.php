<?php

class forgotPassModel extends modelBase
{
    private $data;
    public function getData()
    {
        if(isset($_POST['login'])) {
            if(user::sendEmailPass($_POST['login']) != false)
            {
                $this->data['statusSendEmail'] = true;
            }
            else
            {
                $this->data['statusSendEmail'] = false;
            }
        }
        return $this->data;
    }
}

?>