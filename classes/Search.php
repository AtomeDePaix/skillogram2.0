<?php

class Search {
    
    private $search;

    private function __construct() {
        
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
    }
    
    public function getSearchPosts() {
        

        

//        if ($query->rowCount() == 0) {
//            echo ('Извините, ничего не нашлось...');
//        }
    }

    public function setSearchPosts () {


    }
}
