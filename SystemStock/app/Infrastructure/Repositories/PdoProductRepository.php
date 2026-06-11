<?php
namespace SystemStock\App\Infrastructure\Repositories;
use SystemStock\App\Domain\Model\Product;
use SystemStock\App\Repositories\ProductRepository;
use PDO;
class PdoProductRepository implements ProductRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function save(Product $product): Product {
        if ($product->getId() === null) {
            $stmt = $this->connection->prepare(
                "INSERT INTO products (name, unit_price, code_product)
                 VALUES (:name, :price, :code_product)"
            );
            $stmt->execute([
                ':name' => $product->getName(),
                ':price' => $product->getUnitPrice(),
                ':code_product' => $product->getCodeProduct()
            ]);
            $productId = (int)$this->connection->lastInsertId();
            $product->setId($productId);
        } else {
            $stmt = $this->connection->prepare(
                "UPDATE products
                 SET name = :name, unit_price = :price, code_product = :code_product
                 WHERE id = :id"
            );
            $stmt->execute([
                ':name' => $product->getName(),
                ':price' => $product->getUnitPrice(),
                ':code_product' => $product->getCodeProduct(),
                ':id' => $product->getId()
            ]);
        }
        return $product;
    }

    public function findById(int $id): ?Product {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Product(
                (int)$data['id'],
                $data['name'],
                (float)$data['unit_price'],
                $data['code_product']
            );
        }
        return null;
    }

    public function findAll(): array {
        $stmt = $this->connection->query("SELECT * FROM products");
        return array_map(function($data) {
            return new Product(
                (int)$data['id'],
                $data['name'],
                (float)$data['unit_price'],
                $data['code_product']
            );
        }, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function delete(int $id): void {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
