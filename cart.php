
<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int)($_POST["product_id"] ?? 0);
    $action = $_POST["action"] ?? "";

    if ($action === "remove") unset($_SESSION["cart"][$id]);

    if ($action === "update") {
        $qty = (int)($_POST["quantity"] ?? 1);
        if ($qty <= 0) unset($_SESSION["cart"][$id]);
        else $_SESSION["cart"][$id] = min(10, $qty);
    }

    header("Location: cart.php");
    exit;
}

$items = [];
$total = 0;

if ($_SESSION["cart"]) {
    $ids = array_keys($_SESSION["cart"]);
    $marks = implode(",", array_fill(0, count($ids), "?"));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
    $stmt->execute($ids);

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $product) {
        $id = (int)$product["id"];
        $qty = (int)$_SESSION["cart"][$id];
        $subtotal = (float)$product["price"] * $qty;
        $total += $subtotal;
        $items[] = compact("product", "qty", "subtotal");
    }
}

$productImages = [
    "Nike Air Force 1" => "images/images (2).png",
    "Nike Air Max 90" => "images/images.png",
    "Nike Dunk Low" => "images/images (3).png",
    "Nike Air Max 97" => "images/images (4).png",
    "Adidas Samba OG" => "images/images (5).png",
    "Adidas Campus 00s" => "images/images (6).png",
    "Adidas Gazelle" => "images/images3.png",
    "Adidas Ultraboost" => "images/images44.png",
    "Air Jordan 2" => "images/shoe1.png",
    "Air Jordan 3" => "images/shoe2.png",
    "Air Jordan 4" => "images/shoe3.png",
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart | SneakerVault</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,Arial}
body{background:#09090f;color:#f4f0fa}
header{padding:22px 8%;background:#0d0b15;border-bottom:1px solid #a855f725;display:flex;justify-content:space-between;align-items:center}
.logo{font-size:25px;font-weight:900;color:#a855f7;text-decoration:none}
nav{display:flex;gap:25px}
nav a{color:#bcb4ca;text-decoration:none;font-size:12px;font-weight:700}
nav a:hover{color:#e879f9}
.container{max-width:1100px;margin:55px auto;padding:20px}
h1{font-size:34px;margin-bottom:30px}
h1 span,.price{color:#d879ff}
.cart-item,.total-box,.empty{background:linear-gradient(145deg,#21152f,#120e1c);border:1px solid #a855f735;border-radius:14px;padding:22px;margin-bottom:20px}
.cart-item{display:grid;grid-template-columns:150px 1fr 190px;gap:25px;align-items:center;transition:.3s}
.cart-item:hover{border-color:#c084fc;transform:translateY(-3px)}
.cart-item img{width:150px;height:125px;object-fit:contain;background:#09090f;border-radius:10px}
.product-name{font-size:18px;margin-bottom:12px}
.price{font-size:19px;font-weight:800}
.subtotal{color:#aaa2b8;font-size:13px;margin-top:12px}
input{width:60px;padding:11px;background:#09090f;color:white;border:1px solid #70449a;border-radius:6px}
button,.shop-btn{padding:11px 14px;border:0;border-radius:7px;background:linear-gradient(110deg,#9333ea,#c026d3);color:white;font-weight:800;font-size:11px;cursor:pointer;text-decoration:none;display:inline-block}
button:hover,.shop-btn:hover{box-shadow:0 0 15px #a855f755}
.remove-btn{background:#682044;margin-top:10px}
.total-box{text-align:right;margin-top:30px;padding:28px}
.total-box h2{margin-bottom:15px}
.total-box p,.empty p{color:#aaa2b8;font-size:13px;margin-bottom:18px}
.empty{text-align:center;padding:65px 20px}
.empty h2{margin-bottom:12px}
footer{text-align:center;padding:23px;background:#07060d;border-top:1px solid #a855f725;color:#756a82;font-size:11px;margin-top:60px}
@media(max-width:700px){
header{flex-direction:column;gap:18px}
nav{gap:15px}
.container{margin:25px auto}
.cart-item{grid-template-columns:100px 1fr;gap:15px}
.cart-item img{width:100px;height:100px}
.cart-actions{grid-column:1/-1}
.total-box{text-align:center}
}
@media(max-width:400px){
.cart-item{grid-template-columns:1fr;text-align:center}
.cart-item img{width:100%;height:150px}
.cart-actions{grid-column:auto}
}
</style>
</head>

<body>

<header>
<a href="index.php" class="logo">SNEAKER<span style="color:#f4f0fa">VAULT</span></a>
<nav>
<a href="index.php">HOME</a>
<a href="shop.php">SHOP</a>
<a href="cart.php">CART</a>
<?php if(isset($_SESSION["user_id"])): ?>
<a href="logout.php">LOGOUT</a>
<?php else: ?>
<a href="login.php">LOGIN</a>
<?php endif; ?>
</nav>
</header>

<div class="container">
<h1>YOUR <span>SHOPPING CART</span></h1>

<?php if(empty($items)): ?>
<div class="empty">
<h2>Your cart is empty!</h2>
<p>You haven't added any sneakers yet.</p>
<a href="shop.php" class="shop-btn">START SHOPPING</a>
</div>

<?php else: ?>
<?php foreach($items as $item):
$p = $item["product"];
$id = (int)$p["id"];
$name = $p["name"];
$image = $productImages[$name] ?? ($p["image"] ?? "");
?>

<div class="cart-item">
<img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>">

<div>
<h3 class="product-name"><?= htmlspecialchars($name) ?></h3>
<p class="price">€<?= number_format((float)$p["price"],2) ?></p>
<p class="subtotal">Subtotal: €<?= number_format($item["subtotal"],2) ?></p>
</div>

<div class="cart-actions">
<form method="POST">
<input type="hidden" name="action" value="update">
<input type="hidden" name="product_id" value="<?= $id ?>">
<input type="number" name="quantity" min="1" max="10" value="<?= $item["qty"] ?>">
<button>UPDATE</button>
</form>

<form method="POST">
<input type="hidden" name="action" value="remove">
<input type="hidden" name="product_id" value="<?= $id ?>">
<button class="remove-btn">REMOVE</button>
</form>
</div>
</div>

<?php endforeach; ?>

<div class="total-box">
<h2>TOTAL: <span class="price">€<?= number_format($total,2) ?></span></h2>

<?php if(isset($_SESSION["user_id"])): ?>
<p>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?>!</p>
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

<footer>© 2026 SneakerVault. All Rights Reserved.</footer>

</body>
</html>
