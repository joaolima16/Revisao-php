<?php

namespace SystemStock\App\Domain\Model;

class Product {
    private ?int $id;
    private string $name;
    private float $unitPrice;
    private string $codeProduct;

    public function __construct(
        ?int $id,
        string $name,
        float $unitPrice,
        ?string $codeProduct = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->codeProduct = $codeProduct ?? self::generateCodeProduct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id): void {
        if ($this->id !== null) {
            throw new \LogicException('O produto já possui um ID.');
        }

        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }
    public function getUnitPrice() {
        return $this->unitPrice;
    }
    public function getCodeProduct(): string {
        return $this->codeProduct;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'unit_price' => $this->unitPrice,
            'code_product' => $this->codeProduct,
        ];
    }

    private static function generateCodeProduct(): string {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);

        $hex = bin2hex($bytes);

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12)
        );
    }
}
