<?php
include 'db_connect.php';

$conn->query("SET @id := 0");
$conn->query("UPDATE kelas SET Id = @id := (@id + 1)");
$conn->query("ALTER TABLE kelas AUTO_INCREMENT = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $class_name = $_POST['class_name'];
        $sql = "INSERT INTO kelas (NamaKelas) VALUES ('$class_name')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM kelas WHERE Id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>