<html>
    <head>
          <title>Вход</title>
    </head>
    <body>
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
<?php
if (!empty ($_SESSION['message'])):
  foreach ($_SESSION['message'] as $message):
     echo $message;
   endforeach;
unset ($_SESSION['message']);
endif;
   
if (isset($_POST['login'])) { 
  $login = $_POST['login']; 
  if ($login == '') { 
    unset($login);
    $_SESSION['message']['nologin'] = 'Не введен логин';
    exit;
  } 
}
if (isset($_POST['password'])) {
  $password=$_POST['password']; 
  if ($password =='') {
    unset($password);
    $_SESSION['message']['nopassword'] = 'Не введен пароль';
    exit;
  } 
}
//проверяем внесены ли пользователем данные в форму
//if (empty($login) or empty($password)) {
  //exit ("Заполнены не все поля, необходимые для авторизации");
//}
//проверям наличие логина в базе данных
$stmt = $dbh->prepare("SELECT * FROM user_auth WHERE login =?");
$stmt ->execute([$login]);
$result = $stmt->fetch();
if (!empty($result)) {
  if (md5($password . $result['salt']) == $result['password']) {
    $_SESSION['last_ip']=$_SERVER['REMOTE_ADDR'];
    setcookie ('last_login', $_REQUEST["login"], time()+86400,'/');
    $stmt = $dbh->prepare("SELECT * FROM user_data, user_auth WHERE user_data.user_id = user_auth.id");
    $stmt ->execute();
    $result2 = $stmt->fetch();
    $_SESSION['user_name'] = $result2['author_name'];
  }
} else {
  $_SESSION['message']['badinput'] = 'Неверный логин или пароль';
}
?>