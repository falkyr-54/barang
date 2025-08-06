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

 Date: 06/08/2025 09:23:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for klaster
-- ----------------------------
DROP TABLE IF EXISTS `klaster`;
CREATE TABLE `klaster`  (
  `id_klaster` int NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_klaster`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of klaster
-- ----------------------------
INSERT INTO `klaster` VALUES (1, 'klaster 1');
INSERT INTO `klaster` VALUES (2, 'klaster 2');
INSERT INTO `klaster` VALUES (3, 'klaster 3');
INSERT INTO `klaster` VALUES (4, 'klaster 4');
INSERT INTO `klaster` VALUES (5, 'lintas klaster');
INSERT INTO `klaster` VALUES (6, 'klaster pekayon');
INSERT INTO `klaster` VALUES (7, 'klaster kalisari');
INSERT INTO `klaster` VALUES (8, 'klaster cijantung');
INSERT INTO `klaster` VALUES (9, 'klaster baru');
INSERT INTO `klaster` VALUES (10, 'klaster gedong');

SET FOREIGN_KEY_CHECKS = 1;
