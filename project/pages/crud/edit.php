<?php include '../../includes/header.php'; ?>
<?php include '../../includes/db.php'; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mahasiswa WHERE id = $id")->fetch_assoc();

$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $no_telp = $_POST['no_telp'];
    $fakultas = $_POST['fakultas'];

    $result = $conn->query("UPDATE mahasiswa SET 
                  nama = '$nama', 
                  jenis_kelamin = '$jenis_kelamin', 
                  umur = $umur, 
                  no_telp = '$no_telp', 
                  fakultas = '$fakultas' 
                  WHERE id = $id");

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
        text: 'Data mahasiswa berhasil diperbarui.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '../manage_data.php'; // Redirect setelah klik "OK"
    });
</script>
<?php endif; ?>

<h2 class="text-3xl font-extrabold mb-6 text-center text-gray-200">Edit Data Mahasiswa</h2>

<div class="flex justify-center">
    <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg">
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-400 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $data['nama']; ?>" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-400 mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="umur" class="block text-sm font-medium text-gray-400 mb-1">Umur</label>
            <input type="number" name="umur" id="umur" value="<?= $data['umur']; ?>" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="no_telp" class="block text-sm font-medium text-gray-400 mb-1">No Telepon</label>
            <input type="text" name="no_telp" id="no_telp" value="<?= $data['no_telp']; ?>" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="fakultas" class="block text-sm font-medium text-gray-400 mb-1">Fakultas</label>
            <select name="fakultas" id="fakultas" 
                class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white" required>
                <option value="FAKULTAS ILMU SOSIAL DAN POLITIK" <?= $data['fakultas'] == 'FAKULTAS ILMU SOSIAL DAN POLITIK' ? 'selected' : ''; ?>>FAKULTAS ILMU SOSIAL DAN POLITIK</option>
                <option value="FAKULTAS EKONOMI DAN BISNIS" <?= $data['fakultas'] == 'FAKULTAS EKONOMI DAN BISNIS' ? 'selected' : ''; ?>>FAKULTAS EKONOMI DAN BISNIS</option>
                <option value="FAKULTAS VOKASI" <?= $data['fakultas'] == 'FAKULTAS VOKASI' ? 'selected' : ''; ?>>FAKULTAS VOKASI</option>
                <option value="FAKULTAS HUKUM" <?= $data['fakultas'] == 'FAKULTAS HUKUM' ? 'selected' : ''; ?>>FAKULTAS HUKUM</option>
                <option value="FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM" <?= $data['fakultas'] == 'FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM' ? 'selected' : ''; ?>>FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</option>
                <option value="FAKULTAS TEKNIK" <?= $data['fakultas'] == 'FAKULTAS TEKNIK' ? 'selected' : ''; ?>>FAKULTAS TEKNIK</option>
            </select>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 px-6 py-2 rounded text-white font-bold hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
