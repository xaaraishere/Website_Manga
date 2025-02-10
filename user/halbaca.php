<?php
include '../koneksi/config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    <title>READ MANGA</title>
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

        .content-wrapper {
            margin-top: 100px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .comic-container {
            width: 100%;
            max-width: 900px;
            background-color: #2e2e44;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }

        footer {
            margin-top: 20px;
            color: #7a7a9a;
            font-size: 0.9rem;
        }
    </style>
</head>

    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <h1>MangaVERSE</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search Manga">
            <button>Search</button>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="manga.php">Manga</a>
            <a href="transaksi.php">BUY</a>
            <a href="help.php">Help</a>
            <?php
        if (!empty($_SESSION['user_id'])) {
            echo '<a href="profile.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">Hi, ' . htmlspecialchars($_SESSION['user_email']) . '</a>';
            echo '<a href="logout.php" style="background-color: red; padding: 10px 15px; border-radius: 5px;">Logout</a>';
        } else {
            echo '<a href="login.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">Register/Login</a>';
        }
        ?>
        </nav>
        <div class="auth-buttons">
        </div>
    </header>

    <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        if ($search) {
            $sql = "SELECT * FROM manga WHERE title LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM manga";
        }
        ?>

    <body>
        <div class="content-wrapper">
    <div class="comic-container">
        <?php
        if ($pdf_url) {
            echo '<iframe src="' . $pdf_url . '"></.iframe>';
        } else {
            echo "<p>No PDF available.</p>";
        }
        $conn->close();
        ?>
    </div>
    </div>
</body>
</html>