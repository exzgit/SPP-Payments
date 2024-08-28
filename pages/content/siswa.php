<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styling for autocomplete suggestions */
        .autocomplete-suggestions {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }
        .autocomplete-suggestion {
            padding: 0.5rem;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 p-6">

    <!-- Container -->
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden relative">
        <div class="p-6 space-y-6">
            <!-- Form Tambah Siswa -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-user-plus text-green-600"></i>
                    <span>Tambah Siswa</span>
                </h2>
                <form action="../php/manage_students.php" method="POST" id="student-form">
                    <div id="message-container" class="mb-4"></div>
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                            <input type="text" id="nisn" name="nisn" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="relative">
                            <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <input type="text" id="class" name="class" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autocomplete="off">
                            <div id="suggestions" class="autocomplete-suggestions"></div>
                        </div>
                    </div>
                    <button type="submit" name="action" value="add" 
                            class="flex items-center px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 ease-in-out">
                        <i class="fas fa-save mr-2"></i>
                        Tambah Siswa
                    </button>
                </form>
            </div>

            <!-- Table Siswa -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-users text-gray-800"></i>
                    <span>Daftar Siswa</span>
                </h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NISN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        include '../php/db_connect.php';

                        $sql = "SELECT * FROM siswa";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["Id"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["Nisn"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["NamaSiswa"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row["Kelas"]) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-right">';
                                echo '<a href="../php/view_student.php?id=' . htmlspecialchars($row["Id"]) . '" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out"><i class="fas fa-eye"></i> View</a> | ';
                                echo '<a href="../php/edit_student.php?id=' . htmlspecialchars($row["Id"]) . '" class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out"><i class="fas fa-edit"></i> Edit</a> | ';
                                echo '<a href="../php/manage_students.php?action=delete&id=' . htmlspecialchars($row["Id"]) . '" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out"><i class="fas fa-trash-alt"></i> Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="px-6 py-4 text-center text-gray-600">Tidak ada data</td></tr>';
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
