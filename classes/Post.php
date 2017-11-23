<?php
class Post {
        
    public function addPost($photo, $comment) {
        $user_id = $_SESSION['recent_user'];
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
                $_SESSION['message'][] = "Недопустимое расширение фото.";
            }
            $photo_path = 'images/photos/photo' . date('Y-m-dH:i:s') . mt_rand(1, 1000) . "." . $extension;
            move_uploaded_file($photo['tmp_name'], $photo_path);
        }  
        
        $stmt = DBconnect::$db->prepare("INSERT INTO post SET user_id = ?, added_at = ?, photo = ?, comment = ?, like_sum = ?");
        $stmt->execute([$user_id, $added_at, $photo_path, $comment, $like_sum]);
    }
    
    public function getPosts() {
        $stmt = DBconnect::$db->prepare("SELECT * FROM post INNER JOIN user ON user.user_id = post.user_id");
        $stmt->execute();
        return $stmt;
        
    }
}
