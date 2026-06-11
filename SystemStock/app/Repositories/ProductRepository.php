<?php

namespace SystemStock\App\Repositories;
use SystemStock\App\Domain\Model\Product;

interface ProductRepository {
    public function save(Product $product): ?Product;
    public function findById(int $id): ?Product;
    public function findAll(): array;
    public function delete(int $id): void;
}
