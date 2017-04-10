<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 4:51 PM
 */

namespace DoctrineTest\Example;


/**
 * Class Example15
 * Association mapping
 * @link http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html
 * @package DoctrineTest\Example
 */
class Example15
{
    // Instead of working with foreign keys in your code, you will always work with references to objects instead and
    // Doctrine will convert those references to foreign keys internally.
    // One tip for working with relations is to read the relation from left to right, where the left word refers to the
    // current Entity. For example:

    // OneToMany - One instance of the current Entity has Many instances (references) to the refered Entity.
    // ManyToOne - Many instances of the current Entity refer to One instance of the refered Entity.
    // OneToOne - One instance of the current Entity refers to One instance of the refered Entity.

    // Read more: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/unitofwork-associations.html


    // Mapping Defaults:
    // More here: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#mapping-defaults

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////MANY TO ONE EXAMPLE   (Unidirectional) //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Class User
 * @package DoctrineTest\Example
 * @Entity
 */
class User
{
    //...
    /**
     * Many Users have One Address.
     * @ManyToOne(targetEntity="Address")
     * @JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;
}

/**
 * @Entity
 */
class Address
{

    /**
     * @var
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ONE TO ONE EXAMPLE  (Unidirectional) ///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * @Entity
 */
class Product
{
    // ...

    /**
     * One Product has One Shipping.
     * @OneToOne(targetEntity="Shipping")
     * @JoinColumn(name="shipping_id", referencedColumnName="id")
     */
    private $shipping;

    // ...
}

/**
 * @Entity
 */
class Shipping
{
    /**
     * @var
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    // ...
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ONE TO ONE EXAMPLE  (Bidirectional) ////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * @Entity
 */
class Customer
{
    // ...

    /**
     * One Customer has One Cart.
     * @OneToOne(targetEntity="Cart", mappedBy="customer")
     */
    private $cart;

    // ...
}

/**
 * @Entity
 */
class Cart
{
    // ...

    /**
     * One Cart has One Customer.
     * @OneToOne(targetEntity="Customer", inversedBy="cart")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    // ...
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ONE TO ONE EXAMPLE  (Self Referencing) /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * @Entity
 */
class Student
{
    // ...

    /**
     * One Student has One Student.
     * @OneToOne(targetEntity="Student")
     * @JoinColumn(name="mentor_id", referencedColumnName="id")
     */
    private $mentor;

    // ...
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ONE TO MANY BIDIRECTIONAL //////////// /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// A one-to-many association has to be bidirectional, unless you are using an additional join-table. This is necessary,
// because of the foreign key in a one-to-many association being defined on the “many” side. Doctrine needs a
// many-to-one association that defines the mapping of this foreign key.

// This bidirectional mapping requires the 'mappedBy' attribute on the 'OneToMany' association and the 'inversedBy'
// attribute on the 'ManyToOne' association.


use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 */
class Product
{
    // ...
    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="Feature", mappedBy="product")
     */
    private $features;

    // ...

    public function __construct()
    {
        $this->features = new ArrayCollection();
    }
}

/**
 * @Entity
 */
class Feature
{
    // ...
    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="Product", inversedBy="features")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    // ...
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ONE TO MANY UNIDIRECTIONAL WITH JOIN TABLE /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// A unidirectional one-to-many association can be mapped through a join table. From Doctrine’s point of view, it is
// simply mapped as a unidirectional many-to-many whereby a unique constraint on one of the join columns enforces
// the one-to-many cardinality.

/**
 * @Entity
 */
class User
{
    // ...

    /**
     * Many User have Many Phonenumbers.
     * @ManyToMany(targetEntity="Phonenumber")
     * @JoinTable(name="users_phonenumbers",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="phonenumber_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $phonenumbers;

    public function __construct()
    {
        $this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    // ...
}

/** @Entity */
class Phonenumber
{
    // ...
}
