<?php

class Post {

    private $data;
    private $data_adv;
    private static $instance;
    
    public static function getInstance(){
        if (empty(self::$instance)) {
        self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $connection = DBconnect::getInstance();
        $db = $connection->getConnection();
        $post = $db->prepare(""
                . "SELECT *, post.id "
                . "AS post_id FROM post "
                . "INNER JOIN user "
                . "ON user.user_id = post.user_id "
                . "ORDER BY post.id DESC");
        $post->execute();
        $this->data[] = $post->fetchAll();
        $post_adv = $db->prepare(""
                . "SELECT *"
                . "FROM post_adv"
                . "ORDER BY post_adv.id DESC");
        $post_adv->execute();
        $this->data_adv[] = $post_adv->fetchAll();
    }

    public function getPhoto() {
        return $this->data['photo'];
    }

    public function setPhoto($value) {
        $this->data['photo'] = $value;
        return $this;
    }

    public function getComment() {
        return $this->data['comment'];
    }

    public function setComment($value) {
        $this->data['comment'] = $value;
        return $this;
    }

    public function addPost($photo, $comment) {
        $user_id = $_SESSION['user_id'];
        $added_at = date('Y-m-d H:i:s');
        $like_sum = mt_rand(10, 1000);

        if (!file_exists('images/photos')) {
            mkdir('images/photos', 0777, true);
        } else if ($photo && file_exists($photo['tmp_name'])) {
            $filename = $photo['name'];
            $tmp = explode('.', $filename);
            $extension = end($tmp);
            $allowed_extension = ['jpg', 'png', 'jpeg', 'bmp'];
                if (!in_array($extension, $allowed_extension)) {
                $photo_path = '';
                $helper = Helper::getInstance();
                $message = $helper->setMessage("Недопустимое расширение файла");
                }
                $photo_path = 'images/photos/photo' . date('Y-m-dH:i:s') . mt_rand(1, 1000) . "." . $extension;
                move_uploaded_file($photo['tmp_name'], $photo_path);
        }
        $connection = DBconnect::getInstance();
        $db = $connection->getConnection();
        $stmt = $db->prepare(""
                . "INSERT INTO post "
                . "SET user_id = ?, added_at = ?, photo = ?, comment = ?, like_sum = ?");
        $stmt->execute([$user_id, $added_at, $photo_path, $comment, $like_sum]);
    }
    
    public function getPost() {
        
        foreach ($this->data['0'] as $post){
            $user_id = $post['user_id'];
            $post_id = $post['post_id'];
            $avatar = $post['avatar'];
            $username = $post['username'];
            $added_at = $post['added_at'];
            $photo = $post['photo'];
            $like_sum = $post['like_sum'];
            $comment = $post['comment'];
            
            require 'assets/html/post.php';
            
            if($post['post_id'] % 5 == 0) {
               $advs = $this->getAdvertising();

            }
        }
    }
    
    public function getAdvertising() {
        
        foreach ($this->data_adv['0'] as $post_adv){
            $id = $post_adv['id'];
            $avatar = $post_adv['avatar'];
            $name = $post_adv['name'];
            $adv = $post_adv['adv'];
            $photo = $post_adv['photo'];
            $price = $post_adv['price'];
            $comment = $post_adv['comment'];
            
            require 'assets/html/advertising_form.php';
        }
    }
    
    
}
