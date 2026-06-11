<?php
namespace SystemStock\App\Domain\Model;
class Stock {
    private ?int $id;
    private int $quantity;
    private Product $product;

    public function __construct(?int $id, int $quantity, Product $product) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->product = $product;
    }
    public function id(int $id): void {
        if ($this->id !== null) {
            throw new \LogicException('O estoque já possui um ID.');
        }
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getProduct() {
        return $this->product;
    }
    public function toArray(): array {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'product' => $this->product->toArray(),
        ];
    }
}