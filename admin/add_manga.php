<?php
include '../koneksi/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../images/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $image_path = "images/" . $image_name;


        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }


        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $stmt = $conn->prepare("INSERT INTO manga (title, image, description, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $title, $image_path, $description, $price);

            if ($stmt->execute()) {
                echo "<script>alert('Manga berhasil ditambahkan!'); window.location.href='viewmanga.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data ke database.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal mengupload gambar.');</script>";
        }
    } else {
        echo "<script>alert('Harap pilih gambar sebelum menambahkan manga.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Manga</title>
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

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
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
    
    <br>
    <br>
    <br>
    <br>

<body>
    <div class="container">
        <h2 style="color: black;">Tambah Manga Baru</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Judul Manga" required>
            <textarea name="description" placeholder="Deskripsi" rows="5" required></textarea>
            <input type="number" name="price" placeholder="Harga (IDR)" step="0.01" required>
            <input type="file" name="image" accept="image/*" required style="color: black;">
            <button type="submit">Tambah Manga</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
