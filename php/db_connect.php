<?php
$servername = "localhost";  // Nama server database, biasanya 'localhost'
$username = "root";         // Nama pengguna database
$password = "";             // Kata sandi database
$dbname = "spppayment";    // Nama database yang ingin dihubungkan

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Koneksi berhasil
// echo "Koneksi berhasil!";
?>
