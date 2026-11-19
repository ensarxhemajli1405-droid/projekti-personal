
<?php
header("Content-Type: application/json; charset=UTF-8");

try {
    require_once __DIR__ . "/config/database.php";

    $stmt = $pdo->query(
        "SELECT id, name, price, image FROM products ORDER BY id DESC LIMIT 8"
    );

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}
