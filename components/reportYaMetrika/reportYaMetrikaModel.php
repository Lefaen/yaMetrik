<?php

class reportYaMetrikaModel extends modelBase
{
    private $data;
    public function getData()
    {
        $this->data['listProjects'] = user::getListProjects($_SESSION['login']);

        $this->data['url'] = 'https://api-metrika.yandex.ru/stat/v1/data';
        $this->data['token'] = 'AQAAAAANfujIAAUHWDSXYI7X30Wpshlh3sksM7c';

        $projectReport = null;
        foreach ($this->data['listProjects'] as $project)
        {
            if($project['id'] == $_POST['id'])
            {
                $projectReport = $project;
                break;
            }
        }

        $this->data['ids'] = $projectReport['counter'];
        $this->data['project'] = $projectReport['projectName'];
        $idsProject = null;
        $this->data['dateStart'] = $_POST['dateStart'];
        $this->data['dateFin'] = $_POST['dateFin'];

        $this->data['headProject'] = $projectReport['headProject'];
        $this->data['headDepartment'] = $projectReport['headDepartment'];
        $this->data['specialist'] = $projectReport['specialist'];
        $this->data['client'] = $projectReport['client'];

        $this->data['path'] = "template.php/xl/worksheets/";
        $this->data['pathToDiagram'] = 'template.php/xl/charts/';
        $status = null;


        return $this->data;
    }


}

?>