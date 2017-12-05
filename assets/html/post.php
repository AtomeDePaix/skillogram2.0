<div class="content">
      <div class="post" data-post_id="<?=$post_id;?>">
          <div class="avatar" >
              <img src="<?php echo $avatar;?>" width="40" height="40">
          </div>
          <div class="author">
              <?php echo $username;?>
          </div>
          <div class="date">
              <?php echo $added_at;?>
          </div>
          <div class="post-photo">
              <img src="<?php echo $photo;?>" width="400" height="250">
          </div>
          <div class="like"></div>
          <div class="like_sum">
              <?php echo $like_sum;?>
          </div>
          <div class="post-text">
              <?php echo $comment;?>                  
          </div>
      </div>
 </div> 