<?php

use SystemStock\App\Controllers\ProductController;
use SystemStock\App\Infrastructure\Persistence\ConnectionCreator;
use SystemStock\App\Infrastructure\Repositories\PdoProductRepository;
use SystemStock\App\Services\ProductService;

require_once __DIR__ . '/../vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoProductRepository($connection);
$productService = new ProductService($repository);
$productController = new ProductController($productService);
$dispatchRoutes = require __DIR__ . '/routes.php';

$dispatchRoutes($productController);
