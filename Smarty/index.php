<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\ClientController;

$page = $_GET['page'] ?? 'clients';
$client = new ClientController();

switch( $page ) {
    case 'clients':
        $client->index();
        break;
    case 'clients-create':
        $client->create();
        break;
    default:
     http_response_code(404);
     echo "Pagina não encontrada";
     break;
}
