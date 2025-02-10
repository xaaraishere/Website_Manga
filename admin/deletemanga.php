<?php
include '../koneksi/config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM manga WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $conn->query("SET @count = 0;");
        $conn->query("UPDATE manga SET id = (@count := @count + 1);");

        $result = $conn->query("SELECT MAX(id) AS max_id FROM manga;");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'] ?? 0;


        $conn->query("ALTER TABLE manga AUTO_INCREMENT = " . ($max_id + 1) . ";");

        echo "<script>alert('Manga berhasil dihapus!'); window.location.href='viewmanga.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus manga.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>