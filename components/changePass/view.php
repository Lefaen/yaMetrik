<? if (empty($_POST)): ?>
    <div>
        <form class="changePass" action="" method="post">
            <div>
                <label>Введите старый пароль:</label>
                <label>Введите новый пароль:</label>
                <label>Повторите новый пароль:</label>
            </div>
            <div>
                <input type="password" name="oldPass"/>
                <input type="password" name="newPass"/>
                <input type="password" name="newPassRepeat"/>
            </div>
            <input type="submit"/>
        </form>
    </div>
<? elseif (!empty($_POST) && ($data['statusPassRepeat'] == true) && ($data['statusCheckUser'] == true)): ?>
    <div>Пароль успешно изменен</div>
<? endif; ?>
<? if (isset($data) && $data['statusPassRepeat'] == false): ?>
    <div>Пароли не совпадают</div>
<? endif; ?>
<? if (isset($data) && $data['statusCheckUser'] == false): ?>
    <div>Неверный старый пароль</div>
<? endif; ?>