<?php

namespace SystemStock\App\Services;

use SystemStock\App\Domain\Model\Product;
use SystemStock\App\Repositories\ProductRepository;

class ProductService {
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function save(Product $product): Product {
        return $this->productRepository->save($product);
    }

    public function findById(int $id): ?Product {
        return $this->productRepository->findById($id);
    }

    public function findAll(): array {
        return $this->productRepository->findAll();
    }

    public function delete(int $id): void {
        $this->productRepository->delete($id);
    }
}
