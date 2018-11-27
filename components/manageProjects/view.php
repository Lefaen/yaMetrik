<form class="manageProject" action="" method="post">
    <div>
        <label>Проект:</label>
        <label>Счетчик:</label>
        <label>Руководитель проекта:</label>
        <label>Руководитель отдела:</label>
        <label>Ведущий специалист проекта:</label>
        <label>Обращение к клиенту:</label>
    </div>
    <div>
        <input type="text" name="project"/>
        <input type="text" name="counter"/>
        <input type="text" name="headProject"/>
        <input type="text" name="headDepartment"/>
        <input type="text" name="specialist"/>
        <input type="text" name="client"/>
    </div>

    <input type="submit" value="Добавить проект"/>
</form>

<? if (isset($data['statusAddProject'])): ?>
    <p>
        <?= $data['statusAddProject']; ?>
    </p>
<? endif; ?>

<? if (isset($data['listProjects'])): ?>
    <ul class="listProjects">
<?foreach ($data['listProjects'] as $userList):?>
        <? foreach ($userList as $item): ?>
            <li>
                <div><span>Название проекта:</span><b><?=$item['projectName'];?></b></div>
                <div><span>Номер счетчика:</span><b><?=$item['counter'];?></b></div>
                <div><span>Руководитель проекта:</span><b><?=$item['headProject'];?></b></div>
                <div><span>Руководитель отдела:</span><b><?=$item['headDepartment'];?></b></div>
                <div><span>Ведущий специалист проекта:</span><b><?=$item['specialist'];?></b></div>
                <div><span>Обращение к клиенту:</span><b><?=$item['client'];?></b></div>
                <div><a href="?deleteProject=<?=$item['counter'];?>">Удалить</a></b></div>
            </li>
        <? endforeach; ?>
<?endforeach;?>
    </ul>
<? endif; ?>
