
<?php
session_start();
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Shoe not found. Please go back to the shop.");
}

$productImages = [
    "Nike Air Force 1" => "images/images (2).png",
    "Nike Air Max 90" => "images/images.png",
    "Nike Dunk Low" => "images/images (3).png",
    "Nike Air Max 97" => "images/images (4).png",
    "Adidas Samba OG" => "images/images (5).png",
    "Adidas Campus 00s" => "images/images (6).png",
    "Adidas Gazelle" => "images/images3.png",
    "Adidas Ultraboost" => "images/images44.png"

    "Nike Air Jordan 4" => "https://images.unsplash.com/photo-1552346154-21d32810aba3?w=600",
    "Nike Air Max 270" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600",
    "Nike Blazer Mid" => "https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=600",
    "Nike Dunk Low" => "https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=600",
    "Adidas Superstar" => "https://images.unsplash.com/photo-1556906781-9a412961c28c?w=600",
    "New Balance 550" => "https://images.unsplash.com/photo-1539185441755-769473a23570?w=600",
    "Puma RS-X" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600",
    "Converse Chuck Taylor" => "https://images.unsplash.com/photo-1495555961986-6d4c1ecb7be3?w=600"
];



$image = $productImages[$product['name']] ?? $product['image'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($product['name']) ?> | SneakerVault</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    background: #080b10;
    color: white;
    font-family: Arial, sans-serif;
}

header {
    padding: 22px 8%;
    border-bottom: 1px solid #1b2933;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header a {
    color: #00eaff;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
}

nav a {
    margin-left: 20px;
}

.container {
    max-width: 1100px;
    margin: 60px auto;
    padding: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: center;
}

.photo {
    background: #111923;
    border: 1px solid #00d9ff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 0 25px #00d9ff22;
}

.photo img {
    width: 100%;
    height: 420px;
    object-fit: contain;
}

.details h1 {
    font-size: 38px;
    margin-bottom: 15px;
}

.price {
    color: #00eaff;
    font-size: 30px;
    font-weight: bold;
}

.description {
    color: #b8c3cc;
    line-height: 1.8;
    margin: 25px 0;
}

.quantity {
    display: block;
    margin-bottom: 10px;
}

.quantity input {
    width: 75px;
    padding: 12px;
    background: #111923;
    color: white;
    border: 1px solid #00d9ff;
    border-radius: 7px;
    margin-top: 8px;
}

.add-cart {
    display: block;
    width: 100%;
    max-width: 300px;
    padding: 15px;
    margin: 18px 0;
    background: #00d9ff;
    color: #001014;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.add-cart:hover {
    background: white;
    box-shadow: 0 0 20px #00d9ff;
}

.back {
    display: inline-block;
    background: #202d38;
    color: white;
    padding: 14px 25px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

.back:hover {
    background: #344653;
}

@media(max-width: 700px) {
    .container {
        grid-template-columns: 1fr;
    }

    .photo img {
        height: 300px;
    }

    header {
        flex-direction: column;
        gap: 15px;
    }

    nav a {
        margin: 0 8px;
    }
}
</style>
</head>

<body>

<header>
    <a href="index.php">SNEAKERVAULT</a>

    <nav>
        <a href="shop.php">SHOP</a>
        <a href="cart.php">CART 🛒</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">LOGOUT</a>
        <?php else: ?>
            <a href="login.php">LOGIN</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">

    <div class="photo">
        <img
            src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div class="details">

        <h1><?= htmlspecialchars($product['name']) ?></h1>

        <div class="price">
            €<?= number_format((float)$product['price'], 2) ?>
        </div>

        <p class="description">
            <?= nl2br(htmlspecialchars($product['description'] ?? 'No description available.')) ?>
        </p>

        <form action="add-to-cart.php" method="POST">

            <input
                type="hidden"
                name="product_id"
                value="<?= (int)$product['id'] ?>"
            >

            <label class="quantity">
                Quantity:
                <input
                    type="number"
                    name="quantity"
                    value="1"
                    min="1"
                    max="10"
                    required
                >
            </label>

            <button type="submit" class="add-cart">
                🛒 ADD TO CART
            </button>

        </form>

        <a href="shop.php" class="back">
            ← BACK TO SHOP
        </a>

    </div>

</div>

</body>
</html>
