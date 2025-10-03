<?php
include_once __DIR__ . '/../Model/connectmodel.php';

// Danh mục hiển thị: lấy động từ DB để trùng khớp dữ liệu thực tế
$categoriesMap = [];
$catRes = $conn->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category <> '' ORDER BY category ASC");
if ($catRes && $catRes->num_rows > 0) {
    while ($r = $catRes->fetch_assoc()) {
        $label = $r['category'];
        $categoriesMap[$label] = $label; // key = value = tiếng Việt hoặc key hiện có trong DB
    }
}
// Fallback nếu DB rỗng danh mục
if (empty($categoriesMap)) {
    $categoriesMap = [
        'Văn học' => 'Văn học',
        'Kỹ năng sống' => 'Kỹ năng sống',
        'Thiếu nhi' => 'Thiếu nhi',
        'Lịch sử' => 'Lịch sử',
        'Công nghệ' => 'Công nghệ',
        'Kinh tế' => 'Kinh tế',
        'Giáo dục' => 'Giáo dục',
        'Khoa học' => 'Khoa học'
    ];
}

// Tham số filter
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort     = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// Hỗ trợ đồng thời cả nhãn tiếng Việt và key tiếng Anh trong DB
$enToVn = [
    'technology' => 'Công nghệ',
    'literature' => 'Văn học',
    'business'   => 'Kinh tế',
    'education'  => 'Giáo dục',
    'self_help'  => 'Kỹ năng sống',
    'children'   => 'Thiếu nhi',
    'history'    => 'Lịch sử',
    'science'    => 'Khoa học'
];
$vnToEn = array_flip($enToVn);

// Xây where clause an toàn
$where = "WHERE 1=1";
if ($category !== '') {
    $values = [];
    $values[] = $category; // giá trị được chọn
    if (isset($vnToEn[$category])) { // nếu chọn VN, thêm key EN tương ứng
        $values[] = $vnToEn[$category];
    }
    if (isset($enToVn[$category])) { // nếu chọn EN, thêm nhãn VN tương ứng
        $values[] = $enToVn[$category];
    }
    // unique và escape
    $values = array_values(array_unique(array_filter($values)));
    $escaped = array_map(function($v) use ($conn) { return "'" . $conn->real_escape_string($v) . "'"; }, $values);
    $where .= " AND category IN (" . implode(",", $escaped) . ")";
}
if ($search !== '') {
    $s = $conn->real_escape_string($search);
    $where .= " AND (title LIKE '%" . $s . "%' OR author LIKE '%" . $s . "%')";
}

// Sắp xếp
$orderBy = " ORDER BY id DESC";
switch ($sort) {
    case 'price_low':
        $orderBy = " ORDER BY price ASC"; break;
    case 'price_high':
        $orderBy = " ORDER BY price DESC"; break;
    case 'name':
        $orderBy = " ORDER BY title ASC"; break;
}

// Truy vấn danh sách
$sql = "SELECT * FROM products " . $where . $orderBy . " LIMIT 24";
$products = $conn->query($sql);

// Biến phục vụ view
$categories = $categoriesMap;
?>