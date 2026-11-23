
<?php
require_once "config/database.php";

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop | SneakerVault</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    background: #080a0c;
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    overflow-x: hidden;
}

header {
    height: 85px;
    padding: 0 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(8,10,12,.95);
    border-bottom: 1px solid #20262b;
    position: sticky;
    top: 0;
    z-index: 100;
    backdrop-filter: blur(15px);
}

.logo {
    font-family: 'Montserrat', sans-serif;
    font-size: 25px;
    font-weight: 900;
    letter-spacing: 2px;
}

.logo span {
    color: #00e5ff;
}

nav {
    display: flex;
    align-items: center;
    gap: 32px;
}

nav a {
    color: #aaa;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    transition: .3s;
}

nav a:hover,
nav a.active {
    color: #00e5ff;
}

nav .cart-link {
    border: 1px solid #00e5ff;
    color: #00e5ff;
    padding: 11px 19px;
    border-radius: 4px;
}

.hero {
    min-height: 440px;
    padding: 90px 8%;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(ellipse at 85% 50%, #063d4655, transparent 45%),
        linear-gradient(110deg,#10171b,#080a0c 75%);
    border-bottom: 1px solid #1e292e;
}

.hero::after {
    content: "SV";
    position: absolute;
    right: 8%;
    top: 50%;
    transform: translateY(-50%);
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(170px,28vw,340px);
    font-weight: 900;
    color: rgba(0,229,255,.035);
    pointer-events: none;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 650px;
}

.eyebrow {
    color: #00e5ff;
    font-size: 11px;
    letter-spacing: 5px;
    font-weight: 800;
    margin-bottom: 23px;
}

.hero h1 {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(45px,7vw,82px);
    line-height: 1.05;
    font-weight: 900;
    letter-spacing: -4px;
    margin-bottom: 22px;
}

.hero h1 span {
    color: #00e5ff;
}

.hero p {
    color: #929da3;
    font-size: 15px;
    line-height: 1.8;
    max-width: 430px;
}

.hero-button {
    display: inline-block;
    margin-top: 32px;
    padding: 16px 28px;
    background: #00e5ff;
    color: #05090b;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 1px;
    text-decoration: none;
    transition: .3s;
}

.hero-button:hover {
    background: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px #00e5ff33;
}

.hero-decoration {
    position: absolute;
    right: 13%;
    top: 50%;
    transform: translateY(-50%) rotate(-20deg);
    width: 260px;
    height: 260px;
    border: 1px solid #00e5ff33;
    border-radius: 50%;
    box-shadow: 0 0 80px #00e5ff0c;
}

.hero-decoration::before,
.hero-decoration::after {
    content: "";
    position: absolute;
    border: 1px solid #00e5ff22;
    border-radius: 50%;
}

.hero-decoration::before {
    inset: 22px;
}

.hero-decoration::after {
    inset: 45px;
}

.shop {
    padding: 75px 8%;
    max-width: 1600px;
    margin: auto;
}

.section-label {
    color: #00e5ff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 4px;
    margin-bottom: 13px;
}

.top {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 25px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.top h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(25px,4vw,38px);
    font-weight: 900;
    letter-spacing: -1px;
}

.top h2 span {
    color: #00e5ff;
}

.top p {
    color: #78858b;
    font-size: 12px;
    margin-top: 10px;
}

.search-wrap {
    display: flex;
    align-items: center;
    background: #11171b;
    border: 1px solid #273238;
    padding: 0 17px;
    width: 290px;
    transition: .3s;
}

.search-wrap:focus-within {
    border-color: #00e5ff;
    box-shadow: 0 0 20px #00e5ff12;
}

.search-icon {
    color: #00e5ff;
    font-size: 19px;
}

.search {
    width: 100%;
    padding: 15px 12px;
    background: transparent;
    color: white;
    border: none;
    outline: none;
    font-size: 12px;
    font-family: inherit;
}

.search::placeholder {
    color: #778187;
}

.stats {
    display: flex;
    gap: 30px;
    padding: 20px 0;
    border-top: 1px solid #20282d;
    border-bottom: 1px solid #20282d;
    margin-bottom: 35px;
}

.stat {
    color: #77858c;
    font-size: 11px;
    letter-spacing: 1px;
}

.stat strong {
    color: white;
    font-size: 14px;
    margin-right: 5px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(4,minmax(0,1fr));
    gap: 23px;
}

.card {
    background: #101518;
    border: 1px solid #20292e;
    position: relative;
    overflow: hidden;
    transition: .35s ease;
    min-width: 0;
}

.card:hover {
    transform: translateY(-8px);
    border-color: #00e5ff88;
    box-shadow: 0 15px 40px #0008,0 0 25px #00e5ff0b;
}

.image-box {
    height: 245px;
    background: linear-gradient(145deg,#1a2226,#111619);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-box::after {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: #00e5ff0b;
    filter: blur(25px);
}

.card img {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 20px;
    transition: .5s ease;
}

.card:hover img {
    transform: scale(1.12) rotate(-3deg);
}

.product-number {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
    font-size: 10px;
    color: #849198;
    letter-spacing: 2px;
}

.product-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
    background: #00e5ff;
    color: #05090b;
    padding: 7px 10px;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 1px;
}

.card-info {
    padding: 22px 20px;
}

.brand {
    color: #00e5ff;
    font-size: 9px;
    letter-spacing: 2px;
    font-weight: 800;
    margin-bottom: 10px;
}

.card h3 {
    font-family: 'Montserrat', sans-serif;
    font-size: 15px;
    font-weight: 800;
    min-height: 42px;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.card-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 17px;
    padding-top: 16px;
    border-top: 1px solid #263036;
}

.price {
    color: white;
    font-size: 18px;
    font-weight: 800;
}

.price small {
    color: #00e5ff;
    font-size: 11px;
}

.card-bottom form {
    margin: 0;
}

.view-btn {
    background: #00e5ff;
    color: #05090b;
    border: none;
    padding: 12px 17px;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 1px;
    cursor: pointer;
    transition: .3s;
    white-space: nowrap;
}

.view-btn:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 18px #00e5ff33;
}

.empty {
    grid-column: 1/-1;
    text-align: center;
    padding: 80px 20px;
    background: #101518;
    border: 1px solid #263036;
    color: #929da3;
}

.empty h3 {
    color: white;
    font-size: 22px;
    margin-bottom: 10px;
}

.no-results {
    display: none;
    grid-column: 1/-1;
    text-align: center;
    padding: 50px 20px;
    color: #929da3;
}

.no-results h3 {
    color: white;
    margin-bottom: 10px;
}

footer {
    background: #050708;
    border-top: 1px solid #20282d;
    padding: 45px 8% 25px;
}

.footer-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    padding-bottom: 30px;
}

