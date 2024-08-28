<?php
include '../php/db_connect.php'; // Pastikan file ini menghubungkan ke database Anda

// Query untuk mendapatkan Total Siswa
$sql_total_siswa = "SELECT COUNT(*) AS total_siswa FROM siswa";
$result_total_siswa = $conn->query($sql_total_siswa);
$row_total_siswa = $result_total_siswa->fetch_assoc();
$total_siswa = $row_total_siswa['total_siswa'];

// Query untuk mendapatkan Total Kelas
$sql_total_kelas = "SELECT COUNT(DISTINCT Kelas) AS total_kelas FROM siswa";
$result_total_kelas = $conn->query($sql_total_kelas);
$row_total_kelas = $result_total_kelas->fetch_assoc();
$total_kelas = $row_total_kelas['total_kelas'];

// Query untuk mendapatkan Total Pemasukan
$sql_total_pemasukan = "SELECT SUM(TotalPembayaran) AS total_pemasukan FROM spp";
$result_total_pemasukan = $conn->query($sql_total_pemasukan);
$row_total_pemasukan = $result_total_pemasukan->fetch_assoc();
$total_pemasukan = $row_total_pemasukan['total_pemasukan'];

// Query untuk mendapatkan Top 5 Siswa yang Paling Sering Membayar SPP
$sql_top_siswa = "
SELECT s.Id, s.Nisn, s.NamaSiswa, COUNT(sp.Id) AS total_bayar
FROM siswa s
JOIN spp sp ON s.Nisn = sp.Nisn
GROUP BY s.Id, s.Nisn, s.NamaSiswa
ORDER BY total_bayar DESC
LIMIT 5
";
$result_top_siswa = $conn->query($sql_top_siswa);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../source/style/style.css">
</head>
<body>
    <div class="w-full">
        <h1 class="text-center font-bold text-3xl text-gray-200 bg-gray-700 p-16 rounded">Dashboard Statistic</h1>
        <div class="flex justify-center items-center">
            <div class="flex justify-center gap-4 px-4 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:px-8">
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-green-400"><svg class="h-12 w-12 text-white" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M65.84,98.563l80.867,37.22v48.028h218.582v-48.028l33.424-15.38v85.07c-5.423,0.776-9.606,5.458-9.606,11.087 c0,4.899,3.166,9.146,7.717,10.621l-8.216,54.239c-0.252,1.646,0.225,3.315,1.318,4.581c1.089,1.258,2.665,1.98,4.319,1.98h29.963 c1.654,0,3.23-0.722,4.328-1.988c1.081-1.266,1.557-2.927,1.308-4.573l-8.216-54.239c4.552-1.475,7.715-5.722,7.715-10.621 c0-5.629-4.183-10.31-9.606-11.087v-94.751l26.426-12.158c2.982-1.382,4.909-4.394,4.909-7.671c0-3.284-1.927-6.297-4.91-7.663 L273.855,3.913C268.213,1.32,262.205,0,255.998,0c-6.207,0-12.213,1.32-17.851,3.913L65.842,83.229 c-2.985,1.374-4.915,4.379-4.915,7.663C60.927,94.169,62.855,97.181,65.84,98.563z"></path> <path class="st0" d="M410.518,413.569l-77.193-31.537c-12.284-5.644-20.221-18.028-20.221-31.553v-11.366 c0-5.225,0.862-10.365,2.331-14.852c0.423-0.567,42.372-57.127,48.202-112.88l0.182-1.755H148.175l0.184,1.755 c5.842,55.753,47.777,112.313,47.972,112.445c1.702,4.93,2.566,10.07,2.566,15.287v11.366c0,13.517-7.941,25.9-20.165,31.522 L101.43,413.6c-18.408,8.455-31.562,25.396-35.21,45.481L62.127,512h387.748l-4.109-53.082 C442.119,438.988,428.965,422.047,410.518,413.569z"></path> </g> </g></svg>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Siswa</h3>
                        <p class="text-3xl"><?php echo number_format($total_siswa); ?></p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-blue-400"><svg class="h-12 w-12 text-white" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M81.44,116.972c23.206,0,42.007-18.817,42.007-42.008c0-23.215-18.801-42.016-42.007-42.016 c-23.216,0-42.016,18.801-42.016,42.016C39.424,98.155,58.224,116.972,81.44,116.972z"></path> <path class="st0" d="M224.166,245.037c0-0.856-0.142-1.673-0.251-2.498l62.748-45.541c3.942-2.867,4.83-8.411,1.963-12.362 c-1.664-2.285-4.342-3.652-7.17-3.652c-1.877,0-3.667,0.589-5.191,1.689l-62.874,45.636c-2.341-1.068-4.909-1.704-7.65-1.704 h-34.178l-8.294-47.222c-4.555-23.811-14.112-42.51-34.468-42.51h-86.3C22.146,136.873,0,159.019,0,179.383v141.203 c0,10.178,8.246,18.432,18.424,18.432c5.011,0,0,0,12.864,0l7.005,120.424c0,10.83,8.788,19.61,19.618,19.61 c8.12,0,28.398,0,39.228,0c10.83,0,19.61-8.78,19.61-19.61l9.204-238.53h0.463l5.27,23.269c1.744,11.097,11.293,19.28,22.524,19.28 h51.534C215.92,263.461,224.166,255.215,224.166,245.037z M68.026,218.861v-67.123h24.126v67.123l-12.817,15.118L68.026,218.861z"></path> <polygon class="st0" points="190.326,47.47 190.326,200.869 214.452,200.869 214.452,71.595 487.874,71.595 487.874,302.131 214.452,302.131 214.452,273.113 190.326,273.113 190.326,326.256 512,326.256 512,47.47 "></polygon> <path class="st0" d="M311.81,388.597c0-18.801-15.235-34.029-34.028-34.029c-18.801,0-34.036,15.228-34.036,34.029 c0,18.785,15.235,34.028,34.036,34.028C296.574,422.625,311.81,407.381,311.81,388.597z"></path> <path class="st0" d="M277.781,440.853c-24.259,0-44.866,15.919-52.782,38.199h105.565 C322.648,456.771,302.04,440.853,277.781,440.853z"></path> <path class="st0" d="M458.573,388.597c0-18.801-15.235-34.029-34.028-34.029c-18.801,0-34.036,15.228-34.036,34.029 c0,18.785,15.235,34.028,34.036,34.028C443.338,422.625,458.573,407.381,458.573,388.597z"></path> <path class="st0" d="M424.545,440.853c-24.259,0-44.866,15.919-52.783,38.199h105.565 C469.411,456.771,448.804,440.853,424.545,440.853z"></path> </g> </g></svg></svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Kelas</h3>
                        <p class="text-3xl"><?php echo number_format($total_kelas); ?></p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-indigo-400"><svg  class="h-12 w-12 text-white"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M3 10L3 8C3 6.89543 3.89543 6 5 6L7 6M3 10C4.33333 10 7 9.2 7 6M3 10L3 14M21 10V8C21 6.89543 20.1046 6 19 6H17M21 10C19.6667 10 17 9.2 17 6M21 10V14M7 6L17 6M21 14V16C21 17.1046 20.1046 18 19 18H17M21 14C19.6667 14 17 14.8 17 18M17 18H7M3 14L3 16C3 17.1046 3.89543 18 5 18H7M3 14C4.33333 14 7 14.8 7 18" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><circle cx="12" cy="12" r="2" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle></g></svg>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider">Total Pemasukan</h3>
                        <p class="text-3xl"><?php echo number_format($total_pemasukan, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-5xl mt-16 mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($row = $result_top_siswa->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['Id']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['Nisn']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['NamaSiswa']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['total_bayar']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>