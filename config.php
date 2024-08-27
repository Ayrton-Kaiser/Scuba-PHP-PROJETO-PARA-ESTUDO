<?php
define('SLASH',DIRECTORY_SEPARATOR);
define('VIEW_FOLDER',__DIR__.SLASH.'view'.SLASH);
define('DATA_LOCATION',__DIR__.SLASH.'data'.SLASH.'users.json');
define('EMAIL_ADDRESS', 'email@gmail.com');
define('EMAIL_PASSWORD','password');
define('APP_URL','http://localhost:4242');
define('SECRET_IV', pack('a16', 'senha'));
define('SECRET', pack('a16', 'senha'));