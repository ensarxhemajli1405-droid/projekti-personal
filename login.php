
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

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Inter, Arial, sans-serif;
}

body {
    background: #09090f;
    color: #f4f0fa;
    min-height: 100vh;
    overflow-x: hidden;
}

nav {
    height: 80px;
    padding: 0 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #0d0b15;
    border-bottom: 1px solid #a855f725;
}

.logo {
    color: #a855f7;
    font-size: 25px;
    font-weight: 900;
    letter-spacing: -1px;
    text-decoration: none;
}

.logo span {
    color: #f4f0fa;
}

nav a {
    color: #bcb4ca;
    text-decoration: none;
    margin-left: 25px;
    font-size: 13px;
    font-weight: 600;
    transition: .3s;
}

nav a:hover {
    color: #e879f9;
}

.container {
    min-height: calc(100vh - 145px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 20px;
    position: relative;
    overflow: hidden;
    background:
    radial-gradient(ellipse at 20% 50%, #35164c45, transparent 45%),
    radial-gradient(ellipse at 80% 40%, #9333ea25, transparent 45%);
}

.container:before {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    background: #a855f7;
    filter: blur(170px);
    opacity: .13;
    top: 15%;
    right: 15%;
}

.login-box {
    width: 100%;
    max-width: 440px;
    padding: 45px;
    background: linear-gradient(145deg, #21152f, #110d1c);
    border: 1px solid #a855f755;
    border-radius: 18px;
    box-shadow: 0 25px 70px #0008, 0 0 35px #9333ea18;
    position: relative;
    z-index: 2;
}

.login-box h1 {
    text-align: center;
    margin-bottom: 12px;
    font-size: 30px;
    font-weight: 900;
    color: #d879ff;
    letter-spacing: -1px;
}

.subtitle {
    text-align: center;
    color: #aaa2b8;
    margin-bottom: 35px;
    font-size: 13px;
}

.input-group {
    margin-bottom: 22px;
}

.input-group label {
    display: block;
    margin-bottom: 9px;
    font-size: 12px;
    font-weight: 700;
    color: #e4d6f3;
}

.input-group input {
    width: 100%;
    padding: 15px;
    background: #09090f;
    border: 1px solid #49345d;
    border-radius: 8px;
    color: white;
    outline: none;
    font-size: 13px;
    transition: .3s;
}

.input-group input::placeholder {
    color: #756a82;
}

.input-group input:focus {
    border-color: #c084fc;
    box-shadow: 0 0 15px #a855f730;
}

.login-btn {
    width: 100%;
    padding: 15px;
    background: linear-gradient(110deg, #9333ea, #c026d3);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 800;
    font-size: 13px;
    letter-spacing: 1px;
    cursor: pointer;
    transition: .3s;
    box-shadow: 0 8px 25px #9333ea35;
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px #c026d355;
}

.error {
    background: #401b35;
    border: 1px solid #e879f955;
    color: #ff9adf;
    padding: 13px;
    border-radius: 8px;
    margin-bottom: 22px;
    text-align: center;
    font-size: 13px;
}

.success {
    background: #251537;
    border: 1px solid #a855f755;
    color: #d879ff;
    padding: 13px;
    border-radius: 8px;
    margin-bottom: 22px;
    text-align: center;
    font-size: 13px;
}

.register-link {
    text-align: center;
    margin-top: 27px;
    color: #aaa2b8;
    font-size: 13px;
}

.register-link a {
    color: #e879f9;
    text-decoration: none;
    font-weight: 700;
}

.register-link a:hover {
    color: #c084fc;
}

footer {
    text-align: center;
    padding: 22px;
    background: #07060d;
    border-top: 1px solid #a855f725;
    color: #756a82;
    font-size: 11px;
}

@media(max-width:600px) {
    nav {
        height: auto;
        padding: 20px 5%;
        flex-direction: column;
        gap: 18px;
    }

    nav a {
        margin: 0 8px;
        font-size: 11px;
    }

    .login-box {
        padding: 30px 23px;
    }

    .login-box h1 {
        font-size: 26px;
    }
}
</style>
</head>

<body>

<nav>
    <a href="index.php" class="logo">SNEAKER<span>VAULT</span></a>

    <div>
        <a href="index.php">HOME</a>
        <a href="shop.php">SHOP</a>
        <a href="cart.php">CART</a>
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
            <div class="success">
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
