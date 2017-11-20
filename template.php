<!DOCTYPE html>
<html>
    <head>
            <title>SkilloGram</title>
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />
            <meta http-equiv="X-UA-Compatible" content="IE=10" />
            <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <!--<a href=""><div id="logo"></div></a>-->
            <div class="menu-container">
                    <ul class="menu">
                        <li><a href="index.php">Главная</a></li>
                        <li><a href="index.php?act=sign_in">Вход</a></li>
                        <li><a href="index.php?act=sign_up">Регистрация</a></li>
                        <li><a href="index.php?act=post">Лента</a></li>
                        <li><a href="index.php?act=add">Добавить запись</a></li>
                        <li><a href="index.php?act=about">О проекте</a></li>
                    </ul>
            </div>
            <div class="search-form-container">
                    <form action="" method="post">
               	        <input type="text" placeholder="Поиск..." name="search" value="<?=@$_POST['search'];?>">
                        <input type="submit" value="OK">
                    </form>
            </div>
        </header>

        <div class="footer">
        <?php 
            $counter_file = 'counter.txt';
            if(file_exists($counter_file)) {
            $counter = file_get_contents($counter_file);
            } else {
             $counter = 0;
            }
            $counter++;

            file_put_contents($counter_file, $counter);
            echo $counter;

        ?></br>
        <?php
            echo '&copy';
            echo date ('Y');
        ?>
        </div>
    </body>
</html>