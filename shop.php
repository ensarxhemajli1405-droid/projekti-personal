
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
    "Air Jordan 2" => "images/shoe1.png",
    "Air Jordan 3" => "images/shoe2.png",
    "Air Jordan 4" => "images/shoe3.png"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop | SneakerVault</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:#09090f;color:#f4f0fa;font-family:'DM Sans',sans-serif}
a{text-decoration:none;color:inherit}

header{
    height:85px;padding:0 8%;display:flex;justify-content:space-between;
    align-items:center;background:#100d18;border-bottom:1px solid #a855f730;
    position:sticky;top:0;z-index:100
}
.logo{font:900 25px 'Montserrat';letter-spacing:2px}
.logo span{color:#a855f7}
nav{display:flex;align-items:center;gap:30px}
nav a{font-size:11px;font-weight:800;letter-spacing:1px;color:#bcb4ca;transition:.3s}
nav a:hover,nav .active{color:#e879f9}
.cart-link{border:1px solid #a855f7;padding:11px 18px;border-radius:5px;color:#d8a5ff}

.hero{
    min-height:420px;padding:85px 8%;display:flex;align-items:center;
    position:relative;overflow:hidden;
    background:radial-gradient(ellipse at 85% 50%,#9333ea45,transparent 45%),
    linear-gradient(110deg,#1b1228,#09090f 75%);
    border-bottom:1px solid #a855f730
}
.hero-content{position:relative;z-index:2;max-width:650px}
.eyebrow{color:#e879f9;font-size:11px;font-weight:800;letter-spacing:5px;margin-bottom:22px}
.hero h1{font:900 clamp(45px,7vw,80px)/1.05 'Montserrat';letter-spacing:-3px;margin-bottom:20px}
.hero h1 span{background:linear-gradient(90deg,#a855f7,#e879f9);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.hero p{color:#aaa2b8;max-width:430px;font-size:14px;line-height:1.8}
.hero-button{
    display:inline-block;margin-top:30px;padding:15px 25px;
    background:linear-gradient(110deg,#9333ea,#c026d3);border-radius:5px;
    color:white;font-size:11px;font-weight:900;letter-spacing:1px;transition:.3s
}
.hero-button:hover{transform:translateY(-4px);box-shadow:0 10px 25px #9333ea55}
.hero-decoration{
    position:absolute;right:13%;top:50%;transform:translateY(-50%) rotate(-20deg);
    width:260px;height:260px;border:1px solid #c084fc55;border-radius:50%;
    box-shadow:0 0 80px #a855f725;animation:float 6s ease-in-out infinite
}
.hero-decoration:before,.hero-decoration:after{content:"";position:absolute;border:1px solid #e879f940;border-radius:50%}
.hero-decoration:before{inset:22px}
.hero-decoration:after{inset:45px}
@keyframes float{50%{transform:translateY(-55%) rotate(-10deg)}}

.shop{padding:70px 8%;max-width:1600px;margin:auto}
.top{display:flex;justify-content:space-between;align-items:end;gap:25px;flex-wrap:wrap;margin-bottom:35px}
.section-label{color:#d879ff;font-size:10px;font-weight:800;letter-spacing:4px;margin-bottom:12px}
.top h2{font:900 clamp(26px,4vw,38px) 'Montserrat'}
.top h2 span{color:#c084fc}
.top p{color:#a69bb3;font-size:12px;margin-top:9px}
.search-wrap{
    display:flex;align-items:center;width:290px;padding:0 15px;
    background:#171020;border:1px solid #53346e;border-radius:6px;transition:.3s
}
.search-wrap:focus-within{border-color:#d879ff;box-shadow:0 0 20px #a855f725}
.search-icon{color:#d879ff;font-size:20px}
.search{width:100%;padding:15px 10px;background:transparent;border:0;outline:0;color:white;font-size:12px}
.search::placeholder{color:#8d829a}

.stats{
    display:flex;gap:30px;flex-wrap:wrap;padding:22px;
    background:linear-gradient(100deg,#171020,#24152e,#171020);
    border:1px solid #a855f72c;border-radius:8px;margin-bottom:38px
}
.stat{color:#a99ab9;font-size:11px;letter-spacing:1px}
.stat strong{color:#e879f9;font-size:14px;margin-right:5px}

.grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:22px}
.card{
    background:linear-gradient(145deg,#1b1426,#100d18);
    border:1px solid #a855f72b;border-radius:10px;overflow:hidden;
    transition:.35s;min-width:0
}
.card:hover{transform:translateY(-8px);border-color:#c084fc;box-shadow:0 15px 35px #0008,0 0 22px #a855f725}
.image-box{
    height:235px;position:relative;display:flex;align-items:center;justify-content:center;
    overflow:hidden;background:radial-gradient(circle,#a855f725,transparent 65%),#171020;
    border-bottom:1px solid #a855f720
}
.image-box:after{content:"";position:absolute;width:170px;height:170px;border-radius:50%;background:#d946ef18;filter:blur(35px)}
.card img{position:relative;z-index:1;width:100%;height:100%;object-fit:contain;padding:20px;transition:.5s}
.card:hover img{transform:scale(1.1) rotate(-3deg)}
.product-number{position:absolute;top:14px;left:14px;z-index:2;font-size:10px;color:#c3b4d2;letter-spacing:2px}
.product-tag{
    position:absolute;top:14px;right:14px;z-index:2;
    background:linear-gradient(110deg,#9333ea,#c026d3);
    color:white;padding:7px 9px;border-radius:4px;font-size:9px;font-weight:900
}
.card-info{padding:20px}
.brand{color:#d879ff;font-size:9px;letter-spacing:2px;font-weight:800;margin-bottom:10px}
.card h3{font:800 14px/1.5 'Montserrat';min-height:42px;overflow-wrap:anywhere}
.card-bottom{display:flex;justify-content:space-between;align-items:center;gap:8px;margin-top:15px;padding-top:15px;border-top:1px solid #49345a}
.price{font-size:18px;font-weight:800}
.price small{color:#e879f9;font-size:11px}
.card-bottom form{margin:0}
.view-btn{
    background:linear-gradient(110deg,#9333ea,#c026d3);color:white;border:0;
    padding:11px 15px;border-radius:5px;font-size:9px;font-weight:900;
    letter-spacing:1px;cursor:pointer;transition:.3s;white-space:nowrap
}
.view-btn:hover{transform:translateY(-3px);box-shadow:0 5px 20px #a855f755}
.empty,.no-results{grid-column:1/-1;text-align:center;padding:65px 20px;color:#aaa2b8}
.empty{background:#171020;border:1px solid #a855f740;border-radius:10px}
.empty h3,.no-results h3{color:white;margin-bottom:10px}
.no-results{display:none}

footer{background:#07060d;border-top:1px solid #a855f730;padding:40px 8% 22px}
.footer-top{display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;padding-bottom:28px}
.footer-description{color:#968aa4;font-size:12px;margin-top:10px}
.footer-links{display:flex;gap:25px;flex-wrap:wrap}
.footer-links a{color:#a69bb3;font-size:11px;transition:.3s}
.footer-links a:hover{color:#e879f9}
.copyright{border-top:1px solid #a855f725;padding-top:20px;text-align:center;color:#756a82;font-size:10px;letter-spacing:1px}

@media(max-width:1100px){.grid{grid-template-columns:repeat(3,minmax(0,1fr))}.hero-decoration{right:5%;opacity:.5}}
@media(max-width:800px){
    header{height:auto;padding:20px 5%;flex-direction:column;gap:20px}
    nav{gap:17px;flex-wrap:wrap;justify-content:center}
    .hero{padding:75px 7%}
    .hero-decoration{right:-100px;opacity:.3}
    .shop{padding:55px 5%}
    .grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:15px}
}
@media(max-width:500px){
    nav{gap:12px}nav a{font-size:9px}
    .search-wrap{width:100%}
    .image-box{height:175px}
    .card-info{padding:14px 11px}
    .card h3{font-size:12px}
    .price{font-size:15px}
    .view-btn{padding:10px 8px;font-size:8px}
    .stats{gap:15px}
    .footer-top{flex-direction:column;align-items:flex-start}
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
                $brand = stripos($name, 'nike') !== false ? 'NIKE' : (stripos($name, 'adidas') !== false ? 'ADIDAS' : 'SNEAKERVAULT');
                ?>
                <div class="card" data-name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
                    <div class="image-box">
                        <span class="product-number">#<?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        <span class="product-tag"><?= $index >= count($products) - 3 ? 'NEW ARRIVAL' : 'FEATURED' ?></span>
                        <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" onerror="this.onerror=null;this.src='images/placeholder.jpg';">
                    </div>
                    <div class="card-info">
                        <div class="brand"><?= htmlspecialchars($brand) ?> / ORIGINAL COLLECTION</div>
                        <h3><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></h3>
                        <div class="card-bottom">
                            <div class="price"><small>€</small><?= number_format((float)$product['price'], 2) ?></div>
                            <form action="add-to-cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="view-btn">BUY NOW ↗</button>
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
    <div class="copyright">© 2026 SNEAKERVAULT. ALL RIGHTS RESERVED.</div>
</footer>

<script>
const search = document.getElementById("search");
const cards = document.querySelectorAll(".card");
const noResults = document.getElementById("noResults");

search.addEventListener("input", function(){
    const value = this.value.toLowerCase().trim();
    let visible = 0;

    cards.forEach(card => {
        const match = card.dataset.name.toLowerCase().includes(value);
        card.style.display = match ? "" : "none";
        if(match) visible++;
    });

    noResults.style.display = visible === 0 && cards.length > 0 ? "block" : "none";
});
</script>

</body>
</html>
