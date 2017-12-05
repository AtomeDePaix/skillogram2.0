<?php

class Post {

    private static $post;
    private static $condition;
    private $data;
    private $data_adv;
    
    /**
    * @param int $post_id
    * @return \self
    */

    private function __construct($data = []) {
        $this->data = $data;
    }
    
    public static function getById($post_id) {
        if (!empty($post_id)) {
            self::$condition['value'][] = $post_id;
            self::$condition['sql'][] = 'post.id = ?';
        }
        self::setPost();
        self::getPost();
    }
    
    public static function getByUser($username) {
        if (!empty($username)) {
            self::$condition['value'][] = $username;
            self::$condition['sql'][] = 'user.username = ?';
        }
        self::setPost();
        self::getPost();
    }
    
    public static function getAllPosts() {
        self::setPost();
        self::getPost();
    }
    
    private static function setPost() {
        $db = self::getConnect();
        $where = self::getWhere();
        $bind = self::getBind();
        $posts = $db->prepare(""
                . "SELECT *, post.id "
                . "FROM post INNER JOIN user "
                . "ON user.user_id = post.user_id "
                . "{$where}"
                . "ORDER BY post.id DESC "
                . "LIMIT 0,20 ");
        $posts->execute($bind);
        
        while ($post = $posts->fetch(PDO::FETCH_ASSOC)) {
            self::$post[] = new self($post);
        }
    }
    
    private static function getPost() {
        $posts = self::$post;
        foreach ($posts as $post) {
            $post_id = $post->getPostId();
            $avatar = $post->getAvatar();
            $username = $post->getUserName();
            $added_at = $post->getAddedAt();
            $photo = $post->getPhoto();
            $like_sum = $post->getLikeSum();
            $comment = $post->getComment();
            require 'assets/html/post.php';
        }
    }

    private static function getConnect() {
        $connection = DBconnect::getInstance();
        $db = $connection->getConnection();
        return $db;
    }

    public static function getSearch($search) {
        if (!empty($search)) {
            self::$condition['value'][] = '%' . $search . '%';
            self::$condition['sql'][] = 'post.username LIKE ?';
            self::$condition['value'][] = '%' . $search . '%';
            self::$condition['sql'][] = 'post.comment LIKE ?';
        }
    }
    
    private static function getWhere() {
        if (self::$condition['sql']) {
            $result = 'WHERE ' . implode(', ', self::$condition['sql']);
        } else {
            $result = '';
        }
        return $result;
    }
    
    private static function getBind() {
        if (self::$condition['value']) {
            $result = self::$condition['value'];
        } else {
           $result = []; 
        }
        return $result;
    }

    private function getPostId() {
        return $this->data['id'];
    }
    
    private function getAvatar() {
        return $this->data['avatar'];
    }
    
    private function getUserName() {
        return $this->data['username'];
    }
    
    private function getAddedAt() {
        return $this->data['added_at'];
    }
    
    private function getPhoto() {
        return $this->data['photo'];
    }

    private function getLikeSum() {
        return $this->data['like_sum'];
    }
    
    public function getComment() {
        return $this->data['comment'];
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
    
//    public function getPost() {
//        
//        foreach ($this->data['0'] as $post){
//            $user_id = $post['user_id'];
//            $post_id = $post['post_id'];
//            $avatar = $post['avatar'];
//            $username = $post['username'];
//            $added_at = $post['added_at'];
//            $photo = $post['photo'];
//            $like_sum = $post['like_sum'];
//            $comment = $post['comment'];
//            
//            require 'assets/html/post.php';
//            
//            if($post['post_id'] % 5 == 0) {
//               $advs = $this->getAdvertising();
//
//            }
//        }
//    }
    
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
