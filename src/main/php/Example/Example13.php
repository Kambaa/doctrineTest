<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;

use Doctrine\ORM\Query\ResultSetMapping;
use DoctrineTest\entity\User;
use DoctrineTest\Util\DoctrineEntityManagerCreatorFactory;


/**
 * Class ExampleTemplate
 * Example class template
 * Just write your code to the constructor of the class with your comments, etc. and set run method to display it
 * on the cli or web. And lastly execute static run() method at the last line of the page.
 * @package DoctrineTest\Example
 */
class Example13
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // With NativeQuery you can execute native SELECT SQL statements and map the results to Doctrine entities or
        // any other result format supported by Doctrine.
        /*
        The resultset mapping declares the entities retrieved by this native query.
        Each field of the entity is bound to a SQL alias (or column name).
        All fields of the entity including the ones of subclasses and the foreign key columns of related entities have to be present in the SQL query.
        Field definitions are optional provided that they map to the same column name as the one declared on the class property.
        __CLASS__ is an alias for the mapped class
        */

        // More complex examples can be found here:
        // http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/native-sql.html#native-sql

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(User::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'name');

        // To create a NativeQuery you use the method EntityManager#createNativeQuery($sql, $resultSetMapping).
        // As you can see in the signature of this method, it expects 2 ingredients: The SQL you want to execute and
        // the ResultSetMapping that describes how the results will be mapped.
        $query = $entityManager->createNativeQuery('SELECT id, name FROM users WHERE name = ?', $rsm);
        $query->setParameter(1, 'Kambaa');

        $users = $query->getResult();

        var_dump($users);
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example13();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example13::run();

