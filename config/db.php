<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.env('DB_HOST', 'localhost').';dbname='.env('DB_NAME', 'webblog'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', 'root'),
    'charset' => 'utf8',
    'tablePrefix' => env('DB_PREFIX', '')
];
