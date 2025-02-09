<?php
include './koneksi/config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query SQL dengan search filter
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM manga WHERE title LIKE ?");
    $likeSearch = "%" . $search . "%";
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM manga";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Manga</title>
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
            background-color: #555;
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
            color: #999;
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
            background-color: #555;
        }

        .manga-container { 
            display: grid; 
            grid-template-columns: repeat(2, 1fr);
            gap: 20px; 
            max-width: 900px;
            margin: auto; 
            padding: 20px;
            justify-content: center;
        }

        .manga-item { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex; 
            gap: 15px;
            width: 450px; 
            align-items: center;
            transition: all 0.3s ease;
        }

        .manga-item img { 
            width: 50%; 
            height: 400px; 
            object-fit: cover;
            border-radius: 10px;
        }

        .manga-info {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
        }

        .manga-title {
            font-size: 1.4em;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .manga-description {
            font-size: 0.9em;
            color: #555;
        }

        .read-button {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 8px 12px;
            margin-top: 10px;
            border-radius: 5px;
            text-align: center;
            width: max-content;
        }

        .read-button:hover {
            background-color: #555;
        }

        @media (max-width: 800px) {
            .manga-container {
                grid-template-columns: 1fr;
            }
            .manga-item {
                width: 100%;
                flex-direction: column;
                text-align: center;
            }
            .manga-item img {
                width: 100%;
                height: 200px;
            }
            .manga-info {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
        <h1>MangaVERSE</h1>
    </div>

    <form class="search-bar" method="GET">
        <input type="text" name="search" placeholder="Search Manga" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <nav>
        <a href="index.php">Home</a>
        <a href="manga.php">Manga</a>
        <a href="transaksi.php">Buy</a>
        <a href="help.php">Help</a>
    </nav>

    <div class="auth-buttons">
        <a href="login.php">Login</a>
        <a href="registrasi.php">Register</a>
    </div>
</header>

<br><br><br><br><br><br>

<h1>Daftar Manga</h1>
<div class="manga-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
        <div class="manga-item">
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
            <div class="manga-info">
                <div class="manga-title" style="color: black;"><?php echo $row['title']; ?></div>
                <p class="manga-description" style="color: black;">
                    <?php echo substr($row['description'], 0, 100); ?>...
                </p>
                <p class="full-description" style="color: black; display: none;">
                    <?php echo $row['description']; ?>
                </p>
                <span class="show-more" onclick="toggleDescription(this)" style="color: blue; cursor: pointer;">Lihat Selengkapnya</span>
                <a href="halbaca.php?id=<?php echo $row['id']; ?>" class="read-button">Baca</a>
            </div>
        </div>
      
        <?php }
    } else {
        echo "<p>Tidak ada manga ditemukan.</p>";
    }
    ?>
</div>
<script>
        function toggleDescription(el) {
            let fullDesc = el.previousElementSibling;
            let shortDesc = fullDesc.previousElementSibling;
            let mangaItem = el.closest(".manga-item");

            if (fullDesc.style.display === "none" || fullDesc.style.display === "") {
                fullDesc.style.display = "block"; 
                shortDesc.style.display = "none"; 
                mangaItem.style.height = "auto"; /* Biarkan tinggi menyesuaikan */
                el.textContent = "Sembunyikan";
            } else {
                fullDesc.style.display = "none"; 
                shortDesc.style.display = "-webkit-box"; 
                mangaItem.style.height = ""; /* Kembali ke ukuran default */
                el.textContent = "Lihat Selengkapnya";
            }
        }
    </script>

</body>
</html>

<?php $conn->close(); ?>
