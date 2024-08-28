<?php
include 'db_connect.php';

$query = $_GET['query'] ?? '';
$query = '%' . $query . '%';

$stmt = $conn->prepare("SELECT NamaKelas FROM kelas WHERE NamaKelas LIKE ?");
$stmt->bind_param("s", $query);
$stmt->execute();
$result = $stmt->get_result();

$classes = [];
while ($row = $result->fetch_assoc()) {
    $classes[] = $row['NamaKelas'];
}

echo json_encode($classes);

$stmt->close();
$conn->close();
?>