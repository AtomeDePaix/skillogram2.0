<?php

class Post {

    private $data;

    private function __construct($data = []) {
        $this->data = $data;
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

    public function getPosts() {
        $connection = DBconnect::getInstance();
        $db = $connection->getConnection();
        $stmt = $db->prepare(""
                . "SELECT *, post.id "
                . "AS post_id FROM post "
                . "INNER JOIN user "
                . "ON user.user_id = post.user_id "
                . "ORDER BY post.id DESC");
        $stmt->execute();
        return $stmt;
    }
    
    public function searchPosts() {
        if (!empty($_REQUEST ['search'])) {
            $where = 'WHERE post.comment LIKE ? OR user.name LIKE ?';
            $search = '%' . $_REQUEST['search'] . '%';
            $bind = [$search, $search];
        } else {
            $where = '';
            $bind = [];
        }
        $connection = DBconnect::getInstance();
        $db = $connection->getConnection();
        $query = $db->prepare(""
               . "SELECT *"
               . "FROM post"
               . "JOIN user ON post.user_id = user.user_id"
               . "{$where}"
               . "ORDER BY id DESC"
               . "LIMIT 0,20");
        $query->execute($bind);
        return $query;

        if ($query->rowCount() == 0) {
            echo ('Извините, ничего не нашлось...');
        }
    }
}
