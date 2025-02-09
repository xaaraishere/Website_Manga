<?php
include 'koneksi/config.php'; // Koneksi ke database

if (!isset($_GET['id'])) {
    echo "<script>alert('Transaksi tidak ditemukan.'); window.location.href='transaksi.php';</script>";
    exit();
}

$transaksi_id = $_GET['id'];
$query = "SELECT transaksi.id, transaksi.nama, transaksi.alamat, manga.title, manga.price, manga.image
          FROM transaksi 
          JOIN manga ON transaksi.manga_id = manga.id 
          WHERE transaksi.id = ?";

// Periksa apakah query berhasil disiapkan
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query Error: " . $conn->error); // Tampilkan pesan error jika query gagal
}

$stmt->bind_param("i", $transaksi_id);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

// Periksa apakah transaksi ditemukan
if (!$transaksi) {
    echo "<script>alert('Data transaksi tidak ditemukan.'); window.location.href='transaksi.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2e2e44;
            color: white;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #3a3a5a;
            padding: 20px;
            width: 50%;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }
        .btn {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background: #218838;
        }
        .manga-image {
            max-width: 200px;
            border-radius: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <h1>Konfirmasi Pembayaran</h1>

    <div class="container">
        <h2>Detail Transaksi</h2>
    <hr /> <br />
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($transaksi['nama']); ?></p>
        <p><strong>Alamat:</strong> <?php echo htmlspecialchars($transaksi['alamat']); ?></p>
        <p><strong>Manga yang Dibeli:</strong> <?php echo htmlspecialchars($transaksi['title']); ?></p>
        <p><strong>Total Harga:</strong> Rp <?php echo number_format($transaksi['price'], 0, ',', '.'); ?></p>
<br /><hr />
        <h3>Silakan Transfer ke Rekening:</h3>
        <p><strong>Bank BCA:</strong> 123-456-7890</p>
        <p><strong>Atas Nama:</strong> PT. MangaVerse</p>

        <a href="index.php" class="btn">Selesai</a>
    </div>

</body>
</html>
