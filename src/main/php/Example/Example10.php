<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;


/**
 * Class Example10
 * Extending EntityFactory class to write your own custom db operations.
 * @package DoctrineTest\Example
 */
class Example10
{
    public static $BASEDIR;

    public function __construct()
    {

        // By extending the EntityRepository class, you can create your own custom db operations.
        // Doctrine offers you a convenient way to extend the functionalities of the default EntityRepository
        // and put all the specialized DQL query logic on it. For this you have to create a subclass of
        // Doctrine\ORM\EntityRepository

        // to do that just create the custom repo class.
        //class UserRepository extends EntityRepository
        //{
        //...
        //}

        // and then add repositoryClass="ClassName" attribute to the entity annotation of class header.
        // /**
        //  * @Entity(repositoryClass="UserRepository")
        //  * @Table(name="users")
        //  **/
        // class User
        // {
        // ...
        // }

    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example10();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example10::run();

