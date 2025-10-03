<?php
include_once __DIR__ . '/../Public/config.php';

class ConnectModel {
    private $conn;
    
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
    
    public function selectall($sql) {
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }
    
    public function selectone($sql) {
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}

// Lấy tất cả sản phẩm
function getAllProducts($conn) {
    $sql = "SELECT * FROM products LIMIT 15";
    return $conn->query($sql);
}

// Lấy chi tiết sản phẩm theo id
function getProductById($conn, $id) {
    $id = intval($id);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

// Lấy sản phẩm liên quan theo danh mục, loại trừ id hiện tại
function getRelatedProducts($conn, $category, $excludeId, $limit = 8) {
    $excludeId = intval($excludeId);
    $categoryEscaped = $conn->real_escape_string($category);
    $limit = intval($limit);
    $sql = "SELECT * FROM products WHERE category = '" . $categoryEscaped . "' AND id <> $excludeId ORDER BY id DESC LIMIT $limit";
    $result = $conn->query($sql);
    $items = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items;
}

// Lấy danh sách sản phẩm theo danh mục (phục vụ trang liên quan)
function getProductsByCategory($conn, $category, $limit = 50, $offset = 0) {
    $categoryEscaped = $conn->real_escape_string($category);
    $limit = intval($limit);
    $offset = intval($offset);
    $sql = "SELECT * FROM products WHERE category = '" . $categoryEscaped . "' ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    $items = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items;
}
?>