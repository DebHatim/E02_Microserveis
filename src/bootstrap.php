<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/Entity'],
    isDevMode: true,
);

// configuration base de dades
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user'     => 'usr_generic',
    'password' => '2025@Thos',
    'dbname'   => 'E01_DebbounHatim_Entrada',
];

$connection = DriverManager::getConnection($dbParams, $config);
$em = new EntityManager($connection, $config);