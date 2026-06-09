<?php

namespace Estoque\Pdo\Domain\Model;
class Product {
    private ?int $id;
    private string $name;
    private float $unitPrice;

    private int $codeProduct;

    public function __construct(?int $id, string $name, float $unitPrice, ?int $codeProduct) {
        $this->id = $id;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->codeProduct = $this->generateCodeProduct($codeProduct);
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getUnitPrice() {
        return $this->unitPrice;
    }
    public function getCodeProduct() {
        return $this->codeProduct;
    }

    public function generateCodeProduct(?int $codeProduct = null): int{
        if($codeProduct !== null) {
            return $codeProduct;
        }
        return rand(1000, 9999);
    }
}