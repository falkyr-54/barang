/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100138 (10.1.38-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : u6595778_db_barang

 Target Server Type    : MySQL
 Target Server Version : 100138 (10.1.38-MariaDB)
 File Encoding         : 65001

 Date: 06/08/2025 09:23:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_satker` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_pegawai` int NOT NULL,
  `id_klaster` int NOT NULL,
  `nama_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `akses_level` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_hint` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `input_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edit_by` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 68, 352, 0, 'Die Hermawan', 'admin', 'admin', 'aa1f7c2e369c1c3624daf4a71300b597d8904e69', '141092Die', NULL, 'admin');
INSERT INTO `user` VALUES (4, 3, 104, 219, 0, 'Santoso', 'kelurahan', 'santoso', '96864a56c171f3164ce58895da289749f269f193', '*12345', NULL, 'admin');
INSERT INTO `user` VALUES (5, 4, 101, 78, 0, 'Erna Yusuf', 'kelurahan', 'erna', '96864a56c171f3164ce58895da289749f269f193', '*12345', NULL, 'admin');
INSERT INTO `user` VALUES (6, 2, 105, 338, 0, 'Galih Suciptianto', 'kelurahan', 'galih', '96864a56c171f3164ce58895da289749f269f193', '*12345', NULL, 'admin');
INSERT INTO `user` VALUES (7, 6, 102, 62, 0, 'Aditia Rossy', 'kelurahan', 'Rossy', '96864a56c171f3164ce58895da289749f269f193', '*12345', NULL, NULL);
INSERT INTO `user` VALUES (8, 5, 0, 275, 0, 'Endang Surjana', 'kelurahan', 'endang', '96864a56c171f3164ce58895da289749f269f193', '*12345', NULL, NULL);
INSERT INTO `user` VALUES (9, 1, 0, 75, 0, 'Gesit Kukilo Nugroho', 'admin', 'Gesit', '8cb2237d0679ca88db6464eac60da96345513964', '12345', NULL, 'admin');
INSERT INTO `user` VALUES (10, 1, 0, 438, 0, 'Pratika Dewi', 'admin', 'pratika', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', NULL, NULL);
INSERT INTO `user` VALUES (11, 1, 0, 441, 0, 'Arie Meutia Nada', 'admin', 'admin', 'fe26b2ef194f6e441ccc7eb7b13cbfe56dd74433', 'psrebo', NULL, NULL);
INSERT INTO `user` VALUES (12, 1, 0, 76, 0, 'Wirawan Wibowo', 'admin', 'Bowo', '348162101fc6f7e624681b7400b085eeac6df7bd', '54321', NULL, NULL);
INSERT INTO `user` VALUES (13, 1, 0, 137, 0, 'Carim', 'admin', 'Carim', '348162101fc6f7e624681b7400b085eeac6df7bd', '54321', NULL, NULL);
INSERT INTO `user` VALUES (15, 1, 0, 239, 0, 'Dwi Nurlita', 'admin', 'dwi.nurlita', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', NULL, NULL);
INSERT INTO `user` VALUES (16, 3, 1, 421, 0, 'Niken Susilowati', 'kapustu', 'niken', '212f610927b8cf29abea3e54da7d91939965689f', 'niken', NULL, NULL);
INSERT INTO `user` VALUES (17, 1, 0, 394, 2, 'Puspita Novariana', 'pj_klaster', 'nova', 'e5daba832cd4dfbb3bc3a365ce5d12ab091686af', 'nova', NULL, NULL);
INSERT INTO `user` VALUES (18, 1, 99, 199, 2, 'Fansa Martini', 'admin_poli', 'fansa', '26d572e4c355423e4656ff01e4100f9bf4f37146', 'fansa', NULL, NULL);
INSERT INTO `user` VALUES (19, 1, 0, 508, 1, 'Novian Irfandy Khresnatama', 'admin_barang', 'vian', '391eca22c0c0ec1c1eb4067711ab6d3e3aa5f75d', 'vian', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
