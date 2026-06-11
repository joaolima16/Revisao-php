<?php
namespace SystemStock\App\Controllers;
use SystemStock\App\Services\StockService;
use SystemStock\App\Helpers\ResponseJson;
use InvalidArgumentException;
class StockController{
    private StockService $stockService;
    public function __construct(StockService $stockService) {
        $this->stockService = $stockService;
    }
    public function createStock() {
        try {
            $data = ResponseJson::receive();
            $quantity = $data['quantity'] ?? null;
            $idProduct = $data['id_product'] ?? null;
            $stock = $this->stockService->createStock($quantity, $idProduct);
            if ($stock === null) {
                ResponseJson::send(['error' => "Erro ao criar estoque."], 500);
            } else {
                ResponseJson::send($stock->toArray(), 201);
            }
        } catch (InvalidArgumentException $e) {
            ResponseJson::send(['error' => $e->getMessage()], 400);
        }
    }
    public function findById(int $id): void {
        $stock = $this->stockService->findById($id);
        if ($stock === null) {
            ResponseJson::send(['error' => 'Estoque nao encontrado.'], 404);
            return;
        }
        ResponseJson::send($stock->toArray());
    }
    public function findAll(): void {
        $stocks = array_map(
            static fn ($stock) => $stock->toArray(),
            $this->stockService->findAll()
        );
        ResponseJson::send(['Data' =>$stocks], 200);
    }
    public function delete(int $id): void {
        $this->stockService->delete($id);
        ResponseJson::send(['message' => 'Estoque deletado com sucesso.'], 200);
    }
}