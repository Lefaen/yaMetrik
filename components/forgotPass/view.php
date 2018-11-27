<? if (!isset($data['statusSendEmail'])): ?>
    <form action="" method="post">
        <label>Введите Логин на который зарегестрирован аккаунт</label>
        <input type="text" name="login"/>
        <input type="submit"/>
    </form>
<? elseif (isset($data['statusSendEmail']) && $data['statusSendEmail'] != false): ?>
    <p>Вам на почту отправлен новый пароль</p>
<? elseif (isset($data['statusSendEmail'])): ?>
    <p>Такого аккаунта нет</p>
<? endif; ?>