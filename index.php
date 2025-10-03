<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Việt Book - Nhà sách trực tuyến hàng đầu Việt Nam</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset và biến toàn cục */
        :root {
            --primary: #ff6b6b;
            --secondary: #4ecdc4;
            --dark: #2c3e50;
            --light: #f8f9fa;
            --accent: #ffd700;
            --text: #333;
            --text-light: #666;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
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
            background: #d9f0ff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
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
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
            color: var(--dark);
        }

        .nav {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        .nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
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
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }

        .nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero-section {
            background: url('https://i.pinimg.com/1200x/48/68/d3/4868d3e3de0b1b362faec064c8379765.jpg') no-repeat center center / cover;
            color: white;
            padding: 6rem 0;
            text-align: center;
            min-height: 80vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(30, 30, 60, 0.7) 0%, rgba(74, 20, 140, 0.5) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            animation: fadeInUp 1s ease-out;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.5);
            animation: textGlow 3s infinite alternate;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
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
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
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
            border: 2px solid white;
            box-shadow: none;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Book Categories */
        .book-categories-section {
            padding: 5rem 0;
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
            margin: 0.5rem auto;
            border-radius: 2px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: linear-gradient(135deg, #fff8dc 0%, #ffc0cb 100%);
            padding: 2.5rem 1.8rem;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(255, 192, 203, 0.3);
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            color: var(--text);
            animation: pulseBackground 6s ease-in-out infinite;
        }

        .category-card:hover {
            transform: translateY(-12px) scale(1.04);
            box-shadow: 0 20px 40px rgba(255, 192, 203, 0.5);
            background: linear-gradient(135deg, #fffae6 0%, #ffb6c1 100%);
        }

        .category-card i {
            font-size: 4rem;
            margin-bottom: 1.3rem;
            color: #c71585;
            transition: var(--transition);
            animation: floating 4s infinite ease-in-out;
        }

        .category-card:hover i {
            color: #ff69b4;
            animation-play-state: paused;
        }

        .category-card h3 {
            margin-bottom: 1rem;
            font-size: 1.6rem;
            font-weight: 700;
            color: #800080;
        }

        .category-card p {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.5;
            font-style: italic;
        }

        .category-card::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 191, 0, 0.07) 0%, transparent 70%);
            top: -50%;
            left: -50%;
            filter: blur(40px);
            opacity: 0;
            transition: var(--transition);
            pointer-events: none;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        /* Bestsellers */
        .bestsellers-section {
            padding: 5rem 0;
            background: var(--light);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }

        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }

        .product:hover .product-image {
            transform: scale(1.05);
        }

        .product-discount {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--primary);
            color: white;
            padding: 0.5rem;
            border-radius: 50%;
            font-weight: bold;
            z-index: 2;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-title {
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .product-author {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .current-price {
            color: var(--primary);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .original-price {
            color: #999;
            text-decoration: line-through;
            font-size: 0.9rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .product-actions .btn {
            flex: 1;
            text-align: center;
            justify-content: center;
            padding: 0.8rem;
            font-size: 0.9rem;
        }

        /* Features */
        .features-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature {
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .feature:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--accent);
        }

        .feature h3 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        /* Newsletter */
        .newsletter-section {
            padding: 5rem 0;
            background: var(--light);
        }

        .newsletter-content {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-form {
            display: flex;
            gap: 1rem;
            max-width: 400px;
            margin: 2rem auto 0;
        }

        .newsletter-input {
            flex: 1;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 50px;
            outline: none;
            transition: var(--transition);
        }

        .newsletter-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2);
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

        @keyframes textGlow {
            0% {
                text-shadow: 0 4px 24px rgba(0, 0, 0, 0.5);
            }
            100% {
                text-shadow: 0 4px 30px rgba(255, 215, 0, 0.7);
            }
        }

        @keyframes pulseBackground {
            0%, 100% {
                background: linear-gradient(135deg, #fff8dc 0%, #ffc0cb 100%);
            }
            50% {
                background: linear-gradient(135deg, #fff0d4 0%, #ff9fbc 100%);
            }
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-14px);
            }
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
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .category-card {
                padding: 2rem 1rem;
            }

            .category-card i {
                font-size: 3.2rem;
            }

            .category-card h3 {
                font-size: 1.3rem;
            }

            .newsletter-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
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
        <section class="hero-section">
            <div class="hero-content">
                <h1>Khám phá thế giới qua từng trang sách</h1>
                <p>Việt Book - Điểm đến tin cậy cho những người yêu sách</p>
                <div class="hero-buttons">
                    <a href="products.php" class="btn">
                        <i class="fas fa-shopping-bag"></i> Mua sắm ngay
                    </a>
                    <a href="about.php" class="btn btn-secondary">
                        <i class="fas fa-play"></i> Tìm hiểu thêm
                    </a>
                </div>
            </div>
        </section>

        <!-- Book Categories -->
        <section class="book-categories-section">
            <div class="container">
                <h2 class="section-title">Danh mục sách</h2>
                <div class="category-grid">
                    <div class="category-card">
                        <i class="fas fa-laptop-code" style="color:#3498db;"></i>
                        <h3>Công nghệ</h3>
                        <p>Lập trình, AI, Blockchain và công nghệ mới nhất</p>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-heart" style="color:#e74c3c;"></i>
                        <h3>Văn học</h3>
                        <p>Tiểu thuyết, thơ ca, truyện ngắn kinh điển</p>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-chart-line" style="color:#27ae60;"></i>
                        <h3>Kinh tế</h3>
                        <p>Đầu tư, kinh doanh, tài chính cá nhân</p>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-graduation-cap" style="color:#f39c12;"></i>
                        <h3>Giáo dục</h3>
                        <p>Sách giáo khoa, tham khảo, kỹ năng sống</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bestsellers -->
        <section class="bestsellers-section">
            <div class="container">
                <h2 class="section-title">
                    <i class="fas fa-fire" style="color: #ff6b6b;"></i> Sách bán chạy nhất
                </h2>
                <div class="products-grid">
                    <?php
                    $bestsellers = [
                        [
                            'id' => 1,
                            'title' => 'Nhà Giả Kim',
                            'author' => 'Paulo Coelho',
                            'price' => 95000,
                            'image' => 'https://i.pinimg.com/736x/e7/9b/61/e79b615c3277569a59e312943707eeae.jpg',
                            'discount' => 15
                        ],
                        [
                            'id' => 2,
                            'title' => 'Đắc Nhân Tâm',
                            'author' => 'Dale Carnegie',
                            'price' => 120000,
                            'image' => '2.jpg',
                            'discount' => 20
                        ],
                        [
                            'id' => 3,
                            'title' => 'Tuổi Trẻ Đáng Giá Bao Nhiêu',
                            'author' => 'Rosie Nguyễn',
                            'price' => 110000,
                            'image' => '3.jpg',
                            'discount' => 10
                        ],
                        [
                            'id' => 4,
                            'title' => 'Truyện Kiều',
                            'author' => 'Nguyễn Du',
                            'price' => 150000,
                            'image' => '4.jpg',
                            'discount' => 25
                        ]
                    ];

                    foreach ($bestsellers as $product) {
                        $discounted_price = $product['price'] * (1 - $product['discount'] / 100);
                        echo '<div class="product">';
                        echo '<div class="product-discount">-' . $product['discount'] . '%</div>';
                        echo '<img src="' . $product['image'] . '" alt="' . $product['title'] . '" class="product-image" onerror="this.src=\'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjMzMzIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iI2ZmZDcwMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==\'">';
                        echo '<div class="product-content">';
                        echo '<h3 class="product-title">' . htmlspecialchars($product['title']) . '</h3>';
                        echo '<div class="product-author">Tác giả: ' . htmlspecialchars($product['author']) . '</div>';
                        echo '<div class="product-price">';
                        echo '<span class="current-price">' . number_format($discounted_price, 0, ',', '.') . ' đ</span>';
                        echo '<span class="original-price">' . number_format($product['price'], 0, ',', '.') . ' đ</span>';
                        echo '</div>';
                        echo '<div class="product-actions">';
                        echo '<a href="productdetail.php?id=' . $product['id'] . '" class="btn">Chi tiết</a>';
                        echo '<a href="cart.php?action=add&id=' . $product['id'] . '" class="btn btn-secondary">Thêm giỏ</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div style="text-align: center;">
                    <a href="products.php" class="btn">
                        <i class="fas fa-book-open"></i> Xem tất cả sản phẩm
                    </a>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="features-section">
            <div class="container">
                <h2 class="section-title" style="color: white;">Tại sao chọn Việt Book?</h2>
                <div class="features-grid">
                    <div class="feature">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>Giao hàng nhanh</h3>
                        <p>Miễn phí giao hàng toàn quốc trong 24h</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Sách chính hãng</h3>
                        <p>100% sách chính hãng từ nhà xuất bản uy tín</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-headset"></i>
                        <h3>Hỗ trợ 24/7</h3>
                        <p>Đội ngũ chăm sóc khách hàng chuyên nghiệp</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-content">
                    <h2 class="section-title">Đăng ký nhận tin khuyến mãi</h2>
                    <p>Nhận thông tin về sách mới và ưu đãi đặc biệt</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Nhập email của bạn" class="newsletter-input" required>
                        <button type="submit" class="btn">
                            <i class="fas fa-paper-plane"></i> Đăng ký
                        </button>
                    </form>
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
                    <p><i class="fas fa-map-marker-alt"></i> 2252/22/12 Tân Chánh Hiệp, Quận 12, TP.HCM</p>
                    <p><i class="fas fa-phone"></i> 0333969024</p>
                    <p><i class="fas fa-envelope"></i> info@vietbook.vn</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Việt Book. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>
</body>
</html>
