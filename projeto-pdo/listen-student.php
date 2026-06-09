<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
    $query = 'SELECT * FROM STUDENTS';
    $statement = $pdo->query($query);
    $studentsData = $statement->fetchAll(PDO::FETCH_ASSOC);
    $students = [];
    foreach($studentsData as $studentData) {
        $students[] = new Student($studentData['id'], $studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
    }
    var_dump($students);
    
    ?>