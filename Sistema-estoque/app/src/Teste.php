<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Estoque\Pdo\Domain\Model\Product;
use Estoque\Pdo\Domain\Infrastructure\Persistence\ConnectionCreator;

$connection = ConnectionCreator::createConnection();

$Product = new Product(1, "Coca-cola", 5.99, null);
var_dump($Product);