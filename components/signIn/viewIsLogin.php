<? // var_dump($data);?>
<div class="userPanel">
    <ul>
        <li><span>Вы зашли как: <b><?= $_SESSION['login']; ?></b></span></li>
        <li><a href="/manage">Управление проектами</a></li>
        <li><a href="">Изменить пароль</a></li>
        <li><a href="?action=logout">Выйти</a></li>
    </ul>

</div>

