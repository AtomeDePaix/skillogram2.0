<?php
class User {
    private $login, $password, $salt, $username;
    
    public function __construct($login, $password, $username) {
        $this->login = $login;
        $this->password = $password;
        $this->username = $username;
    }
    
    public function addUser() {
        $login = $this->login;
        $salt = mt_rand(1,100);
        $password = md5($this->password . $salt);
        $stmt = DBconnect::$db->prepare("SELECT id FROM user_auth WHERE login =?");
        $stmt ->execute([$login]);
        $user_exist = $stmt->fetch();
        if (!empty($user_exist['id'])) {
            $_SESSION['message'] = 'Извините, введённый вами логин уже зарегистрирован. Введите другой логин.';
            header('Location: index.php?act=sign_up');
            exit;
        } else {
    //вносим данные нового пользователя
        $stmt = DBconnect::$db->prepare("INSERT INTO user SET username =?");
        $stmt->execute([$username]);
        $stmt = DBconnect::$db->prepare("INSERT INTO user_auth SET login =?, password =?, salt =?");
        $stmt->execute([$login, $password, $salt]);
        }
        $_SESSION['message'] = "Пользователь $username успешно зарегистрирован";
    }
    
    public function logIn () {
        $login = $this->login;
        $password = md5($this->password . $salt);
        $stmt = DBconnect::$db->prepare("SELECT id FROM user_auth WHERE login =?");
        $stmt ->execute([$login]);
        $result = $stmt->fetch();
        if (!empty($result)) {
            if (md5($password . $result['salt']) == $result['password']) {
              $_SESSION['last_ip']=$_SERVER['REMOTE_ADDR'];
              setcookie ('last_login', $_REQUEST["login"], time()+86400,'/');
              $stmt = $dbh->prepare("SELECT * FROM user, user_auth WHERE user.user_id = user_auth.id");
              $stmt ->execute();
              $result2 = $stmt->fetch();
              $_SESSION['username'] = $result2['name'];
              } else {
               $_SESSION['message']['badinput'] = 'Неверный логин или пароль';
              }
        }
    }
}
