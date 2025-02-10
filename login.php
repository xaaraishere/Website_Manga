<?php
session_start();
include './koneksi/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Ambil pilihan role (user/admin)

    if ($role == "user") {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM admins WHERE email = ?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if ($role == "user") {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_email'] = $email;
                echo "<script>alert('Login User Berhasil!'); window.location.href='user/index.php';</script>";
            } else {
                $_SESSION['admin_id'] = $id;
                $_SESSION['admin_email'] = $email;
                echo "<script>alert('Login Admin Berhasil!'); window.location.href='admin/index.php';</script>";
            }
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: poppins, sans-serif;
            background: url('images/bganime.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

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
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
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

        .login-form input, .login-form select {
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
<body>
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
            <a href="registrasi.php">REGISTER</a>
        </div>
    </nav>

    <div class="login-container">
        <div class="login-form">
            <h2>LOGIN</h2>
            <form action="login.php" method="post">
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>