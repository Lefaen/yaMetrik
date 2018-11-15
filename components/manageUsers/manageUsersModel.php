<?php

class manageUsersModel extends modelBase
{
    private $data;
    public function getData()
    {
        $this->data['users'] = sqlClass::getTable('users', array('login', 'email', 'group'));

        return $this->data;
    }


}

?>