CREATE TABLE `loai_hang_hoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ten_loai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `loai_hang_hoa` (`ten_loai`) VALUES
('Laptop','2023-04-11 20:54:03'),
('SamSung','2023-04-11 20:54:03'),
('iPhone');


CREATE TABLE `hang_hoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ten_hang_hoa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `so_luong_hang` int(11) NOT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_loai` int(11) NOT NULL,
  `ngaynhap` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_hang_hoa_loai_hang_hoa` FOREIGN KEY (`id_loai`) REFERENCES `loai_hang_hoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO `hang_hoa` ( `ten_hang_hoa`,`gia`, `so_luong_hang`, `hinh`, `mo_ta`, `id_loai`,`ngaynhap`) VALUES
('Điện thoại Samsung Galaxy Note 10+',15900000, 90, '12333.png', 'mo_ta', 2,'2023-04-11 20:54:03'),
('Điện thoại Samsung Galaxy A21s (6GB/64GB)',52900000, 96, 'samsung-galaxy-a21s-055620-045627-400x460.png', 'mo_ta', 2,'2023-04-11 20:51:03'),
('Điện thoại Samsung Galaxy Note 20 Ultra',29900000, 97, 'samsung-galaxy-note-20-ultra-vangdong-400x460-400x460.png', 'mo_ta', 2,'2023-04-11 21:54:03'),
('Điện thoại Samsung Galaxy Z Flip',36000000, 96, 'samsung-galaxy-z-flip-chitiet-2-788x544.png', 'mo_ta', 2,'2023-04-11 20:14:03'),
('Điện thoại Samsung Galaxy Z Fold2 5G',50000000, 97, 'samsung-galaxy-z-fold-2-123620-093621-400x460.png', 'mo_ta', 2,'2023-04-11 20:12:03'),
('Điện thoại iPhone 8 Plus 128GB',14900000, 99, 'ip8s.jpg', 'mo_ta', 3,'2023-04-11 20:41:03'),
('Điện thoại iPhone 7 Plus 128GB', 11490000, 99, 'iphone-7-plus-128gb-de-400x460.png', 'mo_ta', 3,'2023-04-11 20:14:13'),
('Điện thoại iPhone SE 64GB (2020)',12900000, 49, 'iphone-se-2020-do-400x460-400x460.png', 'mo_ta', 3,'2023-04-11 20:24:23'),
('Điện thoại iPhone 11 Pro 256GB',31900000, 26, 'ip11pr.jpg', 'mo_ta', 3,'2023-04-11 20:34:33'),
('Laptop HP Envy 13 ba0046TU i5 1035G4/8GB/512GB/Office H&S2019/Win10 (171M7PA)',22900000, 19, 'hp-envy-13-ba0046tu-i5-171m7pa-225859-600x600.jpg', 'mo_ta', 1,'2023-04-21 20:44:33'),
('Laptop Asus VivoBook Gaming F571GT i7 9750H/8GB/512GB/120Hz/4GB GTX1650/Win10 (AL858T)',24490000, 18, 'asus-vivobook-gaming-f571gt-i7-al858t-226256-600x600.jpg', 'mo_ta', 1,'2023-04-11 20:04:43'),
('Laptop Lenovo IdeaPad Slim 3 15IIL05 i3 1005G1/4GB/512GB/Win10 (81WE003RVN)', 25000000, 5, 'lenovo-ideapad-3-15iil05-i3-81we003rvn-013920-053901-600x600.jpg', 'mo_ta',1,'2023-04-11 20:01:11')
CREATE TABLE `khach_hang` (
  `id` bigint(20) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `so_dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE ,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- pass=123456(sha1)
INSERT INTO `khach_hang` (`ten`, `dia_chi`, `so_dien_thoai`, `email`,`mat_khau`) VALUES
('doanhuuvinh','angiang','0912345687','doanhuuvinh@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','2023-04-11 20:54:03'),
('ducvinh','cantho','0984568267','ducvinh@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b');

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE ,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--pass=123456(sha1)
INSERT INTO `admin` (`ten`,`email`,`mat_khau`) VALUES
('doanhuuvinh','vinhadmin@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','2023-04-11 20:54:03'),
('ducvinh','ducvinhadmin@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b');
