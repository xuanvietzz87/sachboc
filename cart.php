<?php
session_start();
include_once __DIR__ . '/../Model/connectmodel.php';

// Thêm sản phẩm vào giỏ
if (isset($_GET['action']) && $_GET['action'] == "add" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $product = getProductById($conn, $id);

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                "title" => $product['title'],
                "price" => $product['price'],
                "image" => $product['image'],
                "quantity" => 1
            ];
        }
        
        // Chuyển hướng về trang trước đó với thông báo
        $referer = $_SERVER['HTTP_REFERER'] ?? 'products.php';
        header("Location: $referer?added=1");
        exit();
    }
}

// Cập nhật số lượng
if (isset($_GET['action']) && $_GET['action'] == "update" && isset($_GET['id']) && isset($_GET['quantity'])) {
    $id = intval($_GET['id']);
    $quantity = intval($_GET['quantity']);
    
    if (isset($_SESSION['cart'][$id])) {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = $quantity;
        }
    }
}

// Xóa sản phẩm
if (isset($_GET['action']) && $_GET['action'] == "remove" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// Xóa toàn bộ giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == "clear") {
    $_SESSION['cart'] = [];
}

// Tính tổng
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Việt Book</title>
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

<main class="container">
    <h2 class="text-center">Giỏ hàng của bạn</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item" style="display: flex; align-items: center; padding: 1rem; border: 1px solid #ddd; margin-bottom: 1rem; border-radius: 8px;">
                    <img src="../<?= $item['image']; ?>" alt="<?= $item['title']; ?>" 
                         style="width: 80px; height: 100px; object-fit: cover; margin-right: 1rem;"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iMTAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiMzMzMiLz48dGV4dCB4PSI1MCUiIHk9IjUwJSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjZmZkNzAwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+Tm8gSW1hZ2U8L3RleHQ+PC9zdmc+'">
                    <div class="cart-item-info" style="flex: 1;">
                        <h3 style="margin: 0 0 0.5rem 0; color: #333;"><?= htmlspecialchars($item['title']); ?></h3>
                        <p style="margin: 0.25rem 0; color: #666;">Giá: <?= number_format($item['price'], 0, ',', '.'); ?> đ</p>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span>Số lượng:</span>
                            <a href="cart.php?action=update&id=<?= $id; ?>&quantity=<?= $item['quantity'] - 1; ?>" 
                               class="btn btn-small" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">-</a>
                            <span style="min-width: 2rem; text-align: center;"><?= $item['quantity']; ?></span>
                            <a href="cart.php?action=update&id=<?= $id; ?>&quantity=<?= $item['quantity'] + 1; ?>" 
                               class="btn btn-small" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">+</a>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; font-weight: bold; color: #e74c3c;">
                            Thành tiền: <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> đ
                        </p>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="cart.php?action=remove&id=<?= $id; ?>" class="btn btn-secondary" 
                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary" style="border-top: 2px solid #333; padding-top: 1rem; margin-top: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="margin: 0;">Tổng cộng: <span style="color: #e74c3c; font-size: 1.5rem;"><?= number_format($total, 0, ',', '.'); ?> đ</span></h3>
                <div style="display: flex; gap: 1rem;">
                    <a href="cart.php?action=clear" class="btn btn-secondary" 
                       onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">Xóa tất cả</a>
                    <a href="#" class="btn" style="background: #27ae60;">Thanh toán</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 3rem;">
            <h3 style="color: #666; margin-bottom: 1rem;">Giỏ hàng trống</h3>
            <p style="color: #999; margin-bottom: 2rem;">Hãy thêm một số sản phẩm vào giỏ hàng của bạn!</p>
            <a href="products.php" class="btn">Xem sản phẩm</a>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
