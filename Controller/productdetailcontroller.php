<?php
include_once __DIR__ . '/../Model/connectmodel.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $product = getProductById($conn, $id);
    if (!$product) {
        die("Không tìm thấy sản phẩm.");
    }
    // Lấy sản phẩm liên quan theo cùng danh mục
    $relatedProducts = [];
    if (!empty($product['category'])) {
        $relatedProducts = getRelatedProducts($conn, $product['category'], $product['id'], 8);
    }
} else {
    die("Không tìm thấy sản phẩm.");
}
?>