<?php
include '../koneksi/config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Query untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Pesan berhasil dikirim!');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal mengirim pesan.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Page</title>
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
            padding: 20px;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #101820;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            padding: 0 20px;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
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

        nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #aaa;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin-top: 100px;
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
    <nav>
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
    </nav>
</header>

<body>
    <div class="container">
        <h2 style="color: black;">Keluhan & Saran</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" placeholder="Masukkan keluhan atau saran" rows="5" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
