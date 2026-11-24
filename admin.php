<?php
session_start();
require_once "config/database.php";

$adminPassword = "ChangeThisAdmin123!";
$error = "";
$message = "";

$productImages = [
    "Nike Air Force 1" => "images/images (2).png",
    "Nike Air Max 90" => "images/images.png",
    "Nike Dunk Low" => "images/images (3).png",
    "Nike Air Max 97" => "images/images (4).png",
    "Adidas Samba OG" => "images/images (5).png",
    "Adidas Campus 00s" => "images/images (6).png",
    "Adidas Gazelle" => "images/images3.png",
    "Adidas Ultraboost" => "images/images44.png",
    "air jordan 1" => "images/sneaker.png",
    "air jordan 1 retro" => "images/sneaker1.png",
        "Air Jordan 2" => "images/shoe1.png",
    "Air Jordan 3" => "images/shoe2.png",
    "Air Jordan 4" => "images/shoe3.png",
];

if (!isset($_SESSION["admin_logged_in"])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["admin_password"])) {
        if (hash_equals($adminPassword, $_POST["admin_password"])) {
            session_regenerate_id(true);
            $_SESSION["admin_logged_in"] = true;
            header("Location: admin.php");
            exit;
        } else {
            $error = "Incorrect admin password.";
        }
    }
} else {
    if (isset($_GET["logout"])) {
        unset($_SESSION["admin_logged_in"]);
        header("Location: admin.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $action = $_POST["action"] ?? "";

        if ($action === "add" || $action === "edit") {
            $name = trim($_POST["name"] ?? "");
            $price = (float)($_POST["price"] ?? 0);
            $image = trim($_POST["image"] ?? "");

            if ($name === "" || $price <= 0 || $image === "") {
                $error = "Please enter valid product details.";
            } else {
                if ($action === "add") {
                    $stmt = $pdo->prepare(
                        "INSERT INTO products (name, price, image) VALUES (?, ?, ?)"
                    );
                    $stmt->execute([$name, $price, $image]);
                    $message = "Product added successfully!";
                } else {
                    $id = (int)($_POST["id"] ?? 0);
                    $stmt = $pdo->prepare(
                        "UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?"
                    );
                    $stmt->execute([$name, $price, $image, $id]);
                    $message = "Product updated successfully!";
                }
            }
        }

        if ($action === "delete") {
            $id = (int)($_POST["id"] ?? 0);
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $message = "Product deleted successfully!";
        }
    }

    $editProduct = null;

    if (isset($_GET["edit"])) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([(int)$_GET["edit"]]);
        $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $products = $pdo->query("SELECT * FROM products ORDER BY id DESC")
                    ->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel | SneakerVault</title>

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
    padding: 22px 7%;
    background: #0D0B14;
    border-bottom: 1px solid #292037;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    color: #A855F7;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
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
    max-width: 1100px;
    margin: 45px auto;
    padding: 20px;
}

h1 {
    color: #C084FC;
    margin-bottom: 10px;
}

.subtitle {
    color: #A99BB8;
    margin-bottom: 30px;
}

.panel {
    background: #171326;
    border: 1px solid #453354;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 30px;
}

h2 {
    color: #C084FC;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 13px;
    margin-bottom: 15px;
    background: #09090F;
    border: 1px solid #453354;
    border-radius: 7px;
    color: white;
    outline: none;
}

input:focus {
    border-color: #A855F7;
}

button, .edit-btn {
    padding: 11px 18px;
    border: none;
    border-radius: 7px;
    background: linear-gradient(90deg, #9333EA, #C026D3);
    color: white;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}

button:hover, .edit-btn:hover {
    opacity: 0.8;
}

.delete-btn {
    background: #991B45;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 15px 10px;
    border-bottom: 1px solid #342641;
    text-align: left;
}

th {
    color: #C084FC;
}

td {
    color: #DDD4E8;
}

td img {
    width: 65px;
    height: 55px;
    object-fit: contain;
    background: #0D0B14;
    border-radius: 7px;
}

.actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.actions form {
    display: inline;
}

.error, .message {
    padding: 13px;
    border-radius: 7px;
    margin-bottom: 20px;
}

.error {
    background: #401B35;
    color: #F9A8D4;
}

.message {
    background: #192C25;
    color: #86EFAC;
}

.login-box {
    max-width: 400px;
    margin: 100px auto;
    padding: 35px;
    background: #171326;
    border: 1px solid #9333EA;
    border-radius: 15px;
    box-shadow: 0 0 30px #9333EA22;
}

.login-box h1 {
    text-align: center;
    margin-bottom: 25px;
}

.login-box button {
    width: 100%;
}

@media(max-width: 700px) {
    .container {
        padding: 12px;
    }

    .panel {
        overflow-x: auto;
    }

    table {
        min-width: 650px;
    }

    nav {
        flex-direction: column;
        gap: 15px;
    }
}
</style>
</head>

<body>

<nav>
    <a href="index.php" class="logo">SNEAKERVAULT ADMIN</a>

    <div>
        <a href="index.php">HOME</a>
        <a href="shop.php">SHOP</a>

        <?php if (isset($_SESSION["admin_logged_in"])): ?>
            <a href="admin.php?logout=1">LOGOUT</a>
        <?php endif; ?>
    </div>
</nav>

<?php if (!isset($_SESSION["admin_logged_in"])): ?>

<div class="login-box">
    <h1>ADMIN LOGIN</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="password" name="admin_password"
               placeholder="Enter admin password" required>
        <button type="submit">LOGIN</button>
    </form>
</div>

<?php else: ?>

<div class="container">

    <h1>Dashboard</h1>
    <p class="subtitle">Manage your SneakerVault products</p>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="panel">
        <h2><?= $editProduct ? "Edit Product" : "Add New Product" ?></h2>

        <form method="POST">
            <input type="hidden" name="action"
                   value="<?= $editProduct ? 'edit' : 'add' ?>">

            <?php if ($editProduct): ?>
                <input type="hidden" name="id"
                       value="<?= (int)$editProduct['id'] ?>">
            <?php endif; ?>

            <input type="text" name="name"
                   placeholder="Product name"
                   value="<?= htmlspecialchars($editProduct['name'] ?? '') ?>"
                   required>

            <input type="number" name="price" step="0.01" min="0.01"
                   placeholder="Price"
                   value="<?= htmlspecialchars($editProduct['price'] ?? '') ?>"
                   required>

            <input type="text" name="image"
                   placeholder="Image path (e.g. images/sneaker.png)"
                   value="<?= htmlspecialchars(
                       $editProduct
                       ? ($productImages[$editProduct['name']] ?? $editProduct['image'])
                       : ''
                   ) ?>"
                   required>

            <button type="submit">
                <?= $editProduct ? "UPDATE PRODUCT" : "ADD PRODUCT" ?>
            </button>

            <?php if ($editProduct): ?>
                <a href="admin.php" class="edit-btn">CANCEL</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="panel">
        <h2>All Products (<?= count($products) ?>)</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= (int)$product['id'] ?></td>

                <td>
                    <?php
                    $image = $productImages[$product['name']] ?? $product['image'];
                    ?>
                    <img src="<?= htmlspecialchars($image) ?>" alt="Sneaker">
                </td>

                <td><?= htmlspecialchars($product['name']) ?></td>

                <td>€<?= number_format((float)$product['price'], 2) ?></td>

                <td>
                    <div class="actions">
                        <a class="edit-btn"
                           href="admin.php?edit=<?= (int)$product['id'] ?>">
                            EDIT
                        </a>

                        <form method="POST"
                              onsubmit="return confirm('Delete this product?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id"
                                   value="<?= (int)$product['id'] ?>">
                            <button class="delete-btn" type="submit">
                                DELETE
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>

<?php endif; ?>

</body>
</html>