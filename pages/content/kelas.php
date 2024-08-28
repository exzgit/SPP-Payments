<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-900 p-6">

    <!-- Container -->
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 space-y-6">
            <!-- Form Tambah Kelas -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-plus-circle text-indigo-600"></i>
                    <span>Tambah Kelas</span>
                </h2>
                <form action="../php/manage_classes.php" method="POST">
                    <div class="grid gap-4 mb-4">
                        <div class="relative">
                            <label for="class_name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                            <input type="text" id="class_name" name="class_name" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm pl-10 pr-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <i class="fas fa-chalkboard-teacher absolute left-3 top-[50%] transform -translate-y-[-40%] text-gray-500"></i>
                        </div>
                    </div>
                    <button type="submit" name="action" value="add" 
                            class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                        <i class="fas fa-save mr-2"></i>
                        Tambah Kelas
                    </button>
                </form>
            </div>

            <!-- Table Kelas -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-list-ul text-gray-800"></i>
                    <span>Daftar Kelas</span>
                </h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Kelas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        include '../php/db_connect.php';

                        $sql = "SELECT * FROM kelas";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["Id"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["NamaKelas"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-right">';
                                echo '<a href="../php/edit_class.php?id=' . htmlspecialchars($row["Id"]) . '" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out"><i class="fas fa-edit"></i> Edit</a> | ';
                                echo '<a href="../php/manage_classes.php?action=delete&id=' . htmlspecialchars($row["Id"]) . '" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out"><i class="fas fa-trash-alt"></i> Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3" class="px-6 py-4 text-center text-gray-600">Tidak ada data</td></tr>';
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
