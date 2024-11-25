<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php'); 
    exit;
}
$result = $conn->query("SELECT * FROM mahasiswa");
?>

<h2 class="text-2xl font-bold mb-4">Manage Data</h2>
<a href="crud/add.php" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Add Data</a>

<table class="w-full mt-6 bg-gray-800 rounded shadow text-white">
    <thead>
        <tr>
            <th class="p-2 text-left border-b border-gray-700">Nama</th>
            <th class="p-2 text-left border-b border-gray-700">Jenis Kelamin</th>
            <th class="p-2 text-left border-b border-gray-700">Umur</th>
            <th class="p-2 text-left border-b border-gray-700">No Telp</th>
            <th class="p-2 text-left border-b border-gray-700">Fakultas</th>
            <th class="p-2 text-left border-b border-gray-700">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td class="p-2"><?= $row['nama']; ?></td>
            <td class="p-2"><?= $row['jenis_kelamin']; ?></td>
            <td class="p-2"><?= $row['umur']; ?></td>
            <td class="p-2"><?= $row['no_telp']; ?></td>
            <td class="p-2"><?= $row['fakultas']; ?></td>
            <td class="p-2">
                <a href="crud/edit.php?id=<?= $row['id']; ?>" class="text-blue-400 hover:underline">Edit</a> |
                <a href="crud/delete.php?id=<?= $row['id']; ?>" class="text-red-400 hover:underline">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>