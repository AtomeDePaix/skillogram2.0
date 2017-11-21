<!DOCTYPE html>
<html>
    <head> 
          <title>SkilloGram</title>
          <meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />
          <meta http-equiv="X-UA-Compatible" content="IE=10" />
          <link rel="stylesheet" type="text/css" href="style.css">
    </head>
        <body>
          <div class="content">
            <?php while ($post = $query->fetch ()): ?>
                <div class="post">
                    <div class="avatar" >
                        <img src="images/ava.jpg" width="40" height="40">
                    </div>
                    <div class="author">
                        <?php echo ($post['name']); ?>
                    </div>
                    <div class="date">
                        <?php echo ($post['added_at']); ?>
                    </div>
                    <div class="post-photo">
                        <img src=<?php echo ($post['photo']); ?> width="400" height="250">
                    </div>
                    <div class="like">
                        <img src="images/heart.jpg" width="25" height="25">
                    </div>
                    <div class="like_sum">
                        <?php echo ($post['like_sum']); ?>
                    </div>
                    <div class="post-text">
                        <?php echo ($post['comment']); ?>                  
                    </div>
                </div>
            <?php endwhile; ?>
          </div> 
        </body>
</html>
<?php
if (!empty ($_REQUEST ['search'])) {
    $where = 'WHERE post.comment LIKE ? OR user.name LIKE ?';
    $search = '%' . $_REQUEST['search'] . '%';
    $bind = [$search, $search];
} else {
    $where = '';
    $bind = [];
}

$query = $dbh->prepare("
    SELECT *
    FROM post
    JOIN user ON post.user_id = user.user_id
    {$where}
    ORDER BY id DESC
    LIMIT 0,20
");

$query->execute($bind);if (!empty ($_REQUEST ['search'])) {
    $where = 'WHERE post.comment LIKE ? OR user.name LIKE ?';
    $search = '%' . $_REQUEST['search'] . '%';
    $bind = [$search, $search];
} else {
    $where = '';
    $bind = [];
}

$query = $dbh->prepare("
    SELECT *
    FROM post
    JOIN user ON post.user_id = user.user_id
    {$where}
    ORDER BY id DESC
    LIMIT 0,20
");

$query->execute($bind);
?>
<div class="pardon">
    <?php
    if ($query->rowCount () == 0) {
        echo ('Извините, ничего не нашлось...');
    }
    ?>
</div>
