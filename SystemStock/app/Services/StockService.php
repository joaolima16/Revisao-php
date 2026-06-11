<?php

namespace SystemStock\App\Services;
use InvalidArgumentException;
use SystemStock\App\Repositories\StockRepository;
use SystemStock\App\Domain\Model\Stock;
use SystemStock\App\Repositories\ProductRepository;
class StockService {
        private StockRepository $stockRepository;
        private ProductRepository $productRepository;
        
    public function __construct(
        StockRepository $stockRepository,
        ProductRepository $productRepository
    ) {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
    }
    public function validateStock(int $quantity): void {
        if($quantity < 0) {
            throw new InvalidArgumentException("Quantity must be non-negative.");
        }
    }
    public function createStock(int $quantity, int $idProduct): ?Stock {
        $this->validateStock($quantity);
        $product = $this->productRepository->findById($idProduct);
        if ($product === null) {
            throw new InvalidArgumentException("Product with id $idProduct not found.");
        }
        $stock = new Stock(null, $quantity, $product);
        return $this->stockRepository->save($stock);
    }
    public function findById(int $id): ? Stock
    {
        return $this->stockRepository->findById($id);
    }
    public function findAll(): array
    {
        return $this->stockRepository->findAll();
        }
        
    public function delete(int $id): void
    {
        $this->stockRepository->delete($id);
    }
}