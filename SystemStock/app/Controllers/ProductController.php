<?php

namespace SystemStock\App\Controllers;

use JsonException;
use SystemStock\App\Domain\Model\Product;
use SystemStock\App\Helpers\ResponseJson;
use SystemStock\App\Services\ProductService;

class ProductController {
    public function __construct(
        private ProductService $productService
    ) {
    }

    public function findAll(): void {
        $products = array_map(
            static fn (Product $product): array => $product->toArray(),
            $this->productService->findAll()
        );

        ResponseJson::send($products);
    }

    public function findById(int $id): void {
        $product = $this->productService->findById($id);

        if ($product === null) {
            ResponseJson::send(['error' => 'Produto nao encontrado.'], 404);
            return;
        }

        ResponseJson::send($product->toArray());
    }

    public function create(): void {
        try {
            $data = ResponseJson::receive();
        } catch (JsonException) {
            ResponseJson::send(['error' => 'JSON invalido.'], 400);
            return;
        }

        $name = trim((string) ($data['name'] ?? ''));
        $unitPrice = $data['unit_price'] ?? null;

        if ($name === '' || !is_numeric($unitPrice) || (float) $unitPrice < 0) {
            ResponseJson::send([
                'error' => 'Informe name e unit_price validos.',
            ], 422);
            return;
        }

        $product = new Product(null, $name, (float) $unitPrice);
        $savedProduct = $this->productService->save($product);

        ResponseJson::send($savedProduct->toArray(), 201);
    }
}
