<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        Post::getSearch($_POST('search'));
    }

Post::getAllPosts();
?>

<!--<div class="search-form">
    <form action="" method="post">
        <input type="text" placeholder="Поиск..." name="search" value="<?=@$_POST['search'];?>">
        <input type="hidden" name="act" value="home">
        <input type="submit" value="OK">
    </form>
</div>-->