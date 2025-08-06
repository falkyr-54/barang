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

 Date: 06/08/2025 09:23:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for unit_bagian
-- ----------------------------
DROP TABLE IF EXISTS `unit_bagian`;
CREATE TABLE `unit_bagian`  (
  `id_unit` int NOT NULL AUTO_INCREMENT,
  `id_klaster` int NOT NULL,
  `unit` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_unit`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 127 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of unit_bagian
-- ----------------------------
INSERT INTO `unit_bagian` VALUES (6, 5, 'Loket Pendaftaran');
INSERT INTO `unit_bagian` VALUES (12, 5, 'Laboratorium');
INSERT INTO `unit_bagian` VALUES (18, 2, 'Ruang Bersalin');
INSERT INTO `unit_bagian` VALUES (33, 3, 'KPLDH');
INSERT INTO `unit_bagian` VALUES (53, 3, 'Poli Umum');
INSERT INTO `unit_bagian` VALUES (54, 2, 'Poli MTBS');
INSERT INTO `unit_bagian` VALUES (57, 1, 'Pengadaan Barang');
INSERT INTO `unit_bagian` VALUES (68, 1, 'Pengurus Barang');
INSERT INTO `unit_bagian` VALUES (69, 2, 'Poli PKPR');
INSERT INTO `unit_bagian` VALUES (72, 1, 'Tata Usaha');
INSERT INTO `unit_bagian` VALUES (73, 1, 'Keuangan');
INSERT INTO `unit_bagian` VALUES (75, 5, 'UGD');
INSERT INTO `unit_bagian` VALUES (77, 1, 'Pengolah UKP');
INSERT INTO `unit_bagian` VALUES (78, 4, 'Poli TB');
INSERT INTO `unit_bagian` VALUES (79, 4, 'Poli IMS');
INSERT INTO `unit_bagian` VALUES (80, 3, 'Poli Haji');
INSERT INTO `unit_bagian` VALUES (81, 1, 'Administrasi BPJS');
INSERT INTO `unit_bagian` VALUES (82, 2, 'Poli KIA');
INSERT INTO `unit_bagian` VALUES (83, 1, 'Kebersihan');
INSERT INTO `unit_bagian` VALUES (84, 1, 'Keamanan');
INSERT INTO `unit_bagian` VALUES (85, 3, 'Poli Prolanis');
INSERT INTO `unit_bagian` VALUES (86, 7, 'Poli Lansia');
INSERT INTO `unit_bagian` VALUES (87, 3, 'UKM');
INSERT INTO `unit_bagian` VALUES (88, 5, 'Farmasi');
INSERT INTO `unit_bagian` VALUES (89, 2, 'Poli Gigi');
INSERT INTO `unit_bagian` VALUES (90, 2, 'Poli Gizi');
INSERT INTO `unit_bagian` VALUES (92, 1, 'PJLP');
INSERT INTO `unit_bagian` VALUES (93, 1, 'Kepala Puskesmas');
INSERT INTO `unit_bagian` VALUES (94, 1, 'Diklat');
INSERT INTO `unit_bagian` VALUES (95, 1, 'Dapur/Laundry');
INSERT INTO `unit_bagian` VALUES (96, 3, 'Poli Berlian');
INSERT INTO `unit_bagian` VALUES (97, 1, 'CSSD');
INSERT INTO `unit_bagian` VALUES (98, 9, 'Poli Nursing Care');
INSERT INTO `unit_bagian` VALUES (99, 2, 'Nurse Station');
INSERT INTO `unit_bagian` VALUES (101, 6, 'Pkm Pekayon');
INSERT INTO `unit_bagian` VALUES (102, 10, 'Pkm Gedong');
INSERT INTO `unit_bagian` VALUES (103, 7, 'Pkm Kalisari');
INSERT INTO `unit_bagian` VALUES (104, 8, 'Pkm Cijantung');
INSERT INTO `unit_bagian` VALUES (105, 9, 'Pkm Baru');
INSERT INTO `unit_bagian` VALUES (106, 1, 'AULA');
INSERT INTO `unit_bagian` VALUES (107, 1, 'Vaksin');
INSERT INTO `unit_bagian` VALUES (108, 1, 'IT');
INSERT INTO `unit_bagian` VALUES (109, 1, 'PPTK');
INSERT INTO `unit_bagian` VALUES (110, 1, 'Kepegawaian');
INSERT INTO `unit_bagian` VALUES (111, 3, 'psikologi');
INSERT INTO `unit_bagian` VALUES (113, 1, 'JKN');
INSERT INTO `unit_bagian` VALUES (114, 1, 'foto copy');
INSERT INTO `unit_bagian` VALUES (115, 5, 'Layanan 24 Jam');
INSERT INTO `unit_bagian` VALUES (116, 3, 'Poli Permata');
INSERT INTO `unit_bagian` VALUES (117, 5, 'Kasir');
INSERT INTO `unit_bagian` VALUES (118, 1, 'MUTU');
INSERT INTO `unit_bagian` VALUES (119, 3, 'Poli Caten');
INSERT INTO `unit_bagian` VALUES (121, 1, 'Perencana');
INSERT INTO `unit_bagian` VALUES (122, 1, 'Security');
INSERT INTO `unit_bagian` VALUES (123, 1, 'Cleaning Service');
INSERT INTO `unit_bagian` VALUES (124, 1, 'Akupresur');
INSERT INTO `unit_bagian` VALUES (126, 3, 'PKG');

SET FOREIGN_KEY_CHECKS = 1;
