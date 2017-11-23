<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        Post::addPost($_FILES['photo'], $_POST['comment']);
    }
?>
<div class="form">
   <form enctype="multipart/form-data" action="index.php" method="post">
      <label for="photo"/>Добавить фото:</label>
      <input type="file" name="photo" />
      <label for="comment"/>Комментарий: </label>
      <input type="text" name="comment" maxlength="300"/><br/>
      <input type="hidden" name="act" value="add">
      <input type="submit" value="Опубликовать" />
   </form>
</div>