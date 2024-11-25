<?php include '../../includes/db.php'; ?>

<?php
$id = $_GET['id'];
$conn->query("DELETE FROM mahasiswa WHERE id = $id");
header('Location: ../manage_data.php');
exit;
?>
