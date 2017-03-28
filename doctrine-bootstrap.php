<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once 'vendor/autoload.php';

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array("src/main/php/entity"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => 'db.sqlite',
);

$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'test',
    'password' => 'test',
    'dbname' => 'test',
);

// obtaining the entity manager
$entityManager = EntityManager::create($dbParams, $config);