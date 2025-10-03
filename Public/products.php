<?php
require_once __DIR__ . '/../Controller/productcontroller.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm - Việt Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <div class="container header-content">
        <a href="index.php" class="logo">Việt Book</a>
        <ul class="nav">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="products.php">Sản phẩm</a></li>
            <li><a href="about.php">Giới thiệu</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
        </ul>
    </div>
</header>

<section class="banner">
    <h1>Sản phẩm mới nhất</h1>
    <p>Duyệt và lọc sản phẩm theo nhu cầu của bạn</p>
    <?php if (isset($_GET['added']) && $_GET['added'] == '1'): ?>
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-top: 1rem; text-align: center;">
            ✅ Đã thêm sản phẩm vào giỏ hàng thành công!
        </div>
    <?php endif; ?>
</section>

<section style="background:#f8f9fa; padding:1rem 0; border-top:1px solid #eee; border-bottom:1px solid #eee;">
    <div class="container">
        <form method="GET" style="display:flex; gap:1rem; align-items:center; flex-wrap:wrap;">
            <div style="flex:1; min-width:220px;">
                <input type="text" name="search" placeholder="Tìm kiếm theo tên, tác giả..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="width:100%; padding:0.6rem 0.9rem; border:1px solid #ddd; border-radius:8px;">
            </div>
            <div>
                <select name="category" style="padding:0.6rem 0.9rem; border:1px solid #ddd; border-radius:8px; background:#fff;">
                    <option value="">Tất cả danh mục</option>
                    <?php foreach ($categories as $key => $label): ?>
                        <?php $sel = (($_GET['category'] ?? '') === $key || ($_GET['category'] ?? '') === $label) ? 'selected' : ''; ?>
                        <option value="<?= htmlspecialchars($key) ?>" <?= $sel ?>><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <?php $sort = $_GET['sort'] ?? 'newest'; ?>
                <select name="sort" style="padding:0.6rem 0.9rem; border:1px solid #ddd; border-radius:8px; background:#fff;">
                    <option value="newest" <?= $sort==='newest'?'selected':'' ?>>Mới nhất</option>
                    <option value="name" <?= $sort==='name'?'selected':'' ?>>Tên A-Z</option>
                    <option value="price_low" <?= $sort==='price_low'?'selected':'' ?>>Giá thấp → cao</option>
                    <option value="price_high" <?= $sort==='price_high'?'selected':'' ?>>Giá cao → thấp</option>
                </select>
            </div>
            <button class="btn" type="submit">Lọc</button>
            <?php if (!empty($_GET)): ?>
                <a class="btn btn-secondary" href="products.php">Xóa lọc</a>
            <?php endif; ?>
        </form>
    </div>
</section>

<main class="container">
    <div class="products-grid">
        <?php if ($products && $products->num_rows > 0): ?>
            <?php while($row = $products->fetch_assoc()): ?>
                <div class="product">
                    <div class="skeleton" style="width:100%; height:260px; border-radius:10px; margin-bottom:1rem;"></div>
                    <img src="../<?= $row['image']; ?>" alt="<?= $row['title']; ?>" 
                         onload="this.classList.add('loaded'); this.style.opacity=1; this.previousElementSibling.remove();"
                         onerror="this.style.opacity=1; this.previousElementSibling.remove(); this.src='https://images.unsplash.com/photo-1519681393784-d120267933ba?w=600&auto=format&fit=crop&q=60';">
                    <h3><?= $row['title']; ?></h3>
                    <p class="author"><?= $row['author']; ?></p>
                    <p class="price"><?= number_format($row['price'], 0, ',', '.'); ?> đ</p>
                    <a href="productdetail.php?id=<?= $row['id']; ?>" class="btn">Chi tiết</a>
                    <a href="cart.php?action=add&id=<?= $row['id']; ?>" class="btn btn-secondary">Thêm giỏ</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Không có sản phẩm.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>