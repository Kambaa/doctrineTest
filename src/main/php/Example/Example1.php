<?php
namespace DoctrineTest\Example;

/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 3:54 PM
 */
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Class Example1
 * In this example, We're gonna create an EntityManager, doctrine's general ORM
 * operations access pointer.
 */
class Example1
{
    private $entityManager;

    public static $BASEDIR;

    public function __construct($host, $username, $password, $dbName)
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(self::$BASEDIR . "src/main/php/entity"), $isDevMode);

        // database configuration parameters for an sqlite db connection
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => self::$BASEDIR . 'db.sqlite',
        );

        // database configuration parameters for an mysql db connection. we're gonna use this one.
        $dbParams = array(
            'driver' => 'pdo_mysql',
            'host' => $host,
            'user' => $username,
            'password' => $password,
            'dbname' => $dbName,
        );

        // obtaining the entity manager
        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    public static function run()
    {
        // this variable defines the root of the project folder which we're gonna use it for annotation metadata
        // class location and sqlite db file location(if we're gonna use it).
        self::$BASEDIR = dirname(__DIR__, 4) . '/';
        echo self::class . ' started to run' . PHP_EOL;

        require_once self::$BASEDIR . 'vendor/autoload.php';
        new Example1("localhost", "test", "test", "test");

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, this means that ' .
            'a Doctrine EntityManager is created successfully.';
        exit();
    }
}

Example1::run();
