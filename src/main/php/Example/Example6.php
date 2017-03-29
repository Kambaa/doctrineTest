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
 * Class ExampleTemplate
 * Doctrine Query Language(DQL) select example
 * @package DoctrineTest\Example
 */
class Example6
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // DQL is a lot like HQL(Hibernate Query Language)
        // Let's write an simple example that fetches users by sorting them by descending id's.

        // Be careful to import the entity class (use statement).
        $dql = "SELECT u FROM " . User::class . " u ORDER BY u.id DESC";

        // Created queries run with the createQuery method. Result is a Doctrine Query object.
        $query = $entityManager->createQuery($dql);

        // To get the result as an array of entities, we use getResult method of the Query object.
        $userListAsEntityArray = $query->getResult();
        echo "[ENTITY RESULT ARRAY]: " . var_export($userListAsEntityArray, 1) . PHP_EOL;

        // To get the result as arrays, we use getArrayResult method of the Query object.
        $userListAsArray = $query->getArrayResult();
        echo "[RESULT ARRAY]: " . var_export($userListAsArray, 1) . PHP_EOL;

    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example6();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example6::run();

