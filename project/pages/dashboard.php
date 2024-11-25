<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php'); // Jika user belum login, arahkan ke login
    exit;
}
$date = date('l, d F Y');

// Query untuk mendapatkan data mahasiswa per fakultas
$result = $conn->query("SELECT COUNT(*) as total, fakultas FROM mahasiswa GROUP BY fakultas");
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Query untuk mendapatkan total mahasiswa
$totalResult = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
$totalMahasiswa = $totalResult->fetch_assoc()['total'];
?>

<div class="p-6">
<h2 class="text-3xl font-bold mb-4">Dashboard</h2>

<h3 class="text-xl text-gray-200 font-semibold mb-4">Selamat datang, Muhammad Farhan Nabil</h3>

<div class="flex flex-col md:flex-row justify-between items-left md:items-start mb-6">
    <p class="text-gray-400 text-lg">Today is: <?= $date; ?></p>
    <p id="time" class="text-gray-400 font-mono text-lg"></p>
</div>


    <!-- Kartu Total Mahasiswa -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-800 p-6 rounded shadow">
            <h3 class="text-lg font-bold">Total Mahasiswa</h3>
            <p class="text-3xl"><?= $totalMahasiswa; ?> Mahasiswa</p>
        </div>
    </div>

    <!-- Kartu Mahasiswa per Fakultas -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($data as $fakultas): ?>
            <div class="bg-gray-800 p-6 rounded shadow">
                <h3 class="text-lg font-bold"><?= $fakultas['fakultas']; ?></h3>
                <p class="text-3xl"><?= $fakultas['total']; ?> Mahasiswa</p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Grafik Mahasiswa per Fakultas -->
    <div class="mt-8 bg-gray-800 p-6 rounded shadow">
        <h3 class="text-xl font-bold mb-4">Grafik Mahasiswa per Fakultas</h3>
        <canvas id="barChart"></canvas>
    </div>

    <!-- Grafik Distribusi Mahasiswa (Pie Chart) -->
    <div class="mt-8 bg-gray-800 p-6 rounded shadow">
        <h3 class="text-xl font-bold mb-4">Mahasiswa Aktif</h3>
        <canvas id="pieChart"></canvas>
    </div>
</div>

<script>
    function updateTime() {
        const timeElement = document.getElementById('time');
        const now = new Date();
        const timeString = now.toLocaleTimeString(); 
        timeElement.textContent = `Jam: ${timeString}`;
    }
    setInterval(updateTime, 1000); // 

    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($data, 'fakultas')); ?>,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: <?= json_encode(array_column($data, 'total')); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Data untuk grafik pie
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_column($data, 'fakultas')); ?>,
            datasets: [{
                label: 'Distribusi Mahasiswa',
                data: <?= json_encode(array_column($data, 'total')); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
</script>

<?php include '../includes/footer.php'; ?>
