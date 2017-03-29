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
 * Class Example2
 * Basic insertion
 * @package DoctrineTest\Example
 */
class Example2
{
    public static $BASEDIR;

    public function __construct()
    {
        // We get entity manager from DoctrineEntityManagerCreatorFactory class which is easier.
        // This class which is derived from the first example.
        // In the other examples, we will use this class to remove unnecessary code and make the example focused on
        // the point.
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // Generate an entity object and fill its data.
        $user = new User();
        $user->setName("Kambaa");

        // Persist the entity to the database via entity manager
        $entityManager->persist($user);

        // Flush the entity manager to affect the database with changes.
        $entityManager->flush();

        // After persisting and flushing, we can see the persisted entity has id value which is generated from database
        // and set to the entity we persisted.
        echo (string)$user . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example2();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example2::run();

