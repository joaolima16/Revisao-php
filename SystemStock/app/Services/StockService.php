<?php

namespace SystemStock\App\Services;
use InvalidArgumentException;
use SystemStock\App\Repositories\StockRepository;
use SystemStock\App\Domain\Model\Stock;
class StockService {
        private StockRepository $stockRepository;

    public function __construct(
        StockRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }
    public function createStock(int $quantity, int $idProduct): ?Stock {
        if($quantity < 0) {
            throw new InvalidArgumentException("Quantity must be non-negative.");
        }
        $stock = new Stock(null, $quantity, $idProduct);
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