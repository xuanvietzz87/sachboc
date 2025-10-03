
DROP DATABASE IF EXISTS `vietbook`;

CREATE DATABASE `vietbook` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `vietbook`;

CREATE TABLE `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `price` DECIMAL(12,0) NOT NULL DEFAULT 0,
  `image` VARCHAR(500) NOT NULL,
  `description` TEXT NULL,
  `category` VARCHAR(50) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`title`, `author`, `price`, `image`, `description`, `category`) VALUES
('Truyện Kiều', 'Paulo Nguyễn Du', 95000, 'images/1.jpg', 'Một tác phẩm kinh điển truyền cảm hứng về hành trình cuộc sống.', 'văn học'),
('Đắc Nhân Tâm', 'Dale Carnegie', 120000, 'images/2.jpg', 'Cuốn sách kỹ năng sống bán chạy nhất mọi thời đại.', 'Thiếu nhi'),
('Tuổi Trẻ Đáng Giá Bao Nhiêu', 'Rosie Nguyễn', 110000, 'images/3.jpg', 'Thông điệp ý nghĩa dành cho tuổi trẻ, cách sống và ước mơ.', 'Thiếu nhi'),
('Truyện Kiều', 'Nguyễn Du', 150000, 'images/4.jpg', 'Tác phẩm văn học kinh điển của Việt Nam.', 'văn học'),
('Sapiens: Lược Sử Loài Người', 'Yuval Noah Harari', 143000, 'images/5.jpg', 'Khám phá lịch sử và sự phát triển của loài người.', 'Lịch sử'),
('Totto-chan Bên Cửa Sổ', 'Kuroyanagi Tetsuko', 98000, 'images/6.jpg', 'Câu chuyện xúc động về tuổi thơ và giáo dục.', 'Thiếu nhi'),
('Muôn Kiếp Nhân Sinh', 'Nguyên Phong', 185000, 'images/7.jpg', 'Tác phẩm sâu sắc về nhân quả và cuộc đời.', 'văn học'),
('Sherlock Holmes Toàn Tập', 'Arthur Conan Doyle', 320000, 'images/8.jpg', 'Tuyển tập những vụ án nổi tiếng của Sherlock Holmes.', 'văn học'),
('Để Men Phiêu Lưu Ký', 'Tô Hoài', 85000, 'images/9.jpg', 'Tác phẩm thiếu nhi nổi tiếng của văn học Việt Nam.', 'Lịch sử'),
('Harry Potter và Hòn Đá Phù Thủy', 'J.K. Rowling', 155000, 'images/1.jpg', 'Tập đầu tiên trong series Harry Potter.', 'Thiếu nhi'),
('Harry Potter và Phòng Chứa Bí Mật', 'J.K. Rowling', 165000, 'images/2.jpg', 'Tập 2 tiếp tục câu chuyện tại Hogwarts.', 'Văn học'),
('Harry Potter và Tên Tù Nhân Ngục Azkaban', 'J.K. Rowling', 175000, 'images/3.jpg', 'Tập 3 với sự xuất hiện của Sirius Black.', 'Thiếu nhi'),
('Harry Potter và Chiếc Cốc Lửa', 'J.K. Rowling', 185000, 'images/4.jpg', 'Tập 4 với giải đấu Tam Pháp Thuật.', 'Thiếu nhi'),
('Harry Potter và Hội Phượng Hoàng', 'J.K. Rowling', 195000, 'images/5.jpg', 'Tập 5, cuộc chiến chống lại Voldemort bắt đầu.', 'Kĩ năng sống'),
('Harry Potter và Hoàng Tử Lai', 'J.K. Rowling', 205000, 'images/6.jpg', 'Tập 6 tiết lộ nhiều bí mật về quá khứ của Voldemort.', 'Kinh tế');
