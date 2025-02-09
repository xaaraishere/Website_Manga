<?php
include '../koneksi/config.php'; // Koneksi ke database

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='view_read.php';</script>";
    exit();
}

$page_id = $_GET['id'];

// Ambil informasi file sebelum menghapus data dari database
$query = "SELECT pdf_url FROM manga_pages WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $page_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href='view_read.php';</script>";
    exit();
}

$file_path = $data['pdf_url'];
if (file_exists($file_path)) {
    unlink($file_path);
}

// Hapus data dari database
$query = "DELETE FROM manga_pages WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $page_id);

if ($stmt->execute()) {
    echo "<script>alert('Halaman baca berhasil dihapus!'); window.location.href='viewread.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus halaman baca.'); window.location.href='viewread.php';</script>";
}

$stmt->close();
$conn->close();
?>
