<?php

use SystemStock\App\Controllers\ProductController;
use SystemStock\App\Infrastructure\Persistence\ConnectionCreator;
use SystemStock\App\Infrastructure\Repositories\PdoProductRepository;
use SystemStock\App\Services\ProductService;
use SystemStock\App\Infrastructure\Repositories\PdoStockRepository;
use SystemStock\App\Services\StockService;
use SystemStock\App\Controllers\StockController;
require_once __DIR__ . '/../vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoProductRepository($connection);
$productService = new ProductService($repository);
$productController = new ProductController($productService);

$stockRepository = new PdoStockRepository($connection);
$stockService = new StockService($stockRepository, $repository);
$stockController = new StockController($stockService);


$dispatchRoutes = require __DIR__ . '/routes.php';
$dispatchRoutes($stockController, $productController);
