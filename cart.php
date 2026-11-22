
<?php
session_start();
require_once "config/database.php";

// Initialize cart
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Update or remove products
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";
    $id = (int)($_POST["product_id"] ?? 0);

    if ($action === "remove") {
        unset($_SESSION["cart"][$id]);
    }

    if ($action === "update") {
        $quantity = (int)($_POST["quantity"] ?? 1);

        if ($quantity <= 0) {
            unset($_SESSION["cart"][$id]);
        } else {
            $_SESSION["cart"][$id] = min(10, $quantity);
        }
    }

    header("Location: cart.php");
    exit;
}

// Get cart products from database
$items = [];
$total = 0;

if (!empty($_SESSION["cart"])) {
    $ids = array_keys($_SESSION["cart"]);
    $placeholders = implode(",", array_fill(0, count($ids), "?"));

    $stmt = $pdo->prepare(
        "SELECT * FROM products WHERE id IN ($placeholders)"
    );

    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $id = (int)$product["id"];
        $quantity = (int)$_SESSION["cart"][$id];
        $price = (float)$product["price"];
        $subtotal = $price * $quantity;

        $total += $subtotal;

        $items[] = [
            "product" => $product,
            "quantity" => $quantity,
            "subtotal" => $subtotal
        ];
    }
}

// Your sneaker image paths
$productImages = [
    "Nike Air Force 1" => "images/images (2).png",
    "Nike Air Max 90" => "images/images.png",
    "Nike Dunk Low" => "images/images (3).png",
    "Nike Air Max 97" => "images/images (4).png",
    "Adidas Samba OG" => "images/images (5).png",
    "Adidas Campus 00s" => "images/images (6).png",
    "Adidas Gazelle" => "images/images3.png",
    "Adidas Ultraboost" => "images/images44.png"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shopping Cart | SneakerVault</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    background: #080b10;
    color: white;
    font-family: Arial, sans-serif;
}

header {
    padding: 22px 8%;
    background: #0d131c;
    border-bottom: 1px solid #00d9ff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    color: #00eaff;
    font-size: 25px;
    font-weight: bold;
    text-decoration: none;
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
    max-width: 1100px;
    margin: 50px auto;
    padding: 20px;
}

h1 {
    color: #00eaff;
    margin-bottom: 30px;
}

.cart-item {
    display: grid;
    grid-template-columns: 160px 1fr 180px;
    gap: 25px;
    align-items: center;
    background: #111923;
    border: 1px solid #263943;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 20px;
}

.cart-item img {
    width: 160px;
    height: 130px;
    object-fit: contain;
    background: #080b10;
    border-radius: 10px;
}

.product-name {
    font-size: 20px;
    margin-bottom: 10px;
}

.price {
    color: #00eaff;
    font-weight: bold;
    font-size: 19px;
}

.quantity-form input {
    width: 65px;
    padding: 10px;
    background: #080b10;
    color: white;
    border: 1px solid #00d9ff;
    border-radius: 6px;
}

button, .shop-btn {
    padding: 11px 16px;
    border: none;
    border-radius: 7px;
    background: #00d9ff;
    color: #001014;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}

.remove-btn {
    background: #ff4d5a;
    margin-top: 10px;
}

.total-box {
    text-align: right;
    background: #111923;
    border: 1px solid #00d9ff;
    border-radius: 12px;
    padding: 25px;
    margin-top: 30px;
}

.total-box h2 {
    font-size: 28px;
}

.empty {
    text-align: center;
    padding: 60px 20px;
    background: #111923;
    border-radius: 15px;
}

.empty p {
    color: #aaa;
    margin-bottom: 25px;
}

@media(max-width: 700px) {
    header {
        flex-direction: column;
        gap: 15px;
    }

    nav a {
        margin: 0 7px;
    }

    .cart-item {
        grid-template-columns: 100px 1fr;
        gap: 15px;
    }

    .cart-item img {
        width: 100px;
        height: 100px;
    }

    .cart-actions {
        grid-column: 1 / -1;
    }
}
</style>
</head>

<body>

<header>
    <a href="index.php" class="logo">SNEAKERVAULT</a>

    <nav>
        <a href="index.php">HOME</a>
        <a href="shop.php">SHOP</a>
        <a href="cart.php">CART</a>
        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="logout.php">LOGOUT</a>
        <?php else: ?>
            <a href="login.php">LOGIN</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">

<h1>YOUR SHOPPING CART</h1>

<?php if (empty($items)): ?>

    <div class="empty">
        <h2>Your cart is empty!</h2>
        <p>You haven't added any sneakers yet.</p>
        <a href="shop.php" class="shop-btn">START SHOPPING</a>
    </div>

<?php else: ?>

    <?php foreach ($items as $item):

        $product = $item["product"];
        $id = (int)$product["id"];
        $name = $product["name"];

        $image = $productImages[$name]
            ?? ($product["image"] ?? "");

    ?>

    <div class="cart-item">

        <img
            src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
        >

        <div>
            <h3 class="product-name">
                <?= htmlspecialchars($name) ?>
            </h3>

            <p class="price">
                €<?= number_format((float)$product["price"], 2) ?>
            </p>

            <p>
                Subtotal:
                €<?= number_format($item["subtotal"], 2) ?>
            </p>
        </div>

        <div class="cart-actions">

            <form method="POST" class="quantity-form">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="product_id" value="<?= $id ?>">

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    max="10"
                    value="<?= $item["quantity"] ?>"
                >

                <button type="submit">UPDATE</button>
            </form>

            <form method="POST">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="product_id" value="<?= $id ?>">

                <button type="submit" class="remove-btn">
                    REMOVE
                </button>
            </form>

        </div>

    </div>

    <?php endforeach; ?>

    <div class="total-box">
        <h2>
            TOTAL:
            <span class="price">
                €<?= number_format($total, 2) ?>
            </span>
        </h2>

        <?php if (isset($_SESSION["user_id"])): ?>

            <p>
                Welcome,
                <?= htmlspecialchars($_SESSION["user_name"]) ?>!
            </p>

            <p>Checkout and payment will be connected next.</p>

        <?php else: ?>

            <p>Please log in before checkout.</p>
            <a href="login.php" class="shop-btn">LOGIN</a>

        <?php endif; ?>

        <br><br>
        <a href="shop.php" class="shop-btn">CONTINUE SHOPPING</a>
    </div>

<?php endif; ?>

</div>

</body>
</html>
