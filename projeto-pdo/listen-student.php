<?php

use Alura\Pdo\Domain\Model\Student;

    require_once 'vendor/autoload.php';
    $databasePath = __DIR__ . DIRECTORY_SEPARATOR . 'bd.sqlite';
    $dsn = 'sqlite:' . str_replace('\\', '/', $databasePath);
    $pdo = new PDO($dsn);
    $query = 'SELECT * FROM STUDENTS';
    $statement = $pdo->query($query);
    $studentsData = $statement->fetchAll(PDO::FETCH_ASSOC);
    $students = [];
    foreach($studentsData as $studentData) {
        $students[] = new Student($studentData['id'], $studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
    }
    var_dump($students);
    
    ?>