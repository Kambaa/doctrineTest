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
 * Class Example7
 * Using DQL with placeholders
 * @package DoctrineTest\Example
 */
class Example7
{
    public static $BASEDIR;

    public function __construct()
    {
        $entititManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // In the last example, we wrote DQL queries and get the results as array of entities or simple arrays.
        // Now, we're gonna use placeholders with those queries.

        // FROM DOCTRINE DOCUMENTATION: DQL supports both named and positional parameters, however in contrast to many
        // SQL dialects positional parameters are specified with numbers, for example ”?1”, ”?2” and so on.
        // Named parameters are specified with ”:name1”, ”:name2” and so on.
        $dql = "SELECT u FROM " . User::class . " u WHERE u.id=?1";

        $id2Fetch = 11;

        // When using setParameter, remember NOT to use placeholders prefixes.
        // just write whatever name you did in the dql
        // also to set multiple placeholders in one go, use setParameters method with the array of placeholder list.
        // i.e: ->setParameters(array("key1"=>"value1","key2","value2",...));
        $queryResult = $entititManager->createQuery($dql)
            ->setParameter(1, $id2Fetch)
            ->getResult();

        // Also if you want to paginate your query, you can use these methods to do it.
        // ->setMaxResults($maxResults)
        // ->setFirstResult($offset)

        echo '[DQL RESULT]: ' . var_export($queryResult, 1) . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example7();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example7::run();

