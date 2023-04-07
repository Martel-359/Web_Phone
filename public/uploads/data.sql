CREATE TABLE `loai_hang_hoa` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `ten_loai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `loai_hang_hoa` (`id`, `ten_loai`) VALUES
(1, 'Laptop'),
(2, 'SamSung'),
(3, 'iPhone');


CREATE TABLE `hang_hoa` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `ten_hang_hoa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `so_luong_hang` int(11) NOT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_loai` int(11) NOT NULL,
  CONSTRAINT `fk_hang_hoa_loai_hang_hoa` FOREIGN KEY (`id_loai`) REFERENCES `loai_hang_hoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `hang_hoa` (`id`, `ten_hang_hoa`,`gia`, `so_luong_hang`, `hinh`, `mo_ta`, `id_loai`) VALUES
(1, 'Điện thoại Samsung Galaxy Note 10+',15900000, 90, 'uploads/12333.png', 'mo_ta', 2),
(2, 'Điện thoại Samsung Galaxy A21s (6GB/64GB)',52900000, 96, 'uploads/samsung-galaxy-a21s-055620-045627-400x460.png', 'mo_ta', 2),
(3, 'Điện thoại Samsung Galaxy Note 20 Ultra',29900000, 97, 'uploads/samsung-galaxy-note-20-ultra-vangdong-400x460-400x460.png', 'mo_ta', 2),
(4, 'Điện thoại Samsung Galaxy Z Flip',36000000, 96, 'uploads/samsung-galaxy-z-flip-chitiet-2-788x544.png', 'mo_ta', 2),
(5, 'Điện thoại Samsung Galaxy Z Fold2 5G',50000000, 97, 'uploads/samsung-galaxy-z-fold-2-123620-093621-400x460.png', 'mo_ta', 2),
(6, 'Điện thoại iPhone 8 Plus 128GB',14900000, 99, 'uploads/ip8s.jpg', 'mo_ta', 3),
(7, 'Điện thoại iPhone 7 Plus 128GB', 11490000, 99, 'uploads/iphone-7-plus-128gb-de-400x460.png', 'mo_ta', 3),
(8, 'Điện thoại iPhone SE 64GB (2020)',12900000, 49, 'uploads/iphone-se-2020-do-400x460-400x460.png', 'mo_ta', 3),
(9, 'Điện thoại iPhone 11 Pro 256GB',31900000, 26, 'uploads/ip11pr.jpg', 'mo_ta', 3),
(10, 'Laptop HP Envy 13 ba0046TU i5 1035G4/8GB/512GB/Office H&S2019/Win10 (171M7PA)',22900000, 19, 'uploads/hp-envy-13-ba0046tu-i5-171m7pa-225859-600x600.jpg', 'mo_ta', 1),
(11, 'Laptop Asus VivoBook Gaming F571GT i7 9750H/8GB/512GB/120Hz/4GB GTX1650/Win10 (AL858T)',24490000, 18, 'uploads/asus-vivobook-gaming-f571gt-i7-al858t-226256-600x600.jpg', 'mo_ta', 1),
(12, 'Laptop Lenovo IdeaPad Slim 3 15IIL05 i3 1005G1/4GB/512GB/Win10 (81WE003RVN)', 25000000, 5, 'uploads/lenovo-ideapad-3-15iil05-i3-81we003rvn-013920-053901-600x600.jpg', 'mo_ta',1);

CREATE TABLE `khach_hang` (
  `id` bigint(20) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `so_dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE ,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- pass=123456(MD5)
INSERT INTO `khach_hang` (`id`, `ten`, `dia_chi`, `so_dien_thoai`, `email`,`mat_khau`) VALUES
(1,'doanhuuvinh','angiang','0912345687','doanhuuvinh@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2,'ducvinh','cantho','0984568267','ducvinh@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b');

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED  NOT NULL PRIMARY KEY,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci ,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE ,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--pass=123456(MD5)
INSERT INTO `admin` (`id`, `ten`,`email`,`mat_khau`) VALUES
(1,'doanhuuvinh','vinhadmin@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2,'ducvinh','ducvinhadmin@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b');
