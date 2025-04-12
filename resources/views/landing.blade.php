<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEC - Technical Support</title>
    <link rel="icon" href="{{ asset('CAP.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(to bottom right, #e0f7fa, #fce4ec);
            color: #222;
            line-height: 1.6;
        }
        header {
            background-color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo img {
            height: 45px;
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #1e47cc;
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 4rem 2rem;
            background: linear-gradient(to right, #fce4ec, #f3e5f5);
        }
        .hero-text {
            flex: 1;
            max-width: 500px;
            animation: fadeInLeft 1s;
        }
        .hero-text h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: #2a5bff;
        }
        .hero-text p {
            margin-bottom: 2rem;
            color: #444;
        }
        .hero img {
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: fadeInRight 1s;
        }
        .section {
            padding: 3rem 2rem;
            text-align: center;
            background: white;
            animation: fadeInUp 1.2s;
        }
        .section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #2a5bff;
        }
        .section p {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        .slider {
            padding: 2rem 0;
            background: #fff;
        }
        .swiper-slide {
            text-align: center;
        }
        .swiper-slide img {
            max-height: 220px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        footer {
            background-color: #2a5bff;
            color: #fff;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="{{ asset('images/CAP.png') }}" alt="Logo">
    </div>
    <a href="{{ route('login') }}" class="btn">Sign In</a>
</header>

<section class="hero">
    <div class="hero-text">
        <h1 class="animate__animated animate__fadeInLeft">Seamless Technical Support</h1>
        <p>Streamline your service requests with our intuitive platform designed for efficiency and effectiveness.</p>
        <a href="{{ route('login') }}" class="btn">Sign In</a>
    </div>
    <img src="https://www.flexjobs.com/blog/wp-content/uploads/2020/05/16135325/TechSupportRep.png" alt="Hero Image">
</section>

<section class="section">
    <h2>Empowering Support Teams</h2>
    <p>Our platform empowers customers and technical teams to register, monitor, and complete service requests effortlessly.</p>
</section>

<section class="slider">
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="https://cdn-icons-png.flaticon.com/512/4712/4712054.png" alt="Tool"></div>
            <div class="swiper-slide"><img src="https://cdn-icons-png.flaticon.com/512/1670/1670048.png" alt="Dashboard"></div>
            <div class="swiper-slide"><img src="https://cdn-icons-png.flaticon.com/512/1149/1149168.png" alt="Analytics"></div>
            <div class="swiper-slide"><img src="https://cdn-icons-png.flaticon.com/512/3771/3771574.png" alt="Support"></div>
        </div>
    </div>
</section>

<section class="hero">
    <img src="https://staticlearn.shine.com/l/m/images/blog/mobile/technical_support_engineer.webp" alt="Dashboard image">
    <div class="hero-text">
        <p><strong>Streamline Your Support Today!</strong></p>
        <h2>Manage Your Requests with Ease.</h2>
        <p>Gain full control over service flows, inventory tracking, and technician performance.</p>
        <a href="{{ route('login') }}" class="btn">Sign In</a>
        <a href="#" class="btn" style="background:white; color:#2a5bff; border:1px solid #2a5bff; margin-left:0.5rem;">See It In Action</a>
    </div>
</section>

<footer>
    &copy; 2025 SISTEC - All rights reserved.
</footer>

<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        autoplay: { delay: 3000 },
        slidesPerView: 2,
        spaceBetween: 20,
        breakpoints: {
            640: { slidesPerView: 3 },
            768: { slidesPerView: 4 }
        }
    });
</script>
</body>
</html>
