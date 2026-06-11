<?php

namespace SystemStock\App\Helpers;

class ResponseJson {
    public static function send($data, int $statusCode = 200): void {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
    public static function receive(): array {
        $input = file_get_contents('php://input');
        return json_decode($input, true, 512, JSON_THROW_ON_ERROR);
    }
}
