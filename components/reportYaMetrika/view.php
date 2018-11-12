<? if (!isset($data['linkReport'])): ?>
    <? if (!empty($data['listProjects'])): ?>
        <form class="formReport" method="post" action="/">
            <div class="fieldReports">
                <div>
                    <label>Отчет по проекту</label>
                    <select name="id">
                        <? foreach ($data['listProjects'] as $user): ?>
                            <? foreach ($user as $elm): ?>
                                <option value="<?= $elm['id']; ?>"><?= $elm['projectName']; ?></option>
                            <? endforeach; ?>
                        <? endforeach; ?>
                    </select>
                </div>
                <div>
                    <label>Период выгрузки:<br></label>
                    <span>С</span><input name="dateStart" type="date" value="<?= $_POST['dateStart'] ?>">
                    <span>По</span><input name="dateFin" type="date" value="<?= $_POST['dateFin'] ?>">
                </div>


            </div>
            <input name="submit" type="submit"/>
        </form>
    <? else: ?>
        Добавьте проекты в разделе "управление проектами"
    <? endif; ?>
    <? // var_dump($data['statusField']);?>
<? else: ?>
    <div>
        <?= $data['statusField'] ?>
    </div>
<? endif; ?>

<? if (isset($data['linkReport'])): ?>
    <div>
        <span><a href="<?= $data['linkReport']; ?>">Скачать отчет</a> по <?= $data['project']; ?>
            за <?= $data['dateStart']; ?> - <?= $data['dateFin']; ?></span>
    </div>
<? endif; ?>