<? if((!isset($data['statusRegister']) || ($data['statusRegister'] == false))):?>
    <? if(isset($_SESSION['id']))
        exit("<meta http-equiv='refresh' content='0; url= /'>");
    ?>
<form class="signUp" action="/signUp" method="post">
    <div>
        <label>Логин:</label>
        <label>Пароль:</label>
        <label>e-mail:</label>
    </div>
    <div>
        <input type="text" name="login">
        <input type="password" name="pass">
        <input type="text" name="email">
    </div>
    <!--<button name="signUp" value="success" type="submit">Зарегистрироваться</button>-->
    <input name="signUp" type="submit">
</form>
<? endif;?>
<? if(isset($data['statusRegister']) && $data['statusRegister'] == true):?>
    <div>
        Вы зарегестрирвались на сайте
    </div>
<? elseif(isset($data['statusRegister']) && $data['statusRegister'] == false):?>
<div>
    Пользователь с таким логином уже есть на сайте
</div>
<? endif;?>