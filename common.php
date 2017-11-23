<?php

session_start();

require 'config.php';
require 'classes/DBconnect.php';
require 'classes/User.php';
require 'classes/Post.php';

$connect = new DBconnect();
$connect->connect($db_type, $db_host, $db_user, $db_pass, $db_name);