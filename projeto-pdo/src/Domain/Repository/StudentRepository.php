<?php

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function studentsBirthAt(\DateTimeImmutable $birthDate): array;
    public function saveStudent(Student $student): bool;
    public function remove(Student $student): bool;


}