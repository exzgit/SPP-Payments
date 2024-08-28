<?php
include 'db_connect.php';


$conn->query("SET @id := 0");
$conn->query("UPDATE siswa SET Id = @id := (@id + 1)");
$conn->query("ALTER TABLE siswa AUTO_INCREMENT = 1");

// Mengambil aksi dari URL
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Fungsi untuk memeriksa apakah kelas ada dalam database
function checkClassExists($conn, $className) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM kelas WHERE NamaKelas = ?");
    $stmt->bind_param("s", $className);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count > 0;
}

// Menambah siswa
if ($action === 'add') {
    $nisn = $_POST['nisn'];
    $name = $_POST['name'];
    $class = $_POST['class'];

    // Cek apakah kelas ada
    if (!checkClassExists($conn, $class)) {
        header("Location: ../pages/index.php?message=Kelas%20tidak%20ada%20dalam%20database");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO siswa (Nisn, NamaSiswa, Kelas) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $nisn, $name, $class);

    if ($stmt->execute()) {
        header("Location: ../pages/index.php?success=add");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Mengedit siswa
if ($action === 'edit' && $id > 0) {
    $nisn = $_POST['nisn'];
    $name = $_POST['name'];
    $class = $_POST['class'];

    // Cek apakah kelas ada
    if (!checkClassExists($conn, $class)) {
        header("Location: ../pages/index.php?message=Kelas%20tidak%20ada%20dalam%20database");
        exit;
    }

    $stmt = $conn->prepare("UPDATE siswa SET Nisn=?, NamaSiswa=?, Kelas=? WHERE Id=?");
    $stmt->bind_param("issi", $nisn, $name, $class, $id);

    if ($stmt->execute()) {
        header("Location: ../pages/index.php?success=edit");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Menghapus siswa
if ($action === 'delete' && $id > 0) {
    $stmt = $conn->prepare("DELETE FROM siswa WHERE Id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../pages/index.php?success=delete");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
