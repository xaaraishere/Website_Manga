<?php
include '../koneksi/config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $conn->query("SET @count = 0");
        $conn->query("UPDATE feedback SET id = @count := @count + 1");
        $conn->query("ALTER TABLE feedback AUTO_INCREMENT = 1");

        echo "<script>alert('Saran/Keluhan berhasil dihapus!'); window.location.href='viewhelp.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus saran.');</script>";
    }
}

$sql = "SELECT * FROM feedback ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keluhan & Saran</title>
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
            text-align: left;
        }
        th {
            background-color: #444;
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
    
    <br>
    <br>
    <br>
    <br>



<body>
<div style="text-align: center;">
        <h1>KING Admin Manga</h1>
        <h1>Keluhan & Saran</h1>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <a href="viewhelp.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus saran ini?');" class="delete-btn">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>