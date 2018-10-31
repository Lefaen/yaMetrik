<?php

class signUpModel extends modelBase
{
    private $data;
    public function getData()
    {
        if(!empty($_POST) && isset($_POST['signUp']))
        {
            $this->data = $_POST;
        }
        return $this->data;
    }


}

?>