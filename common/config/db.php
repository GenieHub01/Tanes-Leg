<?php

$host = getenv('MYSQL_HOST');
$port = getenv('MYSQL_PORT');
$dbName = getenv('MYSQL_DATABASE');


return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$host};port={$port};dbname={$dbName}",

    'username' => getenv('MYSQL_USERNAME'),
    'password' => getenv('MYSQL_PASSWORD'),
    'charset' => 'utf8',
    'attributes' => [
        PDO::ATTR_PERSISTENT => true
    ],
    // Enabling Table Schema Caching (Disable SHOW CREATE TABLE) / Кеширование схем данных
//    'schemaCacheDuration' => 300,
    'enableSchemaCache' => false,
];


