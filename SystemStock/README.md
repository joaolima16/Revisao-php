# SystemStock

API REST para cadastro de produtos e controle de estoque, desenvolvida em PHP puro com PDO e MySQL. O projeto foi estruturado em camadas para separar as regras de negocio, o acesso ao banco de dados e o tratamento das requisicoes HTTP.

## Funcionalidades

- Cadastro de produtos.
- Listagem de todos os produtos.
- Busca de produto por ID.
- Criacao de estoque vinculado a um produto existente.
- Listagem dos registros de estoque com os dados do produto.
- Busca de estoque por ID.
- Exclusao de estoque.
- Geracao automatica de um codigo UUID para cada produto.
- Respostas da API no formato JSON.

## Tecnologias utilizadas

- PHP 8 ou superior.
- MySQL.
- PDO para comunicacao com o banco de dados.
- Composer para autoload PSR-4.

## Arquitetura

O projeto segue uma separacao inspirada em arquitetura em camadas:

- **Controllers:** recebem as requisicoes HTTP, validam os dados de entrada e retornam as respostas JSON.
- **Services:** concentram as regras de negocio da aplicacao.
- **Domain/Model:** representa as entidades `Product` e `Stock`.
- **Repositories:** definem os contratos de persistencia.
- **Infrastructure:** implementa os repositorios com PDO e cria a conexao com o MySQL.
- **Helpers:** disponibiliza funcoes compartilhadas para leitura e envio de JSON.

O fluxo de uma requisicao e:

```text
Requisicao HTTP
      |
      v
   Router
      |
      v
 Controller -> Service -> Repository -> MySQL
      |
      v
 Resposta JSON
```

## Estrutura do projeto

```text
SystemStock/
|-- app/
|   |-- Controllers/
|   |   |-- ProductController.php
|   |   `-- StockController.php
|   |-- Domain/Model/
|   |   |-- Product.php
|   |   `-- Stock.php
|   |-- Helpers/
|   |   `-- ResponseJson.php
|   |-- Infrastructure/
|   |   |-- Persistence/
|   |   |   `-- ConnectionCreator.php
|   |   `-- Repositories/
|   |       |-- PdoProductRepository.php
|   |       `-- PdoStockRepository.php
|   |-- Repositories/
|   |   |-- ProductRepository.php
|   |   `-- StockRepository.php
|   |-- Services/
|   |   |-- ProductService.php
|   |   `-- StockService.php
|   |-- index.php
|   `-- routes.php
|-- database/migrations/
|   |-- 001_create_table_product.sql
|   `-- 002_create_table_stock.sql
|-- composer.json
`-- router.php
```

## Pre-requisitos

Antes de executar o projeto, instale:

- PHP 8+ com as extensoes `pdo` e `pdo_mysql` habilitadas.
- MySQL 8+ ou uma versao compativel.
- Composer.

Confirme as instalacoes com:

```bash
php --version
composer --version
mysql --version
```

## Instalacao

1. Clone o repositorio e acesse a pasta do projeto:

```bash
git clone <URL_DO_REPOSITORIO>
cd SystemStock
```

2. Instale as dependencias e gere o autoload:

```bash
composer install
```

3. Crie o banco de dados:

```sql
CREATE DATABASE store
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

4. Execute as migrations na ordem dos arquivos:

```bash
mysql -u root -p store < database/migrations/001_create_table_product.sql
mysql -u root -p store < database/migrations/002_create_table_stock.sql
```

Tambem e possivel copiar e executar o conteudo dos arquivos SQL diretamente em uma ferramenta como MySQL Workbench, DBeaver ou phpMyAdmin.

5. Configure as variaveis de ambiente do banco de dados.

No PowerShell:

```powershell
$env:DB_HOST = "localhost"
$env:DB_PORT = "3306"
$env:DB_DATABASE = "store"
$env:DB_USERNAME = "root"
$env:DB_PASSWORD = "sua_senha"
$env:DB_CHARSET = "utf8mb4"
```

No Linux ou macOS:

```bash
export DB_HOST="localhost"
export DB_PORT="3306"
export DB_DATABASE="store"
export DB_USERNAME="root"
export DB_PASSWORD="sua_senha"
export DB_CHARSET="utf8mb4"
```

As seguintes configuracoes sao utilizadas quando uma variavel nao e informada:

| Variavel | Valor padrao |
|---|---|
| `DB_HOST` | `localhost` |
| `DB_PORT` | `3306` |
| `DB_DATABASE` | `store` |
| `DB_USERNAME` | `root` |
| `DB_PASSWORD` | vazio |
| `DB_CHARSET` | `utf8mb4` |

## Executando a aplicacao

Na mesma sessao do terminal em que as variaveis foram configuradas, inicie o servidor embutido do PHP:

