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
 * Using QueryBuilder
 * @package DoctrineTest\Example
 */
class Example11
{
    public static $BASEDIR;

    public function __construct()
    {
        // A QueryBuilder provides an API that is designed for conditionally constructing a DQL query in several steps.
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();


        $qb = $entityManager->createQueryBuilder();

        // There’re currently 3 possible return values for getType():
        // QueryBuilder::SELECT, which returns value 0
        // QueryBuilder::DELETE, returning value 1
        // QueryBuilder::UPDATE, which returns value 2
        echo "[INFO] Query Builder Type is: " . $qb->getType() . PHP_EOL;

        $idBiggerThan = 1;
        $qb->select('u')
            ->from(User::class, 'u')
            ->where('u.id > ?1')
            ->orderBy('u.id', 'ASC')
            ->setParameter(1, $idBiggerThan); // For multi parameter set, use this version.
        //$qb->setParameters(array(1 => 'value for ?1', 2 => 'value for ?2'));
        // For paginated results use these configurations
        //$qb->setFirstResult($offset)
        //$qb->setMaxResults($limit);


        // The QueryBuilder is a builder object only, it has no means of actually executing the Query.
        // Additionally a set of parameters such as query hints cannot be set on the QueryBuilder itself.
        // This is why you always have to convert a querybuilder instance into a Query object:
        // Retrieve the associated Query object with the processed DQL
        $query = $qb->getQuery();

        // retrieve the associated EntityManager
        //$em = $qb->getEntityManager();

        // retrieve the DQL string of what was defined in QueryBuilder
        $dql = $qb->getDql();
        var_dump($dql);

        // Execute Query
        $result = $query->getResult();
        //$single = $query->getSingleResult();
        //$array = $query->getArrayResult();
        //$scalar = $query->getScalarResult();
        //$singleScalar = $query->getSingleScalarResult();
        var_dump($result);
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example11();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example11::run();

