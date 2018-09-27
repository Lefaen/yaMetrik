<?php
$statusOfSave = array('SUCCESS' => 'Сохранено',
    'ERROR' => 'Ошибка сохранения');

?>

<?php
if($status != null)
{
    if($status == true)
    {
        echo '<p>'.$nameList.': '.$statusOfSave['SUCCESS'].'</p>';
    }
    else
    {
        echo '<p>'.$nameList.': '.$statusOfSave['ERROR'].'</p>';
    }
}
else
{
    echo 'unknown error: status is null';
}