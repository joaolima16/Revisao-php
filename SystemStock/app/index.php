<?php

use SystemStock\App\Controllers\ProductController;
use SystemStock\App\Helpers\ResponseJson;
use SystemStock\App\Infrastructure\Persistence\ConnectionCreator;
use SystemStock\App\Infrastructure\Repositories\PdoProductRepository;
use SystemStock\App\Services\ProductService;

require_once __DIR__ . '/../vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoProductRepository($connection);
$productService = new ProductService($repository);
$productController = new ProductController($productService);


$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($method === 'GET' && $id !== false && $id !== null && $id > 0) {
    $productController->findById($id);
    exit;
}

ResponseJson::send([
    'error' => 'Informe um ID válido. Exemplo: GET /?id=1',
], 400);