```bash
php -S localhost:8000 router.php
```

A API estara disponivel em:

```text
http://localhost:8000
```

## Endpoints

### Produtos

| Metodo | Rota | Descricao |
|---|---|---|
| `POST` | `/products/create` | Cadastra um produto. |
| `GET` | `/products` | Lista todos os produtos. |
| `GET` | `/products/{id}` | Busca um produto pelo ID. |

### Estoque

| Metodo | Rota | Descricao |
|---|---|---|
| `POST` | `/stocks/create` | Cria um estoque para um produto. |
| `GET` | `/stocks` | Lista todos os estoques. |
| `GET` | `/stocks/{id}` | Busca um estoque pelo ID. |
| `DELETE` | `/stocks/{id}` | Exclui um estoque. |

## Exemplos de uso

### Cadastrar um produto

```bash
curl -X POST http://localhost:8000/products/create \
  -H "Content-Type: application/json" \
  -d '{"name":"Teclado mecanico","unit_price":249.90}'
```

Resposta esperada (`201 Created`):

```json
{
  "id": 1,
  "name": "Teclado mecanico",
  "unit_price": 249.9,
  "code_product": "6f521aa0-bac7-43f1-a53b-a778ea426410"
}
```

O campo `code_product` nao precisa ser enviado. Ele e gerado automaticamente pela aplicacao.

### Listar produtos

```bash
curl http://localhost:8000/products
```

### Buscar um produto

```bash
curl http://localhost:8000/products/1
```

Quando o produto nao existe, a API retorna `404 Not Found`:

```json
{
  "error": "Produto nao encontrado."
}
```

### Criar um estoque

O produto informado em `id_product` deve existir.

```bash
curl -X POST http://localhost:8000/stocks/create \
  -H "Content-Type: application/json" \
  -d '{"quantity":20,"id_product":1}'
```

Resposta esperada (`201 Created`):

```json
{
  "id": 1,
  "quantity": 20,
  "product": {
    "id": 1,
    "name": "Teclado mecanico",
    "unit_price": 249.9,
    "code_product": "6f521aa0-bac7-43f1-a53b-a778ea426410"
  }
}
```

### Listar estoques

```bash
curl http://localhost:8000/stocks
```

Resposta esperada:

```json
{
  "Data": [
    {
      "id": 1,
      "quantity": 20,
      "product": {
        "id": 1,
        "name": "Teclado mecanico",
        "unit_price": 249.9,
        "code_product": "6f521aa0-bac7-43f1-a53b-a778ea426410"
      }
    }
  ]
}
```

### Buscar um estoque

```bash
curl http://localhost:8000/stocks/1
```

### Excluir um estoque

```bash
curl -X DELETE http://localhost:8000/stocks/1
```

Resposta esperada (`200 OK`):

```json
{
  "message": "Estoque deletado com sucesso."
}
```

## Regras de negocio

- O nome do produto e obrigatorio.
- O preco unitario deve ser numerico e nao pode ser negativo.
- O codigo do produto e unico e gerado automaticamente no formato UUID v4.
- A quantidade em estoque nao pode ser negativa.
- Um estoque somente pode ser criado para um produto existente.
- Cada produto pode possuir apenas um registro na tabela de estoque, devido a restricao `UNIQUE` em `stock.id_product`.

## Codigos HTTP utilizados

| Codigo | Significado no projeto |
|---|---|
| `200` | Requisicao processada com sucesso. |
| `201` | Recurso criado com sucesso. |
| `400` | Dados invalidos ou regra de negocio nao atendida. |
| `404` | Recurso ou rota nao encontrada. |
| `422` | Dados de produto ausentes ou invalidos. |
| `500` | Falha interna ao criar um estoque. |

## Modelo de dados

### Tabela `products`

| Campo | Tipo | Restricoes |
|---|---|---|
| `id` | `INT` | Chave primaria e auto incremento. |
| `name` | `VARCHAR(150)` | Obrigatorio. |
| `unit_price` | `DECIMAL(5,2)` | Obrigatorio. |
| `code_product` | `VARCHAR(36)` | Obrigatorio e unico. |

### Tabela `stock`

| Campo | Tipo | Restricoes |
|---|---|---|
| `id` | `INT` | Chave primaria e auto incremento. |
| `quantity` | `INT` | Obrigatorio. |
| `id_product` | `INT` | Chave estrangeira para `products.id` e valor unico. |

## Observacoes

- As configuracoes do banco sao lidas das variaveis de ambiente `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` e `DB_CHARSET`.
- O projeto ainda nao possui uma suite automatizada de testes.
- Nao ha autenticacao ou autorizacao nos endpoints.
- As rotas de atualizacao e exclusao de produtos ainda nao estao expostas pela API.

## Licenca

Este projeto ainda nao possui uma licenca definida.
