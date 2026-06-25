<?php
namespace App;

use App\Entity\ClientEntity;
use App\Helper\EntityManagerFactory;

require_once __DIR__ .'/vendor/autoload.php';
require_once __DIR__ . '/Config/bootstrap.php';

$Client = new ClientEntity('Joao','Teste', 'joao@teste.com');

$entityManager->persist($Client);
$entityManager->flush();
echo("Cliente adicionado");