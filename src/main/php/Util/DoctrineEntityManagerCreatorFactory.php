<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 3:55 PM
 */
namespace DoctrineTest\Util;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DoctrineEntityManagerCreatorFactory
{
    public static function getEntityManager()
    {
        $baseDir = dirname(__DIR__, 4) . '/';

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array($baseDir . "src/main/php/entity"), $isDevMode);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => $baseDir . 'db.sqlite',
        );

        $dbParams = array(
            'driver' => 'pdo_mysql',
            'host' => "localhost",
            'user' => "test",
            'password' => "test",
            'dbname' => "test",
        );

        // obtaining the entity manager
        return EntityManager::create($dbParams, $config);
    }


}