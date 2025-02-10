<?php
include '../koneksi/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $manga_id = $_POST['manga_id'];


    $stmt = $conn->prepare("INSERT INTO transaksi (nama, alamat, manga_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama, $alamat, $manga_id);

    if ($stmt->execute()) {
        $transaksi_id = $conn->insert_id;
        header("Location: pembayaran.php?id=$transaksi_id");
        exit();
    } else {
        echo "<script>alert('Gagal melakukan transaksi.'); window.location.href='transaksi.php';</script>";
    }
}

$conn->close();
?>
