<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Domain\Model\Student;

class PdoStudentRepository implements StudentRepository{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function allStudents(): array
    {
        $query = 'SELECT * FROM STUDENTS';
        $statement = $this->connection->query($query);
        $studentsData = $statement->fetchAll(PDO::FETCH_ASSOC);
        $students = [];
        foreach($studentsData as $studentData) {
            $students[] = new Student($studentData['id'], $studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
        }
        return $students;
    }
    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {
        $query = 'SELECT * FROM STUDENTS WHERE birth_date = ?';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1, $birthDate->format('Y-m-d'));
        $statement->execute();
        $studentsData = $statement->fetchAll(PDO::FETCH_ASSOC);
        $students = [];
        foreach($studentsData as $studentData) {
            $students[] = new Student($studentData['id'], $studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
        }
        return $students;
    }
    public function saveStudent(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students(name, birth_date) VALUES (?, ?)";
        $statement = $this->connection->prepare($sqlInsert);
        $statement->bindValue(1, $student->name());
        $statement->bindValue(2, $student->birthDate()->format('Y-m-d'));
        $result = $statement->execute();
        if($result){
            return true;
        }
        return false;
    }
    public function remove(Student $student): bool
    {
        $sqlDelete = "DELETE FROM students WHERE id = ?";
        $statement = $this->connection->prepare($sqlDelete);
        $statement->bindValue(1, $student->id(), PDO::PARAM_INT);
        $result = $statement->execute();
        if($result){
            return true;
        }
        return false;
    }
}