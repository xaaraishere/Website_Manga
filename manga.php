<?php
include './koneksi/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga List</title>
    <style>
        body {
            margin: 0;
            font-family: poppins, sans-serif;
            background-color: #d9b4af;
            color: #fff;
        }

        /* Navbar */
        nav {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            border-radius: 60%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .nav-container {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }

        .search-bar {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar input {
            width: 300px;
            padding: 8px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        .search-bar button {
            padding: 8px 12px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #777;
        }

        .menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #555;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding-bottom: 15px;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card h3 {
            font-size: 16px;
            margin: 10px;
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
            margin: 5px auto;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
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
    <nav>
        <div class="nav-container">
            <!-- Logo -->
            <div class="logo">
                <img src="images/original.png" alt="Logo">
                <span>MangaVERSE</span>
            </div>

            <!-- Search Bar di Tengah -->
            <form class="search-bar" action="manga.php" method="GET">
                <input type="text" name="search" placeholder="Cari manga...">
                <button type="submit">Search</button>
            </form>

            <!-- Menu -->
            <div class="menu">
                <a href="index.php">HOME</a>
                <a href="manga.php">MANGA</a>
                <a href="transaksi.php">BUY</a>
                <a href="help.php">HELP</a>
                <a href="login.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">Register/Login</a>
            </div>
        </div>
    </nav>
</header>

<div class="content">
    
<div class="manga-list">
    <h2>List Of Manga</h2>
    </div>
    <div class="manga-cards">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Query SQL
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
                echo '<button class="zoom-button" onclick="window.location.href=\'beli.php?id=' . $row["id"] . '\'">Beli</button>';
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
