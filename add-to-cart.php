
<?php
session_start();
require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: shop.php");
    exit;
}

$productId = (int)($_POST["product_id"] ?? 0);
$quantity = (int)($_POST["quantity"] ?? 1);

$quantity = max(1, min(10, $quantity));

// Check if product exists
$stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
$stmt->execute([$productId]);

if (!$stmt->fetch()) {
    die("Product not found!");
}

// Create cart if it doesn't exist
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Add product to cart
$currentQuantity = $_SESSION["cart"][$productId] ?? 0;

$_SESSION["cart"][$productId] = min(10, $currentQuantity + $quantity);

// Redirect to cart
header("Location: cart.php?added=1");
exit;
