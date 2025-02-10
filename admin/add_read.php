<?php
include '../koneksi/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['manga_id'])) {
        die("Error: Manga ID tidak dikirim.");
    }
    
    $manga_id = $_POST['manga_id'];


    $result = $conn->query("SELECT COALESCE(MAX(page_number), 0) + 1 AS next_page FROM manga_pages WHERE manga_id = $manga_id");
    if (!$result) {
        die("Query Error: " . $conn->error);
    }
    
    $row = $result->fetch_assoc();
    $page_number = $row['next_page'];

    $target_dir = "../read/";

    if (!is_dir($target_dir)) {
        die("<script>alert('Error: Folder read/ tidak ditemukan. Pastikan folder tersebut ada di dalam Website_Manga/.');</script>");
    }

    $file_name = basename($_FILES["file"]["name"]);
    $new_file_name = time() . "_" . $file_name;
    $target_file = $target_dir . $new_file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ["pdf", "jpg", "jpeg", "png", "gif"];
    if (!in_array($file_type, $allowed_types)) {
        echo "<script>alert('Hanya file PDF atau gambar (JPG, PNG, GIF) yang diperbolehkan.'); window.history.back();</script>";
        exit();
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $relative_path = "read/" . $new_file_name;
        $stmt = $conn->prepare("INSERT INTO manga_pages (manga_id, page_number, pdf_url) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $manga_id, $page_number, $relative_path);

        if ($stmt->execute()) {
            echo "<script>alert('Halaman baca berhasil ditambahkan!'); window.location.href='viewread.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan halaman baca.');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah file. Pastikan folder read/ memiliki izin yang cukup.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Halaman Baca</title>
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

        form {
            background: #2a2a3a;
            padding: 20px;
            width: 40%;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
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

    <h1>Tambah Halaman Baca</h1>
    <br>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="manga_id">Pilih Manga :</label>
        <br>
        <select name="manga_id" required>
    <option value="">Pilih Manga</option>
    <?php
    $result = $conn->query("SELECT id, title FROM manga ORDER BY id ASC");
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['title']}</option>";
    }
    ?>
</select>

        <label for="file">Unggah File :</label>
        <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.gif" required>

        <button type="submit">Tambah Halaman</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
