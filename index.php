
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
body{background:#09090f;color:#f4f0fa;overflow-x:hidden}
a{text-decoration:none;color:inherit}

nav{
height:80px;padding:0 8%;display:flex;align-items:center;
justify-content:space-between;background:#0d0b15;
border-bottom:1px solid #a855f725;
position:relative;z-index:5
}
.logo{font-size:25px;font-weight:900;letter-spacing:-1px}
.logo span,.hero h1 span{color:#a855f7}
.nav-links{display:flex;align-items:center;gap:30px}
.nav-links a{font-size:13px;color:#bcb4ca;font-weight:600;transition:.3s}
.nav-links a:hover{color:#e879f9}
.nav-button{padding:11px 20px;border:1px solid #a855f7;border-radius:7px;color:#d8a5ff!important}
.nav-button:hover{background:#a855f7;color:white!important;box-shadow:0 0 25px #a855f755}

.hero{
min-height:600px;padding:75px 8%;display:grid;
grid-template-columns:1fr 1fr;align-items:center;gap:45px;
position:relative;overflow:hidden;
background:radial-gradient(ellipse at 80% 50%,#35164c55,transparent 50%),
linear-gradient(120deg,#0b0912,#110d1c)
}
.hero:before{
content:"";position:absolute;width:420px;height:420px;
background:#a855f7;filter:blur(180px);opacity:.16;
right:10%;top:50px
}
.hero-content{position:relative;z-index:2}
.small-heading{color:#d879ff;font-size:12px;letter-spacing:4px;font-weight:800;margin-bottom:25px}
.hero h1{font-size:clamp(45px,6vw,75px);line-height:1.05;font-weight:900;letter-spacing:-4px;margin-bottom:25px}
.hero-content p{max-width:470px;color:#aaa2b8;line-height:1.9;font-size:14px;margin-bottom:30px}
.hero-buttons{display:flex;gap:15px;flex-wrap:wrap}
.primary-button,.secondary-button{
display:inline-block;padding:15px 27px;border-radius:7px;
font-size:12px;font-weight:800;transition:.3s
}
.primary-button{
background:linear-gradient(110deg,#9333ea,#c026d3);
color:white;box-shadow:0 8px 25px #9333ea35
}
.primary-button:hover{transform:translateY(-4px);box-shadow:0 12px 30px #c026d355}
.secondary-button{border:1px solid #6e5684;color:#e4d6f3}
.secondary-button:hover{border-color:#d879ff;color:#e879f9;background:#a855f711}

.showcase{width:100%;max-width:520px;justify-self:center;position:relative;padding:20px 12px 40px}
.showcase-circle{
position:absolute;width:420px;height:420px;border:1px solid #c084fc60;
border-radius:50%;top:50%;left:50%;transform:translate(-50%,-50%);
animation:rotateCircle 25s linear infinite;pointer-events:none
}
.showcase-circle:before{
content:"";position:absolute;width:10px;height:10px;
background:#e879f9;border-radius:50%;top:50%;right:-5px;
box-shadow:0 0 20px #e879f9
}
@keyframes rotateCircle{to{transform:translate(-50%,-50%) rotate(360deg)}}
.showcase-frame{
height:380px;position:relative;border:1px solid #c084fc35;
border-radius:25px;background:linear-gradient(145deg,#21152f,#100c19);
box-shadow:0 25px 70px #0009,0 0 35px #9333ea12;overflow:hidden;z-index:1
}
.showcase-frame:before{
content:"";position:absolute;inset:0;
background:radial-gradient(circle at center,#a855f72b,transparent 70%);
z-index:1;pointer-events:none
}
.showcase-label,.slide-number,.floating-label{position:absolute;z-index:3}
.showcase-label{top:23px;left:23px;color:#d879ff;font-size:10px;letter-spacing:3px;font-weight:800}
.slide-number{top:23px;right:23px;color:#b8a9c9;font-size:12px}
.slideshow{position:absolute;inset:0}
.slideshow img{
position:absolute;width:100%;height:100%;object-fit:contain;
padding:55px 25px 35px;opacity:0;transform:scale(.85) rotate(-5deg);
transition:opacity 1s ease,transform 1.2s cubic-bezier(.2,.8,.2,1);z-index:2
}
.slideshow img.active{opacity:1;transform:scale(1) rotate(0)}
.floating-label{bottom:22px;left:25px;font-size:11px;letter-spacing:2px;font-weight:800;color:#e7d6f7}
.showcase-controls{display:flex;justify-content:space-between;align-items:center;margin-top:20px;position:relative;z-index:3}
.arrows{display:flex;gap:10px}
.arrows button{
width:42px;height:42px;border:1px solid #a855f770;border-radius:50%;
background:#1a1225;color:#d879ff;font-size:20px;cursor:pointer;transition:.3s
}
.arrows button:hover{background:#a855f7;color:white;box-shadow:0 0 20px #a855f755}
.dots{display:flex;gap:9px;align-items:center}
.dots button{width:8px;height:8px;border:0;border-radius:20px;background:#655574;cursor:pointer;transition:.4s}
.dots button.active{width:27px;background:#d879ff;box-shadow:0 0 12px #d879ff}

.stats{
padding:35px 8%;display:grid;grid-template-columns:repeat(3,1fr);
background:linear-gradient(100deg,#171020,#21132c,#171020);
border-top:1px solid #a855f725;border-bottom:1px solid #a855f725
}
.stat{text-align:center}
.stat h2{font-size:30px;color:#d879ff;margin-bottom:8px}
.stat p{font-size:11px;letter-spacing:2px;color:#a99ab9;font-weight:700}

.section{padding:85px 8%;background:#09090f}
.section-heading{text-align:center;margin-bottom:40px}
.section-heading span{color:#d879ff;font-size:11px;letter-spacing:4px;font-weight:800}
.section-heading h2{font-size:36px;margin-top:15px;font-weight:900}
.section-heading p{color:#a69bb3;font-size:13px;margin-top:12px}

.categories{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.category-card{
height:310px;position:relative;overflow:hidden;border-radius:15px;
background:linear-gradient(145deg,#21152f,#120e1c);
border:1px solid #a855f72b;box-shadow:0 12px 35px #0005;
transition:.4s
}
.category-card:hover{transform:translateY(-8px);border-color:#c084fc;box-shadow:0 15px 40px #9333ea25}
.category-card img{width:100%;height:100%;object-fit:cover;opacity:.7;transition:.6s}
.category-card:hover img{transform:scale(1.1);opacity:.45}
.category-card:after{
content:"";position:absolute;inset:40% 0 0;
background:linear-gradient(transparent,#100a1c)
}
.category-info{position:absolute;bottom:23px;left:23px;z-index:2}
.category-info h3{font-size:21px;margin-bottom:10px}
.category-info a{color:#e879f9;font-size:11px;font-weight:800;letter-spacing:1px}

.collection{
margin:0 8% 85px;min-height:300px;padding:55px;border-radius:18px;
background:radial-gradient(circle at 80% 50%,#9333ea35,transparent 40%),
linear-gradient(110deg,#171020,#2a1639,#181020);
border:1px solid #a855f750;display:flex;align-items:center;
justify-content:space-between;gap:25px;position:relative;overflow:hidden;
box-shadow:0 20px 50px #0005
}
.collection:after{
content:"";position:absolute;width:280px;height:280px;border-radius:50%;
background:#d946ef;filter:blur(150px);opacity:.15;right:10%
}
.collection-content{position:relative;z-index:2}
.collection-content span{color:#e879f9;font-size:11px;letter-spacing:4px;font-weight:800}
.collection h2{font-size:38px;font-weight:900;margin:17px 0}
.collection p{color:#c0b4ce;max-width:460px;line-height:1.8;font-size:13px;margin-bottom:23px}
.collection-mark{font-size:95px;font-weight:900;color:#d879ff30;position:relative;z-index:2}

footer{
background:#07060d;border-top:1px solid #a855f730;padding:50px 8% 22px
}
.footer-content{display:flex;justify-content:space-between;gap:35px;flex-wrap:wrap;padding-bottom:35px}
.footer-brand p{color:#968aa4;font-size:12px;max-width:280px;line-height:1.8;margin-top:15px}
.footer-links h3{font-size:12px;margin-bottom:17px;color:#f4eaff}
.footer-links a{display:block;color:#968aa4;font-size:12px;margin-bottom:11px;transition:.3s}
.footer-links a:hover{color:#e879f9}
.footer-bottom{
border-top:1px solid #ffffff12;padding-top:20px;display:flex;
justify-content:space-between;gap:15px;flex-wrap:wrap;
color:#756a82;font-size:10px
}

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
<div class="slide-number" id="slideNumber">01 / 03</div>
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
const labels=["PREMIUM SNEAKERS","STREETWEAR STYLE","ICONIC COLLECTION"];
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
