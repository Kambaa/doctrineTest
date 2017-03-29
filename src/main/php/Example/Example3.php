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
 * Class Example3
 * Fetching all table data
 * @package DoctrineTest\Example
 */
class Example3
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();

        // Gets user repository which has the method for getting the datas in the table. This method needs the name of
        // the entity(i.e: User). If entity is an namespace, we need the full namespace structure in the
        // parameter(i.e: DoctrineTest\entity\User). Easiest way is the using the class constant reference
        // of the entity class(i.e: User::class).
        $userRepository = $entityManager->getRepository(User::class);

        // If we want to get all of the data, we user the findAll method of the repository. This method will return
        // an array of entities.
        $userList = $userRepository->findAll();

        // Informing the users in the db.
        echo "Users in the db: " . PHP_EOL;
        foreach ($userList as $user) {
            echo ((String)$user) . PHP_EOL;
        }
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example3();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example3::run();

