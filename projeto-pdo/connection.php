
<?php
$databasePath = __DIR__ . DIRECTORY_SEPARATOR . 'bd.sqlite';
$dsn = 'sqlite:' . str_replace('\\', '/', $databasePath);

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS students(id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');
    echo "Tabela criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro de conexão PDO: " . $e->getMessage();
    exit(1);
}

?>