
<?php
session_start();
require_once "config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Please enter your email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            header("Location: shop.php");
            exit;
        } else {
            $error = "Incorrect email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | SneakerVault</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #080b10;
    color: white;
    min-height: 100vh;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 8%;
    border-bottom: 1px solid #1c2932;
}

.logo {
    color: #00eaff;
    font-size: 25px;
    font-weight: bold;
    text-decoration: none;
    text-shadow: 0 0 12px #00eaff;
}

nav a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

nav a:hover {
    color: #00eaff;
}

.container {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
}

.login-box {
    width: 100%;
    max-width: 420px;
    padding: 40px;
    background: #101820;
    border: 1px solid #00d9ff;
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(0, 217, 255, 0.2);
}

.login-box h1 {
    text-align: center;
    margin-bottom: 10px;
    color: #00eaff;
}

.subtitle {
    text-align: center;
    color: #9baab5;
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
}

.input-group input {
    width: 100%;
    padding: 14px;
    background: #080b10;
    border: 1px solid #344550;
    border-radius: 8px;
    color: white;
    outline: none;
}

.input-group input:focus {
    border-color: #00eaff;
    box-shadow: 0 0 10px rgba(0, 234, 255, 0.2);
}

.login-btn {
    width: 100%;
    padding: 14px;
    background: #00d9ff;
    border: none;
    border-radius: 8px;
    color: #061016;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.login-btn:hover {
    background: white;
    box-shadow: 0 0 18px #00eaff;
}

.error {
    background: #401b22;
    color: #ff9aa8;
    padding: 12px;
    border-radius: 7px;
    margin-bottom: 20px;
    text-align: center;
}

.register-link {
    text-align: center;
    margin-top: 25px;
    color: #aab7c0;
}

.register-link a {
    color: #00eaff;
    text-decoration: none;
}

footer {
    text-align: center;
    padding: 20px;
    color: #65737e;
}
</style>
</head>

<body>

<nav>
    <a href="index.html" class="logo">SNEAKERVAULT</a>

    <div>
        <a href="index.html">HOME</a>
        <a href="shop.php">SHOP</a>
        <a href="cart.php">CART 🛒</a>
        <a href="register.php">REGISTER</a>
    </div>
</nav>

<div class="container">
    <div class="login-box">

        <h1>WELCOME BACK</h1>
        <p class="subtitle">Login to your SneakerVault account</p>

        <?php if (!empty($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET["registered"])): ?>
            <div style="color:#00eaff; text-align:center; margin-bottom:20px;">
                Account created! You can now log in.
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">

            <div class="input-group">
                <label>Email Address</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="input-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                LOGIN
            </button>

        </form>

        <div class="register-link">
            Don't have an account?
            <a href="register.php">Create Account</a>
        </div>

    </div>
</div>

<footer>
    © 2026 SneakerVault. All Rights Reserved.
</footer>

</body>
</html>
