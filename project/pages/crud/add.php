<?php include '../../includes/header.php'; ?>
<?php include '../../includes/db.php'; ?>

<?php
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $no_telp = $_POST['no_telp'];
    $fakultas = $_POST['fakultas'];

    $result = $conn->query("INSERT INTO mahasiswa (nama, jenis_kelamin, umur, no_telp, fakultas) 
                  VALUES ('$nama', '$jenis_kelamin', $umur, '$no_telp', '$fakultas')");

    if ($result) {
        $success = true;
    }
}
?>

<?php if ($success): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data mahasiswa berhasil ditambahkan.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../manage_data.php'; // Redirect setelah klik "OK"
    });
</script>
<?php endif; ?>

<h2 class="text-3xl font-extrabold mb-6 text-center text-gray-200">Tambah Data Mahasiswa</h2>

<div class="flex justify-center">
    <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg">
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-400 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-400 mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="umur" class="block text-sm font-medium text-gray-400 mb-1">Umur</label>
            <input type="number" name="umur" id="umur" placeholder="Masukkan Umur" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="no_telp" class="block text-sm font-medium text-gray-400 mb-1">No Telepon</label>
            <input type="text" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telepon" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="fakultas" class="block text-sm font-medium text-gray-400 mb-1">Fakultas</label>
            <select name="fakultas" id="fakultas" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
                <option value="" disabled selected>Pilih Fakultas</option>
                <option value="FAKULTAS ILMU SOSIAL DAN POLITIK">FAKULTAS ILMU SOSIAL DAN POLITIK</option>
                <option value="FAKULTAS EKONOMI DAN BISNIS">FAKULTAS EKONOMI DAN BISNIS</option>
                <option value="FAKULTAS VOKASI">FAKULTAS VOKASI</option>
                <option value="FAKULTAS HUKUM">FAKULTAS HUKUM</option>
                <option value="FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM">FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</option>
                <option value="FAKULTAS TEKNIK">FAKULTAS TEKNIK</option>
            </select>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 px-6 py-2 rounded text-white font-bold hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
