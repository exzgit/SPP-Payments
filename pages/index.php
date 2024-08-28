<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP-Payment</title>
    
    <link rel="stylesheet" href="../source/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <?php require 'content/sidebar.php'; ?>
    
        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto scrollbar">
            <div id="dashboard" class="tab-content hidden">
                <?php require 'content/dashboard.php'; ?>
            </div>
            <div id="kelas" class="tab-content hidden">
                <?php require 'content/kelas.php'; ?>
            </div>
            <div id="siswa" class="tab-content hidden">
                <?php require 'content/siswa.php'; ?>
            </div>
            <div id="pembayaran" class="tab-content hidden">
                <?php require 'content/pembayaran.php'; ?>
            </div>
        </main>
    </div>


    <script src="../source/js/global.js"></script>

</body>
</html>
