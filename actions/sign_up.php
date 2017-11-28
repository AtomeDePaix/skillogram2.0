<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            $helper = Helper::getInstance();
            $helper->setMessage("Не введен логин или пароль");
            header('Location: index.php?act=sign_up');
            exit;
        } else {
            User::addUser($_POST['login'], $_POST['password'], $_POST['username'], $_FILES['avatar']);
        }
    }
  
?>
<h2 align="center">Регистрация</h2>
<div class="form">
    <form enctype="multipart/form-data" action="index.php" method="post">
        <p>
            <label for="username">Ваше имя:<br></label>
            <input name="username" id="username" type="text" value="" size="24" maxlength="24">
        </p>
        <p>
            <label for="login">Ваш логин:<br></label>
            <input name="login" id="login" type="text" value="" size="16" maxlength="16">
        </p>
        <p>
            <label for="password">Ваш пароль:<br></label>
            <input name="password" id="password" type="password" size="16" maxlength="16">
        </p>
        <p>
            <label for="avatar">Аватар:<br></label>
            <input type="file" name="avatar" id="avatar"/>
        </p>
        <p>
            <input type="hidden" name="act" value="sign_up">
            <input type="submit" name="submit" value="Зарегистрироваться!">
        </p>
    </form>
</div>