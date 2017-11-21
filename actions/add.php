<?php
    require ('header.php');
    require ('database.php');

$date = date('H:i:s');
  function getUserName($first_name, $last_name = null) {
    return trim($first_name . ' ' . $last_name);
    }
var_dump($_FILES);
if (!file_exists('images/photos')) {
    mkdir ('images/photos', 0777, true);
}

if($_FILES['photo'] && file_exists($_FILES['photo']['tmp_name']))
  {
   $filename = $_FILES['photo']['name']; //photo003.png
   $tmp = explode('.', $filename); //['photo003', 'png']
   $extension = end($tmp);
   $allowed_extension = ['jpg', 'png', 'jpeg', 'bmp'];
     if (!in_array($extension, $allowed_extension)) {
      die('Неверный тип файла!');
     }
   $photo_path = 'images/photos/photo.' . $extension;
   move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
}

try {
    $dbh->query('INSERT INTO post SET 

        added_at = "' . date('Y-m-d H:i:s') . '",
        author_photo = "' . $photo_path . '",
        author_post = "' . $_REQUEST['post_comment'] . '",
        like_sum = "' . mt_rand(0, 1000) . '"
    ');
  } catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
  }


?>
<div class="form">
   <form action="" method="post" enctype="multipart/form-data">
      <label for="Имя"/>Имя: </label>
      <input type="text" name="first_name" placeholder="Ваше имя"/>
      <label for="Фамилия"/>Фамилия: </label>
      <input type="text" name="last_name" />
      <input type="file" name="photo" />
      <label for="Комментарий"/>Комментарий: </label>
      <input type="text" name="post_comment" maxlength="300"/><br/>
      <input type="submit" value="Опубликовать" />
   </form>
</div>

<?php
    require ('footer.php');
           /*         author_avatar = "images/ava.jpg",
           author_name = "' . getUserName($_REQUEST['first_name'],$_REQUEST['last_name']) . '", */
?>