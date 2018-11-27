<?php

class forgotPassModel extends modelBase
{
    private $data;
    public function getData()
    {
        if(isset($_POST['login'])) {
            $user = project::$userHref;
            if($user->sendEmailPass($_POST['login']) != false)
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