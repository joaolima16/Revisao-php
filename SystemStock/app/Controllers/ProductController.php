<?php

namespace SystemStock\App\Controllers;

use SystemStock\App\Domain\Model\Product;
use SystemStock\App\Helpers\ResponseJson;
use SystemStock\App\Services\ProductService;

class ProductController {
    public function __construct(
        private ProductService $productService
    ) {
    }

    public function findAll(): array {
        return $this->productService->findAll();
    }

    public function findById(int $id): void {
        $product = $this->productService->findById($id);

        if ($product === null) {
            ResponseJson::send(['error' => 'Produto não encontrado.'], 404);
            return;
        }

        ResponseJson::send($product->toArray());
    }

    public function save(Product $product): Product {
        return $this->productService->save($product);
    }
}
