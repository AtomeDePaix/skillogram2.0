<?php

$stmt = Post::getPosts();

?>
<div class="content">
    <?php while ($post = $stmt->fetch()): ?>
        <div class="post" data-post-id=<?=$post['post_id'];?>>
            <div class="avatar" >
                <img src=<?=$post['avatar'];?> width="40" height="40">
            </div>
            <div class="author">
                <?=$post['username'];?>
            </div>
            <div class="date">
                <?=$post['added_at'];?>
            </div>
            <div class="post-photo">
                <img src=<?=$post['photo'];?> width="400" height="250">
            </div>
            <div class="like"></div>
            <div class="like_sum">
                <?=$post['like_sum'];?>
            </div>
            <div class="post-text">
                <?=$post['comment'];?>                  
            </div>
        </div>
    <?php endwhile; ?>
</div> 




