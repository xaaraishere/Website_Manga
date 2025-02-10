<?php
include '../koneksi/config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaVERSE</title>
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

        nav .logo {
            display: flex;
            align-items: center;
        }

        nav .logo img {
            border-radius: 60%;
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }

        nav .menu {
            display: flex;
            gap: 15px;
        }

        nav .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 5px;
        }

        nav .menu a:hover {
            background-color: #555;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding: 60px 20px;
        }

        .header h1 {
            font-size: 48px;
            margin: 0;
        }

        .header p {
            font-size: 18px;
            margin: 20px 0;
        }

        .header button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        .header button:hover {
            background-color: #555;
        }

        /* Manga Cards */
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
            grid-template-columns: repeat(5, 1fr); /* 4 manga per baris */
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

        
    </style>
</head>
<body>


<nav>   
    <div class="logo">
        <img src="../images/original.png" alt="Logo">
        <span>MangaVERSE</span>
    </div>
    <div class="menu">
        <a href="index.php">HOME</a>
        <a href="manga.php">MANGA</a>
        <a href="transaksi.php">BUY</a>
        <a href="help.php">HELP</a>

        <?php
        if (!empty($_SESSION['user_id'])) {
            echo '<a href="profile.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">Hi, ' . htmlspecialchars($_SESSION['user_email']) . '</a>';
            echo '<a href="logout.php" style="background-color: red; padding: 10px 15px; border-radius: 5px;">Logout</a>';
        } else {
            echo '<a href="login.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">Register/Login</a>';
        }
        ?>
    </div>
</nav>

    <div class="header">
        <h1>MangaVERSE</h1>
        <a href="manga.php"><button>Read Manga</button></a>
        <p>Read Premium Manga uploads frequently as per Schedule<br>Your Trusted Online Manga Reading Services</p>
    </div>

    <div class="manga-cards">
        <?php
        $sql = "SELECT * FROM manga";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="../' . $row["image"] . '" alt="' . $row["title"] . '">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '</div>';
            }
        } else {
            echo "<p>Tidak ada manga tersedia.</p>";
        }

        $conn->close();
        ?>
    </div>
    
    </div>
</body>
</html>