<?php

// path definition
define('PATH', 'http://localhost/EnglishGrammar/');

// font size for question inputs
define('FONT_INPUT', 12);

// image folder for Murphy-units defenition
define('IMG_PATH', 'public/images/murphy_units/unit_');
define('IMG_PATH_EX', 'public/images/murphy_units/ex_');
// exercise pictures path
define ('EX_PIC_PATH', PATH . 'public/images/murphy_units/ex_pics/');

// moduls
require_once './core/App.php';
require_once './core/Controller.php';
require_once './core/View.php';
require_once './core/Model.php';
require_once './core/Database.php';

// database consts
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'engr');
define('DB_USER', 'root');
define('DB_PASS', '');


