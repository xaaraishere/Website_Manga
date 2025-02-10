<?php
include './koneksi/config.php';

$manga_id = isset($_GET['id']) ? intval($_GET['id']) : 1;


$sql = "SELECT pdf_url FROM manga_pages WHERE manga_id = $manga_id LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$pdf_url = $row ? $row["pdf_url"] : null;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga List</title>
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


        /* Agar konten tidak tertutup navbar */
        .content {
            padding-top: 70px;
        }

        /* Manga Cards Section */
        .manga-list {
            padding: 20px;
            background-color: #8f6060;
        }

        .manga-list h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .manga-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .manga-cards {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .manga-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .manga-cards {
                grid-template-columns: repeat(1, 1fr);
            }
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 5);
            text-align: center;
            padding-bottom: 15px;
            height: 250px; /* Menambah tinggi card */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card h3 {
            font-size: 20px;
            margin: 20px;
            color: black;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .card button {
            display: block;
            width: 80%;
            padding: 10px;
            margin: 25px auto;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .card button:hover {
            background-color: #555;
        }

        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body>

<header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <h1>MangaVERSE</h1>
        </div>
        <div class="search-bar">
    <form action="manga.php" method="GET" style="display: flex; width: 100%;">
        <input type="text" name="search" placeholder="Search Manga" value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
        <button type="submit">Search</button>
    </form>
</div>
        <nav>
            <a href="index.php">HOME</a>
            <a href="manga.php">MANGA</a>
            <a href="transaksi.php">BUY</a>
            <a href="help.php">HELP</a>
        </nav>
        <div class="auth-buttons">
            <a href="login.php">Login</a>
            <a href="registrasi.php">Register</a>
        </div>
    </header>

    <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT * FROM manga WHERE title LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%$search%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        ?>

        <hr /> 
        <hr>
        <hr>
       
<div class="content">
<div class="manga-list">
    <h2>List Of Manga</h2>
    </div>
    <div class="manga-cards">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';


        if ($search) {
            $sql = "SELECT * FROM manga WHERE title LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM manga";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card" style="background-image: url(' . $row["image"] . '); background-size: cover; background-position: center;">';
                echo '<div style="background-color: rgba(0, 0, 0, 0.5); padding: 10px;">';
                echo '<h3 style="color: white;">' . $row["title"] . '</h3>';
                echo '<p style="color: white;"><strong>IDR ' . number_format($row["price"], 0, ',', '.') . '</strong></p>';
                echo '<button class="zoom-button" onclick="window.location.href=\'transaksi.php?id=' . $row["id"] . '\'">Beli</button>';
                echo '<button class="zoom-button" onclick="window.location.href=\'listmanga.php?id=' . $row["id"] . '\'">Baca</button>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Tidak ada manga ditemukan.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
