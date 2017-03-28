<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;


/**
 * Class ExampleTemplate
 * Example class template
 * Just write your code to the constructor of the class with your comments, etc. and set run method to display it
 * on the cli or web. And lastly execute static run() method at the last line of the page.
 * @package DoctrineTest\Example
 */
class ExampleTemplate
{
    public static $BASEDIR;

    public function __construct()
    {
        // Example Code with your comments goes here.


    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new ExampleTemplate();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

ExampleTemplate::run();

