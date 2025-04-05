{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEC - Technical Support</title>
    <link rel="icon" href="{{ asset('CAP.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }
        body {
            background-color: #fceef3;
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
        }
        .logo img {
            height: 40px;
        }
        nav a {
            margin: 0 1rem;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 4rem 2rem;
        }
        .hero-text {
            flex: 1;
            max-width: 500px;
        }
        .hero-text h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }
        .hero-text p {
            margin-bottom: 2rem;
            color: #444;
        }
        .hero img {
            max-width: 500px;
            border-radius: 10px;
        }
        .section {
            padding: 3rem 2rem;
            text-align: center;
        }
        .section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .section p {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/CAP.png') }}" alt="Logo">
        </div>

        <nav>
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">Support</a>
            <a href="#">Contact</a>
        </nav>
        <a href="{{ route('login') }}" class="btn">Sign In</a>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h1>Experience Seamless Technical Support Management</h1>
            <p>Streamline your service requests with our intuitive platform designed for efficiency and effectiveness.</p>
            <a href="{{ route('login') }}" class="btn">Sign In</a>
        </div>
        <img src="https://www.flexjobs.com/blog/wp-content/uploads/2020/05/16135325/TechSupportRep.png" alt="Code interface image">
    </section>

    <section class="section">
        <h2>Empowering Technical Support Management</h2>
        <p>Our web application empowers customers to register service requests, assign technicians, and track case statuses effortlessly.</p>
    </section>

    <section class="hero">
        <img src="https://staticlearn.shine.com/l/m/images/blog/mobile/technical_support_engineer.webp" alt="Dashboard image">
        <div class="hero-text">
            <p><strong>Streamline Your Technical Support Today!</strong></p>
            <h2>Efficiently Manage Your Service Requests with Ease.</h2>
            <p>Our tools provide complete control over service request flows, inventory usage, and technician performance.</p>
            <a href="{{ route('login') }}" class="btn">Sign In</a>
            <a href="#" style="margin-left: 1rem; border: 1px solid #2a5bff; background: transparent; color: #2a5bff; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; text-decoration: none;">See It In Action</a>
        </div>
    </section>

    <footer>
        &copy; 2025 SISTEC - All rights reserved.
    </footer>
</body>
</html>
