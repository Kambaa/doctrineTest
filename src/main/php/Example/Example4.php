<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;

use DoctrineTest\entity\User;
use DoctrineTest\Util\DoctrineEntityManagerCreatorFactory;


/**
 * Class Example4
 * Selecting a single row
 * @package DoctrineTest\Example
 */
class Example4
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        $idToFetch = 11;
        $fetchedUser = $entityManager->find(User::class, $idToFetch);

        echo "Fetched from db with an id of $idToFetch: " . PHP_EOL;
        echo (string)$fetchedUser . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example4();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example4::run();

