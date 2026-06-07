<?php
    $databasePath = __DIR__ . DIRECTORY_SEPARATOR . 'bd.sqlite';
    $dsn = 'sqlite:' . str_replace('\\', '/', $databasePath);
    $pdo = new PDO($dsn);
    $sqlDelete = "DELETE FROM students WHERE id = ?";
    $statement = $pdo->prepare($sqlDelete);
    $statement->bindValue(1, 1, PDO::PARAM_INT);
    $statement->execute();
    if($statement->rowCount() > 0) {
        echo "Aluno removido com sucesso!" . PHP_EOL;
    }