<?php
include './koneksi/config.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('images/bganime.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        nav {
            width: 100%;
            height: 60px;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px);
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

        .login-form .remember {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 10px;
        }

        .login-form .remember input {
            width: auto;
            margin-right: 5px;
        }

        .login-form .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }

        .login-form .forgot-password a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .login-form .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/original.png" alt="logo">
            <a href="index.php">MangaVERSE</a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search Manga">
            <a href="index.php">HOME</a>
            <a href="manga.php">MANGA</a>
            <a href="transaksi.php">BUY</a>
            <a href="help.php">HELP</a>
            <a href="login.php">Login</a>
        </div>
    </nav>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Cek apakah email sudah terdaftar
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.'); window.location.href='register.html';</script>";
    } else {
        // Simpan user baru
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat registrasi. Coba lagi!'); window.location.href='register.html';</script>";
        }
        $stmt->close();
    }
    $checkEmail->close();
}

$conn->close();
?>
