<?php

$url = getenv('DATABASE_URL');

if ($url !== false) {
    $matches = parse_url($url);
    $host = $matches['host'];
    $port = $matches['port'];
    $dbname = substr($matches['path'], 1);
    $username = $matches['user'];
    $password = $matches['pass'];

    return [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host=$host;port=$port;dbname=$dbname",
        'username' => $username,
        'password' => $password,
        'charset' => 'utf8',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=misterfut',
    'username' => 'misterfut',
    'password' => 'misterfut',
    'charset' => 'utf8',
];
