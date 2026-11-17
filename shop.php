
<?php
require_once "config/database.php";

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop | SneakerVault</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #080808;
    color: white;
}

header {
    background: #050505;
    border-bottom: 1px solid #222;
    padding: 22px 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 27px;
    font-weight: 900;
    letter-spacing: 2px;
}

.logo span {
    color: #00f7ff;
    text-shadow: 0 0 12px #00f7ff;
}

nav a {
    color: #ddd;
    text-decoration: none;
    margin-left: 20px;
    font-size: 13px;
}

nav a:hover {
    color: #00f7ff;
    text-shadow: 0 0 10px #00f7ff;
}

.hero {
    text-align: center;
    padding: 65px 20px;
    background: radial-gradient(ellipse, #103033, #080808 70%);
}

.hero h1 {
    font-size: clamp(35px, 6vw, 60px);
    margin-bottom: 15px;
}

.hero h1 span {
    color: #00f7ff;
    text-shadow: 0 0 15px #00f7ff;
}

.hero p {
    color: #aaa;
}

.shop {
    padding: 55px 8%;
}

.top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 35px;
}

.top h2 {
    font-size: 28px;
}

.top h2 span {
    color: #00f7ff;
}

.search {
    background: #111;
    border: 1px solid #333;
    color: white;
    padding: 13px 18px;
    border-radius: 6px;
    width: 270px;
    outline: none;
}

.search:focus {
    border-color: #00f7ff;
    box-shadow: 0 0 10px #00f7ff44;
}

.grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 25px;
}

.card {
    background: #111;
    border: 1px solid #242424;
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    padding-bottom: 22px;
    transition: .3s;
}

.card:hover {
    transform: translateY(-7px);
    border-color: #00f7ff;
    box-shadow: 0 0 20px #00f7ff33;
}

.card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    background: #191919;
}

.card h3 {
    margin: 18px 10px 10px;
    font-size: 17px;
}

.price {
    color: #00f7ff;
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 18px;
}

.card a {
    display: inline-block;
    background: #00f7ff;
    color: black;
    padding: 12px 25px;
    text-decoration: none;
    font-weight: bold;
    font-size: 12px;
    border-radius: 5px;
}

.card a:hover {
    box-shadow: 0 0 15px #00f7ff;
}

.empty {
    text-align: center;
    color: #aaa;
    padding: 50px;
    grid-column: 1 / -1;
}

footer {
    text-align: center;
    padding: 30px;
    background: #050505;
    color: #777;
    font-size: 13px;
    margin-top: 50px;
}

@media(max-width: 900px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 600px) {
    header {
        flex-direction: column;
        gap: 20px;
    }

    nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    nav a {
        margin: 0;
    }

    .grid {
        grid-template-columns: 1fr;
    }

    .shop {
        padding: 40px 6%;
    }

    .search {
        width: 100%;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">SNEAKER<span>VAULT</span></div>

    <nav>
        <a href="index.html">HOME</a>
        <a href="shop.php">SHOP</a>
        <a href="cart.php">CART</a>
        <a href="login.php">LOGIN</a>
        <a href="register.php">REGISTER</a>
    </nav>
</header>

<section class="hero">
    <h1>OUR <span>COLLECTION.</span></h1>
    <p>Find your next favourite sneakers.</p>
</section>

<section class="shop">

    <div class="top">
        <h2>ALL <span>SNEAKERS</span></h2>

        <input
            type="text"
            id="search"
            class="search"
            placeholder="Search sneakers..."
        >
    </div>

    <div class="grid" id="productGrid">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $product): ?>

                <div class="card"
                     data-name="<?= htmlspecialchars($product['name']) ?>">

                    <img
                        src="<?= htmlspecialchars($product['image'] ?: 'images/placeholder.jpg') ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>"
                        onerror="this.src='images/placeholder.jpg'"
                    >

                    <h3>
                        <?= htmlspecialchars($product['name']) ?>
                    </h3>

                    <div class="price">
                        €<?= number_format((float)$product['price'], 2) ?>
                    </div>

                    <a href="product.php?id=<?= (int)$product['id'] ?>">
                        VIEW PRODUCT
                    </a>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="empty">No sneakers available yet.</p>

        <?php endif; ?>

    </div>

</section>

<footer>
    © 2026 SNEAKERVAULT — ALL RIGHTS RESERVED
</footer>

<script>
const search = document.getElementById("search");
const cards = document.querySelectorAll(".card");

search.addEventListener("input", function() {

    const value = this.value.toLowerCase();

    cards.forEach(card => {

        const name = card.dataset.name.toLowerCase();

        card.style.display =
            name.includes(value) ? "" : "none";

    });

});
</script>

</body>
</html>
