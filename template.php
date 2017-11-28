<!DOCTYPE html>
<html>
    <head>
        <title>SkilloGram</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />
        <meta http-equiv="X-UA-Compatible" content="IE=10" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </head>
    <body>
        <div>
            <?php
            $helper = Helper::getInstance();
            $message =  $helper->getMessage();
            echo $message;
            ?>
         </div>
        <header>
            <!--<a href="index.php"><div id="logo"></div></a>-->
            <div class="menu-container">
                <ul class="menu">
                    <li><a href="index.php?act=home">Главная</a></li>
                    <li><a href="index.php?act=sign_in">Вход</a></li>
                    <li><a href="index.php?act=sign_up">Регистрация</a></li>
                    <li><a href="index.php?act=post">Лента</a></li>
                    <li><a href="index.php?act=add">Добавить запись</a></li>
                    <li><a href="index.php?act=about">О проекте</a></li>
                </ul>
            </div>
            <div class="search-form-container">
                <form action="" method="post">
                    <input type="text" placeholder="Поиск..." name="search" value="">
                    <input type="submit" value="OK">
                </form>
            </div>
        </header>
        <hr/>
        <?= $content; ?>
        <hr/>
        <div class="footer">
            <?php
            $counter_file = 'counter.txt';
            if (file_exists($counter_file)) {
                $counter = file_get_contents($counter_file);
            } else {
                $counter = 0;
            }
            $counter++;

            file_put_contents($counter_file, $counter);
            
            echo $counter;
            ?>
            <br/>
            &copy <?=date('Y');?>
        </div>
    </body>
</html>