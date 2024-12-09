<?php
require 'database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: profile.php");
        exit;
    } else {
        echo "<p style='color:red;'>Login gagal. Username atau password salah.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sarastya Technology</title>
    <style>
        /* Reset beberapa default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: black; /* Latar belakang hitam */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-box {
            background-color: black; /* Latar belakang box hitam */
            padding: 40px;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: white; /* Teks putih */
        }

        .input-group {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ccc;
            background-color: #333; /* Background input hitam */
            color: white; /* Teks putih */
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: white; /* Border putih saat fokus */
        }

        button.btn {
            background-color: white; /* Tombol putih */
            color: black; /* Teks hitam */
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        button.btn:hover {
            background-color: #333; /* Latar belakang abu gelap saat hover */
            color: white; /* Teks putih saat hover */
        }

        p {
            margin-top: 20px;
            font-size: 14px;
            color: white; /* Teks putih */
        }

        a {
            color: white; /* Link putih */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
