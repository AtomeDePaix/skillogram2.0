<?php

require 'common.php';

$content = '';

$act = !empty($_REQUEST['act']) ? $_REQUEST['act'] : 'home';

$filename = './actions/' . basename($act) . '.php';
if (!file_exists($filename)) {
    $filename = 'actions/404.php';
}

try {
    ob_start();
    require $filename;
    $content = ob_get_clean();
} catch (Exception $e) {
    $content = $e->getMessage();
}

require 'template.php';
