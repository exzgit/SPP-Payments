<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM kelas WHERE Id = $id";
    $result = $conn->query($sql);
    $class = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $class_name = $_POST['class_name'];
    $sql = "UPDATE kelas SET NamaKelas = '$class_name' WHERE Id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 p-6">

    <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-4">Edit Kelas</h2>
            <form action="edit_class.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($class['Id']); ?>">
                <div class="grid gap-4 mb-4">
                    <div>
                        <label for="class_name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input type="text" id="class_name" name="class_name" value="<?php echo htmlspecialchars($class['NamaKelas']); ?>" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

</body>
</html>
