<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 10:09 AM
 */
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use DoctrineTest\entity\User;
use Doctrine\ORM\Query\Expr;

require_once 'doctrine-bootstrap.php';
//////////////////////
//Insert Operations //
//////////////////////

//$u = new User();
//$u->setName("Kambaa");
//$entityManager->persist($u);
//$entityManager->flush();
//var_dump($u->getId());

///////////////////////////
// Select All operations //
///////////////////////////

//$productRepository = $entityManager->getRepository(User::class);
//$products = $productRepository->findAll();
//var_dump($products);

///////////////////////
// Select single row //
///////////////////////

//$idToFetch = 7;
//$u = $entityManager->find(User::class, $idToFetch);
//var_dump($u);

///////////////////////
// Select and Update //
///////////////////////

//$idToFetch = 7;
//$u = $entityManager->find(User::class, $idToFetch);
//$u->setName("Kambaa222");
//$entityManager->flush();
//var_dump($u);

///////////////////////////////////////////////////////
// Simple DQL (Like HQL) custom select query example //
///////////////////////////////////////////////////////

//$dql = "SELECT u FROM " . User::class . " u ORDER BY u.id DESC";
//$query = $entityManager->createQuery($dql);
//$query->setMaxResults(30);
//$userListAsEntityArray = $query->getResult();
//$userListAsArray = $query->getArrayResult();
//var_dump($userListAsEntityArray);
//var_dump($userListAsArray);

/////////////////////////////////////////////////////////////////////
// Simple DQL custom select query with parameter assigning example //
/////////////////////////////////////////////////////////////////////

//$userIdToFetch = 7;
//$dql = "SELECT u FROM " . User::class . " u WHERE u.id=?1";
//$query = $entityManager->createQuery($dql)
//    ->setParameter(1, $userIdToFetch)
//    ->setMaxResults(15)
//    ->getResult();
//var_dump($query);

//////////////////////////////////////////////////////////////////////////////////////////
// Simple DQL custom select query with non-entity values (scalar result values) example //
//////////////////////////////////////////////////////////////////////////////////////////

// May even be aggregate values using COUNT, SUM, MIN, MAX or AVG functions.
//$dql = "SELECT u.id, u.name, count(u.id) as totalCount FROM " . User::class . " u ORDER BY u.id DESC";
//$query = $entityManager->createQuery($dql);
//$query->setMaxResults(30);
//$userListWithScalaerResultValues = $query->getScalarResult();
//var_dump($userListWithScalaerResultValues);

/////////////////////////////////////
// Simple EntityRepository Example //
/////////////////////////////////////

//$userName2Search = "Kambaa222";
//$user = $entityManager->getRepository(User::class)
//    ->findOneBy(array('name' => $userName2Search));
//var_dump($user);

//////////////////////////////////////////////////////////
// Simple EntityRepository Example with multiple result //
//////////////////////////////////////////////////////////

//$userName2Search = "Kambaa222";
//$user = $entityManager->getRepository(User::class)
//    ->findBy(array('name' => $userName2Search));
//var_dump($user);

///////////////////////////////////////////////////////////////////////////////////////////
// Grouping custom DQL operation methods via creating doctrine's custom repository class //
///////////////////////////////////////////////////////////////////////////////////////////

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

////////////////////////
// Using QueryBuilder //
////////////////////////

// A QueryBuilder provides an API that is designed for conditionally constructing a DQL query in several steps.

//$qb = $entityManager->createQueryBuilder();

// There’re currently 3 possible return values for getType():
// QueryBuilder::SELECT, which returns value 0
// QueryBuilder::DELETE, returning value 1
// QueryBuilder::UPDATE, which returns value 2
//echo $qb->getType(); // Prints: 0 which is select.

// retrieve the associated EntityManager
//$em = $qb->getEntityManager();

// retrieve the DQL string of what was defined in QueryBuilder
//$dql = $qb->getDql();

// retrieve the associated Query object with the processed DQL
//$q = $qb->getQuery();

//$idBiggerThan = 1;
//$result = $qb->select('u')
//    ->from(User::class, 'u')
//    ->where('u.id > ?1')
//    ->orderBy('u.id', 'ASC')
//    ->setParameter(1, $idBiggerThan);
// For multi parameter set, use this version.
//$qb->setParameters(array(1 => 'value for ?1', 2 => 'value for ?2'));
// For paginated results use these configurations
//$qb->setFirstResult($offset)
//$qb->setMaxResults($limit);


// The QueryBuilder is a builder object only, it has no means of actually executing the Query.
// Additionally a set of parameters such as query hints cannot be set on the QueryBuilder itself.
// This is why you always have to convert a querybuilder instance into a Query object:
//$query = $qb->getQuery();

// Execute Query
//$result = $query->getResult();
//$single = $query->getSingleResult();
//$array = $query->getArrayResult();
//$scalar = $query->getScalarResult();
//$singleScalar = $query->getSingleScalarResult();

/////////////////////////
// Doctrine Expr class //
/////////////////////////

// To workaround some of the issues that add() method may cause, Doctrine created a class that can be considered
// as a helper for building expressions . This class is called Expr, which provides a set of useful methods to
// help build expressions complete class methods are listed below after the example:

// here's an example of using this Expr classes:
//$qb = $entityManager->createQueryBuilder();
//$qb->add('select', new Expr\Select(array('u')))
//    ->add('from', new Expr\From(User::class, 'u'))
//    ->add('where', $qb->expr()->orX(
//        $qb->expr()->eq('u.id', '?1'),
//        $qb->expr()->like('u.name', '?2')
//    ))
//    ->add('orderBy', new Expr\OrderBy('u.name', 'ASC'))
//    ->setParameter(1, 7)
//    ->setParameter(2, "Kambaa222");
//$q = $qb->getQuery();
//$qr = $q->getResult();
//var_dump($qr);


//    // Example - $qb->expr()->andX($cond1 [, $condN])->add(...)->...
//    public function andX($x = null); // Returns Expr\AndX instance
//
//    // Example - $qb->expr()->orX($cond1 [, $condN])->add(...)->...
//    public function orX($x = null); // Returns Expr\OrX instance
//
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

////////////////
// Native SQL //
////////////////
// Check out this documentation link: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/native-sql.html