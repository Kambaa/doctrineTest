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
 * @package DoctrineTest\Example
 * Simple Doctrine Entity
 * Every PHP object that you want to save in the database using Doctrine is called an “Entity”.
 * The term “Entity” describes objects that have an identity over many independent requests. This identity is
 * usually achieved by assigning a unique identifier to an entity.
 * Because Doctrine is a generic library, it only knows about your entities because you will describe their existence
 * and structure using mapping metadata, which is configuration that tells Doctrine how your entity should be stored
 * in the database. The documentation will often speak of “mapping something”, which means writing the mapping metadata
 * that describes your entity.
 * Marking our Example14 class as an entity for Doctrine is straightforward:
 * @Entity
 * With no additional information, Doctrine expects the entity to be saved into a table with the same name as the
 * class in our case Message. You can change this by configuring information about the table:
 * @Table(name="users")
 * Now the class Example14 will be saved and fetched from the table users.
 */
class Example14
{
    // The next step after marking a PHP class as an entity is mapping its properties to columns in a table.
    // To configure a property use the @Column docblock annotation. The type attribute specifies the Doctrine
    // Mapping Type to use for the field. If the type is not specified, string is used as the default.

    // Every entity class must have an identifier/primary key. You can select the field that serves as the identifier
    // with the @Id annotation. In most cases using the automatic generator strategy (@GeneratedValue) is what you want.
    // It defaults to the identifier generation mechanism your current database vendor prefers: AUTO_INCREMENT with
    // MySQL, SERIAL with PostgreSQL, Sequences with Oracle and so on. More on here:
    // http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/basic-mapping.html#identifier-generation-strategies

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(length=140)
     */
    private $name;

    /**
     * @Column(type="datetime",name="email_address")
     */
    private $email;

    // The Column annotation has some more attributes. Here is a complete list:

    // type: (optional, defaults to ‘string’) The mapping type to use for the column.
    // name: (optional, defaults to field name) The name of the column in the database.
    // length: (optional, default 255) The length of the column in the database. (Applies only if a string-valued
    // column is used).
    // unique: (optional, default FALSE) Whether the column is a unique key.
    // nullable: (optional, default FALSE) Whether the database column is nullable.
    // precision: (optional, default 0) The precision for a decimal (exact numeric) column (applies only for decimal
    // column), which is the maximum number of digits that are stored for the values.
    // scale: (optional, default 0) The scale for a decimal (exact numeric) column (applies only for decimal column),
    // which represents the number of digits to the right of the decimal point and must not be greater than precision.
    // columnDefinition: (optional) Allows to define a custom DDL snippet that is used to create the column. Warning:
    // This normally confuses the SchemaTool to always detect the column as changed.
    // options: (optional) Key-value pairs of options that get passed to the underlying database platform when
    // generating DDL statements.


    // The type option used in the @Column accepts any of the existing Doctrine types or even your own
    // custom types. A Doctrine type defines the conversion between PHP and SQL types, independent from the database
    // vendor you are using. All Mapping Types that ship with Doctrine are fully portable between the supported
    // database systems.

    // As an example, the Doctrine Mapping Type string defines the mapping from a PHP string to a SQL VARCHAR
    // (or VARCHAR2 etc. depending on the RDBMS brand). Here is a quick overview of the built-in mapping types:

    // string: Type that maps a SQL VARCHAR to a PHP string.
    // integer: Type that maps a SQL INT to a PHP integer.
    // smallint: Type that maps a database SMALLINT to a PHP integer.
    // bigint: Type that maps a database BIGINT to a PHP string.
    // boolean: Type that maps a SQL boolean or equivalent (TINYINT) to a PHP boolean.
    // decimal: Type that maps a SQL DECIMAL to a PHP string.
    // date: Type that maps a SQL DATETIME to a PHP DateTime object.
    // time: Type that maps a SQL TIME to a PHP DateTime object.
    // datetime: Type that maps a SQL DATETIME/TIMESTAMP to a PHP DateTime object.
    // datetimetz: Type that maps a SQL DATETIME/TIMESTAMP to a PHP DateTime object with timezone.
    // text: Type that maps a SQL CLOB to a PHP string.
    // object: Type that maps a SQL CLOB to a PHP object using serialize() and unserialize()
    // array: Type that maps a SQL CLOB to a PHP array using serialize() and unserialize()
    // simple_array: Type that maps a SQL CLOB to a PHP array using implode() and explode(), with a comma as delimiter.
    // IMPORTANT Only use this type if you are sure that your values cannot contain a ”,”.
    // json_array: Type that maps a SQL CLOB to a PHP array using json_encode() and json_decode()
    // float: Type that maps a SQL Float (Double Precision) to a PHP double. IMPORTANT: Works only with locale
    // settings that use decimal points as separator.
    // guid: Type that maps a database GUID/UUID to a PHP string. Defaults to varchar but uses a specific type
    // if the platform supports it.
    // blob: Type that maps a SQL BLOB to a PHP resource stream

    // We can also create custom types and use them in the properies. Explanation is here:
    // More on  http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/cookbook/custom-mapping-types.html

    // Sometimes it is necessary to quote a column or table name because of reserved word conflicts. Doctrine does not
    // quote identifiers automatically, because it leads to more problems than it would solve. Quoting tables and column
    // names needs to be done explicitly using ticks in the definition. Take a look at the example below:
    //    /** @Column(name="`number`", type="integer") */
    //    private $number;
    // More on http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/basic-mapping.html#quoting-reserved-words


}

