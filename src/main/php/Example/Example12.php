<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;

use Doctrine\ORM\Query\Expr\From;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\Query\Expr\Select;
use DoctrineTest\entity\User;
use DoctrineTest\Util\DoctrineEntityManagerCreatorFactory;


/**
 * Class ExampleTemplate
 * Doctrine Expr class
 * @package DoctrineTest\Example
 */
class Example12
{
    public static $BASEDIR;

    public function __construct()
    {
        $entityManager = DoctrineEntityManagerCreatorFactory::getEntityManager();


        // To workaround some of the issues that add() method may cause, Doctrine created a class that can be considered
        // as a helper for building expressions . This class is called Expr, which provides a set of useful methods to
        // help build expressions complete class methods are listed below after the example:
        //http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html#the-querybuilder

        // here's an example of using this Expr classes:
        $qb = $entityManager->createQueryBuilder();
        $qb->add('select', new Select(array('u')))
            ->add('from', new From(User::class, 'u'))
            ->add('where', $qb->expr()->orX(
                $qb->expr()->eq('u.id', '?1'),
                $qb->expr()->like('u.name', '?2')
            ))
            ->add('orderBy', new OrderBy('u.name', 'ASC'))
            ->setParameter(1, 7)
            ->setParameter(2, "Kambaa");
        $q = $qb->getQuery();
        $qr = $q->getResult();
        var_dump($qr);

        //    // Example - $qb->expr()->andX($cond1 [, $condN])->add(...)->...
        //    public function andX($x = null); // Returns Expr\AndX instance
        //
        //    // Example - $qb->expr()->orX($cond1 [, $condN])->add(...)->...
        //    public function orX($x = null); // Returns Expr\OrX instance
        //
        //    /** Comparison objects **/
        //
        //    // Example - $qb->expr()->eq('u.id', '?1') => u.id = ?1
        //    public function eq($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->neq('u.id', '?1') => u.id <> ?1
        //    public function neq($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->lt('u.id', '?1') => u.id < ?1
        //    public function lt($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->lte('u.id', '?1') => u.id <= ?1
        //    public function lte($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->gt('u.id', '?1') => u.id > ?1
        //    public function gt($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->gte('u.id', '?1') => u.id >= ?1
        //    public function gte($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->isNull('u.id') => u.id IS NULL
        //    public function isNull($x); // Returns string
        //
        //    // Example - $qb->expr()->isNotNull('u.id') => u.id IS NOT NULL
        //    public function isNotNull($x); // Returns string
        //
        //
        //    /** Arithmetic objects **/
        //
        //    // Example - $qb->expr()->prod('u.id', '2') => u.id * 2
        //    public function prod($x, $y); // Returns Expr\Math instance
        //
        //    // Example - $qb->expr()->diff('u.id', '2') => u.id - 2
        //    public function diff($x, $y); // Returns Expr\Math instance
        //
        //    // Example - $qb->expr()->sum('u.id', '2') => u.id + 2
        //    public function sum($x, $y); // Returns Expr\Math instance
        //
        //    // Example - $qb->expr()->quot('u.id', '2') => u.id / 2
        //    public function quot($x, $y); // Returns Expr\Math instance
        //
        //
        //    /** Pseudo-function objects **/
        //
        //    // Example - $qb->expr()->exists($qb2->getDql())
        //    public function exists($subquery); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->all($qb2->getDql())
        //    public function all($subquery); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->some($qb2->getDql())
        //    public function some($subquery); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->any($qb2->getDql())
        //    public function any($subquery); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->not($qb->expr()->eq('u.id', '?1'))
        //    public function not($restriction); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->in('u.id', array(1, 2, 3))
        //    // Make sure that you do NOT use something similar to $qb->expr()->in('value', array('stringvalue')) as this will cause Doctrine to throw an Exception.
        //    // Instead, use $qb->expr()->in('value', array('?1')) and bind your parameter to ?1 (see section above)
        //    public function in($x, $y); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->notIn('u.id', '2')
        //    public function notIn($x, $y); // Returns Expr\Func instance
        //
        //    // Example - $qb->expr()->like('u.firstname', $qb->expr()->literal('Gui%'))
        //    public function like($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->notLike('u.firstname', $qb->expr()->literal('Gui%'))
        //    public function notLike($x, $y); // Returns Expr\Comparison instance
        //
        //    // Example - $qb->expr()->between('u.id', '1', '10')
        //    public function between($val, $x, $y); // Returns Expr\Func
        //
        //
        //    /** Function objects **/
        //
        //    // Example - $qb->expr()->trim('u.firstname')
        //    public function trim($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->concat('u.firstname', $qb->expr()->concat($qb->expr()->literal(' '), 'u.lastname'))
        //    public function concat($x, $y); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->substring('u.firstname', 0, 1)
        //    public function substring($x, $from, $len); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->lower('u.firstname')
        //    public function lower($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->upper('u.firstname')
        //    public function upper($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->length('u.firstname')
        //    public function length($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->avg('u.age')
        //    public function avg($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->max('u.age')
        //    public function max($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->min('u.age')
        //    public function min($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->abs('u.currentBalance')
        //    public function abs($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->sqrt('u.currentBalance')
        //    public function sqrt($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->count('u.firstname')
        //    public function count($x); // Returns Expr\Func
        //
        //    // Example - $qb->expr()->countDistinct('u.surname')
        //    public function countDistinct($x); // Returns Expr\Func
    }

    public static function run()
    {
        // Base project dir.
        self::$BASEDIR = dirname(__DIR__, 4) . '/';

        // Composer autolader include
        require_once self::$BASEDIR . 'vendor/autoload.php';

        echo self::class . ' started to run' . PHP_EOL;

        new Example12();

        echo '[SUCCESS] If you are seeing this message without any warnings and errors, ' .
            'this means that this example worked ok.';
        exit();
    }
}

Example12::run();

