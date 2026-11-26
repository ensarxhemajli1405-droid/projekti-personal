
<?php
session_start();
require_once "config/database.php";

$error = "";

$name = "";
$email = "";

if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";
    $csrfToken = $_POST["csrf_token"] ?? "";

    if (!hash_equals($_SESSION["csrf_token"], $csrfToken)) {
        $error = "Invalid request. Please refresh the page.";

    } elseif (
        $name === "" ||
        $email === "" ||
        $password === "" ||
        $confirmPassword === ""
    ) {
        $error = "Please fill in all fields.";

    } elseif (strlen($name) > 100) {
        $error = "Name is too long.";

    } elseif (strlen($email) > 150 ||
              !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";

    } elseif (strlen($password) > 4096) {
        $error = "Password is too long.";

    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";

    } else {
        try {

            $stmt = $pdo->prepare(
                "SELECT id FROM users WHERE email = ? LIMIT 1"
            );

            $stmt->execute([$email]);

            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $error = "This email is already registered.";

            } else {
             
    

               
                

              
                $stmt = $pdo->prepare(
                    "INSERT INTO users (name, email, password)
                     VALUES (?, ?, ?)"
                );

                $stmt->execute([
                    $name,
                    $email,
                    $password,
                ]);

              
                $_SESSION["csrf_token"] = bin2hex(random_bytes(32));

                header("Location: login.php?registered=1");
                exit;
            }

        } catch (PDOException $e) {
         
            error_log($e->getMessage());
            $error = "Something went wrong. Please try again.";
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
    background: #09090F;
    color: #F4F0FA;
    min-height: 100vh;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 8%;
    border-bottom: 1px solid #292037;
    background: #0D0B14;
}

.logo {
    color: #A855F7;
    font-size: 25px;
    font-weight: bold;
    text-decoration: none;
    text-shadow: 0 0 12px #9333EA;
}

nav a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    transition: 0.3s;
}

nav a:hover {
    color: #C084FC;
}

.container {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    background: radial-gradient(
        circle at center,
        #21152F 0%,
        #09090F 65%
    );
}

.register-box {
    width: 100%;
    max-width: 440px;
    padding: 40px;
    background: linear-gradient(145deg, #1D1628, #110E19);
    border: 1px solid #9333EA;
    border-radius: 18px;
    box-shadow: 0 0 35px rgba(147, 51, 234, 0.2);
}

.register-box h1 {
    text-align: center;
    margin-bottom: 10px;
    color: #C084FC;
}

.subtitle {
    text-align: center;
    color: #A99BB8;
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 18px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    color: #E9D5FF;
}

.input-group input {
    width: 100%;
    padding: 14px;
    background: #0D0B14;
    border: 1px solid #453354;
    border-radius: 8px;
    color: white;
    outline: none;
    transition: 0.3s;
}

.input-group input:focus {
    border-color: #A855F7;
    box-shadow: 0 0 12px rgba(168, 85, 247, 0.25);
}

.register-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(90deg, #9333EA, #C026D3);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.register-btn:hover {
    background: linear-gradient(90deg, #A855F7, #E879F9);
    box-shadow: 0 0 20px rgba(168, 85, 247, 0.4);
    transform: translateY(-2px);
}

.error {
    background: #401B35;
    color: #F9A8D4;
    padding: 12px;
    border-radius: 7px;
    margin-bottom: 20px;
    text-align: center;
    border: 1px solid #9D174D;
}

.login-link {
    text-align: center;
    margin-top: 25px;
    color: #A99BB8;
}

.login-link a {
    color: #C084FC;
    text-decoration: none;
}

.login-link a:hover {
    color: #E879F9;
}

footer {
    text-align: center;
    padding: 20px;
    color: #74677F;
    border-top: 1px solid #292037;
}

@media (max-width: 600px) {
    nav {
        flex-direction: column;
        gap: 18px;
    }

    nav a {
        margin: 0 7px;
        font-size: 13px;
    }

    .register-box {
        padding: 28px 22px;
    }
}
</style>
</head>

<body>

<nav>
    <a href="index.php" class="logo">SNEAKERVAULT</a>

    <div>
        <a href="index.php">HOME</a>
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
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars(
                    $_SESSION["csrf_token"],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            >

            <div class="input-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your full name"
                    value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="100"
                    required
                >
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="150"
                    required
                >
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="At least 8 characters"
                    minlength="8"
                    maxlength="4096"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Repeat your password"
                    minlength="8"
                    maxlength="4096"
                    autocomplete="new-password"
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
