<?php
use App\Helper\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
require_once __DIR__ . '/Config/bootstrap.php';
require_once __DIR__ .'/vendor/autoload.php';

$entityManager = EntityManagerFactory::create();


return ConsoleRunner::createHelperSet($entityManager);
