<?php
require_once __DIR__ . '/../Controller/productdetailcontroller.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title']); ?> - Việt Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">Việt Book</a>
                <nav>
                    <ul class="nav">
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="products.php">Sản phẩm</a></li>
                        <li><a href="about.php">Giới thiệu</a></li>
                        <li><a href="cart.php">Giỏ hàng</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="product-detail">
                <div class="product-detail-content">
                    <div class="product-image">
                        <div class="skeleton" style="width:100%; height:400px; border-radius:10px; margin-bottom:1rem;"></div>
                        <img src="../<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['title']); ?>" 
                             onload="this.classList.add('loaded'); this.style.opacity=1; this.previousElementSibling.remove();"
                             onerror="this.style.opacity=1; this.previousElementSibling.remove(); this.src='https://images.unsplash.com/photo-1519681393784-d120267933ba?w=800&auto=format&fit=crop&q=60';">
                    </div>
                    <div class="product-info">
                        <h1><?= htmlspecialchars($product['title']); ?></h1>
                        <p class="author"><strong>Tác giả:</strong> <?= htmlspecialchars($product['author']); ?></p>
                        <p class="price"><strong>Giá:</strong> <?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
                        
                        <?php if (!empty($product['description'])): ?>
                            <div class="description">
                                <h3>Mô tả sản phẩm:</h3>
                                <p><?= nl2br(htmlspecialchars($product['description'])); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-actions">
                            <a href="cart.php?action=add&id=<?= $product['id']; ?>" class="btn">Thêm vào giỏ hàng</a>
                            <a href="products.php" class="btn btn-secondary">Quay lại danh sách</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php if (!empty($relatedProducts)): ?>
    <section style="padding: 2rem 0; background: #f8f9fa;">
        <div class="container">
            <h2 style="margin-bottom: 1rem;">Sản phẩm liên quan</h2>
            <div class="products-grid" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
                <?php foreach ($relatedProducts as $item): ?>
                    <div class="product" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                        <div style="position: relative;">
                            <img src="../<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['title']); ?>" 
                                 style="width: 100%; height: 220px; object-fit: cover;"
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1519681393784-d120267933ba?w=600&auto=format&fit=crop&q=60';">
                            <?php if (!empty($item['category'])): ?>
                                <span style="position: absolute; top: 10px; left: 10px; background: rgba(0,0,0,0.6); color: #fff; padding: 0.2rem 0.6rem; border-radius: 12px; font-size: 0.75rem;">
                                    <?= htmlspecialchars($item['category']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div style="padding: 1rem;">
                            <h3 style="margin: 0 0 0.25rem 0; font-size: 1rem; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= htmlspecialchars($item['title']); ?>
                            </h3>
                            <p style="margin: 0 0 0.5rem 0; color: #666; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= htmlspecialchars($item['author']); ?>
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #e74c3c; font-weight: bold;">
                                    <?= number_format($item['price'], 0, ',', '.'); ?> đ
                                </span>
                                <a href="productdetail.php?id=<?= $item['id']; ?>" class="btn" style="padding: 0.5rem 0.75rem; font-size: 0.9rem;">Xem</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($product['category'])): ?>
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a class="btn" href="related.php?category=<?= urlencode($product['category']); ?>">Xem tất cả cùng danh mục</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <footer style="background: #222; padding: 2rem 0; text-align: center; margin-top: 3rem;">
        <div class="container">
            <p>&copy; 2025 Việt Book. Tất cả quyền được bảo lưu.</p>
            <p>Địa chỉ: 2252, Quận 12, TP.HCM | Hotline: 0123-456-789</p>
        </div>
    </footer>
</body>
</html>
