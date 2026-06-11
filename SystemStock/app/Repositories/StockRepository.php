<?php
namespace SystemStock\App\Repositories;
use SystemStock\App\Domain\Model\Stock;
interface StockRepository {
    public function save(Stock $stock): ?Stock;
    public function findById(int $id): ?Stock;
    public function findAll(): array;
    public function delete(int $id): void;
}