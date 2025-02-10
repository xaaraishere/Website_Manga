<?php

include '../koneksi/config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM manga WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $manga = $result->fetch_assoc();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_path = $manga['image'];


    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../images/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $image_path = "images/" . $image_name;


        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            if (!empty($manga['image']) && file_exists("../" . $manga['image'])) {
                unlink("../" . $manga['image']);
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar.');</script>";
        }
    }


    $stmt = $conn->prepare("UPDATE manga SET title=?, image=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("sssdi", $title, $image_path, $description, $price, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Manga berhasil diperbarui!'); window.location.href='viewmanga.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate manga.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manga</title>
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
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            color: black;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
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
    
    <br>
    <br>
    <br>
    <br>



<body>

    <div style="text-align: center;">
    <h1>Edit Manga</h1>
    <a href="viewManga.php" style="background: black; padding: 10px; display: inline-block; color: white; border-radius: 5px;">KEMBALI</a>
    </div>
    
    <div style="text-align: center;">
<form method="post" enctype="multipart/form-data">
    <label>Judul</label>
    <input type="text" name="title" value="<?php echo $manga['title']; ?>" required>
    
    <label>Gambar</label>
    <input type="file" name="image">
    <img src="../<?php echo $manga['image']; ?>" width="75" style="display:block;margin:10px auto;">
    
    <label>Deskripsi</label>
    <textarea name="description" rows="10" required><?php echo $manga['description']; ?></textarea>
    
    <label>Harga</label>
    <input type="number" name="price" value="<?php echo $manga['price']; ?>" required>
    
    <button type="submit" style="background: black; padding: 10px; display: inline-block; color: white; border-radius: 5px;">Simpan Perubahan</button>
    <a href="viewManga.php" style="background: black; padding: 10px; display: inline-block; color: white; border-radius: 5px;">KEMBALI</a>
</form>
    </div>

</body>
</html>