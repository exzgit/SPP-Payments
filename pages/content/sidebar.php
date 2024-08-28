<aside class="w-64 bg-gray-800 text-white p-4">
    <div class="flex items-center mb-8">
        <h1 class="text-xl font-semibold">SPP Dashboard</h1>
    </div>
    <nav>
        <label for="general" class="block bg-gray-600 p-2 rounded mt-2 text-xl font-bold">General</label>
        <ul id="general" class="border-l mx-2 pt-2">
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded-r" onclick="showTab('dashboard')">Dashboard</a></li>
        </ul>
        <label for="master-data" class="block bg-gray-600 p-2 rounded mt-2 text-xl font-bold">Master Data</label>
        <ul id="master-data" class="border-l mx-2 pt-2">
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded-r" onclick="showTab('kelas')">Kelas</a></li>
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded-r" onclick="showTab('siswa')">Siswa</a></li>
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded-r" onclick="showTab('pembayaran')">Pembayaran</a></li>
        </ul>
    </nav>
</aside>