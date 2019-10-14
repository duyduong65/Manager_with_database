<?php
include_once '../class/Student.php';
include_once '../class/StudentManager.php';
include_once '../class/DBConnect.php';


$manager = new StudentManager();
$index = $_GET['id'];

$name = $manager->studentDB->prepare('SELECT name FROM `students` WHERE id=:id');
$phone = $manager->studentDB->prepare('SELECT phone FROM `students` WHERE id=:id');
$phone->bindParam(':id', $index);
$name->bindParam(':id', $index);
$name->execute();
$phone->execute();
$name = $name->fetch()['name'];
$phone =$phone->fetch()['phone'];



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="CRUD/insert.php" method="get">
    <center>
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" value="<?php echo $name ?>"></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type="text" name="phone" value="<?php echo $phone ?>"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="insert">
                </td>
            </tr>
        </table>
    </center>
    <table>
        <tr>
            <td style="width: 30%">ID</td>
            <td style="width: 30%">Name</td>
            <td style="width: 30%">Phone Number</td>
        </tr>

        <?php
        $students = $manager->getAll();

        foreach ($students as $key => $student): ?>
            <tr>
                <td><?php echo ++$key ?></td>
                <td><?php echo $student->name; ?></td>
                <td><?php echo $student->phone; ?></td>
                <td><a href="CRUD/delete.php?id=<?php echo $student->id ?>">Del</a></td>
                <td><a href="CRUD/edit.php?id=<?php echo $student->id ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>

    </table>
</form>

</body>
</html>
