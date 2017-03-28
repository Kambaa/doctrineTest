<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 3/28/17
 * Time: 9:18 AM
 */

// cli-config.php
require_once "doctrine-bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);