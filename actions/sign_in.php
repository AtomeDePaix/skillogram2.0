<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            $_SESSION['message'] = 'Не введен логин или пароль';
            header('Location: index.php?act=sign_ip');
            exit;
        } else {
            $user = new User($_POST['login'],$_POST['password']);
            $user->logIn();
        }
    }
?>

<h2 align="center">Вход</h2>
<div class="form">
    <form action="" method="post">
     <p>
       <label>Ваш логин:<br></label>
       <input name="login" type="text" size="16" maxlength="16">
     </p>
     <p>
       <label>Ваш пароль:<br></label>
       <input name="password" type="password" size="16" maxlength="16">
    </p>
    <p>
       <input type="submit" name="submit" value="Войти">
    </p>
    </form>
</div>