<?php

class reportYaMetrikaModel extends modelBase
{
    private $data;
    public function getData()
    {

        $this->data['listProjects'] = user::getListProjects($_SESSION['login']);
        return $this->data;
    }


}

?>