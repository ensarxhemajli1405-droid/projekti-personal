
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SneakerVault | Premium Sneakers</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,Arial,sans-serif}
html{scroll-behavior:smooth}
body{background:#080b10;color:white;overflow-x:hidden}
a{text-decoration:none;color:inherit}
nav{height:80px;padding:0 8%;display:flex;align-items:center;justify-content:space-between;background:#080b10;border-bottom:1px solid #202832;position:relative;z-index:5}
.logo{font-size:25px;font-weight:900;letter-spacing:-1px}
.logo span,.hero h1 span{color:#00eaff}
.nav-links{display:flex;align-items:center;gap:30px}
.nav-links a{font-size:13px;color:#b8c0cc;font-weight:600;transition:.3s}
.nav-links a:hover{color:#00eaff}
.nav-button{padding:11px 20px;border:1px solid #00eaff;border-radius:5px;color:#00eaff!important}
.nav-button:hover{background:#00eaff;color:#080b10!important}
.hero{min-height:600px;padding:75px 8%;display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:45px;position:relative;overflow:hidden}
.hero:before{content:"";position:absolute;width:400px;height:400px;background:#00eaff;filter:blur(180px);opacity:.1;right:10%;top:50px}
.hero-content{position:relative;z-index:2}
.small-heading{color:#00eaff;font-size:12px;letter-spacing:4px;font-weight:800;margin-bottom:25px}
.hero h1{font-size:clamp(45px,6vw,75px);line-height:1.05;font-weight:900;letter-spacing:-4px;margin-bottom:25px}
.hero-content p{max-width:470px;color:#9ca7b5;line-height:1.9;font-size:14px;margin-bottom:30px}
.hero-buttons{display:flex;gap:15px;flex-wrap:wrap}
.primary-button,.secondary-button{display:inline-block;padding:15px 27px;border-radius:5px;font-size:12px;font-weight:800;transition:.3s}
.primary-button{background:#00eaff;color:#080b10}
.primary-button:hover{background:white;transform:translateY(-4px);box-shadow:0 10px 25px #00eaff30}
.secondary-button{border:1px solid #46515e}
.secondary-button:hover{border-color:#00eaff;color:#00eaff}
.showcase{width:100%;max-width:520px;justify-self:center;position:relative;padding:20px 12px 40px}
.showcase-circle{position:absolute;width:420px;height:420px;border:1px solid #00eaff50;border-radius:50%;top:50%;left:50%;transform:translate(-50%,-50%);animation:rotateCircle 25s linear infinite;pointer-events:none}
.showcase-circle:before{content:"";position:absolute;width:9px;height:9px;background:#00eaff;border-radius:50%;top:50%;right:-5px;box-shadow:0 0 15px #00eaff}
@keyframes rotateCircle{to{transform:translate(-50%,-50%) rotate(360deg)}}
.showcase-frame{height:380px;position:relative;border:1px solid #ffffff20;border-radius:25px;background:linear-gradient(145deg,#18212d,#0b111a);box-shadow:0 25px 70px #0008;overflow:hidden;z-index:1}
.showcase-frame:before{content:"";position:absolute;inset:0;background:radial-gradient(circle,#00eaff20,transparent 70%);z-index:1;pointer-events:none}
.showcase-label,.slide-number,.floating-label{position:absolute;z-index:3}
.showcase-label{top:23px;left:23px;color:#00eaff;font-size:10px;letter-spacing:3px;font-weight:800}
.slide-number{top:23px;right:23px;color:#aeb8c5;font-size:12px}
.slideshow{position:absolute;inset:0}
.slideshow img{position:absolute;width:100%;height:100%;object-fit:contain;padding:55px 25px 35px;opacity:0;transform:scale(.85) rotate(-5deg);transition:opacity 1s ease,transform 1.2s cubic-bezier(.2,.8,.2,1);z-index:2}
.slideshow img.active{opacity:1;transform:scale(1) rotate(0)}
.floating-label{bottom:22px;left:25px;font-size:11px;letter-spacing:2px;font-weight:800}
.showcase-controls{display:flex;justify-content:space-between;align-items:center;margin-top:20px;position:relative;z-index:3}
.arrows{display:flex;gap:10px}
.arrows button{width:42px;height:42px;border:1px solid #00eaff60;border-radius:50%;background:#111b25;color:#00eaff;font-size:20px;cursor:pointer;transition:.3s}
.arrows button:hover{background:#00eaff;color:#080b10}
.dots{display:flex;gap:9px;align-items:center}
.dots button{width:8px;height:8px;border:0;border-radius:20px;background:#53606e;cursor:pointer;transition:.4s}
.dots button.active{width:27px;background:#00eaff}
.stats{padding:35px 8%;display:grid;grid-template-columns:repeat(3,1fr);background:#0d131c;border-top:1px solid #ffffff10;border-bottom:1px solid #ffffff10}
.stat{text-align:center}
.stat h2{font-size:30px;color:#00eaff;margin-bottom:8px}
.stat p{font-size:11px;letter-spacing:2px;color:#8d9aaa;font-weight:700}
.section{padding:85px 8%}
.section-heading{text-align:center;margin-bottom:40px}
.section-heading span{color:#00eaff;font-size:11px;letter-spacing:4px;font-weight:800}
.section-heading h2{font-size:36px;margin-top:15px;font-weight:900}
.section-heading p{color:#8d9aaa;font-size:13px;margin-top:12px}
.categories{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.category-card{height:310px;position:relative;overflow:hidden;border-radius:12px;background:#151d28;border:1px solid #ffffff15}
.category-card img{width:100%;height:100%;object-fit:cover;opacity:.7;transition:.6s}
.category-card:hover img{transform:scale(1.1);opacity:.4}
.category-info{position:absolute;bottom:23px;left:23px}
.category-info h3{font-size:21px;margin-bottom:10px}
.category-info a{color:#00eaff;font-size:11px;font-weight:800;letter-spacing:1px}
.collection{margin:0 8% 85px;min-height:300px;padding:55px;border-radius:15px;background:linear-gradient(110deg,#101d29,#102c38);border:1px solid #00eaff30;display:flex;align-items:center;justify-content:space-between;gap:25px;position:relative;overflow:hidden}
.collection:after{content:"";position:absolute;width:280px;height:280px;border-radius:50%;background:#00eaff;filter:blur(150px);opacity:.12;right:10%}
.collection-content{position:relative;z-index:2}
.collection-content span{color:#00eaff;font-size:11px;letter-spacing:4px;font-weight:800}
.collection h2{font-size:38px;font-weight:900;margin:17px 0}
.collection p{color:#a4b0bd;max-width:460px;line-height:1.8;font-size:13px;margin-bottom:23px}
.collection-mark{font-size:95px;font-weight:900;color:#00eaff20;position:relative;z-index:2}
footer{background:#05080d;border-top:1px solid #ffffff10;padding:50px 8% 22px}
.footer-content{display:flex;justify-content:space-between;gap:35px;flex-wrap:wrap;padding-bottom:35px}
.footer-brand p{color:#7f8b99;font-size:12px;max-width:280px;line-height:1.8;margin-top:15px}
.footer-links h3{font-size:12px;margin-bottom:17px}
.footer-links a{display:block;color:#8793a1;font-size:12px;margin-bottom:11px;transition:.3s}
.footer-links a:hover{color:#00eaff}
.footer-bottom{border-top:1px solid #ffffff12;padding-top:20px;display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap;color:#65717e;font-size:10px}
@media(max-width:900px){
.hero{grid-template-columns:1fr;text-align:center}
.hero-content p{margin-left:auto;margin-right:auto}
.hero-buttons{justify-content:center}
.showcase{max-width:500px}
.categories{grid-template-columns:repeat(2,1fr)}
.collection-mark{display:none}
}
@media(max-width:600px){
nav{height:auto;padding:20px 5%;flex-direction:column;gap:17px}
.nav-links{gap:15px;flex-wrap:wrap;justify-content:center}
.nav-links a{font-size:11px}
.hero{padding:55px 5%}
.hero h1{letter-spacing:-2px}
.showcase{padding:15px 5px 30px}
.showcase-frame{height:290px}
.showcase-circle{width:310px;height:310px}
.stats{padding:28px 5%;gap:8px}
.stat h2{font-size:23px}
.stat p{font-size:9px;letter-spacing:1px}
.section{padding:60px 5%}
.section-heading h2{font-size:29px}
.categories{grid-template-columns:1fr}
.category-card{height:280px}
.collection{margin:0 5% 60px;padding:32px 23px}
.collection h2{font-size:29px}
footer{padding:40px 5% 20px}
}
</style>
</head>

<body>

<nav>
<a href="index.php" class="logo">SNEAKER<span>VAULT</span></a>
<div class="nav-links">
<a href="index.php">Home</a>
<a href="shop.php">Shop</a>
<a href="cart.php">Cart</a>
<a href="login.php">Login</a>
<a href="register.php" class="nav-button">Register</a>
</div>
</nav>

<header class="hero">
<div class="hero-content">
<div class="small-heading">WELCOME TO SNEAKERVAULT</div>
<h1>STEP INTO<br>YOUR <span>STYLE.</span></h1>
<p>Discover sneakers that define your style. From timeless classics to modern streetwear essentials, find your next favorite pair at SneakerVault.</p>
<div class="hero-buttons">
<a href="shop.php" class="primary-button">EXPLORE COLLECTION</a>
<a href="#categories" class="secondary-button">DISCOVER MORE</a>
</div>
</div>

<div class="showcase">
<div class="showcase-circle"></div>
<div class="showcase-frame">
<div class="showcase-label">SNEAKERVAULT / COLLECTION</div>
<div class="slide-number" id="slideNumber">01 / 04</div>
<div class="slideshow">
<img src="images/22.jpg" class="active" alt="Sneaker collection">
<img src="images/23.avif" alt="Streetwear sneakers">
<img src="images/24.jpg" alt="Premium sneakers">
</div>
<div class="floating-label" id="slideLabel">PREMIUM SNEAKERS</div>
</div>
<div class="showcase-controls">
<div class="arrows">
<button type="button" onclick="changeSlide(-1)" aria-label="Previous slide">‹</button>
<button type="button" onclick="changeSlide(1)" aria-label="Next slide">›</button>
</div>
<div class="dots" id="dots"></div>
</div>
</div>
</header>

<section class="stats">
<div class="stat"><h2>100%</h2><p>STYLE FOCUSED</p></div>
<div class="stat"><h2>24/7</h2><p>ONLINE ACCESS</p></div>
<div class="stat"><h2>∞</h2><p>WAYS TO STYLE</p></div>
</section>

<section class="section" id="categories">
<div class="section-heading">
<span>FIND YOUR LOOK</span>
<h2>EXPLORE CATEGORIES</h2>
<p>Discover the styles that match your personality.</p>
</div>
<div class="categories">
<div class="category-card">
<img src="images/22.jpg" alt="Nike sneakers">
<div class="category-info"><h3>NIKE COLLECTION</h3><a href="shop.php">EXPLORE NOW →</a></div>
</div>
<div class="category-card">
<img src="images/23.avif" alt="Adidas sneakers">
<div class="category-info"><h3>ADIDAS COLLECTION</h3><a href="shop.php">EXPLORE NOW →</a></div>
</div>
<div class="category-card">
<img src="images/24.jpg" alt="Streetwear sneakers">
<div class="category-info"><h3>STREETWEAR</h3><a href="shop.php">EXPLORE NOW →</a></div>
</div>
</div>
</section>

<section class="collection">
<div class="collection-content">
<span>THE SNEAKERVAULT EXPERIENCE</span>
<h2>MAKE EVERY STEP COUNT.</h2>
<p>Your style starts from the ground up. Explore a collection built for sneaker lovers, everyday outfits, and standout looks.</p>
<a href="shop.php" class="primary-button">SHOP THE COLLECTION</a>
</div>
<div class="collection-mark">SV.</div>
</section>

<footer>
<div class="footer-content">
<div class="footer-brand">
<a href="index.php" class="logo">SNEAKER<span>VAULT</span></a>
<p>Find your style. Discover your next favorite sneakers and make every step count.</p>
</div>
<div class="footer-links">
<h3>QUICK LINKS</h3>
<a href="index.php">Home</a>
<a href="shop.php">Shop</a>
<a href="cart.php">Shopping Cart</a>
</div>
<div class="footer-links">
<h3>ACCOUNT</h3>
<a href="login.php">Login</a>
<a href="register.php">Register</a>
</div>
<div class="footer-links">
<h3>INFORMATION</h3>
<a href="#categories">Categories</a>
<a href="shop.php">Our Collection</a>
</div>
</div>
<div class="footer-bottom">
<p>© 2026 SneakerVault. All rights reserved.</p>
<p>BUILT FOR SNEAKER LOVERS.</p>
</div>
</footer>

<script>
let currentSlide=0;
const slides=document.querySelectorAll(".slideshow img");
const dotsContainer=document.getElementById("dots");
const slideNumber=document.getElementById("slideNumber");
const slideLabel=document.getElementById("slideLabel");
const labels=["PREMIUM SNEAKERS","STREETWEAR STYLE","ICONIC COLLECTION","FIND YOUR NEXT PAIR"];
let slideTimer;

slides.forEach((slide,index)=>{
const dot=document.createElement("button");
dot.type="button";
dot.setAttribute("aria-label","Go to slide "+(index+1));
dot.addEventListener("click",()=>goToSlide(index));
dotsContainer.appendChild(dot);
});

const dots=dotsContainer.querySelectorAll("button");

function showSlide(){
slides.forEach((slide,index)=>slide.classList.toggle("active",index===currentSlide));
dots.forEach((dot,index)=>dot.classList.toggle("active",index===currentSlide));
slideNumber.textContent=String(currentSlide+1).padStart(2,"0")+" / "+String(slides.length).padStart(2,"0");
slideLabel.textContent=labels[currentSlide];
}

function changeSlide(direction){
currentSlide=(currentSlide+direction+slides.length)%slides.length;
showSlide();
restartTimer();
}

function goToSlide(index){
currentSlide=index;
showSlide();
restartTimer();
}

function restartTimer(){
clearInterval(slideTimer);
if(!document.hidden){
slideTimer=setInterval(()=>{
currentSlide=(currentSlide+1)%slides.length;
showSlide();
},5000);
}
}

document.addEventListener("visibilitychange",restartTimer);
showSlide();
restartTimer();
</script>

</body>
</html>