.footer-description {
    color: #748087;
    font-size: 12px;
    margin-top: 10px;
}

.footer-links {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.footer-links a {
    text-decoration: none;
    color: #929da3;
    font-size: 11px;
    transition: .3s;
}

.footer-links a:hover {
    color: #00e5ff;
}

.copyright {
    border-top: 1px solid #20282d;
    padding-top: 22px;
    color: #566168;
    font-size: 10px;
    letter-spacing: 1px;
    text-align: center;
}

@media(max-width:1100px) {
    .grid {
        grid-template-columns: repeat(3,minmax(0,1fr));
    }

    .hero-decoration {
        right: 5%;
        opacity: .5;
    }
}

@media(max-width:800px) {
    header {
        padding: 20px 5%;
        height: auto;
        flex-direction: column;
        gap: 22px;
    }

    nav {
        gap: 18px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .hero {
        padding: 80px 7%;
    }

    .hero-decoration {
        right: -100px;
        opacity: .3;
    }

    .grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
        gap: 15px;
    }

    .shop {
        padding: 55px 5%;
    }
}

@media(max-width:500px) {
    nav {
        gap: 14px;
    }

    nav a {
        font-size: 10px;
    }

    .hero h1 {
        letter-spacing: -2px;
    }

    .search-wrap {
        width: 100%;
    }

    .image-box {
        height: 175px;
    }

    .card-info {
        padding: 15px 12px;
    }

    .card h3 {
        font-size: 12px;
    }

    .price {
        font-size: 15px;
    }

    .view-btn {
        padding: 10px 9px;
        font-size: 8px;
    }

    .stats {
        gap: 15px;
        flex-wrap: wrap;
    }

    .footer-top {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">SNEAKER<span>VAULT.</span></div>

    <nav>
        <a href="index.php">HOME</a>
        <a href="shop.php" class="active">SHOP</a>
        <a href="cart.php" class="cart-link">CART ↗</a>
        <a href="login.php">LOGIN</a>
        <a href="register.php">REGISTER</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <div class="eyebrow">SNEAKERVAULT / THE COLLECTION</div>
        <h1>FIND YOUR<br><span>NEW ICON.</span></h1>
        <p>Discover sneakers that define your style. Explore iconic silhouettes, timeless classics and the latest streetwear essentials.</p>
        <a href="#collection" class="hero-button">EXPLORE COLLECTION &nbsp; ↘</a>
    </div>

    <div class="hero-decoration"></div>
</section>

<section class="shop" id="collection">

    <div class="top">
        <div>
            <div class="section-label">CURATED FOR YOUR STYLE</div>
            <h2>THE <span>COLLECTION.</span></h2>
            <p>Discover your next favourite pair.</p>
        </div>

        <div class="search-wrap">
            <span class="search-icon">⌕</span>
            <input type="text" id="search" class="search" placeholder="Search your sneakers...">
        </div>
    </div>

    <div class="stats">
        <div class="stat"><strong><?= count($products) ?></strong> PRODUCTS</div>
        <div class="stat"><strong>PREMIUM</strong> QUALITY</div>
        <div class="stat"><strong>EST. 2026</strong> SNEAKERVAULT</div>
    </div>

    <div class="grid" id="productGrid">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $index => $product): ?>

                <?php
                    $name = $product['name'] ?? 'Sneaker';
                    $image = $productImages[$name] ?? ($product['image'] ?? 'images/placeholder.jpg');

                    $brand = stripos($name, 'nike') !== false
                        ? 'NIKE'
                        : (stripos($name, 'adidas') !== false ? 'ADIDAS' : 'SNEAKERVAULT');
                ?>

                <div class="card" data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="image-box">
                        <span class="product-number">#<?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>

                        <span class="product-tag">
                            <?= $index >= count($products) - 3 ? 'NEW ARRIVAL' : 'FEATURED' ?>
                        </span>

                        <img
                            src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                            onerror="this.onerror=null;this.src='images/placeholder.jpg';"
                        >
                    </div>

                    <div class="card-info">

                        <div class="brand">
                            <?= htmlspecialchars($brand) ?> / ORIGINAL COLLECTION
                        </div>

                        <h3><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></h3>

                        <div class="card-bottom">

                            <div class="price">
                                <small>€</small><?= number_format((float)$product['price'], 2) ?>
                            </div>

                            <form action="add-to-cart.php" method="POST">
                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?= (int)$product['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button type="submit" class="view-btn">
                                    BUY NOW ↗
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty">
                <h3>NO SNEAKERS YET.</h3>
                <p>Our collection is currently being updated. Check back soon.</p>
            </div>

        <?php endif; ?>

        <div class="no-results" id="noResults">
            <h3>No sneakers found.</h3>
            <p>Try searching for another sneaker.</p>
        </div>

    </div>

</section>

<footer>
    <div class="footer-top">

        <div>
            <div class="logo">SNEAKER<span>VAULT.</span></div>
            <p class="footer-description">Step into your own style. Discover the difference.</p>
        </div>

        <div class="footer-links">
            <a href="index.php">HOME</a>
            <a href="shop.php">SHOP</a>
            <a href="cart.php">CART</a>
            <a href="login.php">LOGIN</a>
        </div>

    </div>

    <div class="copyright">
        © 2026 SNEAKERVAULT. ALL RIGHTS RESERVED.
    </div>
</footer>

<script>
const search = document.getElementById("search");
const cards = document.querySelectorAll(".card");
const noResults = document.getElementById("noResults");

search.addEventListener("input", function() {

    const value = this.value.toLowerCase().trim();
    let visible = 0;

    cards.forEach(card => {

        const match = card.dataset.name.toLowerCase().includes(value);

        card.style.display = match ? "" : "none";

        if (match) visible++;

    });

    noResults.style.display = visible === 0 && cards.length > 0
        ? "block"
        : "none";

});
</script>

</body>
</html>
