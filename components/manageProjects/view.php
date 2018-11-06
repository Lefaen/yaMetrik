<form action="" method="post">
    <input type="text" name="project"/>
    <input type="text" name="counter"/>
    <input type="submit" value="Добавить проект"/>
</form>

<? if (isset($data['statusAddProject'])): ?>
    <p>
        <?= $data['statusAddProject']; ?>
    </p>
<? endif; ?>

<? if (isset($data['listProjects'])): ?>
    <ul class="listProjects">
        <li>
            <div>Название проекта</div>
            <div>Номер счетчика</div>
            <div>Удалить проект</div>
        </li>
        <? foreach ($data['listProjects'] as $item): ?>

            <li>
                <div><?= $item['projectName']; ?></div>
                <div><?= $item['counter']; ?></div>
                <div><a href="?deleteProject=<?=$item['counter']?>">Удалить</a></div>
            </li>


        <? endforeach; ?>
    </ul>
<? endif; ?>
