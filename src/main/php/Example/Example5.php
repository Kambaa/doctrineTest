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
 * Class Example5
 * Fetching an entity from db and updating it.
 * @package DoctrineTest\Example
 */
class Example5
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        $id2Fetch = 11;
        $newName = "YG";

        // Get the user from db and set it to a entity variable
        $userForUpdate = $entityManager->find(User::class, $id2Fetch);

        if (!$userForUpdate) {
            exit("[ERROR] user with id of $id2Fetch now found in db!");
        }

        // display before
        echo "[BEFORE] " . (string)$userForUpdate . PHP_EOL;

        // setting new name to entity
        $userForUpdate->setName($newName);

        // flushing the entity manager to save changes to db.
        $entityManager->flush();

        // display after
        echo "[AFTER] " . (string)$userForUpdate . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example5();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example5::run();

