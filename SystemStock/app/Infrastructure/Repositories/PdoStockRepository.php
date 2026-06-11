<?php

namespace SystemStock\App\Infrastructure\Repositories;
use SystemStock\App\Domain\Model\Product;
use SystemStock\App\Domain\Model\Stock;
use PDO;
use SystemStock\App\Repositories\StockRepository;
class PdoStockRepository implements StockRepository{
        private PDO $connection;

        public function __construct(PDO $connection) {
            $this->connection = $connection;
        }

        public function save(Stock $stock): ?Stock {
            if(stock->getId() === null){
                $stmt = $this->connection->prepare(
                    "INSERT INTO stocks (quantity, id_product)
                     VALUES (:quantity, :id_product)"
                );
                $stmt->execute([
                    ':quantity' => $stock->getQuantity(),
                    ':id_product' => $stock->getProduct()->getId()
                ]);
                $stockId = (int)$this->connection->lastInsertId();
                $stock->setId($stockId);
            } else {
                $stmt = $this->connection->prepare(
                    "UPDATE stocks
                     SET quantity = :quantity, id_product = :id_product
                     WHERE id = :id"
                );
                $stmt->execute([
                    ':quantity' => $stock->getQuantity(),
                    ':id_product' => $stock->getProduct()->getId(),
                    ':id' => $stock->getId()
                ]);
            }
        }
    
        public function findById(int $id): ? Stock
        {
            $stmt = $this->connection->prepare(
                "SELECT s.id, s.quantity, p.id as id_product, p.name, p.unit_price, p.code_product
                 FROM stocks s
                 JOIN products p ON s.id_product = p.id
                 WHERE s.id = :id"
            );
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Stock(
                    $result['id'],
                    $result['quantity'],
                    new Product(
                        $result['id_product'],
                        $result['name'],
                        $result['unit_price'],
                        $result['code_product']
                    )
                );
            }
            return null;
        }
        public function findAll(): array
        {
            $stmt = $this->connection->query(
                "SELECT s.id, s.quantity, p.id as id_product, p.name, p.unit_price, p.code_product
                 FROM stocks s
                 JOIN products p ON s.id_product = p.id"
            );
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stocks = [];
            foreach ($results as $result) {
                $stocks[] = new Stock(
                    $result['id'],
                    $result['quantity'],
                    new Product(
                        $result['id_product'],
                        $result['name'],
                        $result['unit_price'],
                        $result['code_product']
                    )
                );
            }
            return $stocks;
        }
        public function delete(int $id): void
        {
            $stmt = $this->connection->prepare("DELETE FROM stocks WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }

}