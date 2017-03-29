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
 * Simple DQL custom select query with non-entity values (scalar result values) example
 * @package DoctrineTest\Example
 */
class Example8
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // In case of using scalar resulted values (like SUM,AVG,COUNT etc...) of the DQL, we can use
        // getScalarResult metod of the Query class to get these values.

        $dql = "SELECT u.id, u.name, count(u.id) as totalCount FROM " . User::class . " u ORDER BY u.id DESC";

        $query = $entityManager->createQuery($dql);

        $query->setMaxResults(30);

        // Gets the query result with scalar resulted values in it, in an array.
        $userListWithScalaerResultValues = $query->getScalarResult();

        echo '[SCALAR RESULTED DQL RESULT]: ' . print_r($userListWithScalaerResultValues, 1) . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example8();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok . ';
        exit();
    }
}

Example8::run();

