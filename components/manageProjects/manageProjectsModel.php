<?php

class manageProjectsModel extends modelBase
{
    private $data;
    public function getData()
    {
        $user = project::$userHref;
        if(isset($_POST['project']) && isset($_POST['counter']))
        {

            if(!$user->addProject(
                $_SESSION['login'],
                $_POST['project'],
                $_POST['counter'],
                $_POST['headProject'],
                $_POST['headDepartment'],
                $_POST['specialist'],
                $_POST['client']))
            {
                $this->data['statusAddProject'] = 'Проект с таким счетчиком уже есть';
            }else
            {
                $this->data['statusAddProject'] = 'Проект успешно добавлен';
            }
        }

        $this->data['listProjects'] = $user->getListProjects($_SESSION['login']);
        return $this->data;
    }


}

?>