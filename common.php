<?php

session_start();

require 'config.php.blank';
require 'classes/DBconnect.php';
require 'classes/User.php';
require 'classes/Post.php';
require 'classes/Helper.php';
//require 'classes/Search.php';

DBconnect::setDbHost($db_host);
DBconnect::setDbName($db_name);
DBconnect::setDbPass($db_pass);
DBconnect::setDbType($db_type);
DBconnect::setDbUser($db_user);