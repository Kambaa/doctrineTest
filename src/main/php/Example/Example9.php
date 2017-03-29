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
 * Simple EntityFactory Example
 * @package DoctrineTest\Example
 */
class Example9
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // Entity Repositories are for separating the Doctrine query logic from your model. In the example below,
        // we're trying to get a user and user list from name via entity repositories.

        $userName2Search = "Kambaa";

        // Get the user repository and search for single User entity with given name equals condition.
        $user = $entityManager->getRepository(User::class)
            ->findOneBy(array('name' => $userName2Search));

        echo "[$userName2Search named user] :" . var_export($user, 1) . PHP_EOL;


        // In this example we're trying to get all users who has named $userName2Search's value.
        $userList = $entityManager->getRepository(User::class)
            ->findBy(array('name' => $userName2Search));

        echo "[$userName2Search named users] :" . var_export($userList, 1) . PHP_EOL;
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example9();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example9::run();

