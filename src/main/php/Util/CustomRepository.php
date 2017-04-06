<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 4/6/17
 * Time: 3:59 PM
 */

namespace DoctrineTest\Util;


use Doctrine\ORM\EntityRepository;
use DoctrineTest\entity\User;

class CustomRepository extends EntityRepository
{
    public function getKambaas()
    {
        return $this->_em->createQuery("SELECT u FROM " . User::class . " u WHERE u.name='Kambaa'")
            ->getResult();
    }
}