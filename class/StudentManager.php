<?php


class StudentManager
{
    public $studentDB;

    public function __construct()
    {
        $db = new DBConnect("mysql:host=localhost;dbname=studentManager", "root", "khongbiet1");
        $this->studentDB = $db->connect();
    }

    function getAll()
    {
        $sql = "SELECT*FROM students";
        $stmt = $this->studentDB->query($sql);
        $result = $stmt->fetchAll();
        $students = [];
        foreach ($result as $value) {
            $student = new Student($value['name'], $value['phone']);
            $student->id = $value['id'];
            array_push($students, $student);
        }
        return $students;
    }

    function insert($student)
    {
        $stmt = $this->studentDB->prepare('INSERT INTO students(name, phone) VALUES (:name , :phone)');
        $stmt->bindParam(':name', $student->name);
        $stmt->bindParam(':phone', $student->phone);
        $stmt->execute();
    }

    function delete($index)
    {
        $stmt = $this->studentDB->prepare('DELETE FROM students WHERE id=:id');
        $stmt->bindParam(':id', $index);
        $stmt->execute();
    }
    function showEdit($index){

        $stmt = $this->studentDB->prepare('SELECT phone,name FROM `students` WHERE id=:id');
        $stmt->bindParam(':id', $index);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update($index, $name, $phone)
    {
        $stmt = $this->studentDB->prepare('UPDATE students SET name=:name,phone=:phone WHERE id=:id');

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $index);
        $stmt->execute();
    }

}
