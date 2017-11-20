<?php
class User {
    private $login, $password, $salt;
    
    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
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
        
        $stmt = DBconnect::$db->prepare("INSERT INTO user_auth SET login =?, password =?, salt =?");
        $stmt->execute([$login, $password, $salt]);
        }
        $_SESSION['message'] = "Пользователь $login успешно зарегистрирован";
    }
}
