<?php
include '../koneksi/config.php';

$sql = "SELECT manga_pages.*, manga.title FROM manga_pages 
        JOIN manga ON manga_pages.manga_id = manga.id 
        ORDER BY manga_pages.manga_id, manga_pages.page_number";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Halaman Baca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: white;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            color: black;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background: #333;
            color: white;
        }
        a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .delete-btn {
            background-color: #dc3545;
            padding: 5px 10px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <h1>Daftar Halaman Baca</h1>
    <a href="add_read.php" style="background: green; padding: 10px; color: white; border-radius: 5px;">Tambah Halaman</a>

    <table>
        <tr>
            <th>No</th> <!-- Ganti ID dengan No Urut -->
            <th>Manga</th>
            <th>Nomor Halaman</th>
            <th>PDF</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1; // Mulai penomoran dari 1
        while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $no++; ?></td> <!-- Tampilkan nomor urut -->
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['page_number']; ?></td>
            <td><a href="<?php echo $row['pdf_url']; ?>" target="_blank">Lihat PDF</a></td>
            <td>
                <a href="delete_read.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus halaman ini?');" class="delete-btn">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
