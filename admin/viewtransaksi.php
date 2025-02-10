<?php
include '../koneksi/config.php';

$sql = "SELECT transaksi.id, transaksi.nama, transaksi.alamat, manga.title, transaksi.tanggal_transaksi 
        FROM transaksi 
        JOIN manga ON transaksi.manga_id = manga.id 
        ORDER BY transaksi.tanggal_transaksi DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #1e1e2f;
            color: #f3f3f3;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #101820;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-bottom: 3px solid #333333;
            z-index: 1000;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
        }

        .logo img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
        }

        .logo h1 {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: #20232a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 5px 10px;
            flex: 0.7;
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            color: #ffffff;
            padding: 5px;
            width: 100%;
        }

        .search-bar input::placeholder {
            color: #aaaaaa;
        }

        .search-bar button {
            background-color: #333333;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #333333;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px 20px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #333333;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
            padding: 10px 20px;
        }

        .auth-buttons a {
            background-color: #333333;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .auth-buttons a:hover {
            background-color: #333333;
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
    </style>
</head>
<header>

        <div class="logo">
            <img src="../images/logo.png" alt="Logo">
            <h1>MangaVERSE</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search Manga">
            <button>Search</button>
        </div>
        <nav>
                <a href="index.php">HOME</a>
                <a href="viewmanga.php">MANGA LIST</a>
                <a href="viewread.php">LIST READ</a>
                <a href="viewhelp.php">HELP</a>
        </nav>
        <div class="auth-buttons">
            <a href="./login.php">Login</a>
        </div>
    </header>
    <br><br><br><br>

<br>
<body>
    <h1>Daftar Transaksi</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Manga</th>
            <th>Tanggal Transaksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['tanggal_transaksi']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
