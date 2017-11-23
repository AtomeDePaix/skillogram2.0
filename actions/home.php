<?php
    $stmt = Post::getPosts();
?>
<div class="content">
    <?php while ($post = $stmt->fetch()): ?>
        <div class="post">
            <div class="avatar" >
                <img src=<?php echo ($post['avatar']); ?> width="40" height="40">
            </div>
            <div class="author">
                <?php echo ($post['username']); ?>
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




