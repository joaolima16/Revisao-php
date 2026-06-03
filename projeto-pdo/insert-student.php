<?php

use Alura\Pdo\Domain\Model\Student;
require_once 'vendor/autoload.php';

    $databasePath = __DIR__ . DIRECTORY_SEPARATOR . 'bd.sqlite';
    $dsn = 'sqlite:' . str_replace('\\', '/', $databasePath);
    $pdo = new PDO($dsn);
    $student = new Student(null, 'João', new DateTimeImmutable('2000-01-01'));
    $sqlInsert = "INSERT INTO students(name, birth_date) VALUES ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}')";
    $pdo->exec($sqlInsert);
    var_dump($pdo->lastInsertId());
?>