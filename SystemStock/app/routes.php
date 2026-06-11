<?php

use SystemStock\App\Controllers\ProductController;
use SystemStock\App\Helpers\ResponseJson;
use SystemStock\App\Controllers\StockController;

return function (StockController $stockController, ProductController $productController): void {
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $path = rtrim($path, '/') ?: '/';

    if ($method === 'POST' && $path === '/products/create') {
        $productController->create();
        return;
    }

    if ($method === 'GET' && $path === '/products') {
        $productController->findAll();
        return;
    }

    if ($method === 'GET' && preg_match('#^/products/(\d+)$#', $path, $matches)) {
        $productController->findById((int) $matches[1]);
        return;
    }
    if($method === 'POST' && $path === '/stocks/create') {
        $stockController->createStock();
        return;
    }
    if($method === 'GET' && preg_match('#^/stocks/(\d+)$#', $path, $matches)) {
        $stockController->findById((int) $matches[1]);
        return;
    }
    if($method === 'GET' && $path === '/stocks') {
        $stockController->findAll();
        return;
    }
    if($method === 'DELETE' && preg_match('#^/stocks/(\d+)$#', $path, $matches)) {
        $stockController->delete((int) $matches[1]);
        return;
    }

    ResponseJson::send(['error' => 'Rota nao encontrada.'], 404);
};
