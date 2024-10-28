<?php

return [
    'host' => 'database',
    'dbname' => 'videoteka-old',
    'user' => 'algebra',
    'password' => 'algebra',
    'charset' => 'utf8mb4',
    'port' => 3306,
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],
];