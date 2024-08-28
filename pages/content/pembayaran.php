<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 p-6">
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden relative p-6 space-y-6">
        <!-- Form Pembayaran SPP -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Pembayaran SPP</h2>
            <div id="message-container-payments" class="mb-4"></div>
            <form action='../php/manage_payments.php' method='post' id="payment-form">
                <div class="grid gap-4 mb-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" id="name" name="name" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="total" class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                        <input type="number" id="total" name="total" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Bulan SPP</label>
                        <input type="text" id="month" name="month" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                    Tambah Pembayaran SPP
                </button>
            </form>
        </div>

        <!-- Table Pembayaran SPP -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Pembayaran SPP</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Waktu Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NISN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kelas Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bulan SPP</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="payment-table-body">
                    <?php
                    include '../php/db_connect.php';
                    $sql = "SELECT * FROM spp";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>{$row['Id']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>{$row['WaktuPembayaran']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$row['Nisn']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$row['NamaSiswa']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$row['KelasSiswa']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$row['TotalPembayaran']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$row['BulanSPP']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='px-6 py-4 text-center text-sm text-gray-500'>Tidak ada data pembayaran.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            $('#payment-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '../php/manage_payments.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#response-message').text(response.message).addClass('text-green-600');
                            $('#payment-form')[0].reset();
                        } else {
                            $('#response-message').text(response.message).addClass('text-red-600');
                        }
                    }
                });
            });
        });
    </script> -->
</body>
</html>
