<?php

sleep(3); //блокировка кнопки

echo json_encode([
    'status' => 'success',
    'count' => mt_rand(1,100),
]);

die();

