<?php

class User {

    public $login, $password, $salt, $username, $avatar, $user_id;

    private function __construct($user_id) {
        $this->user_id = $user_id;
        
        $stmt = DBconnect::$db->prepare("SELECT * FROM user INNER JOIN user_auth ON user.user_id = user_auth.id WHERE user.user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        
        $this->login = $user['login'];
        $this->password = $user['password'];
        $this->salt = $user['salt'];
        $this->username = $user['username'];
        $this->avatar = $user['avatar'];
    }

    public function addUser($login, $password, $username, $avatar) {
        $salt = mt_rand(1, 100);
        $password = md5($password . $salt);
//вносим данные в user_auth
        try {
            $stmt = DBconnect::$db->prepare("INSERT INTO user_auth SET login =?, password =?, salt =?");
            $stmt->execute([$login, $password, $salt]);
        } catch (Exception $e) {
            $_SESSION['message'][] = 'Error: ' . $e->getMessage();
            header('Location: index.php?act=sign_up');
            exit;
        }
        $_SESSION['message'][] = "Пользователь $login успешно зарегистрирован";
        $new_user_id = DBconnect::$db->lastInsertId();
//сохраняем аватар        
        if (!file_exists('images/avatars')) {
            mkdir('images/avatars', 0777, true);
        } else if ($avatar && file_exists($avatar['tmp_name'])) {
            $filename = $avatar['name'];
            $tmp = explode('.', $filename);
            $extension = end($tmp);
            $allowed_extension = ['jpg', 'png', 'jpeg', 'bmp'];
            if (!in_array($extension, $allowed_extension)) {
                $avatar_path = '';
                $_SESSION['message'][] = "Недопустимое расширение аватара.";
            }
            $avatar_path = 'images/avatars/avatar' . $new_user_id . "." . $extension;
            move_uploaded_file($avatar['tmp_name'], $avatar_path);
        }  
        $stmt = DBconnect::$db->prepare("INSERT INTO user SET user_id = ?, username = ?, avatar = ?");
        $stmt->execute([$new_user_id, $username, $avatar_path]);  
        $_SESSION['message'][] = "Пользователь $login ($username) успешно зарегистрирован";
    }

    public function logIn($login, $password) {
        $stmt = DBconnect::$db->prepare("SELECT * FROM user INNER JOIN user_auth ON user.user_id = user_auth.id WHERE user_auth.login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();
        if (!empty($user)) {
            if (md5($password . $user['salt']) == $user['password']) {
                //setcookie('recent_user', $login, time() + 86400, '/');
                $_SESSION['recent_user'] = $user['user_id'];
                $_SESSION['message'][] = "Приветствую, " . $user['username'] . " !";
            } else {
                $_SESSION['message'][] = "Неправильная пара логин/пароль.";
            }
        }
    }

}
