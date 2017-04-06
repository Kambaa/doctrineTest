<?php

/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 9:55 AM
 */

namespace DoctrineTest\entity;

/**
 * Class User
 * @Entity(repositoryClass="DoctrineTest\Util\CustomRepository")
 * @Table(name="users")
 *
 * Please note that id has no setter beacuse generally speaking, your code should not set this value since
 * it represents a database id value.
 */
class User
{
    /**
     * @var int id
     * @id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var string name
     * @Column
     */
    protected $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    function __toString()
    {
        return User::class . " [id=$this->id,name=$this->name]";
    }
}