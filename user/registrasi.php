<?php
include '../koneksi/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.'); window.location.href='registrasi.php';</script>";
    } else {
        // Simpan data user baru
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat registrasi. Coba lagi!'); window.location.href='registrasi.php';</script>";
        }
        $stmt->close();
    }
    $checkEmail->close();
}

$conn->close();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <style>
       body {
            margin: 0;
            font-family: poppins, sans-serif;
            background: url('images/bganime.jpg') no-repeat center center fixed;
            background-size: cover;
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

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
            color: #333;
        }

        .login-form h2 {
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<nav>
        <div class="logo">
            <img src="images/original.png" alt="Logo">
            <span>MangaVERSE</span>
        </div>
        <div class="menu">
            <a href="index.php">HOME</a>
            <a href="manga.php">MANGA</a>
            <a href="transaksi.php">BUY</a>
            <a href="help.php">HELP</a>
            <a href="login.php" style="background-color: #555; padding: 10px 15px; border-radius: 5px;">LOGIN</a>
        </div>
    </nav>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2>REGISTER</h2>
            <form action="registrasi.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">REGISTER</button>
</form>
        </div>
    </div>


</body>
