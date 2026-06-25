<?php

namespace App\Controllers;

use App\Models\Client;

class ClientController extends BaseController
{


    public function index(): void
    {
        $client = new Client('Joao Goncalves', 'masculino', 'joao@example.com');

        $this->smarty->assign('titulo', 'Lista de clientes');
        $this->smarty->assign('client', $client);
        $this->smarty->display('index.tpl');
    }
    public function create(): void
    {
        $this->smarty->display('form.tpl');
    }
}
