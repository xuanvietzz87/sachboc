<?php
session_start();
include_once __DIR__ . '/../Model/connectmodel.php';

$category = isset($_GET['category']) ? trim($_GET['category']) : '';
if (empty($category)) {
    die('Thiếu tham số category');
}

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

// Map tên hiển thị danh mục giống categories.php
$categoriesMap = [
    'technology' => 'Công nghệ',
    'literature' => 'Văn học',
    'business' => 'Kinh tế',
    'education' => 'Giáo dục',
    'self_help' => 'Kỹ năng sống',
    'children' => 'Thiếu nhi',
    'history' => 'Lịch sử',
    'science' => 'Khoa học'
];

// Chấp nhận label tiếng Việt -> chuyển về key nếu cần
$keyFromLabel = array_search($category, $categoriesMap, true);
if ($keyFromLabel !== false) {
    $categoryKey = $keyFromLabel;
} else {
    $categoryKey = $category;
}

$items = getProductsByCategory($conn, $categoryKey, $limit, $offset);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoriesMap[$category] ?? $category) ?> - Sách liên quan</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
        .card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 6px 18px rgba(0,0,0,0.08); }
        .card img { width: 100%; height: 220px; object-fit: cover; }
        .card-body { padding: 1rem; }
        .badge { position: absolute; top: 10px; left: 10px; background: rgba(102,126,234,.9); color: #fff; padding: .25rem .6rem; border-radius: 12px; font-size: .75rem; }
    </style>
    </head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo"><i class="fas fa-book"></i> Việt Book</a>
                <nav>
                    <ul class="nav">
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="products.php">Sản phẩm</a></li>
                        <li><a href="categories.php">Danh mục</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <section style="padding: 2rem 0; background: #f8f9fa;">
            <div class="container">
                <h1 style="margin-bottom: 1rem;">
                    <i class="fas fa-layer-group"></i>
                    <?= htmlspecialchars($categoriesMap[$category] ?? $category) ?>
                </h1>
                <div class="grid">
                    <?php foreach ($items as $item): ?>
                        <div class="card">
                            <div style="position: relative;">
                                <div class="skeleton" style="width:100%; height:220px; border-radius:10px;"></div>
                                <img src="../<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"
                                     onload="this.classList.add('loaded'); this.style.opacity=1; this.previousElementSibling.remove();"
                                     onerror="this.style.opacity=1; this.previousElementSibling.remove(); this.onerror=null; this.src='https://images.unsplash.com/photo-1519681393784-d120267933ba?w=600&auto=format&fit=crop&q=60';">
                                <?php if (!empty($item['category'])): ?>
                                    <span class="badge"><?= htmlspecialchars($item['category']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h3 style="margin: 0 0 .25rem 0; font-size: 1rem; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($item['title']) ?></h3>
                                <p style="margin: 0 0 .5rem 0; color: #666; font-size: .9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($item['author']) ?></p>
                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                    <span style="color:#e74c3c; font-weight:bold;"><?= number_format($item['price'], 0, ',', '.') ?> đ</span>
                                    <a class="btn" href="productdetail.php?id=<?= $item['id'] ?>">Xem</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (empty($items)): ?>
                    <p>Chưa có sản phẩm trong danh mục này.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

