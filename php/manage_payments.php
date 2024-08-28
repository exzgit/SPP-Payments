<?php
include 'db_connect.php';

$conn->query("SET @id := 0");
$conn->query("UPDATE spp SET Id = @id := (@id + 1)");
$conn->query("ALTER TABLE spp AUTO_INCREMENT = 1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = [];
    $name = trim($_POST['name']);
    $total = trim($_POST['total']);
    $month = trim($_POST['month']);

    // Validasi input
    if (empty($name) || empty($total) || empty($month)) {
        $response['status'] = 'error';
        $response['message'] = 'Semua kolom harus diisi.';
        echo json_encode($response);
        exit();
    }

    // Cari siswa berdasarkan nama
    $stmt = $conn->prepare("SELECT Nisn, Kelas FROM siswa WHERE NamaSiswa = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->bind_result($nisn, $class);
    $stmt->fetch();
    $stmt->close();

    if ($nisn) {
        $stmt = $conn->prepare("INSERT INTO spp (Nisn, NamaSiswa, KelasSiswa, TotalPembayaran, BulanSPP) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $nisn, $name, $class, $total, $month);

        if ($stmt->execute()) {
            header("Location: ../pages/index.php?status=success&message=Berhasil%20menambahkan%20pembayaran%20spp.");
        } else {
            header("Location: ../pages/index.php?status=error&message=Gagal%20menambahkan%20pembayaran%20spp.");
        }
        $stmt->close();
    } else {
        header("Location: ../pages/index.php?status=error&message=Nama%20siswa%20tidak%20ada.");
    }

    echo json_encode($response);
    exit();
}
?>
