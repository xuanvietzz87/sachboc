<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu - Việt Book</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset và biến toàn cục */
        :root {
            --primary: #E67E22;
            --primary-light: #F39C12;
            --primary-dark: #D35400;
            --secondary: #FDEBD0;
            --accent: #F5B041;
            --dark: #2C3E50;
            --light: #FEF9E7;
            --text: #34495E;
            --text-light: #7F8C8D;
            --shadow: 0 4px 15px rgba(230, 126, 34, 0.1);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background: linear-gradient(135deg, var(--light) 0%, var(--secondary) 100%);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
            color: var(--primary-dark);
        }

        .nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            padding: 0.5rem 0;
            position: relative;
        }

        .nav a:hover {
            color: var(--primary);
        }

        .nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary);
            transition: var(--transition);
            border-radius: 2px;
        }

        .nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .about-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 6rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="0,0 1000,50 1000,100 0,100"/></svg>') no-repeat center bottom;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: titleFloat 3s ease-in-out infinite;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2rem;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.6);
            background: var(--primary-dark);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            box-shadow: none;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        /* Sections */
        .section {
            padding: 5rem 0;
            position: relative;
        }

        .section-light {
            background: white;
        }

        .section-beige {
            background: var(--secondary);
        }

        .section-dark {
            background: var(--dark);
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary);
            margin: 1rem auto;
            border-radius: 2px;
        }

        .section-dark .section-title {
            color: white;
        }

        .section-dark .section-title::after {
            background: var(--accent);
        }

        /* Story Section */
        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .story-content h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .story-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 3rem;
            border-radius: 20px;
            color: white;
            text-align: center;
            box-shadow: 0 15px 35px rgba(230, 126, 34, 0.3);
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-10px) rotate(2deg);
            box-shadow: 0 25px 50px rgba(230, 126, 34, 0.4);
        }

        .stats-card i {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: iconFloat 3s ease-in-out infinite;
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        /* Director Section */
        .director-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 4rem;
            align-items: center;
        }

        .director-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: var(--transition);
        }

        .director-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .director-avatar {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .director-avatar::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: conic-gradient(transparent, var(--accent), transparent, var(--accent));
            animation: rotate 4s linear infinite;
        }

        .director-avatar::after {
            content: '';
            position: absolute;
            width: 190px;
            height: 190px;
            background: white;
            border-radius: 50%;
        }

        .director-avatar i {
            font-size: 4rem;
            color: var(--primary);
            z-index: 2;
            position: relative;
        }

        .director-quote {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-light);
            font-style: italic;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--light);
            border-left: 4px solid var(--primary);
            border-radius: 10px;
            position: relative;
        }

        .director-quote::before {
            content: '"';
            font-size: 4rem;
            color: var(--primary);
            position: absolute;
            top: -10px;
            left: 10px;
            opacity: 0.3;
            font-family: Georgia, serif;
        }

        .qualities-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .quality-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            transition: var(--transition);
        }

        .quality-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .quality-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        /* Mission Section */
        .mission-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .mission-card {
            text-align: center;
            padding: 3rem 2rem;
            border-radius: 20px;
            color: white;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            opacity: 0;
            transition: var(--transition);
        }

        .mission-card:hover::before {
            opacity: 1;
        }

        .mission-card:hover {
            transform: translateY(-15px) scale(1.05);
        }

        .mission-card:nth-child(1) {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .mission-card:nth-child(2) {
            background: linear-gradient(135deg, #E74C3C 0%, #C0392B 100%);
        }

        .mission-card:nth-child(3) {
            background: linear-gradient(135deg, #27AE60 0%, #229954 100%);
        }

        .mission-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: iconPulse 2s ease-in-out infinite;
        }

        /* Team Section */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .team-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(230, 126, 34, 0.1), transparent);
            transform: rotate(45deg);
            transition: var(--transition);
        }

        .team-card:hover::before {
            animation: shine 1.5s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .team-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .team-card:nth-child(1) i { color: var(--primary); }
        .team-card:nth-child(2) i { color: #E74C3C; }
        .team-card:nth-child(3) i { color: #27AE60; }

        /* Contact Section */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .contact-item {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .contact-item i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--accent);
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 4rem 0;
            background: white;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-logo {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .footer-social a {
            color: white;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .footer-social a:hover {
            color: var(--accent);
            transform: translateY(-3px);
        }

        .footer-links h4,
        .footer-contact h4 {
            margin-bottom: 1rem;
            color: var(--accent);
            font-size: 1.2rem;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-contact p {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 2rem;
            text-align: center;
            color: #bdc3c7;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes titleFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes iconFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes iconPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }
            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        @keyframes confetti {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes floatText {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(5deg);
            }
            66% {
                transform: translateY(-10px) rotate(-5deg);
            }
        }

        /* Scroll Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Confetti */
        .confetti {
            position: fixed;
            width: 15px;
            height: 15px;
            background: var(--primary);
            top: -10px;
            opacity: 0;
            z-index: 9999;
            pointer-events: none;
        }

        .confetti:nth-child(2n) {
            background: var(--accent);
        }

        .confetti:nth-child(3n) {
            background: var(--primary-light);
        }

        .confetti:nth-child(4n) {
            background: #E74C3C;
        }

        .confetti:nth-child(5n) {
            background: #27AE60;
        }

        /* Floating Text */
        .floating-text {
            position: absolute;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            opacity: 0;
            z-index: 100;
            pointer-events: none;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .story-grid,
            .director-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .mission-grid {
                grid-template-columns: 1fr;
            }

            .qualities-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Confetti Container -->
    <div id="confetti-container"></div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">
                    <i class="fas fa-book"></i> Việt Book
                </a>
                <nav>
                    <ul class="nav">
                        <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                        <li><a href="products.php"><i class="fas fa-book-open"></i> Sản phẩm</a></li>
                        <li><a href="about.php"><i class="fas fa-info-circle"></i> Giới thiệu</a></li>
                        <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section class="about-hero">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <i class="fas fa-info-circle"></i> Về Việt Book
                    </h1>
                    <p class="hero-subtitle">
                        Hành trình mang tri thức đến mọi người dân Việt Nam
                    </p>
                    <button class="btn" onclick="launchConfetti()">
                        <i class="fas fa-fire"></i> Khám phá câu chuyện
                    </button>
                </div>
            </div>
        </section>

        <!-- Company Story -->
        <section class="section section-light">
            <div class="container">
                <div class="story-grid">
                    <div class="story-content animate-on-scroll">
                        <h2>
                            <i class="fas fa-rocket" style="color: var(--primary);"></i> Câu chuyện của chúng tôi
                        </h2>
                        <p>
                            <strong>Việt Book</strong> được thành lập vào năm 2020 với một tầm nhìn đơn giản nhưng mạnh mẽ: 
                            mang tri thức đến mọi người dân Việt Nam. Chúng tôi tin rằng sách không chỉ là công cụ học tập 
                            mà còn là người bạn đồng hành trong hành trình phát triển bản thân và xây dựng tương lai.
                        </p>
                        <p>
                            Từ những ngày đầu với chỉ vài trăm đầu sách, đến nay Việt Book đã trở thành một trong những 
                            nhà sách trực tuyến hàng đầu Việt Nam với hơn 50,000 đầu sách đa dạng.
                        </p>
                    </div>
                    <div class="animate-on-scroll">
                        <div class="stats-card">
                            <i class="fas fa-book-open"></i>
                            <div class="stats-number">50,000+</div>
                            <p>Đầu sách đa dạng</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Director Section -->
        <section class="section section-beige">
            <div class="container">
                <h2 class="section-title">
                    <i class="fas fa-user-tie"></i> Giám đốc điều hành
                </h2>
                <div class="director-grid">
                    <div class="animate-on-scroll">
                        <div class="director-card">
                            <div class="director-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h3>Nguyễn Bùi Xuân Việt</h3>
                            <p style="color: var(--primary); font-weight: bold; margin-bottom: 1rem;">Giám đốc điều hành & Nhà sáng lập</p>
                            <div style="display: flex; justify-content: center; gap: 1rem;">
                                <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-linkedin"></i></a>
                                <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                                <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="animate-on-scroll">
                        <h3 style="font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--dark);">Lời chia sẻ từ Giám đốc</h3>
                        <blockquote class="director-quote">
                            "Tôi luôn tin rằng tri thức là chìa khóa mở ra mọi cánh cửa thành công. 
                            Việt Book được sinh ra từ niềm đam mê của tôi với sách và mong muốn 
                            chia sẻ niềm đam mê đó với mọi người. Mỗi cuốn sách chúng tôi bán ra 
                            không chỉ là một sản phẩm mà còn là một cơ hội để ai đó khám phá 
                            thế giới mới, học hỏi điều hay và phát triển bản thân."
                        </blockquote>
                        <div class="qualities-grid">
                            <div class="quality-card">
                                <i class="fas fa-graduation-cap"></i>
                                <h4>Học vấn</h4>
                                <p style="color: var(--text-light); font-size: 0.9rem;">Thạc sĩ Quản trị Kinh doanh - Đại học Harvard</p>
                            </div>
                            <div class="quality-card">
                                <i class="fas fa-briefcase"></i>
                                <h4>Kinh nghiệm</h4>
                                <p style="color: var(--text-light); font-size: 0.9rem;">15+ năm trong ngành xuất bản và thương mại điện tử</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="section section-light">
            <div class="container">
                <div class="mission-grid">
                    <div class="mission-card animate-on-scroll">
                        <i class="fas fa-eye"></i>
                        <h3>Tầm nhìn</h3>
                        <p>Trở thành nhà sách trực tuyến hàng đầu Việt Nam, góp phần xây dựng một xã hội học tập và phát triển bền vững.</p>
                    </div>
                    <div class="mission-card animate-on-scroll">
                        <i class="fas fa-bullseye"></i>
                        <h3>Sứ mệnh</h3>
                        <p>Mang đến cho khách hàng những cuốn sách chất lượng cao với giá cả hợp lý, đồng thời tạo ra trải nghiệm mua sắm tiện lợi và thú vị nhất.</p>
                    </div>
                    <div class="mission-card animate-on-scroll">
                        <i class="fas fa-heart"></i>
                        <h3>Giá trị cốt lõi</h3>
                        <p>Chất lượng, Uy tín, Đổi mới và Phục vụ khách hàng là những giá trị không bao giờ thay đổi của chúng tôi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="section section-beige">
            <div class="container">
                <h2 class="section-title">
                    <i class="fas fa-users"></i> Đội ngũ của chúng tôi
                </h2>
                <div class="team-grid">
                    <div class="team-card animate-on-scroll">
                        <i class="fas fa-user-graduate"></i>
                        <h4>Đội ngũ chuyên gia</h4>
                        <p style="color: var(--text-light);">Các chuyên gia có kinh nghiệm trong việc tư vấn và lựa chọn sách phù hợp</p>
                    </div>
                    <div class="team-card animate-on-scroll">
                        <i class="fas fa-shipping-fast"></i>
                        <h4>Đội ngũ logistics</h4>
                        <p style="color: var(--text-light);">Đảm bảo giao hàng nhanh chóng và an toàn đến tay khách hàng</p>
                    </div>
                    <div class="team-card animate-on-scroll">
                        <i class="fas fa-headset"></i>
                        <h4>Chăm sóc khách hàng</h4>
                        <p style="color: var(--text-light);">Hỗ trợ khách hàng 24/7 với thái độ chuyên nghiệp và nhiệt tình</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section section-dark">
            <div class="container">
                <h2 class="section-title">
                    <i class="fas fa-phone"></i> Liên hệ với chúng tôi
                </h2>
                <div class="contact-grid">
                    <div class="contact-item animate-on-scroll">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>Địa chỉ</h4>
                        <p>123 Đường ABC, Phường XYZ, Quận 1, TP.HCM</p>
                    </div>
                    <div class="contact-item animate-on-scroll">
                        <i class="fas fa-phone"></i>
                        <h4>Hotline</h4>
                        <p>0123-456-789</p>
                    </div>
                    <div class="contact-item animate-on-scroll">
                        <i class="fas fa-envelope"></i>
                        <h4>Email</h4>
                        <p>info@vietbook.vn</p>
                    </div>
                    <div class="contact-item animate-on-scroll">
                        <i class="fas fa-clock"></i>
                        <h4>Giờ làm việc</h4>
                        <p>Thứ 2 - Chủ nhật: 8:00 - 22:00</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section">
            <div class="container">
                <h2 style="margin-bottom: 1rem; color: var(--dark);">Sẵn sàng khám phá thế giới tri thức?</h2>
                <p style="font-size: 1.2rem; color: var(--text-light); margin-bottom: 2rem;">Hãy để Việt Book đồng hành cùng bạn trong hành trình học tập và phát triển</p>
                <div class="cta-buttons">
                    <a href="products.php" class="btn">
                        <i class="fas fa-book-open"></i> Khám phá sản phẩm
                    </a>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Về trang chủ
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">
                        <i class="fas fa-book"></i> Việt Book
                    </div>
                    <p>Nhà sách trực tuyến hàng đầu Việt Nam</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Liên kết nhanh</h4>
                    <ul>
                        <li><a href="products.php">Sản phẩm</a></li>
                        <li><a href="about.php">Giới thiệu</a></li>
                        <li><a href="cart.php">Giỏ hàng</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Thông tin liên hệ</h4>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Đường ABC, Quận XYZ, TP.HCM</p>
                    <p><i class="fas fa-phone"></i> 0123-456-789</p>
                    <p><i class="fas fa-envelope"></i> info@vietbook.vn</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Việt Book. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        // Confetti Animation
        function launchConfetti() {
            const container = document.getElementById('confetti-container');
            const colors = ['#E67E22', '#F39C12', '#F5B041', '#D35400', '#E74C3C', '#27AE60'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animation = `confetti ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.animationDelay = Math.random() * 2 + 's';
                container.appendChild(confetti);
                
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
            
            // Create floating text elements
            createFloatingText();
        }
        
        // Floating Text Animation
        function createFloatingText() {
            const texts = ['Sách Hay!', 'Tri Thức!', 'Việt Book!', 'Thành Công!', 'Học Tập!'];
            const container = document.body;
            
            texts.forEach((text, index) => {
                const floatingText = document.createElement('div');
                floatingText.className = 'floating-text';
                floatingText.textContent = text;
                floatingText.style.left = (20 + index * 15) + '%';
                floatingText.style.top = '50%';
                floatingText.style.color = ['#E67E22', '#F39C12', '#F5B041', '#D35400', '#E74C3C'][index];
                floatingText.style.animation = `floatText 3s ease-in-out ${index * 0.2}s forwards`;
                container.appendChild(floatingText);
                
                setTimeout(() => {
                    floatingText.remove();
                }, 3000);
            });
        }
        
        // Scroll Animation
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            const windowHeight = window.innerHeight;
            
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('animated');
                }
            });
        }
        
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            animateOnScroll();
            
            // Auto launch confetti after page load
            setTimeout(launchConfetti, 1000);
        });
        
        window.addEventListener('scroll', animateOnScroll);
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>