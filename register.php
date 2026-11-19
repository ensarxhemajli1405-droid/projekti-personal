
<?php
session_start();
require_once "config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $password === "" || $confirmPassword === "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "This email is already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );

            $stmt->execute([$name, $email, $hashedPassword]);

            header("Location: login.php?registered=1");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | SneakerVault</title>

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

.register-box {
    width: 100%;
    max-width: 440px;
    padding: 40px;
    background: #101820;
    border: 1px solid #00d9ff;
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(0, 217, 255, 0.2);
}

.register-box h1 {
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
    margin-bottom: 18px;
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

.register-btn {
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

.register-btn:hover {
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

.login-link {
    text-align: center;
    margin-top: 25px;
    color: #aab7c0;
}

.login-link a {
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
        <a href="login.php">LOGIN</a>
    </div>
</nav>

<div class="container">
    <div class="register-box">

        <h1>CREATE ACCOUNT</h1>
        <p class="subtitle">Join the SneakerVault community</p>

        <?php if ($error !== ""): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">

            <div class="input-group">
                <label>Full Name</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Enter your full name"
                    value="<?= htmlspecialchars($name ?? '') ?>"
                    maxlength="100"
                    required
                >
            </div>

            <div class="input-group">
                <label>Email Address</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    value="<?= htmlspecialchars($email ?? '') ?>"
                    maxlength="150"
                    required
                >
            </div>

            <div class="input-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="At least 8 characters"
                    minlength="8"
                    required
                >
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Repeat your password"
                    minlength="8"
                    required
                >
            </div>

            <button type="submit" class="register-btn">
                CREATE ACCOUNT
            </button>

        </form>

        <div class="login-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </div>

    </div>
</div>

<footer>
    © 2026 SneakerVault. All Rights Reserved.
</footer>

</body>
</html>
