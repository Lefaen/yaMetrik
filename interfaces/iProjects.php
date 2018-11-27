<?
interface iProjects
{
    public function getListProjects($user);
    public function addProject($login, $project, $counter, $headProject, $headDepartment, $specialist, $client);
    public function deleteProject($login, $counter);
}
?>