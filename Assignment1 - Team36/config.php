<?php
session_start();

define('DB_PATH', __DIR__ . '/database.sqlite');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

define('APP_NAME', 'VNG Company');

define('APP_URL', '/Assignment1 - Team36/');

require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Product.php';
require_once __DIR__ . '/models/News.php';
require_once __DIR__ . '/models/Contact.php';
